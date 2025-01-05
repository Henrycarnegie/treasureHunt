@props(['infoNyawa'])

<div class="col-span-2 w-full flex flex-col lg:flex-row gap-4 md:gap-8 items-center justify-between">
    @csrf
    <div class="flex flex-col lg:flex-row items-center gap-4">
        <div class="md:inline-flex items-center gap-2">
            <p>Nyawa untuk murid : {{ $infoNyawa }}</p>
            <div class="flex gap-2">
                <form wire:submit.prevent="setNyawa" class="flex items-center gap-2">
                    <input
                        type="number"
                        wire:model="nyawa"
                        name="nyawa"
                        class="border rounded px-2 py-1 w-24"
                        placeholder="Nyawa"
                    >
                    <button type="submit" class="bg-indigo-500 px-4 py-2 text-white rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <div>
        <button
            @click="modalOpening = true"
            class="bg-indigo-500 px-4 py-2 text-white rounded hover:bg-indigo-600 transition-colors"
        >
            Ubah Opening
        </button>
    </div>
</div>
