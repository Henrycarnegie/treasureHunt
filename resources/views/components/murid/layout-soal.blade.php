@props(['infoLevel', 'infoSoal'=>"1", 'soal'=>"Berapa hasil dari 2+2?", 'image'])

@if ( $infoLevel === '1' || $infoLevel === '2' || $infoLevel === '3' )
    <div class="bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-md border-gray-200 shadow-lg px-8 py-6 min-w-full min-h-80">
        <h1 class="text-3xl font-bold  mb-4 text-gray-800">Soal no {{ $infoSoal }}</h1>
        <h1 class="text-lg font-medium  text-slate-900">{{ $soal }}</h1>
        <div class="flex w-full justify-center items-center">
            <img src="{{ asset('storage/soal_level'.$infoLevel.'/'.$image) }}" alt="Gambar Soal" class="w-full max-w-max h-auto max-h-96">
        </div>
    </div>
@elseif ( $infoLevel === '4' )
    <div x-data="{ openSoal: false }" class=" bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-md border-gray-200 shadow-lg px-8 py-6 min-w-full min-h-80">
        <div class="flex w-full" x-show="!openSoal">
            <div class="w-full flex flex-col gap-y-3 justify-center items-center">
                <img src="{{ asset('img/small-fish.svg') }}" alt="box-1" class="h-20 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
                <img src="{{ asset('img/small-fish.svg') }}" alt="box-1" class="h-20 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
                <img src="{{ asset('img/small-fish.svg') }}" alt="box-1" class="h-20 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
            </div>
            <div class="w-full flex flex-col gap-y-3 justify-center items-center">
                <img src="{{ asset('img/medium-fish.svg') }}" alt="box-2" class="h-32 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
                <img src="{{ asset('img/medium-fish.svg') }}" alt="box-2" class="h-32 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
                <img src="{{ asset('img/medium-fish.svg') }}" alt="box-2" class="h-32 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
            </div>
            <div class="w-full flex flex-col gap-y-3 justify-center items-center">
                <img src="{{ asset('img/big-fish.svg') }}" alt="box-3" class="h-40 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
                <img src="{{ asset('img/big-fish.svg') }}" alt="box-3" class="h-40 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
                <img src="{{ asset('img/big-fish.svg') }}" alt="box-3" class="h-40 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" @click="openSoal = true">
            </div>
        </div>
        <div class="w-full" x-show="openSoal" x-transition>
            <h1 class="text-lg font-medium  text-slate-900">{{ $soal }}</h1>
        </div>
    </div>
@elseif ( $infoLevel === '5' )
    <div class="bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-md border-gray-200 shadow-lg px-8 py-6 min-w-full min-h-80">
        <h1 class="text-3xl font-bold  mb-4 text-gray-800">Soal no {{ $infoSoal }}</h1>
        <div class="flex w-full justify-center items-center">
            <img src="{{ asset('img/game-map.png') }}" alt="Gambar Soal" class="w-full max-w-max h-auto max-h-96">
        </div>
        <h1 class="text-lg font-medium  text-slate-900">{{ $soal }}</h1>
    </div>
@endif

