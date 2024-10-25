<div x-data="{ viewSoalOpen: false}"
     class="grid grid-flow-row gap-3 border-2 border-gray-400 p-4 rounded-md text-white w-full">
    {{-- Header Soal --}}
    <div class="flex" @click="viewSoalOpen = !viewSoalOpen">
        <span class="text-amber-500 font-semibold">Soal <span x-text="index + 1"></span></span>
    </div>
    {{-- Pertanyaan dan Jawaban --}}
    <div class="flex flex-col" x-show="viewSoalOpen" x-collapse>
        <span>Pertanyaan : </span>
        <Span>jawaban : </Span>
    </div>
</div>
