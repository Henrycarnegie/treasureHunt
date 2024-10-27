@section('title', 'Home Page')

<div class="flex flex-col items-center w-full lg:h-[190dvh] min-h-screen overflow-hidden"> 
    <div
        class="flex items-center justify-between px-2 py-2 lg:px-6 w-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-800 sticky top-0 z-10">
        <img src="{{ asset('img/logo.svg') }}" alt="logo" class="lg:max-w-20 max-w-12">
        <a class="font-bangers tracking-wider text-xl font-bold text-cyan-200">
            <span class="text-amber-600">Treasure</span>
            Hunt
        </a>
        <a class="text-sm font-medium text-red-500" href="{{ route('logout') }}">Logout</a>
    </div>
    <div
        class="relative bg-game-map bg-top bg-no-repeat bg-cover md:bg-cover lg:bg-cover w-screen h-[60dvh] md:min-h-[130dvh] lg:min-h-[180dvh] xl:min-h-[300dvh] overflow-hidden">
        <a href="{{ route('murid.level1') }}">
            {{-- Level 1 --}}
            <img src="{{ asset('img/currentlevel.svg') }}" alt="stone-level-1"
                class="absolute w-12 md:w-24 lg:w-40 top-[13%] right-[27%] md:top-[14%] md:right-[28%] lg:top-[13%] lg:right-[27%] xl:top-[14%] xl:right-[30%]">
        </a>

        <a href="{{ route('murid.level2') }}">
            {{-- Level 2 --}}
            <img src="{{ asset('img/currentlevel.svg') }}" alt="stone-level-2"
                class="absolute w-12 md:w-24 lg:w-40 top-[25%] left-[13%] md:top-[28%] md:left-[14%] lg:top-[25%] lg:left-[11%] xl:top-[27%] xl:left-[15%]">
        </a>

        <a href="{{ route('murid.level3') }}">
            {{-- Level 3 --}}
            <img src="{{ asset('img/currentlevel.svg') }}" alt="stone-level-3"
                class="absolute w-12 md:w-24 lg:w-40 top-[40%] right-[15%] md:top-[45%] md:right-[16%] lg:top-[42%] lg:right-[14%] xl:top-[43%] xl:right-[18%]">
        </a>

        <a href="{{ route('murid.level4') }}">
            {{-- Level 4 --}}
            <img src="{{ asset('img/currentlevel.svg') }}" alt="stone-level-4"
                class="absolute w-12 md:w-24 lg:w-40 top-[60%] left-[20%] md:top-[65%] md:left-[22%] lg:top-[61%] lg:left-[20%] xl:top-[65%] xl:left-[22%]">
        </a>

        <a href="{{ route('murid.level5') }}">
            {{-- Level 5 --}}
            <img src="{{ asset('img/currentlevel.svg') }}" alt="stone-level-5"
                class="absolute w-12 md:w-24 lg:w-40 top-[68%] right-[15%] md:top-[75%] md:right-[14%] lg:top-[72%] lg:right-[14%] xl:top-[75%] xl:right-[18%]">
        </a>
    </div>
    <audio autoplay class="flex" src="{{ asset('audio/audio.mp3') }}"></audio>
   
</div>
