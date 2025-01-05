@props(['infoLevel', 'levelTimeLeft' => 0, 'startTime', 'endTime', 'display' => '00:00', 'data', 'nyawa', 'totalNyawa', 'deskripsi_opening'])
@if ($infoLevel === '1')
<!-- Modal preparation user -->
<div x-data="{
    showModal: @entangle('showModal'),
    display: '00:00',
    endTime: {{ $endTime ?? 'null' }},
    intervalId: null,
    isFinished: false,
    isSubmitted: false,
    levelTimeLeft: {{ $levelTimeLeft ?? 0 }},
    remainingTime: 0,
    currentQuestion: 1,
    totalQuestions: {{ $data->where('role_name', auth()->user()->getRoleNames()->first())->count() }},

    init() {
        // Initialize countdown if endTime exists
        if (this.endTime !== null) {
            const remaining = this.endTime - Date.now();
            if (remaining > 0) {
                this.remainingTime = remaining;
                this.startCountdown();
            } else {
                this.display = '00:00';
                this.isFinished = true;
            }
        }
    },

    startCountdown() {
        if (this.isFinished) return;

        // Set up the end time based on remaining time or new countdown
        if (this.remainingTime > 0) {
            this.endTime = Date.now() + this.remainingTime;
        } else {
            this.endTime = Date.now() + (this.levelTimeLeft * 60 * 1000);
        }

        // Notify Livewire of game start
        $wire.call('startGame', this.endTime);

        // Start the countdown interval
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

    updateDisplay(remaining) {
        const totalSeconds = Math.floor(remaining / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    },

    handleSubmit() {
        if (this.isSubmitted) return;

        this.isSubmitted = true;
        const submitButton = document.getElementById('submit-button');
        if (submitButton) {
            submitButton.click();
        }
    },

    finishCountdown() {
        if (!this.isFinished) {
            this.isFinished = true;
            clearInterval(this.intervalId);
            this.display = '00:00';
            $wire.call('countdownFinished');

            // Only trigger submit if time runs out and not already submitted
            if (!this.isSubmitted) {
                this.handleSubmit();
            }
        }
    },

    previousQuestion() {
        if (this.currentQuestion > 1) {
            this.currentQuestion--;
        }
    },

    nextQuestion() {
        if (this.currentQuestion < this.totalQuestions) {
            this.currentQuestion++;
        }
    }
}"
x-init="init()">

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
                    {{ $deskripsi_opening }}
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
    isSubmitted: false,
    levelTimeLeft: {{ $levelTimeLeft ?? 0 }},
    remainingTime: 0,
    currentQuestion: 1,
    totalQuestions: {{ $data->where('role_name', auth()->user()->getRoleNames()->first())->count() }},

    init() {
        // Initialize countdown if endTime exists
        if (this.endTime !== null) {
            const remaining = this.endTime - Date.now();
            if (remaining > 0) {
                this.remainingTime = remaining;
                this.startCountdown();
            } else {
                this.display = '00:00';
                this.isFinished = true;
            }
        }
    },

    startCountdown() {
        if (this.isFinished) return;

        // Set up the end time based on remaining time or new countdown
        if (this.remainingTime > 0) {
            this.endTime = Date.now() + this.remainingTime;
        } else {
            this.endTime = Date.now() + (this.levelTimeLeft * 60 * 1000);
        }

        // Notify Livewire of game start
        $wire.call('startGame', this.endTime);

        // Start the countdown interval
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

    updateDisplay(remaining) {
        const totalSeconds = Math.floor(remaining / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    },

    handleSubmit() {
        if (this.isSubmitted) return;

        this.isSubmitted = true;
        const submitButton = document.getElementById('submit-button');
        if (submitButton) {
            submitButton.click();
        }
    },

    finishCountdown() {
        if (!this.isFinished) {
            this.isFinished = true;
            clearInterval(this.intervalId);
            this.display = '00:00';
            $wire.call('countdownFinished');

            // Only trigger submit if time runs out and not already submitted
            if (!this.isSubmitted) {
                this.handleSubmit();
            }
        }
    },

    previousQuestion() {
        if (this.currentQuestion > 1) {
            this.currentQuestion--;
        }
    },

    nextQuestion() {
        if (this.currentQuestion < this.totalQuestions) {
            this.currentQuestion++;
        }
    }
}"
x-init="init()">

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
                    {{ $deskripsi_opening }}
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
    <div x-show="currentQuestion === {{ $loop->iteration }}" class="flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center w-full">
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
        <input type="hidden" wire:model.fill="soallevel2_id.{{ $item->id }}" value="{{ $item->id }}">

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

@elseif ($infoLevel === '3')
<!-- Modal preparation user -->
<div x-data="{
    display: '00:00',
    endTime: {{ $endTime ?? 'null' }},
    intervalId: null,
    isFinished: false,
    isSubmitted: false,
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
                this.handleSubmit();
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

    handleSubmit() {
        if (this.isSubmitted) return; // Prevent multiple submissions

        this.isSubmitted = true;
        const submitButton = document.getElementById('submit-button');
        if (submitButton) {
            submitButton.click();
        }
    },

    finishCountdown() {
        if (!this.isFinished) {
            this.isFinished = true;
            clearInterval(this.intervalId);
            this.display = '00:00';
            this.$wire.call('countdownFinished');
            this.handleSubmit();
        }
    },

    updateDisplay(remaining) {
        const totalSeconds = Math.floor(remaining / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }
}" x-init="init()">

    <!-- Countdown Display -->
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Countdown</h2>
        <div class="text-lg font-mono">
            <span x-text="display"></span>
        </div>
    </aside>
</div>

    @foreach ($data as $item)
        <div x-show="currentQuestion === {{ $loop->iteration }}" class="flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center w-full">
            {{-- Soal --}}
            <x-murid.layout-soal infoLevel="{{$infoLevel}}" :image="$item->question_image" :infoSoal="$loop->iteration" :soal="$item->question_text"></x-murid.layout-soal>

            {{-- Upload Foto --}}
            <x-murid.upload-foto id_option="{{ $item->id }}"></x-murid.upload-foto>
            <input type="hidden" wire:model.fill="soallevel3_id.{{ $item->id }}" value="{{ $item->id }}">

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

@elseif ($infoLevel === '4')
    <!-- Modal preparation user -->
    <div x-data="{
            showModal: @entangle('showModal'),
            display: '00:00',
            endTime: {{ $endTime ? $endTime : 'null' }},
            intervalId: null,
            isFinished: false,
            isSubmitted: false,
            levelTimeLeft: {{ $countdown ?? 0 }},
            remainingTime: 0,

            init() {
                // Jika endTime sudah ada (misal reload halaman)
                if (this.endTime !== null) {
                    const remaining = this.endTime - Date.now();
                    if (remaining > 0) {
                        this.remainingTime = remaining;
                        this.startCountdown();
                    } else {
                        this.display = '00:00';
                        this.finishCountdown();
                    }
                }
            },

            startCountdown() {
                if (this.isFinished) return;

                // Jika belum ada endTime, hitung baru
                if (!this.endTime) {
                    this.endTime = Date.now() + (this.levelTimeLeft * 60 * 1000);
                    $wire.call('startGame', this.endTime);
                }

                this.intervalId = setInterval(() => {
                    const now = Date.now();
                    const remaining = Math.max(0, this.endTime - now);

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
                    this.display = '00:00';
                    this.$wire.call('countdownFinished');
                }
            },

            updateDisplay(remaining) {
                const totalSeconds = Math.floor(remaining / 1000);
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }
        }" x-init="init()">

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
        <div class="flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center w-full">
            {{-- Soal --}}
            <x-murid.layout-soal infoLevel="{{$infoLevel}}" :image="$item->question_image" :infoSoal="$loop->iteration" :soal="$item->question_text"></x-murid.layout-soal>

            {{-- Upload Foto --}}
            <x-murid.upload-foto id_option="{{ $item->id }}"></x-murid.upload-foto>
            <input type="hidden" wire:model.fill="soallevel4_id.{{ $item->id }}" value="{{ $item->id }}">

            <div class="w-full flex justify-end gap-4">
                <button id="submit-button"
                        type="submit"
                        class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    Submit
                </button>
            </div>
        </div>
    @endforeach
@elseif($infoLevel === '5')

    <!-- Modal preparation user -->
    <div x-data="{
        showModal: @entangle('showModal')
    }">

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
                    {{ $deskripsi_opening }}
                </h1>
            </div>

            <!-- Button -->
            <div class="flex justify-end">
                <button type="button"
                    class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    wire:click="startGame">
                    Mulai bermain
                </button>
            </div>
        </div>
    </div>

    {{-- Nyawa Siswa --}}
    <aside class="fixed top-[10px] right-[10px] z-10 max-w-max md:w-1/5 p-4 bg-gray-800 rounded-md text-white shadow-lg flex flex-col items-center">
        <h2 class="text-sm font-bold mb-2">Sisa Nyawa</h2>
        <div
            class="text-lg font-mono text-red-500 flex gap-2">
            @for ($i = 1; $i <= $totalNyawa; $i++)
                @if ($i <= $nyawa)
                    <span class="text-red-500">❤️</span>
                @else
                    <span class="text-gray-500">🩶</span>
                @endif
            @endfor
        </div>
    </aside>
</div>


    {{-- <x-murid.layout-soal infoLevel="{{$infoLevel}}" infoSoal="1"></x-murid.layout-soal> --}}
    <x-murid.layout-soal infoLevel="{{$infoLevel}}" :image="$data->question_image" :infoSoal="1" :soal="$data->question_text"></x-murid.layout-soal>

    {{-- Option Jawaban --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 xl:gap-x-20 xl:gap-y-8 min-w-full">
    <x-murid.answer-option id_option="{{ $data->id }}" value="{{ $data->answer_a }}" infoLevel="{{$infoLevel}}">{{ $data->answer_a }}</x-murid.answer-option>
    <x-murid.answer-option id_option="{{ $data->id }}" value="{{ $data->answer_b }}" infoLevel="{{$infoLevel}}">{{ $data->answer_b }}</x-murid.answer-option>
    <x-murid.answer-option id_option="{{ $data->id }}" value="{{ $data->answer_c }}" infoLevel="{{$infoLevel}}">{{ $data->answer_c }}</x-murid.answer-option>
    <x-murid.answer-option id_option="{{ $data->id }}" value="{{ $data->answer_d }}" infoLevel="{{$infoLevel}}">{{ $data->answer_d }}</x-murid.answer-option>
    </div>
@endif
