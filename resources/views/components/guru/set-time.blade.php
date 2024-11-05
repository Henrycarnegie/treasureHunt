@props([
    'waktuLevel' => false,
    'waktuSoal' => false,
    'infoWaktu',
])

@if ($waktuLevel || $waktuSoal)
    <div class="col-span-2 w-full inline-flex flex-col lg:flex-row gap-4 md:gap-8">
        @csrf
        @if ($waktuLevel)
            <div class="md:inline-flex items-center gap-2">
                <p>Waktu untuk level ini: {{ $infoWaktu }} menit</p>
                <div class="flex gap-2">
                    <form wire:submit.prevent="simpanWaktuLevel">
                        <input type="number" wire:model="level_time" name="level_time" name="minutes" min="0" max="59" class="border rounded px-2 py-1" placeholder="Menit">
                        @error('level_time')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="bg-indigo-500 px-4 py-2 text-white rounded">Simpan</button>
                    </form>
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
    </div>
@endif
