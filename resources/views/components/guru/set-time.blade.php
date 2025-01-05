@props([
    'waktuLevel' => false,
    'waktuSoal' => false,
    'infoWaktu',
    'showOpeningButton' => false,
])

@if ($waktuLevel || $waktuSoal || $showOpeningButton)
    <div class="col-span-2 w-full flex flex-col lg:flex-row gap-4 md:gap-8 items-center justify-between">
        @csrf

        <div class="flex flex-col lg:flex-row items-center gap-4">
            @if ($waktuLevel)
                <div class="md:inline-flex items-center gap-2">
                    <p>Waktu untuk level ini: {{ $infoWaktu }} menit</p>
                    <div class="flex gap-2">
                        <form wire:submit.prevent="simpanWaktuLevel" class="flex items-center gap-2">
                            <input type="number" wire:model="level_time" name="level_time" min="0" max="59" class="border rounded px-2 py-1 w-20" placeholder="Menit">
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
                    <span>Waktu untuk tiap Soal: {{ $infoWaktu }}</span>
                    <form wire:submit.prevent="simpanWaktuSoal" class="flex items-center gap-2">
                        <input type="number" wire:model="level_time" name="level_time" min="0" max="59" class="border rounded px-2 py-1 w-20" placeholder="Menit">
                        @error('level_time')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="bg-indigo-500 px-4 py-2 text-white hover:bg-indigo-600 rounded">Simpan</button>
                    </form>
                </div>
            @endif
        </div>

            <div class="ml-auto">
                <button
                    @click="modalOpening = true"
                    class="bg-indigo-500 px-4 py-2 text-white rounded hover:bg-indigo-600 transition-colors"
                >
                    Ubah Opening
                </button>
            </div>
    </div>
@endif
