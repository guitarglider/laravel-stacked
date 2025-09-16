<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200">
    <x-header />
    <div class="container mx-auto p-4 grid grid-cols-12 gap-4">
        <aside class="col-span-12 md:col-span-3 lg:col-span-2">
            <x-sidebar />
        </aside>
        <main class="col-span-12 md:col-span-9 lg:col-span-10">
            <x-container>
                {{ $slot }}
            </x-container>
        </main>
    </div>
</body>
</html>
