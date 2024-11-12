<div id="leaderboard-chart" style="width: 600px; height: 400px;"></div>
<script>
    document.addEventListener("livewire:load", function () {
        var chartDom = document.getElementById('leaderboard-chart');
        if (chartDom) {
            var myChart = echarts.init(chartDom);

            var option = {
                title: {
                    text: 'Leaderboard Chart'
                },
                tooltip: {},
                legend: {
                    data: ['Scores']
                },
                xAxis: {
                    data: ['Player1', 'Player2', 'Player3', 'Player4', 'Player5']
                },
                yAxis: {},
                series: [{
                    name: 'Scores',
                    type: 'bar',
                    data: [120, 200, 150, 80, 70]
                }]
            };

            myChart.setOption(option);
        }
    });
</script>
