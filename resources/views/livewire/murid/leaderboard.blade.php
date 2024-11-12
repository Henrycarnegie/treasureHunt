<div id="main" style="width: 1200px; height: 800px;"></div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('main'));

    var data = [120, 200, 150, 80, 70]; // Sample data
    var categories = ['A', 'B', 'C', 'D', 'E']; // Categories

    var option = {
        xAxis: {
            max: 'dataMax'
        },
        yAxis: {
            type: 'category',
            data: categories,
            inverse: true,
            animationDuration: 300,
            animationDurationUpdate: 300,
            max: 2 // Display only the largest 2 bars
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
                color: 'green' // Set bar color
            }
        }],
        animationDuration: 0,
        animationDurationUpdate: 3000,
        animationEasing: 'linear',
        animationEasingUpdate: 'linear'
    };

    myChart.setOption(option);

    // Function to update data for racing effect
    // function run() {
    //     for (var i = 0; i < data.length; ++i) {
    //         data[i] += Math.round(Math.random() * 200); // Randomly update data
    //     }
    //     myChart.setOption({
    //         series: [{
    //             data: data
    //         }]
    //     });
    // }

    // setInterval(run, 3000); // Update every 3 seconds
</script>
