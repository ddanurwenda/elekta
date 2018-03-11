$(function () {
    var khof_color = '#f6ab02';
    var ipul_color = '#05693c';
    /*
     * LINE CHART
     * ----------
     */
    function gd(year, month, day) {
        return new Date(year, month, day).getTime();
    }

    var khof_week = [], ipul_week = [];
    var today = new Date(2018, 2, 7, 7, 0, 0, 0).getTime();
    for (var i = -5; i <= 1; i++) {
        khof_week.push([today + (1000 * 3600 * 24 * i), khof_7[i + 5]])
        ipul_week.push([today + (1000 * 3600 * 24 * i), ipul_7[i + 5]])
    }
    var line_data1 = {
        label: "Khofifah",
        data: khof_week,
        color: khof_color
    }
    var line_data2 = {
        label: "Gus Ipul",
        data: ipul_week,
        color: ipul_color
    }
    $.plot('#week-chart', [line_data1, line_data2], {
        grid: {
            hoverable: true,
            borderColor: '#f3f3f3',
            borderWidth: 1,
            tickColor: '#f3f3f3'
        },
        series: {
            shadowSize: 0,
            lines: {
                show: true
            },
            points: {
                show: true
            }
        },
        lines: {
            fill: false,
            color: ['#3c8dbc', '#f56954']
        },
        yaxis: {
            show: true
        },
        xaxis: {
            mode: "time",
            tickSize: [1, "day"],
            tickLength: 0
        }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        position: 'absolute',
        display: 'none',
        opacity: 0.8
    }).appendTo('body')
    $('#week-chart').bind('plothover', function (event, pos, item) {

        if (item) {
            var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2)

            $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
                    .css({top: item.pageY + 5, left: item.pageX + 5})
                    .fadeIn(200)
        } else {
            $('#line-chart-tooltip').hide()
        }

    })
    /* END WEEK CHART */



    /*
     * INTER CHART
     * ---------
     */

    var inter_khof = {
        data: [['Khofifah', khof_follower]],
        color: khof_color
    }
    var inter_gi = {
        data: [['Gus Ipul', ipul_follower]],
        color: ipul_color
    }
    $.plot('#interaction-chart', [inter_khof, inter_gi], {
        grid: {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor: '#f3f3f3'
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        }
    })


    /**
     * TOTAL INTERACTION CHART
     */
    $.plot('#total_khof', [
        //LIKE
        {
        data: [['Like', khof_summary[0]]],
        color: khof_color
    },
        //COMMENTS
        {
        data: [['Comments', khof_summary[1]]],
        color: khof_color
    },
                //SHARE
     {
        data: [['Share', khof_summary[2]]],
        color: khof_color
    }    ,
    //TOTAL INTERACTION
        {
        data: [['Interaction/1K', khof_summary[3]*1000/khof_follower]],
        color: khof_color
    }       
    ], {
        grid: {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor: '#f3f3f3'
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        }
    })
    $('a[href="#total_ipul"]').one('shown.bs.tab', function (e) {
        console.log('render hidden plot')
        $.plot('#total_ipul', [//LIKE
        {
        data: [['Like', ipul_summary[0]]],
        color: ipul_color
    },
        //COMMENTS
        {
        data: [['Comments', ipul_summary[1]]],
        color: ipul_color
    },
                //SHARE
     {
        data: [['Share', ipul_summary[2]]],
        color: ipul_color
    }    ,
    //TOTAL INTERACTION
        {
        data: [['Interaction/1K', ipul_summary[3]*1000/ipul_follower]],
        color: ipul_color
    } ], {
            grid: {
                borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor: '#f3f3f3'
            },
            series: {
                bars: {
                    show: true,
                    barWidth: 0.5,
                    align: 'center'
                }
            },
            xaxis: {
                mode: 'categories',
                tickLength: 0
            }
        })
    })

    /* END INTER CHART */

    /*
     * TODAY CHART
     * ---------
     */

    var today_khof = {
        data: [['Khofifah', khof_today]],
        color: khof_color
    }
    var today_gi = {
        data: [['Gus Ipul', ipul_today]],
        color: ipul_color
    }
    $.plot('#today-chart', [today_khof, today_gi], {
        grid: {
            borderWidth: 1,
            borderColor: '#f3f3f3',
            tickColor: '#f3f3f3'
        },
        series: {
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        }
    })
    /* END TODAY CHART */



})

/*
 * Custom Label formatter
 * ----------------------
 */
function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
            + label
            + '<br>'
            + Math.round(series.percent) + '%</div>'
}