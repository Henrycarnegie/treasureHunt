@props(['responseType' => '', 'fullOption' => false])

@if ($responseType === 'pilgan')

    <!-- Input Pertanyaan -->
    <div class="w-full max-w-sm min-w-[200px]">
        <label
            class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pertanyaan</label>
        <input type="text" required wire:model="question_text" name="question_text"
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan pertanyaan" />

        @error('question_text')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600">Gambar Pertanyaan</label>
        <input type="file" wire:model="question_image" name="question_image"
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow file:bg-indigo-500 file:text-white file:px-3 file:py-1" />
        @error('question_image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Input Jawaban -->
    @if ($fullOption)
        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban A</label>
            <input type="text" required wire:model="answer_a" name="answer_a"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_a')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban B</label>
            <input type="text" required wire:model="answer_b" name="answer_b"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_b')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban C</label>
            <input type="text" required wire:model="answer_c" name="answer_c"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_c')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban D</label>
            <input type="text" required wire:model="answer_d" name="answer_d"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_d')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @else
        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban A</label>
            <input type="text" required wire:model="answer_a" name="answer_a"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_a')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban B</label>
            <input type="text" required wire:model="answer_b" name="answer_b"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_b')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    @endif
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pilih opsi
            jawaban yang benar</label>
        <select
            wire:model="correct_answer" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
            <option value="" selected>Pilih opsi jawaban yang tepat</option>
            <option value="A" class="">Option A</option>
            <option value="B" class="">Option B</option>
        </select>
    </div>
@elseif ($responseType === 'pilganUploadFoto' || $responseType === 'uploadFoto')
    <!-- Input Pertanyaan -->
    <div class="w-full max-w-sm min-w-[200px]">
        <label
            class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pertanyaan</label>
        <input type="text" required
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan pertanyaan" />
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600">Gambar Pertanyaan</label>
        <input type="file"
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow file:bg-indigo-500 file:text-white file:px-3 file:py-1" />
    </div>
@endif
