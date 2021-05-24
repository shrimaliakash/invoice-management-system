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

if (!isset($_SESSION['email'])) {
    header("location:index.php");
}
$email = $_SESSION['email'];

if ($_POST) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $re_password = $_POST['re_password'];
    //Fetch Old Password From DB
    $oldpassq = mysqli_query($conn, "select password from admin where email='{$email}'") or die(mysqli_error());
    $oldpassdatafromdb = mysqli_fetch_array($oldpassq);

    //Check Old password From DB and Variable 
    if ($oldpassdatafromdb[0] == $old_password) {
        //Check new_password == re_password
        if ($new_password == $re_password) {

            if ($oldpassdatafromdb[0] == $new_password) {
                echo "<script>alert('New and Old Password Must be Diff ');</script>";
            } else {
                //Finally 
                $updateq = mysqli_query($conn, "update admin set password='{$new_password}' where email='{$email}'") or die(mysqli_error());
                echo "<script>alert('Password Changed');</script>";
            }
        } else {
            echo "<script>alert('New and Confirm Password Not Match');</script>";
        }
    } else {
        echo "<script>alert('Old Password Not Match');</script>";
    }
}
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
                var old_password = document.forms["change_password"]["old_password"].value;
                var new_password = document.forms["change_password"]["new_password"].value;
                var re_password = document.forms["change_password"]["re_password"].value;

                if (old_password == "")
                {
                    document.getElementById("old_password_error").innerHTML = "* please enter old password";
                    return false;
                }
                if (new_password == "")
                {
                    document.getElementById("old_password_error").innerHTML = "*";
                    document.getElementById("new_password_error").innerHTML = "* please enter new password";
                    return false;
                }
                if (re_password == "")
                {
                    document.getElementById("new_password_error").innerHTML = "*";
                    document.getElementById("re_password_error").innerHTML = "* please enter re-password";
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

                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-10">
                            <!-- Horizontal Form -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Change Password Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="change_password" id="change_password" method="POST"  onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="old_password" class="col-sm-4 control-label">Old Password</label>

                                            <div class="col-sm-4">
                                                <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Enter Old Password">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="old_password_error">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password" class="col-sm-4 control-label">New Password</label>

                                            <div class="col-sm-4">
                                                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Enter New Password">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="new_password_error">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="re_password" class="col-sm-4 control-label">Re Password</label>

                                            <div class="col-sm-4">
                                                <input type="password" name="re_password" class="form-control" id="re_password" placeholder="Enter Re Password">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="re_password_error">*</span>
                                            </div>
                                        </div>   





                                        <button type="submit" class="btn btn-primary pull-right">CHANGE PASSWORD</button>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div>
                            <!-- /.box -->
                            <!-- general form elements disabled -->

                            <!-- /.box -->
                        </div>
                        <!--/.col (right) -->
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
