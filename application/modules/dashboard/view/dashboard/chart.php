<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="en"/>
    <style>
        .margin-top {
            margin-top: 20px;
        }
    </style>
    <title>Customers/Orders chart</title>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Show statistics<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/dashboard/dashboard/index?type=totalOrders">Total number of orders</a></li>
                        <li><a href="/dashboard/dashboard/index?type=totalRevenue">Total number of revenue</a></li>
                        <li><a href="/dashboard/dashboard/index?type=totalCustomers">Total number of customers</a></li>
                        <li><a href="/dashboard/dashboard/index?type=TopCustomers">Top 10 customers</a></li>
                        <li><a href="/dashboard/dashboard/index?type=TopItems">Top 10 selling items</a></li>
                        <li><a href="/dashboard/dashboard/index?type=TopOrdersRevenue">Top 10 orders by revenue</a></li>
                        <li><a href="/dashboard/dashboard/index?type=TopOrdersItemCount">Top 10 orders by item count</a></li>
                        <li><a href="/dashboard/dashboard/chart">Customers/Orders chart</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1><?= 'Customers/Orders chart' ?></h1>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="input-group date">
                        <input id="month" type="text" class="form-control month"
                               data-date-format="yyyy-mm-dd" name="from">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <button type="button" id="submitDateChart" class="btn btn-primary">Submit</button>
            </div>
            <div class="row margin-top">
                <div class="col-lg-12">
                    <div id="chart" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script type="text/javascript">
    var from = '<?= $from ?>';
    var to = '<?= $to ?>';
    var orders = '<?= json_encode($orders) ?>';
    var customers = '<?= json_encode($customers) ?>';
</script>
<script type="text/javascript">
    $(function () {
        var seriesOptions = [];
        seriesOptions[0] = {name: 'Orders', data: JSON.parse(orders)};
        seriesOptions[1] = {name: 'Customers', data: JSON.parse(customers)};

        $('#chart').highcharts('chart', {
            rangeSelector: {
                selected: 4
            },
            title: {
                text: 'Orders and Customers'
            },
            yAxis: {
                title: {
                    text: 'Count'
                },
                plotLines: [{
                    value: 0,
                    width: 2,
                    color: 'silver'
                }]
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    day: '%e of %b'
                }
            },
            series: seriesOptions
        });
    });
</script>
<script type="text/javascript" src="/js/dashboard.js"></script>
</body>

</html>
