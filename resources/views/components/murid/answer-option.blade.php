@props(['id_option'])

<button type="button"
    class="flex justify-center bg-gray-300 rounded-md bg-clip-padding backdrop-filter backdrop-blur-md bg-opacity-20 border-gray-700 text-amber-400 hover:bg-amber-500 hover:text-white shadow-lg px-4 py-6 text-lg font-bold">
    {{ $slot }}
</button>
