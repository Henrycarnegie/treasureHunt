@props([
    'waktuLevel' => false,
    'waktuSoal' => false,
    'infoWaktu' => '15.00',
])

@if ($waktuLevel || $waktuSoal)
    <form class="col-span-2 w-full inline-flex flex-col lg:flex-row gap-4 md:gap-8">
        @csrf
        @if ($waktuLevel)
            <div class="md:inline-flex items-center gap-2">
                <span class="">Waktu untuk level ini : {{ $infoWaktu }}</span>
                <div class="flex gap-2">
                    <input type="time" name="level_time" class="border rounded px-2 py-1">
                    <button type="submit" class="bg-indigo-500 px-4 py-2 text-white rounded">Simpan</button>
                </div>
            </div>
        @endif
        @if ($waktuSoal)
            <div class="md:inline-flex items-center gap-2">
                <span class="">Waktu untuk tiap Soal : {{ $infoWaktu }}</span>
                <div class="flex gap-2">
                    <input type="time" name="question_time" class="border rounded px-2 py-1">
                    <button type="submit" class="bg-indigo-500 px-4 py-2 text-white rounded">Simpan</button>
                </div>
            </div>
        @endif
    </form>
@endif
