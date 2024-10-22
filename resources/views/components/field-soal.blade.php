@props(['infoSoal'])

<div class="flex gap-4 items-center">
    <div class="flex items-center border-2 border-gray-400 p-4 rounded-md text-white w-full">                
        {{-- <span>Soal {{$infoSoal}} </span> --}}
        {{ $slot }}
    </div>
    <a href="#" @click.stop class="col-end-auto">
        <x-icon icon="iconDelete"></x-icon>
    </a>
</div>