@props(['active', 'infoPekerjaan'])

@php
    $defaultClasses = 'flex flex-col border-2 border-gray-200 p-4 rounded-md cursor-pointer';
@endphp

<div x-data="{ isOpen: false }" class="col-span-2">
    <div {{ $attributes->merge(['class' => $defaultClasses]) }}
        :class="isOpen ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white focus:bg-gray-800'"
        @click="isOpen = !isOpen" @click.outside="isOpen = false">
        <!-- Header Level -->
        <div class="flex justify-between">
            <span class="text-md font-medium">
                {{ $infoPekerjaan }}
            </span>
            <svg :class="{ 'rotate-180': isOpen }" class="w-5 h-5 ml-2 transition-transform duration-200"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
            </svg>
        </div>

        <!-- Detail Kelompok -->
        <div x-show="isOpen" x-collapse>
            {{ $slot }}
        </div>
    </div>
</div>
