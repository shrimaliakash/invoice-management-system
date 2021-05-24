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
    $aid = $row['admin_id'];
}

if (isset($_POST['update'])) {
    $target_dir = "uploads/";
    $del = $target_dir . $admin_image;
    if (file_exists($del)) {
        unlink($del);
        error_reporting(E_ALL);
    }

    $image1 = $_FILES['admin_image']['name'];
    $imageType = pathinfo($image1, PATHINFO_EXTENSION);
    $imageTemp = $_FILES['admin_image']['tmp_name'];
    $image2 = rand(1, 10000);
    $image3 = $image2 . "." . $imageType;

    $qry = mysqli_query($conn, "UPDATE admin SET admin_image='$image3' WHERE email='$user_check'");

    $move = (move_uploaded_file($imageTemp, $target_dir . $image3));

    if (!$move) {
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
                        <div class="col-md-12">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <form action="" method="post" enctype="multipart/form-data">		  
                                        <div class="form-group has-feedback">
                                            <input type="hidden" class="form-control"  id="aid" name="aid" value="<?php echo $aid ?>">
                                        </div>
                                        <div class="form-group has-feedback">
                                            <input type="file" id="admin_image" name="admin_image" value="<?php echo $admin_image ?>">
                                            <span class="glyphicon glyphicon-camera form-control-feedback"></span>
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
