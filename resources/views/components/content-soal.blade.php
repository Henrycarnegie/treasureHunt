<div x-data="{ questions: ['1'], tambahSoalOpen: false }" x-cloak class="grid items-center gap-2 mt-2" @click.stop>
    <!-- Loop untuk menampilkan field-soal -->
    <template x-for="(question, index) in questions" :key="index">
        <div class="flex gap-4 items-center">
            <!-- Detail Soal-->
            <x-view-soal></x-view-soal>

            <!-- Tombol Hapus Soal -->
            <button type="button" @click="questions.splice(index, 1)" class="col-end-auto">
                <x-icon icon="iconDelete"></x-icon>
            </button>
        </div>
    </template>

    <!-- Tombol Tambah Soal -->
    <button 
        @click="tambahSoalOpen = !tambahSoalOpen" 
        type="button"
        class="mt-4 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
    >
        Tambah Soal
    </button>

    <!-- Modal Tambah Soal -->
    <x-tambah-soal>{{ $slot }}</x-tambah-soal>
</div>
