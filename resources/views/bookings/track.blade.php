@extends('layouts.portal')

@section('title', 'My Bookings | SmartDalaw')

@section('content')
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <p class="text-xs font-semibold uppercase text-[#0A2472]">Booking status</p>
            <h1 class="mt-2 text-3xl font-bold text-[#102044] sm:text-4xl">My Bookings</h1>
            <p class="mt-3 text-sm leading-6 text-slate-600">Enter the reference code you received after submitting a visit request.</p>

            @if(session('error'))
                <div class="mt-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">{{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="mt-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">{{ $errors->first('reference_code') }}</div>
            @endif

            <div class="mt-8 rounded-lg border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
                <h2 class="text-lg font-semibold text-slate-900">Look up a booking</h2>
                <p class="mt-1 text-sm text-slate-600">Your reference code starts with BJMP-.</p>
                <form action="{{ route('bookings.track.search') }}" method="POST" class="mt-5">
                    @csrf
                    <label for="reference_code" class="mb-2 block text-sm font-semibold text-slate-800">Booking reference code</label>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <input type="text" id="reference_code" name="reference_code" value="{{ old('reference_code') }}" required autocomplete="off" autocapitalize="characters" placeholder="BJMP-XXXXXX" class="min-h-12 min-w-0 flex-1 rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm uppercase text-slate-900 placeholder:normal-case placeholder:text-slate-400 focus:border-[#0A2472] focus:outline-none focus:ring-2 focus:ring-blue-100">
                        <button type="submit" class="min-h-12 rounded-lg bg-[#0A2472] px-6 py-3 text-sm font-semibold text-white hover:bg-[#071D54] focus:outline-none focus:ring-2 focus:ring-[#0A2472] focus:ring-offset-2">Find booking</button>
                    </div>
                </form>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-lg border border-slate-200 bg-white p-5">
                    <h2 class="text-sm font-semibold text-slate-900">Where to find your code</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Your reference code appears on the booking confirmation page after you submit your request. Keep it somewhere safe.</p>
                </div>
                <div class="rounded-lg border border-slate-200 bg-white p-5">
                    <h2 class="text-sm font-semibold text-slate-900">Need to make a booking?</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Start a new visit request and get a reference code when it is submitted.</p>
                    <a href="{{ route('bookings.create') }}" class="mt-3 inline-block text-sm font-semibold text-[#0A2472] underline decoration-blue-200 underline-offset-4">Book a visit</a>
                </div>
            </div>
        </div>
    </section>
@endsection