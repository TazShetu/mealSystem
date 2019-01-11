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
            name:'January',
            
            type:'pie',
//            radius : [30, 110],
            radius : '65%',
            center : ['50%', '50%'],
            roseType : 'area',
            data:[
                
                // dynamin value and name (better sort by name)
                {value:10, name:'rose1'},
                {value:10, name:'rose2'},
                {value:11, name:'rose3'},
                {value:20, name:'rose4'},
                {value:22, name:'rose5'},
                {value:20, name:'rose6'},
                {value:21, name:'rose7'},
                {value:10, name:'rose8'},
                {value:15, name:'rose9'},
                {value:13, name:'rose10'},
                {value:11, name:'rose11'},
                {value:19, name:'rose12'},
                {value:14, name:'rose13'},
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
            // dynamic min and max value
            // min = min ; max = max + 200;
            min: 0,
            max: 1200,
            
            inRange: {
                colorLightness: [0, 1]
            }
        },
        series : [
            {
                // dynamic month name
                name:'Januray',
                
                type:'pie',
                radius : '65%',
                center: ['50%', '50%'],
                data:[
                    
                    // dynamin value and name
                    {value:0, name:'Taz Shetu'},
                    {value:0, name:'Mphammad Ksdf'},
                    {value:0, name:'Abdul kader'},
                    {value:0, name:'Rahima sad khan'},
                    {value:0, name:'Karima taz sdf'},
                    {value:1000, name:'Taz Shetu'},
                    {value:500, name:'Mphammad Ksdf'},
                    {value:250, name:'Abdul kader'},
                    {value:400, name:'Rahima sad khan'},
                    {value:310, name:'Karima taz sdf'},
                    {value:609, name:'Karima taz sdf'},
                    
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
//        grid: {
//            right: '20%'
//        },        
        legend: {
            data:['Meal','Bazar']
        },
        xAxis: [
            {
                type: 'category',
                axisTick: {
                    alignWithLabel: true
                },
                data: ['1','2','3','4','5','6','7','8','9','10','11','12', '13','14','15','16','17','18','19','20','21','22','23','24', '25', '26', '27', '28', '29', '30', '31']
            }
        ],
        yAxis: [
            {
                // MEAL
                type: 'value',
                name: 'Meal',
                min: 0,
                max: 60,
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
                max: 1600,
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
                data:[10, 12, 8, 11, 15, 12, 4, 12, 0, 0, 0, 0, 10, 8, 9, 16, 10, 11, 3, 5, 12, 10, 6, 14, 3, 5, 12, 10, 6, 14, 0]
            },

            {
                name:'Bazar',
                type:'line',
                yAxisIndex: 2,
                smooth: true,
                data:[120, 0, 200, 1500, 100, 200, 0, 60, 0, 0, 0, 0, 120, 0, 30, 1300, 0, 2, 0, 0, 950, 40, 50, 0, 50, 0, 1220, 0, 0, 60, 0],
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