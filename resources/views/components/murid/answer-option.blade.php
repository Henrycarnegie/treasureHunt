@props(['id_option', 'value', 'infoLevel'=> null])
@if ($infoLevel === null)
    <label class="relative">
        <input type="radio"
               name="answer_{{ $id_option }}"  {{-- Menggunakan id_option untuk nama yang unik --}}
               value="{{ $value }}"
               wire:model="selectedAnswer.{{ $id_option }}"  {{-- Mengikat ke selectedAnswer dengan id_option --}}
               class="peer absolute opacity-0">
        <div class="cursor-pointer flex justify-center bg-gray-300 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-20 border-gray-700 text-amber-400 hover:bg-amber-200 hover:text-slate-800 shadow-lg px-4 py-6 text-lg font-bold transition-all peer-checked:bg-amber-500 peer-checked:text-white">
            {{ $slot }}
        </div>
    </label>
@else
    <div class="relative cursor-pointer flex justify-center bg-gray-300 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-20 border-gray-700 text-amber-400 hover:bg-amber-200 hover:text-slate-800 shadow-lg px-4 py-6 text-lg font-bold transition-all" wire:click="selectAnswer({{ $id_option }}, {{ $value }})">
        {{ $slot }}
    </div>
@endif
