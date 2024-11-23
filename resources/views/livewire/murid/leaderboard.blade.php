<div class="min-w-fit">
    <div class="inline-flex w-full items-center justify-between px-4">
        <a href="{{ route('murid.home') }}" class="text-slate-700 font-semibold font-base">Back</a>
        <h1 class="text-2xl font-bold text-center py-8">Leaderboard</h1>
        <a href="{{ route('logout') }}" class="text-red-500 font-semibold font-base">Logout</a>
    </div>
    <div id="main"
        style="margin-left: 10px; width: 1200px; height: 800px; max-width: 100%;">
    </div>
</div>

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));

    // Ambil skor dari Livewire
    var data = [
        @json($skor_polisi),
        @json($skor_detektif),
        @json($skor_nelayan),
        @json($skor_petani)
    ];

    var categories = ['Polisi', 'Detektif', 'Nelayan', 'Petani'];

    var option = {
        xAxis: {
            max: 'dataMax',
        },
        yAxis: {
            type: 'category',
            data: categories,
            inverse: true,
            animationDuration: 300,
            animationDurationUpdate: 300,
            max: 3
        },
        series: [{
            realtimeSort: true,
            name: 'Values',
            type: 'bar',
            data: data,
            label: {
                show: true,
                position: 'right',
                valueAnimation: true
            },
            itemStyle: {
                color: 'blue' // Set bar color
            }
        }],
        animationDuration: 0,
        animationDurationUpdate: 3000,
        animationEasing: 'linear',
        animationEasingUpdate: 'linear'
    };
    myChart.setOption(option);
</script>
