<div 
        x-show="tambahSoalOpen" 
        x-transition.opacity 
        x-cloak 
        @click.away="tambahSoalOpen = false"
        class="fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm transition-opacity duration-300"
    >
        <div 
            class="relative mx-auto w-full max-w-[24rem] rounded-lg overflow-hidden shadow-sm bg-white"
            @click.stop
        >
            <div class="flex flex-col gap-4 p-6">
                <!-- Input Pertanyaan -->
                <div class="w-full max-w-sm min-w-[200px]">
                    <label class="block mb-2 text-sm text-slate-600">Pertanyaan</label>
                    <input 
                        type="text"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Masukan pertanyaan"
                    />
                </div>

                <!-- Input Jawaban -->
                <div class="w-full max-w-sm min-w-[200px]">
                    <label class="block mb-2 text-sm text-slate-600">Jawaban</label>
                    <input 
                        type="text"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                        placeholder="Masukan jawaban"
                    />
                </div>
            </div>

            <!-- Simpan Soal Button -->
            <div class="p-6 pt-0">
                <button
                    @click="tambahSoalOpen = false; questions.push(questions.length + 1)"
                    class="w-full rounded-md bg-indigo-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button"
                >
                    Simpan Soal
                </button>
            </div>
        </div>
    </div>