<script>
    $(function (){


        // ------------------------------------------------------- //
        // Expense Per Member
        // ------------------------------------------------------ //
        var colorEPM = {
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

                // dynamic user name
                data : [
                    @foreach($uepm as $u)
                        '{{$u->name}}',
                    @endforeach
                ]
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
                    // dynamic value
                    @foreach($uepm as $u)
                        {value: {{($u->totalexpense)*1}}, itemStyle: {color: colorEPM}, label: {position: 'insideTopLeft', color: '#6f1887'}},
                    @endforeach
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
                    type : 'shadow'
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
                // dynamic name
                data : [
                    @foreach($uepm as $u)
                        '{{$u->name}}',
                    @endforeach
                ]
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
                    // dynamiv value with conditional color + label
                    @foreach($uepm as $u)
                        @if((($u->expA)*1) < 0)
                            {value: {{($u->expA)*1}}, itemStyle: {color: '#ff7675'}, label: {position: 'right', color: '#ff4342'}},
                        @else
                            {value: {{($u->expA)*1}}, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
                        @endif
                    @endforeach
                    // {value: 210, itemStyle: {color: '#50c670'}, label: {position: 'left', color: '#2b8544'}},
                    // {value: -40, itemStyle: {color: '#ff7675'}, label: {position: 'right', color: '#ff4342'}},

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
            }, 300);
        });
    });
</script>