@section('title', 'Level 4')

<div
class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-teal-700 via-teal-900 to-blue-900 py-12 px-6 lg:px-20 xl:px-60 relative">
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
                $wire.call('handleConfirm');

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
            x-transition:leave-end="opacity-0 scale-90"
            x-cloak>

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

    <div class="bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-md border-gray-200 shadow-lg px-8 py-6 min-w-full min-h-80">
        <div class="flex w-full" wire:poll>
            <div class="w-full flex flex-col gap-y-3 justify-center items-center">
                @foreach ($data->where('type', 'ikan kecil') as $item)
                    @if($item->is_answered == true)
                        <img src="{{ asset('img/small-fish-used.svg') }}" alt="box-1" class="h-40 cursor-not-allowed transform transition-transform duration-300 hover:scale-110 p-2">
                    @else
                        <img src="{{ asset('img/small-fish.svg') }}" alt="box-1" class="h-40 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" wire:navigate href="{{ route('murid.ShowSoalLevel4', ['soalId' => $item->id]) }}">
                    @endif
                @endforeach
            </div>
            <div class="w-full flex flex-col gap-y-3 justify-center items-center">
                @foreach ($data->where('type', 'ikan sedang') as $item)
                    @if($item->is_answered == true)
                        <img src="{{ asset('img/medium-fish-used.svg') }}" alt="box-1" class="h-40 cursor-not-allowed transform transition-transform duration-300 hover:scale-110 p-2">
                    @else
                        <img src="{{ asset('img/medium-fish.svg') }}" alt="box-1" class="h-40 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" wire:navigate href="{{ route('murid.ShowSoalLevel4', ['soalId' => $item->id]) }}">
                    @endif
                @endforeach
            </div>
            <div class="w-full flex flex-col gap-y-3 justify-center items-center">
                @foreach ($data->where('type', 'ikan besar') as $item)
                    @if($item->is_answered == true)
                        <img src="{{ asset('img/big-fish-used.svg') }}" alt="box-1" class="h-40 cursor-not-allowed transform transition-transform duration-300 hover:scale-110 p-2">
                    @else
                        <img src="{{ asset('img/big-fish.svg') }}" alt="box-1" class="h-40 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" wire:navigate href="{{ route('murid.ShowSoalLevel4', ['soalId' => $item->id]) }}">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @if ($data->where('is_answered', true)->count() > 0)
        <div class="w-full flex justify-end">
            <button
                type="button"
                class="rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" wire:click="confirmFinish">
                Selesai
            </button>
        </div>
    @endif
</div>
