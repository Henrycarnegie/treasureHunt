{{-- Pertanyaan dan jawaban --}}

@props(['infoSoal'])

<div class="pt-4 grid gap-4">
    <span class="flex text-lg font-bold text-amber-500">Soal {{ $infoSoal }}</span>
    <div class="grid grid-cols-1 gap-4">
        {{ $slot }}
    </div>
</div>
