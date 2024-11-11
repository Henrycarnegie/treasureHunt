@section('title', 'Respondent')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru.guru-header>Kumpulan jawaban siswa</x-guru.guru-header>
            <x-guru.modal-respondent :data="$data" :soal="$soal" :muridId=1>Polisi</x-guru.modal-respondent>
            <x-guru.modal-respondent :data="$data" :soal="$soal" :muridId=2>Detektif</x-guru.modal-respondent>
            <x-guru.modal-respondent :data="$data" :soal="$soal" :muridId=3>Nelayan</x-guru.modal-respondent>
            <x-guru.modal-respondent :data="$data" :soal="$soal" :muridId=4>Petani</x-guru.modal-respondent>
        </div>
    </div>
</div>
