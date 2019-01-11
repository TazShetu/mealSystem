<script>
    $(function (){

        // ------------------------------------------------------- //
        // Meal
        // ------------------------------------------------------ //

        var mealChart = echarts.init(document.getElementById('meal'));
        var option1 = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },

            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    magicType : {
                        show: true,
                        type: ['pie', 'funnel']
                    },
                }
            },
            calculable : true,
            series :{

                // dunamic month name
                name:'{{$va['monthName']}}',

                type:'pie',
                radius : '65%',
                center : ['50%', '50%'],
                roseType : 'area',
                data:[

                    // dynamin value and name (better sort by name)
                    @foreach ($usersForMBD as $u)
                        { value:({{ $u->totalMeal }} * 1), name:'{{ $u->name }}' },
                    @endforeach
                    // {value:10, name:'rose1'},
                ]
            }
        };
        mealChart.setOption(option1);




        // ------------------------------------------------------- //
        // Bazar + Deposit
        // ------------------------------------------------------ //
        var myChart = echarts.init(document.getElementById('b+d'));
        var option = {
            backgroundColor: '#2c343c',
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },

            visualMap: {
                show: false,
                // dynamic max value
                // min = min ; max = max + 200;
                min: 0,
                max: {{(($maxBazarDeposit * 1) + 200)}},

                inRange: {
                    colorLightness: [0, 1]
                }
            },
            series : [
                {
                    // dynamic month name
                    name:'{{$va['monthName']}}',

                    type:'pie',
                    radius : '65%',
                    center: ['50%', '50%'],
                    data:[

                        // dynamin value and name
                        @foreach ($usersForMBD as $u)
                            { value:({{ $u->totalBazarDeposit }} * 1), name:'{{ $u->name }}' },
                        @endforeach
                        // {value:0, name:'Taz Shetu'},

                    ].sort(function (a, b) { return a.value - b.value; }),
                    roseType: 'radius',
                    label: {
                        normal: {
                            textStyle: {
                                color: 'rgba(255, 255, 255, 0.5)'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            },
                            smooth: 0.2,
                            length: 10,
                            length2: 20
                        }
                    },
                    itemStyle: {
                        normal: {
                            color: '#c23531',
                            shadowBlur: 200,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },

                    animationType: 'scale',
                    animationEasing: 'elasticOut',
                    animationDelay: function (idx) {
                        return Math.random() * 200;
                    }
                }
            ]
        };
        myChart.setOption(option);







        // ------------------------------------------------------- //
        // tMtB
        // ------------------------------------------------------ //

        var colors = ['#7ed6e1', '#d783bf'];
        var tmtbChart = echarts.init(document.getElementById('tMtB'));
        var option2 = {
            color: colors,

            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross'
                }
            },
            legend: {
                data:['Meal','Bazar']
            },
            xAxis: [
                {
                    type: 'category',
                    axisTick: {
                        alignWithLabel: true
                    },

                    // dynamic days
                    data: [
                            @foreach ($mealandbazars as $m)
                                '{{$m->day}}',
                            @endforeach
                        // '1','........'31',
                    ]
                }
            ],
            yAxis: [
                {
                    // MEAL
                    type: 'value',
                    name: 'Meal',
                    min: 0,
                    // dynamic max meal = max * 4
                    // max: 60,
                    max: {{$maxMeal * 4}},
                    position: 'right',
                    axisLine: {
                        lineStyle: {
                            color: colors[0]
                        }
                    },
                    axisLabel: {
                        formatter: '{value}'
                    }
                },
                {},
                {
                    // BAZAR
                    type: 'value',
                    name: 'Bazar',
                    min: 0,
                    // max bazar = max + 100 ////////////////////////////////////////////////////
                    // max: 1600,
                    max: {{$maxBazar + 100}},
                    position: 'left',
                    axisLine: {
                        lineStyle: {
                            color: colors[1]
                        }
                    },
                    axisLabel: {
                        formatter: '{value}'
                    }
                }
            ],
            series: [
                {
                    name:'Meal',
                    type:'bar',
                    //  dymanic meal
                    data:[
                        @foreach ($mealandbazars as $m)
                            {{($m->totalMeal) * 1}},
                        @endforeach
                        // 10, 12, 8, 11, 6, 14, 0,
                    ]
                },

                {
                    name:'Bazar',
                    type:'line',
                    yAxisIndex: 2,
                    smooth: true,
                    // dynamic bazar
                    data:[
                        @foreach ($mealandbazars as $m)
                            {{($m->totalBazar) * 1}},
                        @endforeach
                        // 120, 0, 200, 0, 1220, 0, 0, 60, 0
                    ],
                    areaStyle: {
                        normal: {
                            color: {
                                type: 'linear',
                                x: 0,
                                y: 0,
                                x2: 0,
                                y2: 1,
                                colorStops: [{
                                    offset: 0, color: 'rgba(215, 131, 191, 1)'
                                }, {
                                    offset: 0.5, color: 'rgba(215, 131, 191, 0.1)'
                                }, {
                                    offset: 1, color: 'rgba(255, 255, 255, 0)'
                                }]
                            }
                        }
                    }
                }
            ]
        };
        tmtbChart.setOption(option2);










        // ------------------------------------------------------- //
        // Chart Resize on window resize
        // ------------------------------------------------------ //

        $(window).on('resize', function(){

            if(myChart != null && myChart != undefined){
                myChart.resize();
            }
            if(mealChart != null && mealChart != undefined){
                mealChart.resize();
            }
            if(tmtbChart != null && tmtbChart != undefined){
                tmtbChart.resize();
            }

        });

        $(".sidebar-toggler").click(() => {
            setTimeout(() => {

                myChart.resize();
                mealChart.resize();
                tmtbChart.resize();


            }, 150);
        });


    });
</script>