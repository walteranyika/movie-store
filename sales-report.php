<?php
include 'protect.php';
include 'protect-admins.php';

require 'connect.php';
$sql = "SELECT customers.names AS c_names, users.names AS u_names, products.title, sales.date_sold,
        sales.price FROM customers
        JOIN sales ON customers.id = sales.customer_id
        JOIN users ON users.id = sales.user_id
        JOIN products ON products.id = sales.product_id";

if (isset($_REQUEST["start_date"])  and  isset($_REQUEST["end_date"])  )
{
    $start =  $_REQUEST["start_date"];
    $end =  $_REQUEST["end_date"];
    $sql = "SELECT customers.names AS c_names, users.names AS u_names, products.title, sales.date_sold,
        sales.price FROM customers
        JOIN sales ON customers.id = sales.customer_id
        JOIN users ON users.id = sales.user_id
        JOIN products ON products.id = sales.product_id
        WHERE sales.date_sold BETWEEN '$start' AND '$end'
        ";
}

$result = mysqli_query($con, $sql) or die(mysqli_error($con));// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array
mysqli_close($con);//close the connection

//last 7 days
$today = date('Y-m-d');
$last_seven = date('Y-m-d', strtotime('-7 days') );
$last_thirty = date('Y-m-d', strtotime('-30 days') );
$last_fourteen = date('Y-m-d', strtotime('-14 days') );
$last_6_months = date('Y-m-d', strtotime('-6 months') );

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Report</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>

<?php include 'nav.php' ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">

            <form action="sales-report.php" class="form-inline mt-3 mb-3">

                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" class="form-control" name="start_date" max="<?=date('Y-m-d')?>" >
                </div>

                <div class="form-group ml-3">
                    <label>End Date</label>
                    <input type="date" class="form-control" name="end_date" max="<?=date('Y-m-d')?>" >
                </div>
                <button class="btn btn-info ml-3">Filter Report</button>

                <button type="reset" class="btn btn-warning ml-3">Clear Fields</button>

            </form>

            <a class="btn btn-sm btn-dark" href="sales-report.php?start_date=<?=$last_seven?>&end_date=<?=$today?>">Report For last 7 Days</a>
            <a class="btn btn-sm btn-dark" href="sales-report.php?start_date=<?=$last_thirty?>&end_date=<?=$today?>">Report For last 30 Days</a>
            <a class="btn btn-sm btn-dark" href="sales-report.php?start_date=<?=$last_fourteen?>&end_date=<?=$today?>">Report For last 2 weeks</a>
            <a class="btn btn-sm btn-dark" href="sales-report.php?start_date=<?=$last_6_months?>&end_date=<?=$today?>">Report For last 6 months</a>


            <table id="example" class="table table-striped table-bordered">

                <thead>
                    <tr>
                        <th>CUSTOMER</th>
                        <th>SERVED BY</th>
                        <th>TITLE</th>
                        <th>PRICE</th>
                        <th>DATE SOLD</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $sale): ?>
                    <tr>
                        <td> <?=$sale['c_names']?> </td>
                        <td> <?=$sale['u_names']?> </td>
                        <td> <?=$sale['title']?> </td>
                        <td> <?=$sale['price']?> </td>
                        <td> <?=$sale['date_sold']?> </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <th></th>
                    <th></th>
                    <th>Total Sales</th>
                    <th class="total"></th>
                    <th></th>
                </tfoot>

            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.24/api/sum().js"></script>

<script>

    // $(document).ready(function () {
    //     $('#example').DataTable();
    // });

    $('#example').DataTable( {
        drawCallback: function () {
            var api = this.api();
            $('.total').html(
                api.column( 3, {page:'current'} ).data().sum()
            );
        }
    }); //

</script>

</body>
</html>
