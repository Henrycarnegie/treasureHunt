@section('title', 'Level 1')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid gap-4 pt-4">
            <x-guru-header>Kumpulan soal quiz</x-guru-header>
            <x-modal-soal infoLevel="1">
                <x-content-soal>
                    <x-field-soal></x-field-soal>
                </x-content-soal>
            </x-modal-soal>
            <x-modal-soal infoLevel="2">
                <x-content-soal>
                    <x-field-soal></x-field-soal>
                    <x-field-soal></x-field-soal>
                </x-content-soal>
            </x-modal-soal>
            <x-modal-soal infoLevel="3">
                <x-content-soal>
                    <x-field-soal></x-field-soal>
                    <x-field-soal></x-field-soal>
                    <x-field-soal></x-field-soal>
                </x-content-soal>
            </x-modal-soal>
            <x-modal-soal infoLevel="4">
                <x-content-soal>
                    <x-field-soal></x-field-soal>
                    <x-field-soal></x-field-soal>
                </x-content-soal>
            </x-modal-soal>
        </div>
    </div>
</div>