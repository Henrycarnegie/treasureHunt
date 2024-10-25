@include('sweetalert::alert')

@extends('layouts.base')

@section('body')
<div class="flex flex-col items-center w-full lg:h-[300vh] min-h-screen overflow-hidden">
    <div class="flex items-center justify-between px-2 py-2 lg:px-6 w-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-800 sticky top-0 z-10">
        <img src="{{ asset('img/logo.svg') }}" alt="logo" class="lg:max-w-20 max-w-12">
        <a class="font-bangers tracking-wider text-xl font-bold text-cyan-200">
            <span class="text-amber-600">Treasure</span>
            Hunt
        </a>
        <a class="text-sm font-medium text-red-500" href="{{ route('logout') }}">Logout</a>
    </div>
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
    
</div>
@endsection

@if (session('success'))
    <script>
        Swal.fire(
            'Success!',
            '{{ session('success') }}',
            'success'
        )
    </script>
@elseif (@session('error'))
    <script>
        Swal.fire(
            'Error!',
            '{{ session('error') }}',
            'error'
        )
    </script>
@endif
