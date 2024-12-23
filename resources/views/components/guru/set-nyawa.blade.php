@props(['infoNyawa'])

<div class="col-span-2 w-full inline-flex flex-col lg:flex-row gap-4 md:gap-8">
    @csrf
    <div class="md:inline-flex items-center gap-2">
        <p>Nyawa untuk murid : {{ $infoNyawa }} menit</p>
        <div class="flex gap-2">
            <form action="">
                <input type="number" class="border rounded px-2 py-1" placeholder="3">
                <button type="submit" class="bg-indigo-500 px-4 py-2 text-white rounded">Simpan</button>
            </form>
        </div>
    </div>
</div>
