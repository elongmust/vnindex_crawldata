$(".char_").each(function () {
    var id_name = $(this).attr('id');
    var chart_data = $(this).attr('chart_data');
    console.log(chart_data);
    var chart = LightweightCharts.createChart(document.getElementById(id_name), {
        width: 200,
        height: 100
    });

    var lineSeries = chart.addLineSeries();
    lineSeries.setData(JSON.parse(chart_data));
    chart.timeScale().fitContent();

});