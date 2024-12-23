@props(['responseType', 'pekerjaan', 'type_question', 'fullOption', 'boxId'])

<div x-show="tambahSoalOpen" x-transition.opacity x-cloak @click="tambahSoalOpen = false"
    class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm transition-opacity duration-300">
    <div class="relative mx-auto w-full max-w-[24rem] rounded-lg overflow-hidden shadow-sm bg-white" @click.stop>
        @if ($boxId)
            <form wire:submit.prevent="simpanSoal({{ $boxId }})">
        @else
            <form wire:submit.prevent="simpanSoal">
        @endif
            {{-- Modal Input --}}
            <div class="flex flex-col gap-4 p-6">

                <!-- Close Modal -->
                <div class="w-full flex justify-end">
                    <x-icon icon="iconClose" @click="tambahSoalOpen = false"></x-icon>
                </div>
                <x-guru.field-tambah-soal :responseType="$responseType" :fullOption="$fullOption" box_id="{{ $boxId ?? null }}"></x-guru.field-tambah-soal>
            </div>

            <!-- Simpan Soal Button -->
            <div class="p-6 pt-0">
                @if ($pekerjaan == null && $type_question == null)
                    <button
                        class="w-full rounded-md bg-indigo-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="submit">
                        Simpan Soal
                    </button>
                @else
                    <button wire:click="setValue('{{ $pekerjaan }}', '{{ $type_question }}')"
                        class="w-full rounded-md bg-indigo-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="submit">
                        Simpan Soal
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>
