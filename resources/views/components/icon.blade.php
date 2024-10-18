@props(['classes', 'icon'])

@php
    $classes = "w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900
dark:group-hover:text-white";
@endphp

@if ($icon === 'iconDashboard')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" {{ $attributes->merge(['class' => $classes]) }}>
        <path fill="#ffffff"
            d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
    </svg>
@elseif ($icon === 'iconLevel1')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" {{ $attributes->merge(['class' => $classes]) }}>
        <path fill="#ffffff"
            d="M160 64c0-11.8-6.5-22.6-16.9-28.2s-23-5-32.8 1.6l-96 64C-.5 111.2-4.4 131 5.4 145.8s29.7 18.7 44.4 8.9L96 123.8 96 416l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l96 0 96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0 0-352z" />
    </svg>
@elseif ($icon === 'iconLevel2')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" {{ $attributes->merge(['class' => $classes]) }}>
        <path fill="#ffffff"
            d="M142.9 96c-21.5 0-42.2 8.5-57.4 23.8L54.6 150.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L40.2 74.5C67.5 47.3 104.4 32 142.9 32C223 32 288 97 288 177.1c0 38.5-15.3 75.4-42.5 102.6L109.3 416 288 416c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 480c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9L200.2 234.5c15.2-15.2 23.8-35.9 23.8-57.4c0-44.8-36.3-81.1-81.1-81.1z" />
    </svg>
@elseif ($icon === 'iconLevel3')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" {{ $attributes->merge(['class' => $classes]) }}>
        <path fill="#ffffff"
            d="M0 64C0 46.3 14.3 32 32 32l240 0c13.2 0 25 8.1 29.8 20.4s1.5 26.3-8.2 35.2L162.3 208l21.7 0c75.1 0 136 60.9 136 136s-60.9 136-136 136l-78.6 0C63 480 24.2 456 5.3 418.1l-1.9-3.8c-7.9-15.8-1.5-35 14.3-42.9s35-1.5 42.9 14.3l1.9 3.8c8.1 16.3 24.8 26.5 42.9 26.5l78.6 0c39.8 0 72-32.2 72-72s-32.2-72-72-72L80 272c-13.2 0-25-8.1-29.8-20.4s-1.5-26.3 8.2-35.2L189.7 96 32 96C14.3 96 0 81.7 0 64z" />
    </svg>
@elseif ($icon === 'iconLevel4')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" {{ $attributes->merge(['class' => $classes]) }}>
        <path fill="#ffffff"
            d="M189 77.6c7.5-16 .7-35.1-15.3-42.6s-35.1-.7-42.6 15.3L3 322.4c-4.7 9.9-3.9 21.5 1.9 30.8S21 368 32 368l224 0 0 80c0 17.7 14.3 32 32 32s32-14.3 32-32l0-80 32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-32 0 0-144c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L82.4 304 189 77.6z" />
    </svg>
@elseif ($icon === 'iconLevel5')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" {{ $attributes->merge(['class' => $classes]) }}>
        <path fill="#ffffff"
            d="M32.5 58.3C35.3 43.1 48.5 32 64 32l192 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L90.7 96 70.3 208 184 208c75.1 0 136 60.9 136 136s-60.9 136-136 136l-83.5 0c-39.4 0-75.4-22.3-93-57.5l-4.1-8.2c-7.9-15.8-1.5-35 14.3-42.9s35-1.5 42.9 14.3l4.1 8.2c6.8 13.6 20.6 22.1 35.8 22.1l83.5 0c39.8 0 72-32.2 72-72s-32.2-72-72-72L32 272c-9.5 0-18.5-4.2-24.6-11.5s-8.6-16.9-6.9-26.2l32-176z" />
    </svg>
@endif