<html>

<head>
    <script type="text/javascript" src="https://unpkg.com/lightweight-charts@1.0.0-rc.3/dist/lightweight-charts.standalone.production.js"></script>
</head>

</script>

<body>

</body>
<footer>

    <script type="text/javascript">
        var chart = LightweightCharts.createChart(document.body, {
            width: 400,
            height: 300
        });
        var lineSeries = chart.addLineSeries();
        lineSeries.setData([{
                time: '2019-04-11',
                value: 80.01
            },
            {
                time: '2019-04-12',
                value: 96.63
            },
            {
                time: '2019-04-13',
                value: 76.64
            },
            {
                time: '2019-04-14',
                value: 81.89
            },
            {
                time: '2019-04-15',
                value: 74.43
            },
            {
                time: '2019-04-16',
                value: 80.01
            },
            {
                time: '2019-04-17',
                value: 96.63
            },
            {
                time: '2019-04-18',
                value: 76.64
            },
            {
                time: '2019-04-19',
                value: 81.89
            },
            {
                time: '2019-04-20',
                value: 74.43
            },
        ]);
        chart.timeScale().fitContent();
    </script>

</footer>

</html>