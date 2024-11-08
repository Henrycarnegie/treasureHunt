@section('title', 'Level 1')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru.guru-header>Kumpulan soal quiz</x-guru.guru-header>
            <x-guru.set-time waktuLevel="true" infoWaktu="{{ $waktu_level1 ?? 0 }}"/>

            <!-- Modal Soal untuk Level 1 -->
            <x-guru.modal-soal infoPekerjaan="Polisi">
                <x-guru.content-soal
                    responseType="pilgan"
                    pekerjaan="polisi"
                    type_question="main_question"
                    :data="$data"
                    :fullOption="false"
                />
            </x-guru.modal-soal>

            <x-guru.modal-soal infoPekerjaan="Detektif">
                <x-guru.content-soal
                    responseType="pilgan"
                    pekerjaan="detektif"
                    type_question="main_question"
                    :data="$data"
                    :fullOption="false"
                />
            </x-guru.modal-soal>

            <x-guru.modal-soal infoPekerjaan="Nelayan">
                <x-guru.content-soal
                    responseType="pilgan"
                    pekerjaan="nelayan"
                    type_question="main_question"
                    :data="$data"
                    :fullOption="false"
                />
            </x-guru.modal-soal>

            <x-guru.modal-soal infoPekerjaan="Petani">
                <x-guru.content-soal
                    responseType="pilgan"
                    pekerjaan="petani"
                    type_question="main_question"
                    :data="$data"
                    :fullOption="false"
                />
            </x-guru.modal-soal>

            <x-guru.modal-soal infoPekerjaan="Alternatif">
                <x-guru.content-soal
                    responseType="pilgan"
                    pekerjaan="null"
                    type_question="secondary_question"
                    :data="$data"
                    :fullOption="false"
                />
            </x-guru.modal-soal>

        </div>
    </div>
</div>
