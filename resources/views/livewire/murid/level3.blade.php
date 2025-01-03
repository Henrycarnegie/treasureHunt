@section('title', 'Level 3')

<div
class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-orange-900 to-teal-800 py-12 px-6 lg:px-20 xl:px-60 relative">
    <div x-data="{
        showModal: @entangle('showModal')}">

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
                        @click="showModal = false">
                        Oke
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-md bg-clip-padding backdrop-filter backdrop-blur-md border-gray-200 shadow-lg px-8 py-6 min-w-full min-h-80">
        <div class="flex w-full">
            @foreach ( $data as $item)
                <div class="w-full flex flex-col gap-y-3 justify-center items-center">
                    <span class="md:text-2xl font-bold text-orange-600 cursor-default">Box {{ $loop->iteration }}</span>
                    <img src="{{ asset('img/Chest.svg') }}" alt="box-1" class="h-40 cursor-pointer transform transition-transform duration-300 hover:scale-110 p-2" wire:click="selectBox({{ $item->id }})">
                </div>
            @endforeach
        </div>
    </div>
</div>
