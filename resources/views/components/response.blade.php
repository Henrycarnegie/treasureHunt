@props([
    'question' => 'Pertanyaan tidak tersedia',
    'answer' => 'Jawaban tidak tersedia',
    'responseType' => 'pilgan',
])

@if ($responseType === 'pilgan')
    <span class="text-sm">Pertanyaan =
        <span class="text-sm text-white">{{ $question }}</span>
    </span>
    <span class="text-sm">Jawaban =
        <span class="text-sm text-white">{{ $answer }}</span>
    </span>
@elseif ($responseType === 'pilgan-with-upload')
    <span class="text-sm">Pertanyaan =
        <span class="text-sm text-white">{{ $question }}</span>
    </span>
    <span class="text-sm">Jawaban =
        <span class="text-sm text-white">{{ $answer }}</span>
    </span>
    <div class="flex gap-4">
        <span class="text-sm">Lembar alasan = </span>
        <img src="{{ asset('img/dummyResponse.png') }}" alt="jawaban siswa" class="w-40">
    </div>
    <div class="flex flex-col gap-2 ">
        <span class="text-sm">Masukan nilai siswa</span>
        <form action="" class="flex gap-2">
            <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="nilai 1 - 100">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </form>
    </div>
@elseif ($responseType === 'upload')
    <div class="grid grid-cols-2">
        <div class="flex gap-4">
            <span class="text-sm">Lembar alasan = </span>
            <img src="{{ asset('img/dummyResponse.png') }}" alt="jawaban siswa" class="w-40">
        </div>
        <div class="flex flex-col gap-2">
            <span class="text-sm">Masukan nilai siswa</span>
            <form action="" class="flex gap-2">
                <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="nilai 1 - 100">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </form>
        </div>
    </div>
@endif

{{-- 
    Level 1 : Pilihan ganda & Upload foto || Koreksi oleh guru
    Level 2 : Pilihan ganda || Koreksi oleh sistem
    Level 3 : Upload foto || Koreksi oleh guru
    Level 4 : Upload foto || Koreksi oleh guru
    Level 5 : Pilihan ganda || Koreksi oleh sistem
--}}
