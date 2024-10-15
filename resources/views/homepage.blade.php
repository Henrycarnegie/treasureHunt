<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Treasure-Hunt</title>

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
    <div class="flex items-center justify-center w-full h-[300vh]">
        <div class="bg-game-map bg-center bg-no-repeat bg-cover px-8 py-8 w-full h-full">
            <h1 class="text-2xl font-bold text-center mb-6 dark:text-gray-200"></h1>
        </div>
    </div>
</body>

