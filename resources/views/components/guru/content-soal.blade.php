@props(['responseType', 'pekerjaan' => null, 'type_question' => null, 'fullOption' => false, 'data', 'infoLevel' => '', 'boxId' => ''])

<div x-data="{ tambahSoalOpen: @entangle('tambahSoalOpen') }" x-cloak class="grid items-center gap-2 mt-2" @click.stop>
    <!-- Pengecekan data kosong atau bukan tipe yang bisa di-loop -->
    @if ($pekerjaan == 'polisi' || $pekerjaan == 'detektif' || $pekerjaan == 'nelayan' || $pekerjaan == 'petani')
        @if($data->where('role_name', $pekerjaan)->isEmpty())
            <div class="text-gray-500">Belum ada soal yang tersedia.</div>
        @else
            @foreach ($data->where('role_name', $pekerjaan) as $dataItem)
                <div class="flex gap-4 items-center" x-data="{ viewSoalOpen: false }" @click.outside="viewSoalOpen = false">
                    <!-- Detail Soal -->
                    <x-guru.view-soal :question="$dataItem" :iteration="$loop->iteration" infoLevel="{{ $infoLevel }}"></x-guru.view-soal>

                    <!-- Tombol Hapus Soal -->
                    <button wire:click="confirmDelete('{{ $dataItem->id }}')" type="button" class="col-end-auto">
                        <x-icon icon="iconDelete"></x-icon>
                    </button>
                </div>
            @endforeach
        @endif
    @else
        @if($data == null)
            <div class="text-gray-500">Belum ada soal yang tersedia.</div>
        @else
            @if ($infoLevel == '3')
                @foreach ($data as $dataItem)
                    <div class="flex gap-4 items-center" x-data="{ viewSoalOpen: false }" @click.outside="viewSoalOpen = false">
                        <!-- Detail Soal -->
                        <x-guru.view-soal :question="$dataItem" :iteration="$loop->iteration" infoLevel="{{ $infoLevel }}"></x-guru.view-soal>

                        <!-- Tombol Hapus Soal -->
                        <button wire:click="confirmDelete('{{ $dataItem->id }}')" type="button" class="col-end-auto">
                            <x-icon icon="iconDelete"></x-icon>
                        </button>
                    </div>
                @endforeach
            @else
                @foreach ($data as $dataItem)
                    <div class="flex gap-4 items-center" x-data="{ viewSoalOpen: false }" @click.outside="viewSoalOpen = false">
                        <!-- Detail Soal -->
                        <x-guru.view-soal :question="$dataItem" :iteration="$loop->iteration" infoLevel="{{ $infoLevel }}"></x-guru.view-soal>

                        <!-- Tombol Hapus Soal -->
                        <button wire:click="confirmDelete('{{ $dataItem->id }}')" type="button" class="col-end-auto">
                            <x-icon icon="iconDelete"></x-icon>
                        </button>
                    </div>
                @endforeach
            @endif
        @endif
    @endif

    <!-- Tombol Tambah Soal -->
    <button
        @click="tambahSoalOpen = !tambahSoalOpen"
        type="button"
        class="mt-4 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >
        Tambah Soal
    </button>

    <!-- Modal Tambah Soal -->
    <x-guru.tambah-soal
        responseType="{{ $responseType }}"
        pekerjaan="{{ $pekerjaan ?? '' }}"
        type_question="{{ $type_question ?? '' }}"
        :fullOption="$fullOption"
        boxId="{{ $boxId ?? null }}">
    </x-guru.tambah-soal>

</div>
