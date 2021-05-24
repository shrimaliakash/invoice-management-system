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


$cid = $_REQUEST['country_id'];
$query = "select * from country where country_id='$cid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$cname = $row['country_name'];
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
        <!-- DataTables -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
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
                var country_name = document.forms["country"]["country_name"].value;
                var letters = /^[A-Za-z\s]+$/;

                if (country_name == "")
                {
                    document.getElementById("country_error").innerHTML = "* please enter country";
                    return false;
                } else if (!country_name.match(letters))
                {
                    document.getElementById("country_error").innerHTML = "* invalid country name";
                    return false;
                }
            }

        </script>


        <script src="jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#country').on('change', function () {
                    var countryID = $(this).val();
                    if (countryID) {
                        $.ajax({
                            type: 'POST',
                            url: 'country_tate_city_ajax.php',
                            data: 'country_id=' + countryID,
                            success: function (html) {
                                $('#state').html(html);
                                $('#city').html('<option value="">Select state first</option>');
                            }
                        });
                    } else {
                        $('#state').html('<option value="">Select country first</option>');
                        $('#city').html('<option value="">Select state first</option>');
                    }
                });

                $('#state').on('change', function () {
                    var stateID = $(this).val();
                    if (stateID) {
                        $.ajax({
                            type: 'POST',
                            url: 'country_tate_city_ajax.php',
                            data: 'state_id=' + stateID,
                            success: function (html) {
                                $('#city').html(html);
                            }
                        });
                    } else {
                        $('#city').html('<option value="">Select state first</option>');
                    }
                });
            });
        </script>
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
                            url: "country_ajax_delete.php",
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
                                    <h3 class="box-title">Country Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" action="country_update.php" name="country" id="country" method="POST" onclick="return validateForm();">
                                    <div class="box-body">      
                                        <div class="form-group">
                                            <label for="id"></label>
                                            <input type="hidden" name="country_id" class="form-control" id="country_id" value="<?php echo $row['country_id']; ?>">
                                            <label for="cname" class="col-sm-4 control-label">Country Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="country_name" class="form-control" id="country_name" placeholder="Country" value="<?php echo $cname;?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="country_error" id="country_error">*</span>
                                            </div>
                                        </div>   

                                        <button type="submit" name="submit" class="btn btn-primary pull-right">UPDATE</button>
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
