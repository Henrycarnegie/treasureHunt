@props(['infoLevel', 'infoSoal', 'soal', 'image'])

<div class="bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-md border-gray-200 shadow-lg px-8 py-6 min-w-full min-h-80">
    @if ($infoLevel == 5)
        <h1 class="text-3xl font-bold  mb-4 text-gray-800">Soal Level 5</h1>
    @else
        <h1 class="text-3xl font-bold  mb-4 text-gray-800">Soal no {{ $infoSoal }}</h1>
    @endif
    <h1 class="text-lg font-medium  text-slate-900">{{ $soal }}</h1>
    @if ($image)
        <div class="flex w-full justify-center items-center">
            <img src="{{ asset('storage/soal_level'.$infoLevel.'/'.$image) }}" alt="Gambar Soal" class="w-full max-w-max h-auto max-h-96">
        </div>
    @endif
</div>


