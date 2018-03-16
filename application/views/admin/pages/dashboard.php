<link href="<?= asset("admin/css/slider.css") ?>" type="text/css" rel="stylesheet"/>
<div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
    </div>
    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <!--
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Share</button>
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            This week
        </button>
    </div>
    -->
</div>

<div class="col-12">
    <div id="curve_chart_tick" style="width: 100%; min-height: 400px"></div>
    <input onchange="drawLineChart($(this).val());" type="range" min="2" max="365" value="31">
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div id="piechart" style="width: 100%; min-height: 400px;"></div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div id="curve_chart_log" style="width: 100%; min-height: 400px;"></div>
    </div>
</div>

<script type="text/javascript" src="<?= asset('google/charts/chart.js') ?>"></script>
<script>
    google.charts.load('current', {'packages': ['line']});
    google.charts.setOnLoadCallback(drawLineChart);
    google.charts.setOnLoadCallback(drawLineChartLogins);

    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawPieChartCat);

    function drawLineChart(daysBack = 31) {
        var jsonData = $.ajax({
            url: "<?php echo base_url(); ?>" + "ajax/lineChartTicket/" + daysBack,
            dataType: "json",
            async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        var options = {
            title: 'Tickets',
            subtitle: 'The amount of tickets are shown by day',
            curveType: 'function',
            legend: {position: 'bottom'}
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart_tick'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }

    function drawLineChartLogins() {
        var jsonData = $.ajax({
            url: "<?php echo base_url(); ?>" + "ajax/lineChartLogins/",
            dataType: "json",
            async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        var options = {
            title: 'Logins',
            subtitle: 'The amount of logins are shown by day',
            curveType: 'function',
            legend: {position: 'bottom'}
        };

        var chart = new google.charts.Line(document.getElementById('curve_chart_log'));

        chart.draw(data, google.charts.Line.convertOptions(options));
    }


    function drawPieChartCat() {
        var jsonData = $.ajax({
            url: "<?php echo base_url(); ?>" + "ajax/pieChartCat/",
            dataType: "json",
            async: false
        }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        var options = {
            title: 'Ticket Category\'s',
            subtitle: 'A quick view of which category\'s occur most',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>



