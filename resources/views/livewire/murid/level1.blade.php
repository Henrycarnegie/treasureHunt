@section('title', 'Level 1')

<div
    class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-700 px-6 lg:px-20 xl:px-60">
    <x-murid.layout-soal infoSoal="1"></x-murid.layout-soal>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:px-12 xl:gap-x-20 xl:gap-y-8 min-w-full">
        <x-murid.answer-option>{0 , 5}</x-murid.answer-option>
        <button type="button"
            class="flex justify-center bg-gray-600 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-40 border-gray-700 text-amber-400 hover:bg-amber-500 hover:text-white shadow-lg px-4 py-6 text-lg font-bold">{0 , 5}
        </button>
        <button type="button"
            class="flex justify-center bg-gray-600 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-40 border-gray-700 text-amber-400 hover:bg-amber-500 hover:text-white shadow-lg px-4 py-6 text-lg font-bold">{0 , 5}
        </button>
        <button type="button"
            class="flex justify-center bg-gray-600 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-40 border-gray-700 text-amber-400 hover:bg-amber-500 hover:text-white shadow-lg px-4 py-6 text-lg font-bold">{0 , 5}
        </button>
    </div>
    <div class="flex justify-end">
        {{-- Button Next --}}
        <button
            class="w-full rounded-md bg-indigo-600 py-2 px-8 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-indigo-700 focus:shadow-none active:bg-indigo-700 hover:bg-indigo-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Next</button>
    </div>
</div>
