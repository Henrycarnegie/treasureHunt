@props([ 
'active', 'infoPekerjaan'])

@php
    $defaultClasses = 'flex flex-col border-2 border-gray-100 p-4 rounded-md cursor-pointer';
@endphp

<div x-data="{ isOpen: false }" class="col-span-2">
    <div 
        {{ $attributes->merge(['class' => $defaultClasses]) }} 
        :class="isOpen ? 'bg-gray-800 text-white' : 'hover:bg-gray-800 hover:text-white focus:bg-gray-800'" 
        @click="isOpen = !isOpen" 
        @click.outside="isOpen = false"
    >
        <!-- Header Level -->
        <span class="text-md font-medium">
            {{ $infoPekerjaan }}
        </span>

        <!-- Detail Kelompok -->
        <div x-show="isOpen" x-collapse>
            {{ $slot }}
        </div>
    </div>
</div>
