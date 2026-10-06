<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class FacilitySettingsController extends Controller
{
    public function index(): View
    {
        $facilities = Facility::visibleToUser(auth()->user())->orderBy('name')->get();

        return view('admin.facilities.settings', compact('facilities'));
    }

    public function updateCapacity(Request $request, Facility $facility): RedirectResponse
    {
        $facility = Facility::visibleToUser($request->user())->whereKey($facility->id)->firstOrFail();
        $validated = $request->validate([
            'max_visitors_per_hour' => ['required', 'integer', 'min:1', 'max:10000'],
        ]);

        $facility->update($validated);

        return redirect()->route('admin.facilities.settings')->with('success', 'Hourly visitor limit updated.');
    }

    public function updateBranding(Request $request, Facility $facility): RedirectResponse
    {
        $facility = Facility::visibleToUser($request->user())->whereKey($facility->id)->firstOrFail();
        $validated = $request->validate([
            'regional_office' => ['nullable', 'string', 'max:150'],
            'jail_unit_name' => ['nullable', 'string', 'max:150'],
            'badge_image' => ['nullable', File::image()->types(['jpg', 'jpeg', 'png', 'webp'])->max('2mb')],
        ]);

        $badge = $validated['badge_image'] ?? null;
        unset($validated['badge_image']);

        $previousBadgePath = $facility->badge_image_path;
        if ($badge instanceof UploadedFile) {
            $badgePath = $badge->store("facility-badges/{$facility->id}", 'public');

            if (! $badgePath) {
                throw ValidationException::withMessages([
                    'badge_image' => 'The facility badge could not be stored. Please try again.',
                ]);
            }

            $validated['badge_image_path'] = $badgePath;
        }

        $facility->update($validated);

        if ($badge instanceof UploadedFile && $previousBadgePath) {
            Storage::disk('public')->delete($previousBadgePath);
        }

        return redirect()->route('admin.facilities.settings')->with('success', 'Facility identity details updated.');
    }
}
