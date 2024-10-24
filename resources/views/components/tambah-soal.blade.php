<div 
    x-show="tambahSoalOpen" 
    x-transition.opacity x-cloak 
    @click="tambahSoalOpen = false"
    class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm transition-opacity duration-300"
    >
    <div class="relative mx-auto w-full max-w-[24rem] rounded-lg overflow-hidden shadow-sm bg-white" @click.stop>
        {{-- Modal Input --}}
        <div class="flex flex-col gap-4 p-6">

            <!-- Close Modal -->
            <div class="w-full flex justify-end">
                <x-icon icon="iconClose" @click="tambahSoalOpen = false"></x-icon>
            </div>
            {{ $slot }}
        </div>

        <!-- Simpan Soal Button -->
        <div class="p-6 pt-0">
            <button @click="tambahSoalOpen = false; questions.push(questions.length + 1)"
                class="w-full rounded-md bg-indigo-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                Simpan Soal
            </button>
        </div>
    </div>
</div>
