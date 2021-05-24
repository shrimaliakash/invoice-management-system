<?php
include('connection.php');
?>

<?php
require_once 'quotation-save.php';

$quotation_id = $_REQUEST['quotation_id'];
$query = "select * from quotation where quotation_id='$quotation_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$quotation_id = $row["quotation_id"];
$date = $row["date"];
$from_date = $row["from_date"];
$expire_date = $row["expire_date"];
$customer_id = $row["customer_id"];
$customer_name = $row["customer_name"];
$number = $row["number"];
$address = $row["address"];
$gross_amount = $row["gross_amount"];
$discount = $row["discount"];
$tax = $row["tax"];
$additional_tax = $row["additional_tax"];
$total_amount = $row["total_amount"];
?>

<?php
$quotation_id = $_REQUEST['quotation_id'];
$query1 = "select * from quotation_details where quotation_id='$quotation_id'";
$result1 = mysqli_query($conn, $query1);
$rows = mysqli_fetch_array($result1);

$quotation_id = $rows["quotation_id"];
$product_code = $rows["product_code"];
$price = $rows["price"];
$quantity = $rows["quantity"];
$total = $rows["total"];
?>

<?php
$quotation_id = $_REQUEST['quotation_id'];
$query2 = "select quotation_details.`product_code`,product.`product_name` FROM quotation_details LEFT JOIN product ON quotation_details.product_code=product.product_code where quotation_id='$quotation_id'";
$result2 = mysqli_query($conn, $query2);
$rowss = mysqli_fetch_array($result2);


$product_name = $rowss["product_name"];
?>

<?php
$query = mysqli_query($conn, "SELECT * FROM category");
$rowCount = mysqli_num_rows($query);
?>

<?php
$query1 = mysqli_query($conn, "SELECT * FROM customer");
$rowCount1 = mysqli_num_rows($query1);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Invoice Management</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    </head>
    <body onload="window.print();">
        <div class="wrapper">
            <!-- Main content -->
            <section class="quotation">
                <!-- title row -->

                <div class="row">
                    <div class="col-xs-4">
                        <div class="logo">
                            <img src="img/tct.jpg" style="width:200px" alt="Company Logo">
                        </div>
                    </div>
                    <div class="col-xs-4">
                    </div>
                    <div class="col-xs-4">
                        <div class="logo">
                            <h1 style="color:#f59e00">Quotation</h1>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="col-sm-12 col quotation-info">
            <div class="col-sm-4 quotation-col">
                From
                <address>
                    <strong>410,Ashwamegh Avenue,<br>
                        Mithkhali under Bridge,<br>
                        Navaranpura,<br>
                        Ahmedabad - 380009.</strong>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 quotation-col">
                To
                <address>
                    <strong><?php echo $customer_name; ?></strong><br>
                    <?php echo $address; ?>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 quotation-col">
                <b>quotation No:</b> <?php echo $quotation_id; ?>
                <br>
                <b>quotation Date:</b><?php echo date('d/m/Y' , strtotime($date));?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $view_customer = mysqli_query($conn, "select quotation_details.`quotation_id`,quotation_details.`product_code`,product.`product_name`,quotation_details.`price`,quotation_details.`quantity`,quotation_details.`total` FROM quotation_details LEFT JOIN product ON quotation_details.product_code=product.product_code where quotation_id='$quotation_id'");
                        while ($row = mysqli_fetch_assoc($view_customer)) {
                            ?>
                            <tr>

                                <td><?php echo $row['product_code']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <?php
                            }
                            ?>
                        </tr>


                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-4">
                <div class="table-responsive">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="table-responsive">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Subtotal:</th>
                            <td><?php echo $gross_amount; ?></td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td><?php echo $discount; ?></td>
                        </tr>
                        <tr>
                            <th>Tax:</th>
                            <td><?php echo $tax; ?></td>
                        </tr>
                        <tr>
                            <th>Additional Tax:</th>
                            <td><?php echo $additional_tax; ?></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td><?php echo $total_amount; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
