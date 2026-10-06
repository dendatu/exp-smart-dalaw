<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SmartDalaw | Online Visitation Booking')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/bjmp-logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
    @stack('head')
</head>
<body class="min-h-screen bg-base-200 text-base-content antialiased">
    <div class="bg-[#002244] text-blue-100">
        <div class="mx-auto flex max-w-7xl items-center gap-2 px-4 py-2 text-[10px] font-medium sm:px-6 sm:text-xs lg:px-8">
            <span>Republic of the Philippines</span>
            <span aria-hidden="true">•</span>
            <span>Bureau of Jail Management and Penology</span>
        </div>
    </div>

    <header class="sticky top-0 z-40 border-b border-white/10 bg-[#003366] text-white shadow-md">
        <div class="relative mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3" aria-label="SmartDalaw home">
                <img src="{{ asset('images/bjmp-logo.png') }}" alt="BJMP Official Seal" class="h-11 w-11 shrink-0 rounded-full bg-white object-contain p-0.5 shadow-sm">
                <span class="flex min-w-0 flex-col">
                    <span class="truncate text-base font-bold leading-tight sm:text-lg">SmartDalaw</span>
                    <span class="truncate text-[10px] leading-tight text-blue-200 sm:text-xs">Online Visitation Booking</span>
                </span>
            </a>

            <button id="portal-menu-toggle" type="button" class="flex h-10 w-10 shrink-0 flex-col items-center justify-center gap-1.5 rounded-md text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white md:hidden" aria-label="Toggle navigation" aria-controls="portal-navigation" aria-expanded="false">
                <span class="h-0.5 w-5 bg-current"></span>
                <span class="h-0.5 w-5 bg-current"></span>
                <span class="h-0.5 w-5 bg-current"></span>
            </button>

            <nav id="portal-navigation" class="absolute left-0 right-0 top-full hidden flex-col gap-1 border-b border-white/15 bg-[#003366] px-4 py-3 shadow-lg md:static md:flex md:flex-row md:items-center md:gap-2 md:border-0 md:bg-transparent md:p-0 md:shadow-none" aria-label="Main navigation">
                <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'bg-[#FFD700] text-[#003366]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">Home</a>
                <a href="{{ route('bookings.create') }}" @if(request()->routeIs('bookings.create')) aria-current="page" @endif class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('bookings.create') ? 'bg-[#FFD700] text-[#003366]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">Book a Visit</a>
                <a href="{{ route('bookings.track') }}" @if(request()->routeIs('bookings.track', 'bookings.track.search', 'booking.success')) aria-current="page" @endif class="rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('bookings.track', 'bookings.track.search', 'booking.success') ? 'bg-[#FFD700] text-[#003366]' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">My Bookings</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-[#002244] text-blue-100">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <p class="text-lg font-bold text-white">BJMP SmartDalaw</p>
                <p class="mt-3 max-w-sm text-sm leading-6 text-blue-100/80">Official online visitation booking system of the Bureau of Jail Management and Penology.</p>
                <p class="mt-2 text-xs text-blue-200">An e-Service of the Republic of the Philippines</p>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-white">Quick Links</h2>
                <div class="mt-4 grid gap-3 text-sm text-blue-100/80">
                    <a href="{{ route('bookings.create') }}" class="hover:text-white">Book a visit</a>
                    <a href="{{ route('bookings.track') }}" class="hover:text-white">Track a booking</a>
                    <a href="{{ route('home') }}#requirements" class="hover:text-white">Visitation requirements</a>
                    <a href="{{ route('home') }}#faqs" class="hover:text-white">Frequently asked questions</a>
                </div>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-white">Contact &amp; Support</h2>
                <div class="mt-4 grid gap-3 text-sm text-blue-100/80">
                    <p>Hotline: (02) 8922-9003</p>
                    <a href="mailto:smartdalaw@bjmp.gov.ph" class="hover:text-white">smartdalaw@bjmp.gov.ph</a>
                    <p class="text-xs text-blue-200">For emergencies, contact the facility directly.</p>
                </div>
            </div>
        </div>
        <div class="border-t border-white/15">
            <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-4 text-xs text-blue-200 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
                <p>&copy; {{ now()->year }} Bureau of Jail Management and Penology. All rights reserved.</p>
                <p>Official BJMP e-Service</p>
            </div>
        </div>
    </footer>

    <script>
        const portalMenuToggle = document.getElementById('portal-menu-toggle');
        const portalNavigation = document.getElementById('portal-navigation');

        portalMenuToggle?.addEventListener('click', () => {
            const isExpanded = portalMenuToggle.getAttribute('aria-expanded') === 'true';

            portalMenuToggle.setAttribute('aria-expanded', String(!isExpanded));
            portalNavigation.classList.toggle('hidden', isExpanded);
        });
    </script>
    @stack('scripts')
</body>
</html>