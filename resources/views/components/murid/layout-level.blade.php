@props(['infoLevel', 'levelTimeLeft' => 10, 'startTime', 'endTime', 'display' => '00:00', 'data'])
@if ($infoLevel === '1')
<!-- Modal preparation user -->
<div x-data="{
    showModal: @entangle('showModal'),
    display: '00:00',
    endTime: {{ $endTime ?? 'null' }},
    intervalId: null,
    isFinished: false,
    levelTimeLeft: {{ $levelTimeLeft ?? 0 }},
    remainingTime: 0,
    init() {
        if (this.endTime !== null) {
            const remaining = this.endTime - Date.now();
            if (remaining > 0) {
                this.remainingTime = remaining;
                this.startCountdown();
            } else {
                this.display = '00:00';
            }
        } else {
            this.display = '00:00';
        }
    },

    startCountdown() {
        if (this.isFinished) return;

        if (this.remainingTime > 0) {
            this.endTime = Date.now() + this.remainingTime;
        } else {
            this.endTime = Date.now() + (this.levelTimeLeft * 60 * 1000);
        }

        $wire.call('startGame', this.endTime);

        this.intervalId = setInterval(() => {
            const now = Date.now();
            const remaining = Math.max(0, this.endTime - now);
            this.remainingTime = remaining;

            if (remaining > 0) {
                this.updateDisplay(remaining);
            } else {
                this.finishCountdown();
            }
        }, 1000);
    },

    finishCountdown() {
        if (!this.isFinished) {
            this.isFinished = true;
            clearInterval(this.intervalId);
            this.display = '00:00'; // Menampilkan 00:00 setelah selesai
            this.$wire.call('countdownFinished');
            const submitButton = document.getElementById('submit-button');
            if (submitButton) {
                submitButton.click();
            }
        }
    },

    updateDisplay(remaining) {
        const totalSeconds = Math.floor(remaining / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }
}" x-init="init()">

    <!-- Modal -->
    <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-70 backdrop-blur-lg"
        x-show="showModal"
        x-transition:enter="transition ease-out duration-300 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 motion-reduce:transition-opacity"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">

        <!-- Modal inner -->
        <div class="max-w-3xl px-6 py-4 mx-4 text-left bg-white rounded shadow-lg"
            x-transition:enter="transition ease-out duration-300 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0 scale-75"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 delay-75 motion-reduce:transition-opacity"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75">

            <!-- Title / Close -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-xl font-bold text-center mr-3 text-black max-w-none">Apakah kalian sudah siap bermain?</h1>
            </div>

            <!-- Content -->
            <div class="mb-6">
                <h1>
                    Siapkan semua alat tulis dan kertas! Tidak diperbolehkan menggunakan
                    <span class="text-red-500 font-semibold">kalkulator</span>
                    atau
                    <span class="text-red-500 font-semibold">ChatGPT</span>
                </h1>
            </div>

            <!-- Button -->
            <div class="flex justify-end">
                <button type="button"
                    class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    @click="showModal = false; startCountdown()">
                    Mulai bermain
                </button>
            </div>
        </div>
    </div>

    <!-- Countdown Display -->
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center"
        x-show="!showModal">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono">
            <span x-text="display"></span>
        </div>
    </aside>
</div>

@foreach ($data->where('role_name', auth()->user()->getRoleNames()->first()) as $item)
    <div x-show="currentQuestion === {{ $loop->iteration }}" class="flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center w-full">
        {{-- Soal --}}
        <x-murid.layout-soal infoLevel="{{$infoLevel}}" :image="$item->question_image" :infoSoal="$loop->iteration" :soal="$item->question_text"></x-murid.layout-soal>

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

@elseif ($infoLevel === '2')
<!-- Modal preparation user -->
<div x-data="{
    showModal: @entangle('showModal'),
    display: '00:00',
    endTime: {{ $endTime ?? 'null' }},
    intervalId: null,
    isFinished: false,
    levelTimeLeft: {{ $levelTimeLeft ?? 0 }},
    remainingTime: 0,
    init() {
        if (this.endTime !== null) {
            const remaining = this.endTime - Date.now();
            if (remaining > 0) {
                this.remainingTime = remaining;
                this.startCountdown();
            } else {
                this.display = '00:00';
            }
        } else {
            this.display = '00:00';
        }
    },

    startCountdown() {
        if (this.isFinished) return;

        if (this.remainingTime > 0) {
            this.endTime = Date.now() + this.remainingTime;
        } else {
            this.endTime = Date.now() + (this.levelTimeLeft * 60 * 1000);
        }

        $wire.call('startGame', this.endTime);

        this.intervalId = setInterval(() => {
            const now = Date.now();
            const remaining = Math.max(0, this.endTime - now);
            this.remainingTime = remaining;

            if (remaining > 0) {
                this.updateDisplay(remaining);
            } else {
                this.finishCountdown();
            }
        }, 1000);
    },

    finishCountdown() {
        if (!this.isFinished) {
            this.isFinished = true;
            clearInterval(this.intervalId);
            this.display = '00:00'; // Menampilkan 00:00 setelah selesai
            this.$wire.call('countdownFinished');
            const submitButton = document.getElementById('submit-button');
            if (submitButton) {
                submitButton.click();
            }
        }
    },

    updateDisplay(remaining) {
        const totalSeconds = Math.floor(remaining / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }
}" x-init="init()">

    <!-- Modal -->
    <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-70 backdrop-blur-lg"
        x-show="showModal"
        x-transition:enter="transition ease-out duration-300 motion-reduce:transition-opacity"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 motion-reduce:transition-opacity"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">

        <!-- Modal inner -->
        <div class="max-w-3xl px-6 py-4 mx-4 text-left bg-white rounded shadow-lg"
            x-transition:enter="transition ease-out duration-300 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0 scale-75"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 delay-75 motion-reduce:transition-opacity"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75">

            <!-- Title / Close -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-xl font-bold text-center mr-3 text-black max-w-none">Apakah kalian sudah siap bermain?</h1>
            </div>

            <!-- Content -->
            <div class="mb-6">
                <h1>
                    Siapkan semua alat tulis dan kertas! Tidak diperbolehkan menggunakan
                    <span class="text-red-500 font-semibold">kalkulator</span>
                    atau
                    <span class="text-red-500 font-semibold">ChatGPT</span>
                </h1>
            </div>

            <!-- Button -->
            <div class="flex justify-end">
                <button type="button"
                    class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    @click="showModal = false; startCountdown()">
                    Mulai bermain
                </button>
            </div>
        </div>
    </div>

    <!-- Countdown Display -->
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center"
        x-show="!showModal">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono">
            <span x-text="display"></span>
        </div>
    </aside>
</div>

@foreach ($data as $item)
    <div x-show="currentQuestion === {{ $loop->iteration }} && !isQuestionAnswered({{ $item->id }})"
        class="flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center w-full">
        {{-- Soal --}}
        <x-murid.layout-soal infoLevel="{{$infoLevel}}" :image="$item->question_image" :infoSoal="$loop->iteration" :soal="$item->question_text"></x-murid.layout-soal>

        {{-- Option Jawaban --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:gap-x-20 xl:gap-y-8 min-w-full">
            <x-murid.answer-option id_option="{{ $item->id }}" value="{{ $item->answer_a }}">{{ $item->answer_a }}</x-murid.answer-option>
            <x-murid.answer-option id_option="{{ $item->id }}" value="{{ $item->answer_b }}">{{ $item->answer_b }}</x-murid.answer-option>
            <x-murid.answer-option id_option="{{ $item->id }}" value="{{ $item->answer_c }}">{{ $item->answer_c }}</x-murid.answer-option>
            <x-murid.answer-option id_option="{{ $item->id }}" value="{{ $item->answer_d }}">{{ $item->answer_d }}</x-murid.answer-option>
        </div>

        {{-- Upload Foto --}}
        <x-murid.upload-foto id_option="{{ $item->id }}"></x-murid.upload-foto>
        <input type="hidden" wire:model.fill="soallevel1_id.{{ $item->id }}" value="{{ $item->id }}">

        {{-- Button Navigation --}}
        <div class="w-full flex justify-end gap-4">
            <button type="button"
                    x-show="currentQuestion < totalQuestions && $wire.questionAnswered({{ $item->id }})"
                    @click="nextQuestion()"
                    class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                Next
            </button>
            <button id="submit-button"
                    x-show="currentQuestion === totalQuestions"
                    type="submit"
                    class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                Submit
            </button>
        </div>
    </div>
@endforeach

@elseif ($infoLevel === '3')
    {{-- Countdown Timer --}}
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono" x-data="countdown({{ $levelTimeLeft }})" x-init="init()" x-text="display">
            {{ $display }}
        </div>
    </aside>

    {{-- Soal --}}
    <x-murid.layout-soal infoLevel="{{$infoLevel}}" infoSoal="1"></x-murid.layout-soal>

    {{-- Upload Foto --}}
    <x-murid.upload-foto id_option="1"></x-murid.upload-foto>

    {{-- Button Next --}}
    <div class="w-full flex justify-end">
        <button
            class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Next</button>
    </div>
@elseif ($infoLevel === '4')
    {{-- Countdown Timer --}}
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono" x-data="countdown({{ $levelTimeLeft }})" x-init="init()" x-text="display">
            {{ $display }}
        </div>
    </aside>

    {{-- Soal --}}
    <x-murid.layout-soal infoLevel="{{$infoLevel}}" infoSoal="1"></x-murid.layout-soal>

    {{-- Upload Foto --}}
    <x-murid.upload-foto id_option="1"></x-murid.upload-foto>

    {{-- Button Next --}}
    <div class="w-full flex justify-end">
        <button
            class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Next</button>
    </div>
@elseif($infoLevel === '5')
    {{-- Nyawa Siswa --}}
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Sisa Nyawa</h2>
        <div
            class="text-lg font-mono text-red-500 flex gap-2"
            {{-- x-data="lives({{ $initialLives }})"
            x-init="init()" --}}
        >
            <template x-for="(life, index) in lives" :key="index">
                <span class="text-red-500">❤️</span>
            </template>
        </div>
    </aside>


    <x-murid.layout-soal infoLevel="{{$infoLevel}}" infoSoal="1"></x-murid.layout-soal>

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
@endif
