@section('title', 'Level 4')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru.guru-header>Kumpulan soal quiz</x-guru.guru-header>
            <x-guru.set-time :waktuSoal="true" :waktuLevel="true" />

            <!-- Modal Soal untuk Level 4 -->
            <x-guru.modal-soal infoPekerjaan="Polisi">
                <x-guru.content-soal responseType="uploadFoto" pekerjaan="polisi" type_question="main_question" />
            </x-guru.modal-soal>
            <x-guru.modal-soal infoPekerjaan="Detektif">
                <x-guru.content-soal responseType="uploadFoto" pekerjaan="detektif" type_question="main_question" />
            </x-guru.modal-soal>
            <x-guru.modal-soal infoPekerjaan="Nelayan">
                <x-guru.content-soal responseType="uploadFoto" pekerjaan="nelayan" type_question="main_question" />
            </x-guru.modal-soal>
            <x-guru.modal-soal infoPekerjaan="Petani">
                <x-guru.content-soal responseType="uploadFoto" pekerjaan="petani" type_question="main_question" />
            </x-guru.modal-soal>
            <x-guru.modal-soal infoPekerjaan="Alternatif">
                <x-guru.content-soal responseType="uploadFoto" pekerjaan=null type_question="secondary_question" />
            </x-guru.modal-soal>
        </div>
    </div>
</div>