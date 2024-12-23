@section('title', 'Dashboard Guru')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-200 mt-14 min-h-screen">
        <div class="grid lg:grid-cols-3 gap-4 mb-4">
            <div class="flex flex-col items-center justify-center rounded bg-gray-50 dark:bg-gray-800 py-8">
                <h1 class="mb-5 text-white text-5xl font-semibold">50</h1>
                <h6 class="text-white text-base">Jumlah Soal</h6>
            </div>
            <div class="flex flex-col items-center justify-center rounded bg-gray-50 dark:bg-gray-800 py-8">
                <h1 class="mb-5 text-white text-5xl font-semibold">32</h1>
                <h6 class="text-white text-base">Jumlah Siswa</h6>
            </div>
            <div class="flex flex-col items-center justify-center rounded bg-gray-50 dark:bg-gray-800 py-8">
                <h1 class="mb-5 text-white text-5xl font-semibold">4</h1>
                <h6 class="text-white text-base">Jumlah Kelompok</h6>
            </div>
        </div>
        <div class="grid grid-cols-1 mb-4">
            <div class="bg-white shadow-md rounded-md p-2 lg:p-4 mx-auto min-w-full mt-14">
                <h2 class="text-xl font-semibold mb-4">Leaderboard Kelompok</h2>
                <ul>
                    @foreach ($scores as $key => $score)
                        <li class="flex items-center justify-between py-2 border-b border-gray-300">
                            <div class="flex items-center">
                                <div class="flex justify-center items-center px-2 min-w-8">
                                    <span class="text-lg font-semibold">{{ array_search($key, [2 => 'Polisi', 3 => 'Detektif', 4 => 'Nelayan', 5 => 'Petani']) }}</span>
                                </div>
                                <img src="{{ asset('/img/' . strtolower($score['name']) . '.png') }}"
                                    alt="User Avatar"
                                    class="w-8 h-8 rounded-full mr-2 lg:mr-4">
                                    <span class="text-gray-800 font-semibold text-md lg:text-lg">{{ $score['name'] }}</span>

                            </div>
                            <span class="text-orange-500 font-semibold text-sm lg:text-base">{{ $score['score'] }} Points</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
