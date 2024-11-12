@props(['infoLevel', 'levelTimeLeft' => 15, 'display' => '00:00', 'data'])

@if ($infoLevel === '1')
    {{-- PopUp before start game --}}
    <x-murid.ready-popup x-show="isModalWarning"></x-murid.ready-popup>

    {{-- Countdown Timer --}}
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono" x-data="countdown({{ $levelTimeLeft }})" x-init="init()" x-text="display">
            {{ $display }}
        </div>
    </aside>

    @foreach ($data->where('role_name', auth()->user()->getRoleNames()->first()) as $item)
        <div x-show="currentQuestion === {{ $loop->iteration }}"
            class="flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center w-full">

            {{-- Soal --}}
            <x-murid.layout-soal :infoSoal="$loop->iteration" :soal="$item->question_text"></x-murid.layout-soal>

            {{-- Option Jawaban --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:gap-x-20 xl:gap-y-8 min-w-full">
                <x-murid.answer-option id_option="{{ $item->id }}" value="{{ $item->answer_a }}">{{ $item->answer_a }}</x-murid.answer-option>
                <x-murid.answer-option id_option="{{ $item->id }}" value="{{ $item->answer_b }}">{{ $item->answer_b }}</x-murid.answer-option>
            </div>
            {{-- Upload Foto --}}
            <x-murid.upload-foto id_option="{{ $item->id }}"></x-murid.upload-foto>
            <input type="hidden" wire:model.fill="soallevel1_id.{{ $item->id }}" value="{{ $item->id }}">


            {{-- Button Navigation --}}
            <div class="w-full flex justify-end gap-4">
                <button type="button"
                        x-show="currentQuestion > 1"
                        @click="previousQuestion()"
                        class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    Previous
                </button>
                <button type="button"
                        x-show="currentQuestion < totalQuestions"
                        @click="nextQuestion()"
                        class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    Next
                </button>
                <button id="submit-button" x-show="currentQuestion === totalQuestions"
                        type="submit"
                        class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    Submit
                </button>
            </div>
        </div>
    @endforeach

@elseif ($infoLevel === '2' || $infoLevel === '5')
    {{-- Countdown Timer --}}
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono" x-data="countdown({{ $levelTimeLeft }})" x-init="init()" x-text="display">
            {{ $display }}
        </div>
    </aside>

    <x-murid.layout-soal infoSoal="1"></x-murid.layout-soal>

    {{-- Option Jawaban --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:gap-x-20 xl:gap-y-8 min-w-full">
        <x-murid.answer-option id_option="1" value="A">1</x-murid.answer-option>
        <x-murid.answer-option id_option="2" value="B">2</x-murid.answer-option>
        <x-murid.answer-option id_option="3" value="C">3</x-murid.answer-option>
        <x-murid.answer-option id_option="4" value="D">4</x-murid.answer-option>
    </div>

    <div class="w-full flex justify-end">
        {{-- Button Next --}}
        <button
            type="submit"
            class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Next</button>
    </div>
@elseif ($infoLevel === '3' || $infoLevel === '4')
    {{-- Countdown Timer --}}
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono" x-data="countdown({{ $levelTimeLeft }})" x-init="init()" x-text="display">
            {{ $display }}
        </div>
    </aside>

    {{-- Soal --}}
    <x-murid.layout-soal infoSoal="1"></x-murid.layout-soal>

    {{-- Upload Foto --}}
    <x-murid.upload-foto id_option="1"></x-murid.upload-foto>

    {{-- Button Next --}}
    <div class="w-full flex justify-end">
        <button
            class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Next</button>
    </div>
@endif
