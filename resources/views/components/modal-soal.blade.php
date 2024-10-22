@props(['active', 'infoLevel'])

@php
    $defaultClasses = 'flex flex-col border-2 border-gray-100 p-4 rounded-md cursor-pointer';
    $activeClasses = 'bg-gray-800 text-white';
    $hoverClasses = 'hover:bg-gray-800 hover:text-white focus:bg-gray-800';
@endphp

<div x-data="{ isOpen: false }" class="col-span-2">
    <div {{ $attributes->merge(['class' => $defaultClasses]) }} :class="{ '{{ $activeClasses }}': isOpen, '{{ $hoverClasses }}': !isOpen }" 
        @click="isOpen = !isOpen" @click.outside="isOpen = false">
        
        {{-- Header Level --}}
        <span class="text-md font-medium">
            Level {{ $infoLevel }}
        </span>

        <!-- Detail Kelompok -->
        {{ $slot }}
    </div>
</div>

