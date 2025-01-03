<div class="min-w-fit min-h-screen flex flex-col bg-indigo-100 overflow-hidden">
    <!-- Header -->
    <div class="flex items-center justify-between w-full px-4 py-3 bg-indigo-300 shadow-md">
        <a href="{{ route('murid.home') }}" class="text-slate-700 font-semibold hover:text-slate-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="text-xl md:text-2xl font-bold text-center text-slate-800">Leaderboard</h1>
        <a href="{{ route('logout') }}" class="text-red-500 font-semibold hover:text-red-700 transition-colors">
            Logout
        </a>
    </div>

    <!-- Chart Container -->
    <div class="flex-grow flex items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-xl overflow-hidden">
            <div id="main" class="w-full h-[300px] md:h-[400px] lg:h-[500px]"></div>
        </div>
    </div>

    <script>
        // Pass avatars and scores from PHP to JavaScript
        var avatars = @json($avatars);
        var scores = {
            'Polisi': @json($skor_polisi),
            'Detektif': @json($skor_detektif),
            'Nelayan': @json($skor_nelayan),
            'Petani': @json($skor_petani)
        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.2/echarts.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Responsive chart initialization
            var chartContainer = document.getElementById('main');
            var myChart = echarts.init(chartContainer, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });

            // Responsive resize
            window.addEventListener('resize', function() {
                myChart.resize();
            });

            // Definisikan warna untuk setiap kategori
            var categoryStyles = {
                'Polisi': {
                    color: '#3B82F6',
                    avatar: avatars['polisi']
                },
                'Detektif': {
                    color: '#10B981',
                    avatar: avatars['detektif']
                },
                'Nelayan': {
                    color: '#F43F5E',
                    avatar: avatars['nelayan']
                },
                'Petani': {
                    color: '#8B5CF6',
                    avatar: avatars['petani']
                }
            };

            var categories = ['Polisi', 'Detektif', 'Nelayan', 'Petani'];
            var actualData = categories.map(category => scores[category]);
            var initialData = [0, 0, 0, 0];

            var option = {
                responsive: true,
                grid: {
                    left: '20%',
                    right: '10%',
                    top: '10%',
                    bottom: '10%'
                },
                xAxis: {
                    max: 'dataMax',
                    axisLine: { show: false },
                    axisTick: { show: false },
                    splitLine: {
                        show: true,
                        lineStyle: {
                            type: 'dashed',
                            color: '#e0e0e0'
                        }
                    }
                },
                yAxis: {
                    type: 'category',
                    data: categories,
                    inverse: true,
                    animationDuration: 300,
                    animationDurationUpdate: 300,
                    max: 3,
                    axisLine: { show: false },
                    axisTick: { show: false },
                    axisLabel: {
                        fontSize: window.innerWidth < 640 ? 10 : 12, // Responsif ukuran font
                        formatter: function(value) {
                            return '{' + value + '| }  ' + value;
                        },
                        rich: categories.reduce((acc, category) => {
                            acc[category] = {
                                width: window.innerWidth < 640 ? 30 : 40,
                                height: window.innerWidth < 640 ? 30 : 40,
                                backgroundColor: {
                                    image: categoryStyles[category].avatar
                                },
                                borderRadius: 20
                            };
                            return acc;
                        }, {})
                    }
                },
                series: [{
                    realtimeSort: true,
                    type: 'bar',
                    barWidth: '50%',
                    data: initialData,
                    emphasis: {
                        focus: 'series',
                    },
                    label: {
                        show: true,
                        position: 'right',
                        color: '#000',
                        fontSize: window.innerWidth < 640 ? 12 : 16,
                        fontWeight: 'bold',
                        valueAnimation: true
                    },
                    itemStyle: {
                        color: function(params) {
                            return categoryStyles[categories[params.dataIndex]].color;
                        },
                        borderRadius: [0, 10, 10, 0]
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
            }, 300);
        });
    </script>
</div>