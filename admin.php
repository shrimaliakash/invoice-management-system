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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Invoice</title>
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

        <style>
            .error {color: #FF0000;}
        </style>
        <script type="text/javascript">
            function validateForm()
            {
                var admin_name = document.forms["admin"]["admin_name"].value;
                var email = document.forms["admin"]["email"].value;
                var password = document.forms["admin"]["password"].value;

                if (admin_name == "")
                {
                    document.getElementById("admin_name_error").innerHTML = "* please enter admin name";
                    return false;
                }
                if (email == "")
                {
                    document.getElementById("admin_name_error").innerHTML = "*";
                    document.getElementById("email_error").innerHTML = "* please enter email";
                    return false;
                }
                else if (email.indexOf("@") == -1)
                {
                    document.getElementById("email_error").innerHTML = "* please enter valid email";
                    return false;
                }
                else if (email.indexOf(".") == -1)
                {
                    document.getElementById("email_error").innerHTML = "* please enter valid email";
                    return false;
                }
                if (password == "")
                {
                    document.getElementById("email_error").innerHTML = "*";
                    document.getElementById("password_error").innerHTML = "* please enter user name";
                    return false;
                }
            }

        </script>


        <script src="jquery.min.js"></script>
    
        <script src="js/jquery-1.10.2.min.js"></script>
        
        <script type="text/javascript">
            $(function () {
                $(".delete").click(function () {
                    var element = $(this);
                    var del_id = element.attr("data-id");
                    var info = 'id=' + del_id;
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "admin_ajax_delete.php",
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
                                    <h3 class="box-title">Admin Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="admin" id="admin" method="POST" action="admin_insert.php" onclick="return validateForm();" enctype="multipart/form-data">
                                    <div class="box-body">      
                                        <div class="form-group">
                                            <label for="admin_name" class="col-sm-4 control-label">User Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="admin_name" class="form-control" id="admin_name" placeholder="Admin Name">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="admin_name_error" id="admin_name_error">*</span>
                                            </div>
                                        </div>   
                                        <div class="form-group">
                                            <label for="email" class="col-sm-4 control-label">Email</label>

                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="email_error" id="email_error">*</span>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="password" class="col-sm-4 control-label">Password</label>

                                            <div class="col-sm-4">
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="password_error" id="password_error">*</span>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="admin_image" class="col-sm-4 control-label">Image</label>

                                            <div class="col-sm-4">
                                                <input type="file" name="admin_image" id="admin_image">
                                            </div>
                                            
                                        </div> 

                                        <button type="submit" class="btn btn-primary pull-right">ADD</button>
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
