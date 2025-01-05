@section('title', 'Level 5')

<div
class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-700 py-12 px-6 lg:px-20 xl:px-60 relative">
    <x-murid.layout-level infoLevel="5" :data="$data" :nyawa="$nyawa" :totalNyawa="$totalNyawa" :deskripsi_opening="$deskripsi_opening"></x-murid.layout-level>
</div>
