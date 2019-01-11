$(function () {

    var violet = '#DF99CA',
        red = '#F0404C',
        green = '#7CF29C',
        blue = '#4680ff';
    
    // ------------------------------------------------------- //
    // Charts Gradients
    // ------------------------------------------------------ //
    var ctx1 = $("canvas").get(0).getContext("2d");
    // (.. , qq , .. , ..)
    var gradient1 = ctx1.createLinearGradient(150, 0, 150, 300);
    gradient1.addColorStop(0, 'rgba(210, 114, 181, 0.91)');
    gradient1.addColorStop(1, 'rgba(177, 62, 162, 0)');

    var gradient2 = ctx1.createLinearGradient(10, 0, 150, 300);
    gradient2.addColorStop(0, 'rgba(252, 117, 176, 0.84)');
    gradient2.addColorStop(1, 'rgba(250, 199, 106, 0.92)');
    
    
    
    
    
    
    
    


//    // ------------------------------------------------------- //
//    // Line Chart
//    // ------------------------------------------------------ //
//
//    var LINECHART = $('#lineChart1');
//    var myLineChart = new Chart(LINECHART, {
//        type: 'line',
//        options: {
//            scales: {
//                xAxes: [{
//                    display: false
//                }],
//                yAxes: [{
//                    ticks: {
//                        // set max value dynamically (value + qq)
//                        max: 50,
//                        min: 0
//                    },
//                    display: false
//                }]
//            },
//            legend: {
//                display: false
//            }
//        },
//        data: {
//            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14"],
//            datasets: [{
//                label: "Page Visitors",
//                fill: true,
//                lineTension: 0.4,
//                backgroundColor: "transparent",
//                borderColor: green,
//                pointBorderColor: green,
//                pointHoverBackgroundColor: green,
//                borderCapStyle: 'butt',
//                borderDash: [],
//                borderDashOffset: 0.0,
//                borderJoinStyle: 'miter',
//                borderWidth: 3,
//                pointBackgroundColor: "#fff",
//                pointBorderWidth: 5,
//                pointHoverRadius: 5,
//                pointHoverBorderColor: "#fff",
//                pointHoverBorderWidth: 1,
//                pointRadius: 0,
//                pointHitRadius: 1,
//                data: [20, 14, 21, 15, 22, 8, 18, 13, 21, 13, 17, 13, 20, 15],
//                spanGaps: false
//            }]
//        }
//    });
//
//
//    // ------------------------------------------------------- //
//    // Line Chart
//    // ------------------------------------------------------ //
//
//    var LINECHART = $('#lineChart2');
//    var myLineChart = new Chart(LINECHART, {
//        type: 'line',
//        options: {
//            scales: {
//                xAxes: [{
//                    display: false
//                }],
//                yAxes: [{
//                    ticks: {
//                        max: 50,
//                        min: 0
//                    },
//                    display: false
//                }]
//            },
//            legend: {
//                display: false
//            }
//        },
//        data: {
//            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14"],
//            datasets: [{
//                label: "Page Visitors",
//                fill: true,
//                lineTension: 0.4,
//                backgroundColor: "transparent",
//                borderColor: blue,
//                pointBorderColor: blue,
//                pointHoverBackgroundColor: blue,
//                borderCapStyle: 'butt',
//                borderDash: [],
//                borderDashOffset: 0.0,
//                borderJoinStyle: 'miter',
//                borderWidth: 3,
//                pointBackgroundColor: "#fff",
//                pointBorderWidth: 5,
//                pointHoverRadius: 5,
//                pointHoverBorderColor: "#fff",
//                pointHoverBorderWidth: 1,
//                pointRadius: 0,
//                pointHitRadius: 1,
//                data: [20, 14, 21, 15, 22, 8, 18, 13, 21, 13, 17, 13, 20, 15],
//                spanGaps: false
//            }]
//        }
//    });
//
//
//    // ------------------------------------------------------- //
//    // Line Chart 3
//    // ------------------------------------------------------ //
//
//    var LINECHART = $('#lineChart3');
//    var myLineChart = new Chart(LINECHART, {
//        type: 'line',
//        options: {
//            scales: {
//                xAxes: [{
//                    display: false
//                }],
//                yAxes: [{
//                    ticks: {
//                        max: 50,
//                        min: 0
//                    },
//                    display: false
//                }]
//            },
//            legend: {
//                display: false
//            }
//        },
//        data: {
//            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14"],
//            datasets: [{
//                label: "Page Visitors",
//                fill: true,
//                lineTension: 0.4,
//                backgroundColor: "transparent",
//                borderColor: red,
//                pointBorderColor: red,
//                pointHoverBackgroundColor: red,
//                borderCapStyle: 'butt',
//                borderDash: [],
//                borderDashOffset: 0.0,
//                borderJoinStyle: 'miter',
//                borderWidth: 3,
//                pointBackgroundColor: "#fff",
//                pointBorderWidth: 5,
//                pointHoverRadius: 5,
//                pointHoverBorderColor: "#fff",
//                pointHoverBorderWidth: 1,
//                pointRadius: 0,
//                pointHitRadius: 1,
//                data: [20, 14, 21, 15, 22, 8, 18, 13, 21, 13, 17, 13, 20, 15],
//                spanGaps: false
//            }]
//        }
//    });
//
//
//    // ------------------------------------------------------- //
//    // Pie Chart
//    // ------------------------------------------------------ //
//    var PIECHART = $('#pieChartHome1');
//    var myPieChart = new Chart(PIECHART, {
//        type: 'doughnut',
//        options: {
//            cutoutPercentage: 70,
//            legend: {
//                display: false
//            }
//        },
//        data: {
//            labels: [
//                "First",
//                "Second",
//                "Third"
//            ],
//            datasets: [{
//                data: [250, 200, 200],
//                borderWidth: [0, 0],
//                backgroundColor: [
//                    green,
//                    "#eee",
//                    "#ddd",
//                ],
//                hoverBackgroundColor: [
//                    green,
//                    "#eee",
//                    "#ddd",
//                ]
//            }]
//        }
//    });
//    
//
//
//    // ------------------------------------------------------- //
//    // Pie Chart
//    // ------------------------------------------------------ //
//    var PIECHART = $('#pieChartHome2');
//    var myPieChart = new Chart(PIECHART, {
//        type: 'doughnut',
//        options: {
//            cutoutPercentage: 90,
//            legend: {
//                display: false
//            }
//        },
//        data: {
//            labels: [
//                "First",
//                "Second"
//            ],
//            datasets: [{
//                data: [300, 50],
//                borderWidth: [0, 0],
//                backgroundColor: [
//                    blue,
//                    "#eee"
//                ],
//                hoverBackgroundColor: [
//                    blue,
//                    "#eee"
//                ]
//            }]
//        }
//    });
//
//
//    // ------------------------------------------------------- //
//    // Pie Chart
//    // ------------------------------------------------------ //
//    var PIECHART = $('#pieChartHome3');
//    var myPieChart = new Chart(PIECHART, {
//        type: 'doughnut',
//        options: {
//            cutoutPercentage: 90,
//            legend: {
//                display: false
//            }
//        },
//        data: {
//            labels: [
//                "First",
//                "Second"
//            ],
//            datasets: [{
//                data: [300, 50],
//                borderWidth: [0, 0],
//                backgroundColor: [
//                    violet,
//                    "#eee"
//                ],
//                hoverBackgroundColor: [
//                    violet,
//                    "#eee"
//                ]
//            }]
//        }
//    });
//
//
//    // ------------------------------------------------------- //
//    // Pie Chart
//    // ------------------------------------------------------ //
//    var PIECHART = $('#pieChartHome4');
//    var myPieChart = new Chart(PIECHART, {
//        type: 'doughnut',
//        options: {
//            cutoutPercentage: 90,
//            legend: {
//                display: false
//            }
//        },
//        data: {
//            labels: [
//                "First",
//                "Second"
//            ],
//            datasets: [{
//                data: [200, 80],
//                borderWidth: [0, 0],
//                backgroundColor: [
//                    green,
//                    "#eee"
//                ],
//                hoverBackgroundColor: [
//                    green,
//                    "#eee"
//                ]
//            }]
//        }
//    });
//    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    
    
    
    
    // ------------------------------------------------------- //
    // Doughnut Chart
    // ------------------------------------------------------ //
    var DOUGHNUTCHARTEXMPLE  = $('#doughnutChartExample');
    var pieChartExample = new Chart(DOUGHNUTCHARTEXMPLE, {
        type: 'doughnut',
        options: {
            cutoutPercentage: 70,
        },
        data: {
//            labels: [
//                "Abul Karim"
//                "Babu",
//                "Chaudhiry",
//                "Danga Babu",
//                "sdfdsfgdsgf",
//                "sdfdsfgfdsg",
//                "sdfdsgds",
//                "sdgfsdgg",
//                "sdgfdsg"
//            ],
            datasets: [
                {
                    data: [50, 150, 180, 80, 20, 30, 40, 50, 50],
                    borderWidth: 0,
                    backgroundColor: [
                        "#81376a",
                        '#df99ca',
                        '#c374ab',
                        "#a44e8a",                        
                        "#aaa",
                        "#bbb",
                        "#ccc",
                        "#ddd",
                        "#eee"
                    ],
                    hoverBackgroundColor: [
                        '#df99ca',
                        '#c374ab',
                        "#a44e8a",
                        "#81376a",
                        "#aaa",
                        "#bbb",
                        "#ccc",
                        "#ddd",
                        "#eee"
                    ]
                }]
            }
    });

    var pieChartExample = {
        responsive: true
    };

    
    
    // ------------------------------------------------------- //
    // Pie Chart
    // ------------------------------------------------------ //
    var PIECHARTEXMPLE    = $('#pieChartExample');
    var pieChartExample = new Chart(PIECHARTEXMPLE, {
        type: 'pie',
        data: {
            labels: [
                "Abul Karim",
                "Babu",
                "Chaudhiry",
                "Danga Babu",
                "sdfdsfgdsgf",
                "sdfdsfgfdsg",
                "sdfdsgds",
                "sdgfsdgg",
                "sdgfdsg"
            ],
            datasets: [
                {
                    data: [250, 50, 100, 40, 20, 30, 40, 50, 50],
                    borderWidth: 0,
                    backgroundColor: [
                        '#df99ca',
                        '#c374ab',
                        "#a44e8a",
                        "#81376a",
                        "#aaa",
                        "#bbb",
                        "#ccc",
                        "#ddd",
                        "#eee"
                    ],
                    hoverBackgroundColor: [
                        '#df99ca',
                        '#c374ab',
                        "#a44e8a",
                        "#81376a",
                        "#aaa",
                        "#bbb",
                        "#ccc",
                        "#ddd",
                        "#eee"
                    ]
                }]
            }
    });

    var pieChartExample = {
        responsive: true
    };
    
    
     // It will only show the day where data is entered(available) 
    
    
    // ------------------------------------------------------- //
    // Line Chart Example
    // ------------------------------------------------------ //
    
    var LINECHARTEXMPLE   = $('#lineChartExample');
    var lineChartExample = new Chart(LINECHARTEXMPLE, {
        type: 'line',
        options: {
            legend: {labels:{fontColor:"#777", fontSize: 12}},
            scales: {
                xAxes: [{
                    display: true,
                    ticks: {
                        max: 31,
                        min: 1,
                        maxTicksLimit: 15
                    },
                    gridLines: {
                        color: '#fff'
                    }
                }],
                yAxes: [{
                    display: true,
                    ticks: {
                        max: 70,
                        min: 0
                    },
                    gridLines: {
                        color: '#fff'
                    }
                }]
            },
        },
        data: {
//            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20","21","22","23","24","25","26","27","28","29", "30", "31"],
            datasets: [
                {
                    label: "Meal-Rate v Date",
                    fill: true,
                    lineTension: 0.3,
                    backgroundColor: gradient1,
                    borderColor: 'rgba(210, 114, 181, 0.91)',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 2,
                    pointBorderColor: gradient1,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 2,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: gradient1,
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
//                    data: [0, 50, 33, 71, 49, 55, 35, 40, 30, 50, 25, 40],
                    data: [0, 50, 0, 69, 49, 55, 35, 40, 30, 50, 25, 40, 0, 50, 0, 69, 49, 55, 35, 40, 30, 50, 25, 40, 65, 0, 0, 70, 63, 30, 47],
                    spanGaps: false
                }
            ]
        }
    });
    
    
    
    
    


});