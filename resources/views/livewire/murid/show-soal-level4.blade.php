@section('title', 'Level 4')

<form wire:submit.prevent="simpanJawaban"
class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-orange-900 to-teal-800 py-12 px-6 lg:px-20 xl:px-60 relative">
    <x-murid.layout-level infoLevel="4" :data="$data" :endTime="$endTime" :startTime="$startTime" :levelTimeLeft="$countdown" :display="$display"></x-murid.layout-level>
</form>

