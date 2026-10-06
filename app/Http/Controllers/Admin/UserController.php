<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->with('facility')->orderBy('name')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        $managedUser = new User;
        $facilities = Facility::query()->orderBy('name')->get();

        return view('admin.users.create', compact('facilities', 'managedUser'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_FACILITY_ADMIN])],
            'facility_id' => ['exclude_unless:role,'.User::ROLE_FACILITY_ADMIN, 'required', 'integer', 'exists:facilities,id'],
        ]);

        $validated['facility_id'] = $validated['role'] === User::ROLE_FACILITY_ADMIN
            ? (int) $validated['facility_id']
            : null;

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Admin account created.');
    }

    public function edit(User $user): View
    {
        $managedUser = $user;
        $facilities = Facility::query()->orderBy('name')->get();

        return view('admin.users.edit', compact('facilities', 'managedUser'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_FACILITY_ADMIN])],
            'facility_id' => ['exclude_unless:role,'.User::ROLE_FACILITY_ADMIN, 'required', 'integer', 'exists:facilities,id'],
        ]);

        $validated['facility_id'] = $validated['role'] === User::ROLE_FACILITY_ADMIN
            ? (int) $validated['facility_id']
            : null;

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        if (Auth::user()->is($user)
            && ($user->role !== $validated['role'] || (int) $user->facility_id !== (int) $validated['facility_id'])) {
            throw ValidationException::withMessages([
                'role' => 'You cannot change your own administrator role or facility assignment.',
            ]);
        }

        if ($user->isSuperAdmin()
            && $validated['role'] !== User::ROLE_SUPER_ADMIN
            && User::where('role', User::ROLE_SUPER_ADMIN)->count() === 1) {
            throw ValidationException::withMessages([
                'role' => 'The final Super Admin account cannot be downgraded.',
            ]);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Admin account updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (Auth::user()->is($user)) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own admin account.');
        }

        if ($user->isSuperAdmin() && User::where('role', User::ROLE_SUPER_ADMIN)->count() === 1) {
            return redirect()->route('admin.users.index')->with('error', 'The final Super Admin account cannot be deleted.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Admin account deleted.');
    }
}
