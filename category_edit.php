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


$category_id = $_REQUEST['category_id'];
$query = "select * from category where category_id='$category_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$category_name = $row['category'];
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

        <style>
            .error {color: #FF0000;}
        </style>
        <script type="text/javascript">
            function validateForm()
            {
                var category_name = document.forms["category"]["category_name"].value;
                var letters = /^[A-Za-z\s]+$/;

                if (category_name == "")
                {
                    document.getElementById("category_name_error").innerHTML = "* please enter category";
                    return false;
                } else if (!country_name.match(letters))
                {
                    document.getElementById("category_name_error").innerHTML = "* invalid category name";
                    return false;
                }
            }
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
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-10">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Category Form</h3>
                                </div>
                                <!-- User Registration elements -->
                                <form class="form-horizontal" name="category" id="category" method="POST" action="category_update.php" onclick="return validateForm()">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="id"></label>
                                            <input type="hidden" name="category_id" class="form-control" id="category_id" value="<?php echo $row['category_id']; ?>">
                                            <label for="category_name" class="col-sm-4 control-label">Category Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="category_name" class="form-control" id="category_name" value="<?php echo $row['category']; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="category_name_error" id="category_name_error">*</span>
                                            </div>
                                        </div>
                                        <button type="submit"  name="submit" class="btn btn-primary pull-right">UPDATE</button>
                                    </div>
                                    <!-- /.box-body -->


                                </form>
                                <!-- /User Registration elements  -->
                            </div>
                            <!-- /.box -->
                        </div>

                        <!--/.col (left) -->
                        <!-- right column -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
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
