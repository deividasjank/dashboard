<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="en"/>

    <title>Dashboard</title>

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
                <h1><?= isset($data['type']) ? $data['type'] : 'Welcome to Dashboard' ?></h1>
            </div>
            <?php if (isset($data['statistics']) && $data['statistics']) { ?>
                <table class="table table-striped">
                    <tr>
                        <?php foreach (array_keys($data['statistics'][0]) as $key) { ?>
                            <th><?= ucfirst(str_replace('_', ' ', $key)) ?></th>
                        <?php } ?>
                    </tr>
                    <?php foreach ($data['statistics'] as $stats) { ?>
                        <tr>
                            <?php foreach ($stats as $stat) { ?>
                                <td><?= $stat ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

        </div>
    </div>
</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>

</html>
