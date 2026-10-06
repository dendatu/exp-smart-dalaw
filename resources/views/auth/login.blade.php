<!DOCTYPE html>
<html lang="en" data-theme="bumblebee">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SmartDalaw</title>
    <link rel="icon" type="image/png" href="{{ asset('images/bjmp-logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-base-200 min-h-screen flex items-center justify-center px-4 py-8 text-base-content">
    <div class="max-w-md w-full px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/bjmp-logo.png') }}" alt="BJMP Official Seal" class="w-20 h-20 rounded-full mx-auto mb-4 object-contain shadow-md bg-white p-1">
            <h1 class="text-2xl font-bold text-base-content mb-2">SmartDalaw Admin</h1>
            <p class="text-base-content/70 text-sm">Sign in to manage visitation bookings</p>
        </div>

        @if(session('error'))
            <div class="alert alert-error mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="bg-base-100 border border-base-300 rounded-box p-6 shadow-sm">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
                <input type="email" id="email" name="email" required class="input input-bordered w-full" autocomplete="username" placeholder="admin@bjmp.gov.ph">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" required class="input input-bordered w-full" autocomplete="current-password" placeholder="••••••••">
            </div>

            <div class="mb-6">
                <label for="remember" class="flex items-center gap-2 text-sm">
                    <input type="checkbox" id="remember" name="remember" value="1" @checked(old('remember')) class="checkbox checkbox-primary checkbox-sm">
                    <span>Remember me</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-full">
                Sign In
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="link link-hover text-sm text-base-content/70">
                ← Back to Public Portal
            </a>
        </div>
    </div>
</body>
</html>