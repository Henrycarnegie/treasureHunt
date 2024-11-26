<div class="min-w-fit h-screen place-items-center bg-indigo-100 overflow-hidden">
    <div class="flex items-center justify-around w-full px-4 bg-indigo-300">
        <a href="{{ route('murid.home') }}" class="text-slate-700 font-semibold font-base">Back</a>
        <h1 class="text-2xl font-bold text-center py-8">Leaderboard</h1>
        <a href="{{ route('logout') }}" class="text-red-500 font-semibold font-base">Logout</a>
    </div>
    <div id="main">
    </div>
</div>

<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));

    // Ambil skor dari Livewire
    var actualData = [
        @json($skor_polisi),
        @json($skor_detektif),
        @json($skor_nelayan),
        @json($skor_petani)
    ];

    var categories = ['Polisi', 'Detektif', 'Nelayan', 'Petani'];

    // Set initial data to 0 for animation effect
    var initialData = [0, 0, 0, 0];

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
            type: 'bar',
            barWidth: '30%',
            barGap: '20%',
            barCategoryGap: '40%',
            data: initialData, // Use initial data
            emphasis: {
                focus: 'series',
            },
            label: {
                label: 'labelOption',
                color: '#000',
                fontSize: 24,
                fontFamily: 'Inter',
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

    // Set initial option
    myChart.setOption(option);

    // Update chart data after a delay to allow animation from 0
    setTimeout(function() {
        myChart.setOption({
            series: [{
                data: actualData // Update with actual data
            }]
        });
    }, 300); // Delay of 1 second
</script>
