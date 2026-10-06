<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | SmartDalaw')</title>
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
</head>
<body class="min-h-screen bg-base-200 text-base-content antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/bjmp-logo.png') }}" alt="BJMP Official Seal" class="h-10 w-10 shrink-0 rounded-full bg-white object-contain shadow-sm border border-slate-200">
                <span>
                    <span class="block text-sm font-bold text-[#002244]">SmartDalaw Admin</span>
                    <span class="block text-xs text-slate-500">Visitation management</span>
                </span>
            </a>
            <div class="flex items-center gap-3 text-sm">
                <span class="hidden text-slate-600 sm:inline">{{ auth()->user()->name }}</span>
                
            </div>
            <nav class="order-3 flex w-full gap-1 overflow-x-auto border-t border-slate-100 pt-3 sm:order-none sm:w-auto sm:border-0 sm:pt-0" aria-label="Admin navigation">
                <a href="{{ route('admin.dashboard') }}" @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif class="whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-[#003366]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Dashboard</a>
                <a href="{{ route('admin.calendar') }}" @if(request()->routeIs('admin.calendar')) aria-current="page" @endif class="whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.calendar') ? 'bg-blue-50 text-[#003366]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Visit calendar</a>
                <a href="{{ route('admin.facilities.settings') }}" @if(request()->routeIs('admin.facilities.*')) aria-current="page" @endif class="whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.facilities.*') ? 'bg-blue-50 text-[#003366]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Facility settings</a>
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('admin.users.index') }}" @if(request()->routeIs('admin.users.*')) aria-current="page" @endif class="whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-[#003366]' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Admin accounts</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-md border border-slate-300 px-3 py-2 font-medium text-slate-700 hover:bg-slate-50">Log out</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-7 sm:px-6 sm:py-9 lg:px-8">
        @if(session('success'))
            <div class="mb-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-5 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="mb-5 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800" role="alert">
                <p class="font-semibold">Please review the form.</p>
                <ul class="mt-2 list-inside list-disc">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>