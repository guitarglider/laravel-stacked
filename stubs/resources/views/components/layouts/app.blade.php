{{-- resources/views/components/layouts/app.blade.php --}}
@props(['title' => config('app.name')])

<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('head')
</head>
<body class="h-full antialiased">
<div class="min-h-full">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Left: Brand + primary links (desktop only) -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="shrink-0 flex items-center gap-2 text-white">
                        <img src="/logo.svg" alt="{{ config('app.name') }}" class="size-8" />
                        <span class="hidden sm:inline font-semibold">{{ config('app.name') }}</span>
                    </a>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('dashboard') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : '' }}">Dashboard</a>
                        </div>
                    </div>
                </div>

                <!-- Right: Auth links -->
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="rounded bg-gray-700 px-3 py-2 text-sm font-medium text-white hover:bg-gray-600">Logout</button>
                            </form>
                        @else
                            <a class="text-gray-300 hover:text-white mr-4" href="{{ route('login') }}">Login</a>
                            <a class="rounded bg-indigo-600 px-3 py-2 text-sm font-medium text-white hover:bg-indigo-500" href="{{ route('register') }}">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @hasSection('page-header')
        <header class="relative bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @yield('page-header')
            </div>
        </header>
    @endif

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</div>
@stack('scripts')
</body>
</html>
