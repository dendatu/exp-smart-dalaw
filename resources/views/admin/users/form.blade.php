<form action="{{ $formAction }}" method="POST" class="mt-7 space-y-5">
    @csrf
    @if($isEditing)
        @method('PUT')
    @endif

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold text-slate-800">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $managedUser->name) }}" required maxlength="255" autocomplete="name" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
    </div>

    <div>
        <label for="email" class="mb-2 block text-sm font-semibold text-slate-800">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $managedUser->email) }}" required maxlength="255" autocomplete="email" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
    </div>

    <div>
        <label for="role" class="mb-2 block text-sm font-semibold text-slate-800">Admin role</label>
        <select id="role" name="role" required class="select select-bordered w-full bg-base-100">
            <option value="super_admin" @selected(old('role', $managedUser->role ?? 'super_admin') === 'super_admin')>Super Admin - system-wide access</option>
            <option value="facility_admin" @selected(old('role', $managedUser->role ?? 'super_admin') === 'facility_admin')>Facility Admin - one assigned facility</option>
        </select>
    </div>

    <div id="facility-assignment-field">
        <label for="facility_id" class="mb-2 block text-sm font-semibold text-slate-800">Assigned facility</label>
        <select id="facility_id" name="facility_id" class="select select-bordered w-full bg-base-100">
            <option value="">Select a facility</option>
            @foreach($facilities as $facility)
                <option value="{{ $facility->id }}" @selected((string) old('facility_id', $managedUser->facility_id) === (string) $facility->id)>{{ $facility->name }}</option>
            @endforeach
        </select>
        <p class="mt-1.5 text-xs text-slate-500">Facility Admins are limited to this facility's bookings, queue, analytics, and settings.</p>
    </div>

    <div>
        <label for="password" class="mb-2 block text-sm font-semibold text-slate-800">{{ $isEditing ? 'New password' : 'Password' }}</label>
        <input type="password" id="password" name="password" @if(! $isEditing) required @endif minlength="8" autocomplete="new-password" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
        @if($isEditing)
            <p class="mt-1.5 text-xs text-slate-500">Leave blank to keep the current password.</p>
        @else
            <p class="mt-1.5 text-xs text-slate-500">Use at least 8 characters.</p>
        @endif
    </div>

    <div>
        <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-800">Confirm password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" @if(! $isEditing) required @endif minlength="8" autocomplete="new-password" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.users.index') }}" class="inline-flex min-h-10 items-center justify-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
        <button type="submit" class="inline-flex min-h-10 items-center justify-center rounded-md bg-[#0A2472] px-4 py-2 text-sm font-semibold text-white hover:bg-[#071D54]">{{ $isEditing ? 'Save changes' : 'Create account' }}</button>
    </div>
</form>

<script>
    const adminRoleSelect = document.getElementById('role');
    const assignedFacilitySelect = document.getElementById('facility_id');
    const facilityAssignmentField = document.getElementById('facility-assignment-field');

    function updateFacilityAssignmentField() {
        const requiresFacility = adminRoleSelect.value === 'facility_admin';

        assignedFacilitySelect.required = requiresFacility;
        facilityAssignmentField.classList.toggle('hidden', !requiresFacility);

        if (!requiresFacility) {
            assignedFacilitySelect.value = '';
        }
    }

    adminRoleSelect.addEventListener('change', updateFacilityAssignmentField);
    updateFacilityAssignmentField();
</script>