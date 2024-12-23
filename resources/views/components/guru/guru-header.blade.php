<div class="col-span-2 text-xl font-bold flex justify-between items-center">
    <span class="text-xl font-bold text-gray-900">{{ $slot }}</span>
    @if (request()->routeIs('guru.respondent'))
        <button wire:click="resetJawaban" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm">Reset jawaban</button>
    @endif
</div>

