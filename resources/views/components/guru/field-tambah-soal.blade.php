@props(['responseType' => '', 'fullOption' => false, 'boxId', 'infoLevel'])

@if ($responseType === 'pilgan')

    <!-- Input Pertanyaan -->
    <div class="w-full max-w-sm min-w-[200px]">
        <label for="question_text"
            class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pertanyaan</label>
        <input type="text" required wire:model="question_text" id="question_text"
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan pertanyaan" />

        @error('question_text')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label for="question_image" class="block mb-2 text-sm text-slate-600">Gambar Pertanyaan</label>
        <input type="file" wire:model="question_image" id="question_image" class="filepond" />
        @error('question_image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Input Jawaban -->
    @if ($fullOption)
        <div class="w-full max-w-sm min-w-[200px]">
            <label for="answer_a" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban A</label>
            <input type="text" required wire:model="answer_a" id="answer_a"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_a')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label for="answer_b" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                ja waban B</label>
            <input type="text" required wire:model="answer_b" id="answer_b"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_b')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label for="answer_c" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban C</label>
            <input type="text" required wire:model="answer_c" id="answer_c"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_c')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label for="answer_d" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban D</label>
            <input type="text" required wire:model="answer_d" id="answer_d"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_d')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full max-w-sm min-w-[200px]">
            <label for="correct_answer" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pilih opsi
                jawaban yang benar</label>
            <select
                wire:model="correct_answer" id="correct_answer" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                <option value="" selected>Pilih opsi jawaban yang tepat</option>
                <option value="A" class="">Option A</option>
                <option value="B" class="">Option B</option>
                <option value="C" class="">Option C</option>
                <option value="D" class="">Option D</option>
            </select>
        </div>
    @else
        <div class="w-full max-w-sm min-w-[200px]">
            <label for="answer_a" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban A</label>
            <input type="text" required wire:model="answer_a" id="answer_a"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_a')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full max-w-sm min-w-[200px]">
            <label for="answer_b" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Opsi
                jawaban B</label>
            <input type="text" required wire:model="answer_b" id="answer_b"
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                placeholder="Masukan jawaban" />
            @error('answer_b')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full max-w-sm min-w-[200px]">
            <label for="correct_answer" class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pilih opsi
                jawaban yang benar</label>
            <select
                wire:model="correct_answer" class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                <option value="" selected>Pilih opsi jawaban yang tepat</option>
                <option value="A" class="">Option A</option>
                <option value="B" class="">Option B</option>
            </select>
        </div>
    @endif
@elseif ( $responseType === 'uploadFoto')
    <!-- Input Pertanyaan -->
    @if ($infoLevel == '4')
        <div class="w-full max-w-sm min-w-[200px]">
            <label for="type"
                class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pilih Tipe Ikan</label>
            <select wire:model="type" id="question_text" required
                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow">
                <option value="" selected>Pilih Tipe Ikan</option>
                <option value="ikan kecil" class="">Ikan Kecil</option>
                <option value="ikan sedang" class="">Ikan Sedang</option>
                <option value="ikan besar" class="">Ikan Besar</option>
            @error('type')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            </select>
        </div>
    @endif
    <div class="w-full max-w-sm min-w-[200px]">
        <label for="question_text"
            class="block mb-2 text-sm text-slate-600 after:content-['*'] after:ml-0.5 after:text-red-500">Pertanyaan</label>
        <input wire:model="question_text" type="text" required id="question_text"
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            placeholder="Masukan pertanyaan" />
        @error('question_text')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="w-full max-w-sm min-w-[200px]">
        <label class="block mb-2 text-sm text-slate-600">Gambar Pertanyaan </label>
        <input type="file" wire:model="question_image"
            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow file:bg-indigo-500 file:text-white file:px-3 file:py-1" />
        @error('question_image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
@endif

<script>
    // Pastikan FilePond sudah di-load sebelumnya
    document.addEventListener('DOMContentLoaded', function () {
        FilePond.registerPlugin(FilePondPluginImagePreview);

        FilePond.create(document.querySelector('.filepond'), {
            imagePreviewHeight: 150,
            imagePreviewMaxFileSize: '5MB',
            allowImagePreview: true,
            allowMultiple: false,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            server: {
                process: '/your-upload-endpoint',
                revert: '/your-revert-endpoint',
            }
        });
    });
 </script>
