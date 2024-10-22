{{-- <div class="grid items-center gap-2 mt-2" x-show="isOpen" x-transition @click.stop>
    {{ $slot }}
    Button Tambah Soal
    <button type="submit" class="w-3/4 md:w-1/5 lg:w-1/6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah Soal</button>
</div> --}}

<div x-data="{ soalList: [1] }" class="p-4">
    <!-- Loop untuk menampilkan x-field-soal -->
    <template x-for="(soal, index) in soalList" :key="index">
        <div class="mt-2">
            <x-field-soal :infoSoal="soal"></x-field-soal>
        </div>
    </template>

    <!-- Tombol untuk menambah soal baru -->
    <button @click="soalList.push(soalList.length + 1)"
        type="button"
        class="mt-4 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
        Tambah Soal
    </button>
</div>
