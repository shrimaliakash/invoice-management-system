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
include('connection.php');
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
        <!-- DataTables -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <script src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".delete").click(function () {
                    var element = $(this);
                    var del_id = element.attr("data-id");
                    var info = 'customer_id=' + del_id;
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "customer_ajax_delete.php",
                            data: info,
                            success: function () {

                            }
                        });
                        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow")
                                .animate({opacity: "hide"}, "slow");
                    }
                    return false;
                });
            });
        </script>

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

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Customer Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Customer Id</th>
                                                <th>Customer Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Address</th>
                                                <th>Contact Person</th>
                                                <th>City</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $view_customer = mysqli_query($conn, "select customer.customer_id,customer.customer_name,customer.phone,customer.email,customer.contact_no,customer.address,customer.contact_person,city.city_name,customer.status FROM customer LEFT JOIN city ON customer.city=city.city_id");
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($view_customer)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['customer_name']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['contact_no']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['contact_person']; ?></td>
                                                    <td><?php echo $row['city_name']; ?></td>
                                                    <td><?php echo $row['status']; ?></td>
                                                    <?php
                                                    $i++;
                                                    ?>

                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>	 
            </div>
            <!-- /.content -->

            <!-- /.content-wrapper -->
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
        <script>
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        </script>
        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.min.js"></script>
        <!-- Slimscroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
    </body>
</html>