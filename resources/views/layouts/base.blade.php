<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Font Inter --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- Font Bangers --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
    @livewireScripts
    <!-- FilePond Core -->
    <link href="https://cdn.jsdelivr.net/npm/filepond@4.30.4/dist/filepond.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/filepond@4.30.4/dist/filepond.min.js"></script>

    <!-- FilePond Image Preview Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.0.3/dist/filepond-plugin-image-preview.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4.0.3/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styling Leaderboard -->
    <style>
        @media (min-width: 320px) {
            #main {
                width: 410px;
                height: 500px;
                margin-left: 0;
                overflow: visible !important;
            }
        }

        @media (min-width: 640px) {
            #main {
                width: 100%;
                height: 750px;
                margin-left: 0;
            }
        }
        @media (min-width: 1024px) {
            #main {
                width: 100%;
                height: 800px;
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="font-sans antialiase">
    @yield('body')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</body>

</html>
