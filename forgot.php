<?php
session_start();
if (isset($_POST['submit'])) {
    if (empty($_POST['mail']) || empty($_POST['password'])) {
        echo "Username or password Invalid";
    } else {
        $email = $_POST['mail'];
        $password = $_POST['password'];

        $conn = mysqli_connect('localhost', 'root', '', 'invoice');

        $email = stripslashes($email);
        $password = stripslashes($password);

        $query = mysqli_query($conn, "select *from admin where email='$email'  AND password='$password' ");

        $rows = mysqli_num_rows($query);
        if ($rows == 1) {
            $_SESSION['email'] = $email;

            header("Location:admin_welcome.php");
        } else {
            echo "<center>Username or password not valid</center>";
        }
        mysqli_close($conn);
    }
//header("Location:admin_profile.php");	
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin | Log in</title>
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
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>ADMIN</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Forgot Password</p>

                <form action="forgot_password.php" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" name="mail" id="mail" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    
                        
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                          
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">submit</button>
                        </div>
                    </div>
                    
                </form>

            </div>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->


        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>


