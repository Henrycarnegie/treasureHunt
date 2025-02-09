@props([
    'level',
    'number',
    'question' => 'Pertanyaan tidak tersedia',
    'answer',
    'is_correct',
    'image_reason',
    'point_reason',
    'responseType',
    'id',
])

@if ($responseType === 'pilgan')
    <div class="w-full flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <span class="text-sm">Pertanyaan =
                <span class="text-sm text-white">{{ $question }}</span>
            </span>
            <span class="text-sm">Jawaban =
                <span class="text-sm text-white">
                    {{ $answer == null ? 'Jawaban Kosong' : $answer }}
                    @if ($is_correct == 1)
                        <span class="ml-2 text-green-500 font-bold">(Benar)</span>
                    @else
                        <span class="ml-2 text-red-500 font-bold">(Salah)</span>
                    @endif
                </span>
            </span>
        </div>
    </div>
@elseif ($responseType === 'pilganWithUpload')
    <div class="w-full flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <span class="text-sm">Pertanyaan =
                <span class="text-sm text-white">{{ $question }}</span>
            </span>
            <span class="text-sm">Jawaban =
                <span class="text-sm text-white">
                    {{ $answer == null ? 'Jawaban Kosong' : $answer }}
                    @if ($is_correct == 1)
                        <span class="ml-2 text-green-500 font-bold">(Benar)</span>
                    @else
                        <span class="ml-2 text-red-500 font-bold">(Salah)</span>
                    @endif
                </span>
            </span>
        </div>

        <div class="flex flex-col gap-4">
            <div class="flex gap-4">
                <span class="text-sm">Lembar alasan = </span>
                @if ($image_reason == null)
                    <span class="text-sm text-white">Gambar Kosong</span>
                @else
                    <a href="{{ asset('storage/answer_soal_level'.$level.'/' . $image_reason) }}" target="_blank">
                        <img src="{{ asset('storage/answer_soal_level'.$level.'/' . $image_reason) }}" alt="jawaban siswa" class="w-40">
                    </a>
                @endif
            </div>

            <div class="flex flex-col gap-2 w-full">
                <span class="text-sm">{{ ($point_reason == 0) ? 'Masukan nilai untuk alasan siswa' : 'nilai alasan siswa : ' . $point_reason }}</span>
                @if ($point_reason == 0)
                    <form wire:submit.prevent="simpanNilai({{$level}}, {{ $id }}, {{ $number }})" class="flex gap-2">
                        <input type="number" name="point_reason.{{ $number }}" wire:model="point_reason.{{ $number }}"
                            class="w-full block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 placeholder:text-sm"
                            placeholder="nilai 1 - 50">
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
        </div>
    </div>
@elseif ($responseType === 'upload')
        <span class="text-sm">Pertanyaan =
            <span class="text-sm text-white">{{ $question }}</span>
        </span>
        <div class="md:flex gap-4">
            @if ($image_reason == null)
                <span class="text-sm text-white">Gambar Kosong</span>
            @else
                <a href="{{ asset('storage/answer_soal_level'.$level.'/' . $image_reason) }}" target="_blank">
                    <img src="{{ asset('storage/answer_soal_level'.$level.'/' . $image_reason) }}" alt="jawaban siswa" class="w-40">
                </a>
            @endif
        </div>
        <div class="flex flex-col gap-2 ">
            <span class="text-sm"> {{ ($point_reason == 0) ? 'Masukan nilai untuk alasan siswa' : 'nilai alasan siswa : ' . $point_reason }}</span>
            @if ($point_reason == 0)
            <form wire:submit.prevent="simpanNilai({{$level}}, {{ $id }}, {{ $number }})" class="flex gap-2">
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
@endif
