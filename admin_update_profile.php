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
$sql = mysqli_query($conn, "SELECT * FROM admin WHERE email='$user_check'");
while ($row = mysqli_fetch_assoc($sql)) {
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $admin_image = $row['admin_image'];
}

if (isset($_POST['update'])) {
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email'];

    $qry = mysqli_query($conn, "UPDATE admin SET username='$username' WHERE email='$user_check'");
    echo $qry;

    if (!$qry) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:admin_profile.php");
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Invoice Management | Admin Profile</title>
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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                    <h1>
                        Admin Profile
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-10">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <form class="form-horizontal" action="" method="post">		  
                                        <div class="form-group">
                                            <input type="hidden" class="form-control"  id="aid" name="aid" value="<?php echo $aid ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="username" class="col-sm-4 control-label">User Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control"  id="username" name="username" value="<?php echo $username ?>">
                                            </div>
                                        </div>


                                        <div class="box-footer">
                                            <input type="submit" id="update" name="update" class="btn btn-primary pull-right" value="UPDATE">
                                        </div>
                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->

                            <!-- /.box -->
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </section>
                <!-- /.content -->
            </div>
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
