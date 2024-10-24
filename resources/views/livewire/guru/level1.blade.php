@section('title', 'Level 1')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru-header>Kumpulan soal quiz</x-guru-header>
            
            <!-- Modal Soal untuk Level 1 -->
            <x-modal-soal infoPekerjaan="Polisi">
                <x-content-soal>
                    <x-field-tambah-soal responseType="pilgan"></x-field-tambah-soal>
                </x-content-soal>
            </x-modal-soal>
            <x-modal-soal  infoPekerjaan="Detektif">
                <x-content-soal>
                    <x-field-tambah-soal responseType="pilgan"></x-field-tambah-soal>
                </x-content-soal>
            </x-modal-soal>
            <x-modal-soal  infoPekerjaan="Nelayan">
                <x-content-soal>
                    <x-field-tambah-soal responseType="pilgan"></x-field-tambah-soal>
                </x-content-soal>
            </x-modal-soal>
            <x-modal-soal  infoPekerjaan="Petani">
                <x-content-soal>
                    <x-field-tambah-soal responseType="pilgan"></x-field-tambah-soal>
                </x-content-soal>
            </x-modal-soal>
        </div>
    </div>
</div>