<?php
session_start();
include('admin_auth.php');
$conn = mysqli_connect('localhost', 'root', '', 'invoice');

$user_check = $_SESSION['email'];

$sql = mysqli_query($conn, "SELECT username,admin_image FROM admin WHERE email='$user_check'");
$row = mysqli_fetch_assoc($sql);
$login_session1 = $row['username'];
$image = $row['admin_image'];
?>

<?php
$query1 = mysqli_query($conn, "SELECT * FROM customer");
$result1 = mysqli_num_rows($query1);
?>
<?php
$query2 = mysqli_query($conn, "SELECT * FROM product");
$result2 = mysqli_num_rows($query2);
?>
<?php
$query3 = mysqli_query($conn, "SELECT * FROM quotation");
$result3 = mysqli_num_rows($query3);
?>
<?php
$query4 = mysqli_query($conn, "SELECT * FROM invoice");
$result4 = mysqli_num_rows($query4);
?>
<?php
$query5 = mysqli_query($conn, "SELECT * FROM admin");
$result5 = mysqli_num_rows($query5);
?>
<?php
$query6 = mysqli_query($conn, "SELECT * FROM vendor");
$result6 = mysqli_num_rows($query6);
?>
<?php
$query7 = mysqli_query($conn, "SELECT * FROM category");
$result7 = mysqli_num_rows($query7);
?>
<?php
$query8 = mysqli_query($conn, "SELECT * FROM subcategory");
$result8 = mysqli_num_rows($query8);
?>
<?php
$query9 = mysqli_query($conn, "SELECT * FROM country");
$result9 = mysqli_num_rows($query9);
?>
<?php
$query10 = mysqli_query($conn, "SELECT * FROM state");
$result10 = mysqli_num_rows($query10);
?>
<?php
$query11 = mysqli_query($conn, "SELECT * FROM city");
$result11 = mysqli_num_rows($query11);
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
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php
            include('header.php');
            ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php
            include('asidebar.php');
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <section class="content-header">
                    <center><h1><b id="welcome">Welcome : <i><?php echo $login_session1; ?></i></b></h1></center>
                    <h1>
                        Dashboard
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result1; ?></h3>
                                    <p>Customers</p>
                                    </center>
                                </div>
                                <a href="customer_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result2; ?></h3>
                                    <p>product</p>
                                    </center>
                                </div>
                                <a href="product_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result3; ?></h3>
                                    <p>Quotation</p>
                                    </center>
                                </div>
                                <a href="quotation_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result4; ?></h3>
                                    <p>Invoice</p>
                                    </center>
                                </div>
                                <a href="invoice_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result5; ?></h3>
                                    <p>Admin</p>
                                    </center>
                                </div>
                                <a href="admin_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result6; ?></h3>
                                    <p>Vendor</p>
                                    </center>
                                </div>
                                <a href="vendor_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-fuchsia">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result7; ?></h3>
                                    <p>Category</p>
                                    </center>
                                </div>
                                <a href="category_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result8; ?></h3>
                                    <p>Subcategory</p>
                                    </center>
                                </div>
                                <a href="subcategory_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result9; ?></h3>
                                    <p>Country</p>
                                    </center>
                                </div>
                                <a href="country_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-lime">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result10; ?></h3>
                                    <p>State</p>
                                    </center>
                                </div>
                                <a href="state_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <center>
                                    <h3><?php echo $result11; ?></h3>
                                    <p>City</p>
                                    </center>
                                </div>
                                <a href="city_display.php" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </section>

                
            </div>
            <!-- /.content-wrapper -->


            <!-- footer -->
            <?php
            include('footer.php');
            ?>

            <!-- Control Sidebar -->
            <?php
            include('control_sidebar.php');
            ?>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
    </body>
</html>
