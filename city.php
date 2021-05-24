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
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
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
        </style>
        <script type="text/javascript">
            function validateForm()
            {
                var country_id = document.forms["city"]["country"].value;
                var state_id = document.forms["city"]["state"].value;
                var city_name = document.forms["city"]["city_name"].value;
                var letters = /^[A-Za-z\s]+$/;

                if (country_id == "")
                {
                    document.getElementById("country_id_error").innerHTML = "* please select country";
                    return false;
                }
                if (state_id == "")
                {
                    document.getElementById("country_id_error").innerHTML = "*";
                    document.getElementById("state_id_error").innerHTML = "* please select state";
                    return false;
                }
                if (city_name == "")
                {
                    document.getElementById("state_id_error").innerHTML = "*";
                    document.getElementById("city_name_error").innerHTML = "* please enter city name";
                    return false;
                } else if (!city_name.match(letters))
                {
                    document.getElementById("city_name_error").innerHTML = "* invalid city name";
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

                            }
                        });
                    } else {
                        $('#state').html('<option value="">Select country first</option>');

                    }
                });

            });
        </script>

        <script src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('submit', '#city', function () {
                    var url = "city_ajax_insert.php";
                    $('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#city").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            $(".mains").append($(data));
                            $('#city')[0].reset();
                        }
                    });
                    return false;
                });
            });
        </script>
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
                            url: "city_ajax_delete.php",
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
                                    <h3 class="box-title">City Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="city" id="city" method="POST" action="city_ajax_insert.php" onclick="return validateForm();">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="country" class="col-sm-4 control-label">Country Name</label>

                                            <div class="col-sm-4">
                                                <select class="form-control select2" name="country" id="country">
                                                    <option value="">--Select Country--</option>
<?php
$link = mysqli_query($conn, "select * from country");
while ($d = mysqli_fetch_assoc($link)) {
    echo "<option value='" . $d['country_id'] . "'>" . $d['country_name'] . "</option>";
}
?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="country_id_error">*</span>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="state" class="col-sm-4 control-label">State Name</label>

                                            <div class="col-sm-4">
                                                <select class="form-control select2" name="state" id="state">
                                                    <option value="">--Select Country First--</option>
<?php
$link = mysqli_query($conn, "select * from state");
while ($d = mysqli_fetch_assoc($link)) {
    echo "<option value='" . $d['state_id'] . "'>" . $d['state_name'] . "</option>";
}
?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="state_id_error">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="city_name" class="col-sm-4 control-label">City Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="city_name" class="form-control" id="city_name" placeholder="City">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="city_name_error">*</span>
                                            </div>
                                        </div>   





                                        <button type="submit" class="btn btn-primary pull-right">INSERT</button>
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


                 <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <!-- /.box -->

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">City Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="mains table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>City Id</th>
                                                <th>Country Id</th>
                                                <th>State Id</th>
                                                <th>City Name</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                include('connection.php');

                                                $sql = "SELECT city.city_id,country.country_name,state.state_name,city.city_name FROM city LEFT JOIN
                                                        country ON city.country_id=country.country_id LEFT JOIN state ON city.state_id=state.state_id";

                                                $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $row["city_id"]; ?></td>
                                                            <td><?php echo $row["country_name"]; ?></td>
                                                            <td><?php echo $row["state_name"]; ?></td>
                                                            <td><?php echo $row["city_name"]; ?></td>
                                                            <td><a href="<?php echo 'city_edit.php?city_id=' . $row['city_id']; ?>" class="btn btn-warning">Update</a></td>
                                                            <td><a data-id="<?php echo $row['city_id']; ?>" class="delete btn btn-danger" href="#">Delete</a></td>
                                                        </tr>
                                                <?php
                                                    }
                                                ?>
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
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- page script -->
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
