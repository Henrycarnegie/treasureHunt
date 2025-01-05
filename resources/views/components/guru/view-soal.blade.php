<div
     class="grid grid-flow-row gap-3 border-2 border-gray-400 p-4 rounded-md text-white w-full">
    {{-- Header Soal --}}
    <div class="flex" @click="viewSoalOpen = !viewSoalOpen">
        <span class="text-amber-500 font-semibold">Soal {{ $iteration }} <span class="text-green-500"> {{ ($infoLevel == '4') ? '('. $question->type.')'  : '' }} </span></span>
    </div>

    {{-- Pertanyaan dan Jawaban --}}
    <div class="flex flex-col" x-show="viewSoalOpen" x-collapse>
        <span class="mb-2">Pertanyaan: {{ $question->question_text }}</span>
        <div class="flex items-start gap-4 mb-2">
            <span>
                gambar:
            </span>
            <img
                src="{{ url(asset('storage/soal_level'.$infoLevel.'/' . $question->question_image)) }}"
                alt="gambar pertanyaan"
                class="h-48 w-auto"
            >
        </div>
        @if ($infoLevel != '3' && $infoLevel != '4')
            <span>Jawaban: {{ $question->correct_answer }}</span>
        @endif
    </div>
</div>
