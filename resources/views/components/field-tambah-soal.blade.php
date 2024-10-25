@props(['responseType' => 'pilgan'])

@if ($responseType === 'pilgan')
    <!-- Input Pertanyaan -->
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pertanyaan</label>
        <input type="text" required
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan pertanyaan" />
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600">Gambar Pertanyaan</label>
        <input type="file" 
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow file:bg-indigo-500 file:text-white file:px-3 file:py-1"/>
    </div>

    <!-- Input Jawaban -->
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi jawaban 1</label>
        <input type="text" required
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan jawaban" />
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi jawaban 2</label>
        <input type="text" required
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan jawaban" />
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600">Opsi jawaban 3</label>
        <input type="text" required
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan jawaban" />
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600">Opsi jawaban 4</label>
        <input type="text" required
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan jawaban" />
    </div>
@elseif ($responseType === 'pilganUploadFoto' || $responseType === 'uploadFoto')
    <!-- Input Pertanyaan -->
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pertanyaan</label>
        <input type="text" required
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan pertanyaan" />
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600">Gambar Pertanyaan</label>
        <input type="file" 
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow file:bg-indigo-500 file:text-white file:px-3 file:py-1"/>
    </div>
@endif

