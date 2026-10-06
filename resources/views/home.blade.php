@extends('layouts.portal')

@section('title', 'SmartDalaw | Official BJMP Visitation Booking')

@section('content')
    <section class="bg-white">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 py-14 sm:px-6 sm:py-20 lg:grid-cols-[1.1fr_0.9fr] lg:px-8 lg:py-24">
            <div class="max-w-2xl">
                <p class="inline-flex rounded-full border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-[#0A2472]">Official BJMP e-Service</p>
                <h1 class="mt-6 text-4xl font-bold leading-tight text-[#102044] sm:text-5xl">Book a Jail Visit Safely &amp; Easily Online</h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-slate-600 sm:text-lg">SmartDalaw lets family and loved ones schedule in-person visits at BJMP facilities without the long lines. Fast, secure, and available 24/7.</p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary min-h-12 px-6">Book a Visit Now</a>
                    <a href="{{ route('bookings.track') }}" class="btn btn-outline min-h-12 border-base-300 bg-base-100 px-6 text-base-content">Check My Booking</a>
                </div>
                <p class="mt-5 text-xs text-slate-500">Free to use. No booking agents or service fees.</p>
            </div>

            <div class="mx-auto w-full max-w-md">
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-xl shadow-blue-950/10 sm:p-7">
                    <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-5">
                        <div>
                            <p class="text-xs font-semibold uppercase text-[#0A2472]">Your visit, organized</p>
                            <h2 class="mt-1 text-lg font-bold text-slate-900">One clear booking flow</h2>
                        </div>
                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Secure</span>
                    </div>
                    <div class="mt-5 flex items-center gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-bold text-[#0A2472]">SD</span>
                        <div>
                            <p class="font-semibold text-slate-900">Your booking details</p>
                            <p class="mt-1 text-sm text-slate-500">Facility, date, and visitor information</p>
                        </div>
                    </div>
                    <ol class="mt-6 grid gap-4">
                        <li class="flex items-center gap-3"><span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#0A2472] text-xs font-semibold text-white">1</span><span class="text-sm text-slate-700">Choose a facility and time</span></li>
                        <li class="flex items-center gap-3"><span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-xs font-semibold text-[#0A2472]">2</span><span class="text-sm text-slate-700">Add visitor and PDL details</span></li>
                        <li class="flex items-center gap-3"><span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-xs font-semibold text-[#0A2472]">3</span><span class="text-sm text-slate-700">Submit and keep your reference code</span></li>
                    </ol>
                    <div class="mt-6 rounded-lg bg-[#F6F8FB] p-4">
                        <p class="text-xs font-semibold text-slate-500">AFTER YOU SUBMIT</p>
                        <p class="mt-1 text-sm leading-6 text-slate-700">Track approval online and present your booking QR code at the facility gate.</p>
                    </div>
                </div>
                <p class="mt-4 text-center text-xs text-slate-500">Keep your reference code to check your booking status.</p>
            </div>
        </div>
    </section>

    <section aria-labelledby="justice-pillars-heading" class="border-y border-base-300 bg-base-200">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 md:grid-cols-[minmax(12rem,0.7fr)_minmax(0,1.3fr)] md:items-center lg:px-8">
            <div class="flex items-center gap-4">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full border-2 border-primary bg-base-100 text-2xl text-primary" aria-hidden="true">⚖</span>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-base-content/60">Republic of the Philippines</p>
                    <h2 id="justice-pillars-heading" class="mt-1 text-sm font-bold text-base-content">BJMP · Corrections</h2>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase text-base-content/60">Five pillars of the criminal justice system</p>
                <ul class="mt-3 grid grid-cols-2 gap-2 text-xs font-medium text-base-content sm:grid-cols-3 lg:grid-cols-5">
                    <li class="rounded-md border border-base-300 bg-base-100 px-3 py-2">Law enforcement</li>
                    <li class="rounded-md border border-base-300 bg-base-100 px-3 py-2">Prosecution</li>
                    <li class="rounded-md border border-base-300 bg-base-100 px-3 py-2">Courts</li>
                    <li class="rounded-md border border-primary bg-primary px-3 py-2 text-primary-content">Corrections</li>
                    <li class="rounded-md border border-base-300 bg-base-100 px-3 py-2">Community</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="mx-auto max-w-7xl px-4 py-14 sm:px-6 sm:py-16 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <p class="text-xs font-semibold uppercase text-[#0A2472]">How it works</p>
            <h2 class="mt-2 text-3xl font-bold text-[#102044]">Book in 3 simple steps</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">No lines. No hassle. Done from your phone.</p>
        </div>
        <div class="mt-9 grid gap-4 md:grid-cols-3">
            <article class="rounded-lg border border-slate-200 bg-white p-6">
                <p class="text-xs font-bold text-[#0A2472]">STEP 01</p>
                <h3 class="mt-3 text-base font-semibold text-slate-900">Choose facility &amp; schedule</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Select the facility, choose a visit date, and pick an available time slot.</p>
            </article>
            <article class="rounded-lg border border-slate-200 bg-white p-6">
                <p class="text-xs font-bold text-[#0A2472]">STEP 02</p>
                <h3 class="mt-3 text-base font-semibold text-slate-900">Enter visitor &amp; PDL information</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Provide your details, a valid ID, and the name of the person you are visiting.</p>
            </article>
            <article class="rounded-lg border border-slate-200 bg-white p-6">
                <p class="text-xs font-bold text-[#0A2472]">STEP 03</p>
                <h3 class="mt-3 text-base font-semibold text-slate-900">Confirm &amp; get your reference</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Submit your request, track its status, and show your QR code when approved.</p>
            </article>
        </div>
        <div class="mt-8 text-center">
            <a href="{{ route('bookings.create') }}" class="btn btn-primary">Start Booking</a>
        </div>
    </section>

    <section id="requirements" class="border-y border-slate-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 sm:py-16 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
            <div>
                <p class="text-xs font-semibold uppercase text-[#0A2472]">Before you visit</p>
                <h2 class="mt-2 text-3xl font-bold text-[#102044]">Requirements &amp; reminders</h2>
                <p class="mt-3 max-w-md text-sm leading-6 text-slate-600">Prepare these before arriving at the facility. All visitors are subject to security screening upon entry.</p>
            </div>
            <ul class="grid gap-3 sm:grid-cols-2">
                <li class="rounded-lg bg-[#F6F8FB] p-4"><h3 class="text-sm font-semibold text-slate-900">Valid government-issued ID</h3><p class="mt-1 text-xs leading-5 text-slate-600">Bring the same ID used in your booking.</p></li>
                <li class="rounded-lg bg-[#F6F8FB] p-4"><h3 class="text-sm font-semibold text-slate-900">Proper attire</h3><p class="mt-1 text-xs leading-5 text-slate-600">Dress modestly and follow facility rules.</p></li>
                <li class="rounded-lg bg-[#F6F8FB] p-4"><h3 class="text-sm font-semibold text-slate-900">No prohibited items</h3><p class="mt-1 text-xs leading-5 text-slate-600">Restricted items are not allowed inside.</p></li>
                <li class="rounded-lg bg-[#F6F8FB] p-4"><h3 class="text-sm font-semibold text-slate-900">Booking QR code</h3><p class="mt-1 text-xs leading-5 text-slate-600">Present your code at the gate for check-in.</p></li>
                <li class="rounded-lg bg-[#F6F8FB] p-4 sm:col-span-2"><h3 class="text-sm font-semibold text-slate-900">Arrive 15 minutes early</h3><p class="mt-1 text-xs leading-5 text-slate-600">Late arrivals may forfeit their booking slot. Contact the facility for rescheduling guidance.</p></li>
            </ul>
        </div>
    </section>

    <section id="faqs" class="mx-auto max-w-4xl px-4 py-14 sm:px-6 sm:py-16">
        <div class="text-center">
            <p class="text-xs font-semibold uppercase text-[#0A2472]">Frequently asked questions</p>
            <h2 class="mt-2 text-3xl font-bold text-[#102044]">Good to know before you book</h2>
        </div>
        <div class="mt-8 divide-y divide-slate-200 border-y border-slate-200">
            <details class="py-5"><summary class="cursor-pointer text-sm font-semibold text-slate-900">Who may visit a PDL?</summary><p class="mt-3 text-sm leading-6 text-slate-600">Immediate family members, legal counsel, and approved visitors may visit. All visitors must register and present a valid ID.</p></details>
            <details class="py-5"><summary class="cursor-pointer text-sm font-semibold text-slate-900">How long is a visitation slot?</summary><p class="mt-3 text-sm leading-6 text-slate-600">Standard visitation slots are one hour. Contact the facility for questions about extended visits.</p></details>
            <details class="py-5"><summary class="cursor-pointer text-sm font-semibold text-slate-900">Can I cancel a booking?</summary><p class="mt-3 text-sm leading-6 text-slate-600">Contact the facility as early as possible if you need to cancel or change your visit.</p></details>
            <details class="py-5"><summary class="cursor-pointer text-sm font-semibold text-slate-900">Is this service free?</summary><p class="mt-3 text-sm leading-6 text-slate-600">Yes. SmartDalaw is a free official BJMP e-Service. Do not pay unauthorized booking agents.</p></details>
        </div>
    </section>

    <section class="bg-[#0A2472] text-white">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 py-12 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
            <div><h2 class="text-2xl font-bold">Ready to schedule a visit?</h2><p class="mt-2 text-sm text-blue-100">Start your request online in just a few minutes.</p></div>
            <a href="{{ route('bookings.create') }}" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-white px-5 py-3 text-sm font-semibold text-[#0A2472] hover:bg-blue-50">Book a Visit</a>
        </div>
    </section>
@endsection