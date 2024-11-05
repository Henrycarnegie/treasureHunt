<div
     class="grid grid-flow-row gap-3 border-2 border-gray-400 p-4 rounded-md text-white w-full">
    {{-- Header Soal --}}
    <div class="flex" @click="viewSoalOpen = !viewSoalOpen">
        <span class="text-amber-500 font-semibold">Soal {{ $iteration }}</span>
    </div>

    {{-- Pertanyaan dan Jawaban --}}
    <div class="flex flex-col" x-show="viewSoalOpen" x-collapse>
        <span>Pertanyaan: {{ $question->question_text }}</span>
        <span>gambar: <img src="{{ url(asset('storage/soal_level1/' . $question->question_image)) }}" alt="gambar pertanyaan"></span>
        <span>Jawaban: {{ $question->correct_answer }}</span>
    </div>
</div>
