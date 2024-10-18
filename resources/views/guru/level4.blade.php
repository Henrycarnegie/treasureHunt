<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Treasure-Hunt</title>
    <link rel="icon" href="{{ asset('img/logo.svg') }}">

    {{-- CSS --}}
    @vite('resources/css/app.css')

    {{-- JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font Inter --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- Font Bangers --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
</head>

<body class="font-sans antialiase">
    <x-navigation></x-navigation>

    <!-- Sidebar -->
    <aside
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <x-nav-link href="{{ route('guru.dashboard') }}" icon="iconDashboard" :active="request()->routeIs('guru.dashboard')">Dashboard</x-nav-link>
                </li>
                <li>
                    <x-nav-link href="{{ route('guru.level1') }}" icon="iconLevel1" :active="request()->routeIs('guru.level1')">Level 1</x-nav-link>
                </li>
                <li>
                    <x-nav-link href="{{ route('guru.level2') }}" icon="iconLevel2" :active="request()->routeIs('guru.level2')">Level 2</x-nav-link>
                </li>
                <li>
                    <x-nav-link href="{{ route('guru.level3') }}" icon="iconLevel3" :active="request()->routeIs('guru.level3')">Level 3</x-nav-link>
                </li>
                <li>
                    <x-nav-link href="{{ route('guru.level4') }}" icon="iconLevel4" :active="request()->routeIs('guru.level4')">Level 4</x-nav-link>
                </li>
                <li>
                    <x-nav-link href="{{ route('guru.level5') }}" icon="iconLevel5" :active="request()->routeIs('guru.level5')">Level 5</x-nav-link>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14">
            <h1>Level 4</h1>
        </div>
    </div>
</body>

</html>
