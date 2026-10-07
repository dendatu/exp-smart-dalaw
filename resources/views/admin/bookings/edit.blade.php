@extends('layouts.admin')

@section('title', 'Edit Visit | SmartDalaw')

@section('content')
    <div class="max-w-3xl">
        <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-[#0A2472] hover:underline">&larr; Booking requests</a>
        <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase text-[#0A2472]">{{ $booking->reference_code }}</p>
                <h1 class="mt-1 text-2xl font-bold text-[#102044]">Edit visit</h1>
            </div>
            <span class="w-fit rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-[#0A2472]">Current status: {{ $booking->status }}</span>
        </div>
        <p class="mt-2 text-sm text-slate-600">Update schedule or visitor details. Editing does not change the approval status.</p>

        @include('bookings.partials.status-history', ['booking' => $booking])

        <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="mt-7 space-y-5 border-y border-slate-200 bg-white py-6">
            @csrf
            @method('PUT')

            <div>
                <label for="facility_id" class="mb-2 block text-sm font-semibold text-slate-800">Facility</label>
                <select id="facility_id" name="facility_id" required class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                    @foreach($facilities as $facility)
                        <option value="{{ $facility->id }}" @selected(old('facility_id', $booking->facility_id) == $facility->id)>{{ $facility->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="pdl_name" class="mb-2 block text-sm font-semibold text-slate-800">Person deprived of liberty (PDL) Name</label>
                <input type="text" id="pdl_name" name="pdl_name" value="{{ old('pdl_name', $booking->pdl_name) }}" required maxlength="255" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="visit_date" class="mb-2 block text-sm font-semibold text-slate-800">Visit date</label>
                    <input type="date" id="visit_date" name="visit_date" value="{{ old('visit_date', $booking->visit_date->format('Y-m-d')) }}" min="{{ today()->addDay()->format('Y-m-d') }}" required class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label for="time_slot" class="mb-2 block text-sm font-semibold text-slate-800">Time slot</label>
                    <select id="time_slot" name="time_slot" required class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                        @foreach(['8:00 AM - 9:00 AM', '9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '1:00 PM - 2:00 PM', '2:00 PM - 3:00 PM', '3:00 PM - 4:00 PM'] as $timeSlot)
                            <option value="{{ $timeSlot }}" @selected(old('time_slot', $booking->time_slot) === $timeSlot)>{{ $timeSlot }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="visitor_full_name" class="mb-2 block text-sm font-semibold text-slate-800">Visitor full name</label>
                <input type="text" id="visitor_full_name" name="visitor_full_name" value="{{ old('visitor_full_name', $booking->visitor_full_name) }}" required maxlength="255" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="visitor_contact" class="mb-2 block text-sm font-semibold text-slate-800">Contact number</label>
                    <input type="tel" id="visitor_contact" name="visitor_contact" value="{{ old('visitor_contact', $booking->visitor_contact) }}" required maxlength="20" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label for="visitor_email" class="mb-2 block text-sm font-semibold text-slate-800">Email <span class="font-normal text-slate-500">(optional)</span></label>
                    <input type="email" id="visitor_email" name="visitor_email" value="{{ old('visitor_email', $booking->visitor_email) }}" maxlength="255" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="visitor_sex" class="mb-2 block text-sm font-semibold text-slate-800">
                        Sex
                    </label>

                    <select
                        id="visitor_sex"
                        name="visitor_sex"
                        required
                        class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100"
                    >
                        <option value="">Select sex</option>

                        <option value="Male"
                            @selected(old('visitor_sex', $booking->visitor_sex) === 'Male')>
                            Male
                        </option>

                        <option value="Female"
                            @selected(old('visitor_sex', $booking->visitor_sex) === 'Female')>
                            Female
                        </option>
                    </select>
                </div>
                <div>
                    <label for="visitor_age" class="mb-2 block text-sm font-semibold text-slate-800">Age</label>
                    <input type="number" id="visitor_age" name="visitor_age" value="{{ old('visitor_age', $booking->visitor_age) }}" required min="1" max="120" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="visitor_id_type" class="mb-2 block text-sm font-semibold text-slate-800">Type of valid ID</label>
                    <input type="text" id="visitor_id_type" name="visitor_id_type" value="{{ old('visitor_id_type', $booking->visitor_id_type) }}" required maxlength="50" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
                <div>
                    <label for="visitor_id_number" class="mb-2 block text-sm font-semibold text-slate-800">ID number</label>
                    <input type="text" id="visitor_id_number" name="visitor_id_number" value="{{ old('visitor_id_number', $booking->visitor_id_number) }}" required maxlength="50" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                </div>
            </div>

            <div>
                <label for="relationship_to_pdl" class="mb-2 block text-sm font-semibold text-slate-800">Relationship to PDL</label>
                <input type="text" id="relationship_to_pdl" name="relationship_to_pdl" value="{{ old('relationship_to_pdl', $booking->relationship_to_pdl) }}" required maxlength="100" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2.5 text-sm focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex min-h-10 items-center justify-center rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
                <button type="submit" class="inline-flex min-h-10 items-center justify-center rounded-md bg-[#0A2472] px-4 py-2 text-sm font-semibold text-white hover:bg-[#071D54]">Save booking</button>
            </div>
        </form>
    </div>
@endsection