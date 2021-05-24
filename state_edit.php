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


$state_id = $_REQUEST['state_id'];
$query = "select state.state_id,state.state_name,country.country_name FROM state LEFT JOIN country ON country.country_id=state.country_id where state_id='$state_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$country_name = $row['country_name'];
$state_name = $row['state_name'];
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
        <!-- select multiple autocomplete text --> 
        <link rel="stylesheet" href="css/select2.min.css">
        <!-- /select multiple autocomplete text --> 
		


        <style>
            .error {color: #FF0000;}
            /*.error1 {color: #FF0000;}*/
        </style>
        <script type="text/javascript">
            function validateForm()
            {
                var country_id = document.getElementById("country_id").value;
                var state_name = document.getElementById("state_name").value;
                var letters = /^[A-Za-z\s]+$/;

                if (country_id == "")
                {
                    document.getElementById("country_id_error").innerHTML = "*please select country";
                    return false;
                }
                if (state_name == "")
                {
                    document.getElementById("state_name_error").innerHTML = "* please enter state";
                    return false;
                } else if (!state_name.match(letters))
                {
                    document.getElementById("state_name_error").innerHTML = "* please enter valid state";
                    return false;
                }
            }
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
                            url: "state_ajax_delete.php",
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
                                    <h3 class="box-title">State Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="state" id="state" action="state_update.php" method="POST" onclick="return validateForm()">
                                    <div class="box-body">
                                        <div class="select-boxes">
                                            <?php
                                            //Include database configuration file
                                            include('connection.php');

                                            //Get all country data
                                            $query = mysqli_query($conn, "SELECT * FROM country");

                                            //Count total number of rows
                                            $rowCount = $query->num_rows;
                                            ?>

                                        <div class="form-group">
                                            <input type="hidden" name="state_id" class="form-control" id="state_id" value="<?php echo $row['state_id']; ?>">
                                            <label for="country" class="col-sm-4 control-label">Country Name</label>

                                            <div class="col-sm-4">
                                                <select class="form-control select2" name="country_id" id="country_id">
                                                     <?php
                                                        if ($rowCount > 0) {
                                                            while ($row = $query->fetch_assoc()) {?>
                                                               <option value='<?php echo $row['country_id']; ?>' <?php if($row['country_name']==$country_name) { echo "selected=selected";} ?>><?php echo $row['country_name']; ?></option>
                                                        <?php }}
                                                        ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="country_id_error" id="country_id_error">*</span>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state_name" class="col-sm-4 control-label">State Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="state_name" class="form-control" id="state_name" placeholder="State" value="<?php echo $state_name; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="state_name_error" id="state_name_error">*</span>
                                            </div>
                                        </div>       
                                        <button type="submit"  name="submit" class="btn btn-primary pull-right">UPDATE</button>
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
        
        <!-- multiple autocomplete -->       
        <!-- Select2 -->
        <script src="js/select2.full.min.js"></script>
        <!-- Page script -->
        <script>
                                    $(function () {
                                        //Initialize Select2 Elements
                                        $(".select2").select2();
                                    });
        </script>
        <!--/ multiple autocomplete -->
    </body>
</html>