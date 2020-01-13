<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        let array = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12',]
        var money = <?php echo $money; ?>;
        // const keys = Object.keys(money);
        // array.forEach(value => {
        //     if(!keys.includes(value)){
        //         money[value]=0;
        //     }
        // })
        console.log(money);
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(money);
            var options = {
                title: 'Site Visitor Line Chart',
                curveType: 'function',
                legend: {position: 'bottom'}
            };
            var chart = new google.visualization.LineChart(document.getElementById('linechart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="linechart" style="width: 900px; height: 500px"></div>
</body>
</html>
