<div class="min-w-fit">
    <div class="inline-flex w-full items-center justify-between px-4">
        <a href="{{ route('murid.home') }}" class="text-slate-700 font-semibold font-base">Back</a>
        <h1 class="text-2xl font-bold text-center py-8">Leaderboard</h1>
        <a href="{{ route('logout') }}" class="text-red-500 font-semibold font-base">Logout</a>
    </div>
    <div id="main"
        style=" margin-left: 10px;
                width: 1200px;
                height: 800px;
                max-width: 100%;
                @media (min-width: 640px) {
                    max-width: 150%;
                }
                @media (min-width: 768px) {
                    max-width: 180%;
                }
                @media (min-width: 1024px) {
                    max-width: 250%
                }
                @media (min-width: 1280px) {
                    max-width: 300%
                }"
    ></div>
</div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));

    var data = [0, 0, 0, 0]; // Sample data
    var categories = ['Polisi', 'Detektif', 'Petani', 'Nelayan']; // Categories

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
            yAxis: {
                padding: 100
            },
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

    // Function to update data for racing effect
    function run() {
        for (var i = 0; i < data.length; ++i) {
            data[i] += Math.round(Math.random() * 200); // Randomly update data
        }
        myChart.setOption({
            series: [{
                data: data,
            }]
        });
    }

    setInterval(run, 3000); // Update every 3 seconds

</script>
