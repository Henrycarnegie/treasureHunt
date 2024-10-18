@props(['active', 'icon'])

@php
$classes = ($active ?? false) 
    ? "flex items-center p-2 rounded-lg text-white bg-gray-700 group"  
    : "flex items-center p-2 rounded-lg text-white group cursor-pointer hover:bg-gray-700";
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <x-icon :icon="$icon"></x-icon>
    <span class="ms-3">{{ $slot }}</span>
</a>