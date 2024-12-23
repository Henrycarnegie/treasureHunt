@section('title', 'Level 3')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru.guru-header>Kumpulan soal quiz</x-guru.guru-header>
            <x-guru.set-time waktuLevel="true"  infoWaktu="10"/>

            @foreach ($data as $item)
                    <x-guru.modal-soal infoPekerjaan="{{ $item->nama_box }}">
                        <x-guru.content-soal
                            responseType="uploadFoto"
                            :data="$item->soalLevel3"
                            :fullOption="false"
                            infoLevel="3"
                            boxId="{{ $item->id }}"
                        />
                    </x-guru.modal-soal>
            @endforeach
        </div>
    </div>
</div>
