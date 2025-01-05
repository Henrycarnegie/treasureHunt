@section('title', 'Level 5')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4" x-data="{ modalOpening: @entangle('modalOpening') }" x-cloak>
            <x-guru.guru-header>
                <span class="text-xl font-bold text-gray-900">
                    Kumpulan soal quiz
                </span>
                </x-guru.guru-header>
            <x-guru.set-nyawa infoNyawa="{{ $nyawa_level5 }}"/>

            <!-- Modal Soal untuk Level 5 -->
            <x-guru.modal-soal x-data="{ isOpen: true }" infoPekerjaan="Data soal untuk level 5">
                <x-guru.content-soal
                    responseType="pilgan"
                    :data="$data"
                    :fullOption="true"
                    infoLevel="5"
                />
            </x-guru.modal-soal>

            <div x-show="modalOpening" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
                <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 w-[500px] relative">
                    <button
                        @click="modalOpening = false"
                        class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <form wire:submit.prevent="simpanOpening" class="space-y-4">
                        <h2 class="text-xl font-bold text-gray-900">Ubah Opening</h2>
                        <div>
                            <textarea
                                wire:model.fill="deskripsi_opening"
                                value = "{{ $deskripsi_opening }}"
                                id="deskripsi_opening"
                                rows="8"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-y min-h-[200px] max-h-[400px]"
                                placeholder="Tuliskan Opening disini..."
                            ></textarea>
                            @error('deskripsi_opening')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3 mt-4">
                            <button
                                type="submit"
                                class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 transition-colors"
                            >
                                Simpan Opening
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
