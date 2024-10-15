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
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font Inter --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- Font Bangers --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
</head>

<body class="font-sans antialiase">
    <div class="flex flex-col items-center w-full lg:h-[300vh] min-h-screen overflow-hidden">
        <div class="flex items-center justify-between px-2 py-2 lg:px-6 w-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-800 sticky top-0 z-10">
            <img src="{{ asset('img/logo.svg') }}" alt="logo" class="lg:max-w-20 max-w-12">
            <a class="font-bangers tracking-wider text-xl font-bold text-cyan-200">
                <span class="text-amber-600">Treasure</span>
                Hunt
            </a>
            <a class="text-sm font-medium text-red-500">Logout</a>
        </div>
        <div class="relative bg-game-map bg-top bg-no-repeat bg-cover md:bg-cover lg:bg-cover w-screen h-[80vh] md:min-h-[150dvh] lg:min-h-[200dvh] lg:max-h-[300dvh]">
            <img src="{{ asset('img/currentlevel.svg') }}" alt="stone-level-1" class="absolute w-14 h-14 top-[60px] right-[66px]">
        </div>


        {{-- <div class="flex">
            <img src="{{ asset('img/game-map.png') }}" alt="game-map" srcset="" class="relative w-full h-[110vh] lg:w-[100vw] lg:h-[300vh]">

        </div> --}}
    </div>
</body>

