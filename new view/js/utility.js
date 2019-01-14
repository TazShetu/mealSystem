$(function (){
    
    
    // ------------------------------------------------------- //
    // Utility Per Member
    // ------------------------------------------------------ //
    var colorUPM = {
            type: 'bar',
            x: 1,
            y: 0,
            x2: 0,
            y2: 0,
            colorStops: [{
                offset: 0, color: 'rgba(215, 131, 191, 1)'
            }, {
                offset: 0.5, color: 'rgba(215, 131, 191, 0.5)'
            }, {
                offset: 1, color: 'rgba(215, 131, 191, 0.1)'
            }]
        }
    var ChartUtilityPersonal = echarts.init(document.getElementById('utilityPersonalTotal'));
    var optionUP = {
    
        tooltip : {
        trigger: 'axis',
        axisPointer : {           
            type : 'shadow'        // 'line' | 'shadow'
        }
        },

        xAxis: {
            type : 'value',
            position: 'top',
            splitLine: {lineStyle:{type:'dashed'}},
        },
        yAxis: {
            type : 'category',
            axisLine: {show: false},
            axisLabel: {show: false},
            axisTick: {show: false},
            splitLine: {show: false},
            data : ['ten karimul islam', 'nine', 'eight karimul Islam', 'seven abbdul rasid', 'six', 'five', 'four', 'three', 'two', 'one abdur rahim',]
        },
        series : {
            type:'bar',
            label: {
                normal: {
                    show: true,
                    formatter: '{b}'
                }
            },
            data:[
               {value: 10, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 0, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 109, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 500, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 0, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 200, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 0, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 0, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 210, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
               {value: 0, itemStyle: {color: colorUPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
            ]
        }        
    
    };
    ChartUtilityPersonal.setOption(optionUP);
    
    
    
    
    // ------------------------------------------------------- //
    // Utility Balances
    // ------------------------------------------------------ //
    var ChartUtilityBalances = echarts.init(document.getElementById('utilityBalances'));
    var optionUBs = {
    
        tooltip : {
        trigger: 'axis',
        axisPointer : {           
            type : 'shadow'        // 'line' | 'shadow'
        }
        },

        xAxis: {
            type : 'value',
            position: 'top',
            splitLine: {lineStyle:{type:'dashed'}},
        },
        yAxis: {
            type : 'category',
            axisLine: {show: false},
            axisLabel: {show: false},
            axisTick: {show: false},
            splitLine: {show: false},
            data : ['ten', 'nine', 'eight', 'seven', 'six', 'five', 'four', 'three', 'two', 'one abdur rahim',]
        },
        series : {
            type:'bar',
            label: {
                normal: {
                    show: true,
                    formatter: '{b}'
                }
            },
            data:[
               {value: 100, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
               {value: -20, itemStyle: {color: '#ff7675'}, label: {position: 'right', color: '#ff4342'}},
               {value: 109, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
               {value: 500, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
               {value: -400, itemStyle: {color: '#ff7675'}, label: {position: 'right', color: '#ff4342'}},
               {value: 200, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
               {value: -60, itemStyle: {color: '#ff7675'}, label: {position: 'right', color: '#ff4342'}},
               {value: 359, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
               {value: 210, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
               {value: -40, itemStyle: {color: '#ff7675'}, label: {position: 'right', color: '#ff4342'}},

            ]
        }        

    };
    ChartUtilityBalances.setOption(optionUBs);
    
    
    
    
    
    
    
    
    
    
    // ------------------------------------------------------- //
    // Chart Resize on window resize
    // ------------------------------------------------------ //
    
    $(window).on('resize', function(){
        
        if(ChartUtilityPersonal != null && ChartUtilityPersonal != undefined){
            ChartUtilityPersonal.resize();            
        }
        if(ChartUtilityBalances != null && ChartUtilityBalances != undefined){
            ChartUtilityBalances.resize();            
        }
        
        
    });
    
    $(".sidebar-toggler").click(() => {
        setTimeout(() => {
            
            ChartUtilityPersonal.resize();
            ChartUtilityBalances.resize();
            
            
        }, 150);        
    });
    
    
    
    
    
});