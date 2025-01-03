@section('title', 'Level 2')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru.guru-header>
                <span class="text-xl font-bold text-gray-900">
                    Kumpulan soal quiz
                </span> 
                </x-guru.guru-header>
            <x-guru.set-nyawa infoNyawa="3"/>

            <!-- Modal Soal untuk Level 1 -->
            <x-guru.modal-soal x-data="{ isOpen: true }" infoPekerjaan="Data soal untuk level 5">
                <x-guru.content-soal
                    responseType="pilgan"
                    pekerjaan="polisi"
                    type_question="main_question"
                    {{-- :data="$data" --}}
                    :fullOption="false"
                />
            </x-guru.modal-soal>
        </div>
    </div>
</div>
