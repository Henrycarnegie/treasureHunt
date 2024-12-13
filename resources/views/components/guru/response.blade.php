@props([
    'number',
    'question' => 'Pertanyaan tidak tersedia',
    'answer',
    'image_reason',
    'point_reason',
    'responseType',
    'id',
])

@if ($responseType === 'pilgan')
    <span class="text-sm">Pertanyaan =
        <span class="text-sm text-white">{{ $question }}</span>
    </span>
    <span class="text-sm">Jawaban =
        <span class="text-sm text-white">{{ $answer == null ? 'Jawaban Kosong' : $answer }}</span>
    </span>
    <div class="md:flex gap-4">
        <span class="text-sm">Lembar alasan = </span>
        <img src="{{ asset('img/dummyResponse.png') }}" alt="jawaban siswa" class="w-40">
    </div>
@elseif ($responseType === 'pilganWithUpload')
    <span class="text-sm">Pertanyaan =
        <span class="text-sm text-white">{{ $question }}</span>
    </span>
    <span class="text-sm">Jawaban =
        <span class="text-sm text-white">{{ $answer == null ? 'Jawaban Kosong' : $answer }}</span>
    </span>
    <div class="md:flex gap-4">
        <span class="text-sm">Lembar alasan = </span>
        @if ($image_reason == null)
            <span class="text-sm text-white">Gambar Kosong</span>
        @else
            <img src="{{ asset('storage/answer_soal_level1/' . $image_reason) }}" alt="jawaban siswa" class="w-40">
        @endif
    </div>
        <div class="flex flex-col gap-2 ">
            <span class="text-sm"> {{ ($point_reason == 0) ? 'Masukan nilai untuk alasan siswa' : 'nilai alasan siswa : ' . $point_reason }}</span>
            @if ($point_reason == 0)
                <form wire:submit.prevent="simpanNilaiSoal1({{ $id }}, {{ $number }})" class="flex gap-2">
                    <!-- Gunakan wire:model dengan format point_reason.{{ $number }} -->
                    <input type="number" name="point_reason.{{ $number }}" wire:model="point_reason.{{ $number }}"
                        class="w-full block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 placeholder:text-sm"
                        placeholder="nilai 1 - 100">
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Save
                    </button>
                </form>

                @error('point_reason.' . $number)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            @endif
        </div>
@elseif ($responseType === 'upload')
    <div class="grid lg:grid-cols-2 gap-4">
        <div class="md:flex gap-4">
            <span class="text-sm">Lembar alasan = </span>
            <img src="{{ asset('img/dummyResponse.png') }}" alt="jawaban siswa" class="w-40">
        </div>
        <div class="flex flex-col gap-2">
            <span class="text-sm">Masukan nilai siswa</span>
            <form action="" class="flex gap-2">
                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                    class="w-full block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="nilai 1 - 100">
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </form>
        </div>
    </div>
@endif
