@section('title', 'Respondent')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru.guru-header>
                <span class="text-xl font-bold text-gray-900">
                    Kumpulan jawaban siswa
                </span>
                <button wire:click="confirmReset" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm">Reset jawaban</button>
            </x-guru.guru-header>
            <x-guru.modal-respondent :level1="$datalevel1" :level2="$datalevel2" :level3="$datalevel3" :level4="$datalevel4" :level5="$datalevel5" :soal="$soal" :muridId=1>Polisi</x-guru.modal-respondent>
            <x-guru.modal-respondent :level1="$datalevel1" :level2="$datalevel2" :level3="$datalevel3" :level4="$datalevel4" :level5="$datalevel5" :soal="$soal" :muridId=2>Detektif</x-guru.modal-respondent>
            <x-guru.modal-respondent :level1="$datalevel1" :level2="$datalevel2" :level3="$datalevel3" :level4="$datalevel4" :level5="$datalevel5" :soal="$soal" :muridId=3>Nelayan</x-guru.modal-respondent>
            <x-guru.modal-respondent :level1="$datalevel1" :level2="$datalevel2" :level3="$datalevel3" :level4="$datalevel4" :level5="$datalevel5" :soal="$soal" :muridId=4>Petani</x-guru.modal-respondent>
        </div>
    </div>
</div>
