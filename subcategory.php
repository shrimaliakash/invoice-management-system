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
                var category_id = document.forms["subcategory"]["category_id"].value;
                var subcategory = document.forms["subcategory"]["subcategory"].value;
                var letters = /^[A-Za-z\s]+$/;

                if (category_id == "")
                {
                    document.getElementById("category_id_error").innerHTML = "* please select category";
                    return false;
                }
                if (subcategory == "")
                {
                    document.getElementById("category_id_error").innerHTML = "*";
                    document.getElementById("subcategory_error").innerHTML = "* please enter subcategory name";
                    return false;
                } else if (!state_name.match(letters))
                {
                    document.getElementById("subcategory_error").innerHTML = "* invalid subcategory name";
                    return false;
                }

            }
        </script>
        <script src="jquery.min.js"></script>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('submit', '#subcategory', function () {
                    var url = "subcategory_ajax_insert.php";
                    $('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#subcategory").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            $(".mains").append($(data));
                            $('#subcategory')[0].reset();
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
                            url: "subcategory_ajax_delete.php",
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
                                    <h3 class="box-title">Subcategory Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="subcategory" id="subcategory" method="POST" action="subcategory_ajax_insert.php" onclick="return validateForm();">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="category_id" class="col-sm-4 control-label">Category Name</label>

                                            <div class="col-sm-4">
                                                <select class="form-control select2" name="category_id" id="category_id">
                                                    <option value="">--Select Category--</option>
<?php
$link = mysqli_query($conn, "select * from category");
while ($d = mysqli_fetch_assoc($link)) {
    echo "<option value='" . $d['category_id'] . "'>" . $d['category'] . "</option>";
}
?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="category_id_error">*</span>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="subcategory" class="col-sm-4 control-label">Subcategory Name</label>

                                            <div class="col-sm-4">
                                                <input type="text" name="subcategory" class="form-control" id="subcategory" placeholder="Subacategory">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="subcategory_error">*</span>
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
                                    <h3 class="box-title">Subcategory Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="mains table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Subcategory Id</th>
                                                <th>Category Id</th>
                                                <th>Subcategory Name</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                include('connection.php');

                                                $sql = "SELECT subcategory.subcategory_id,category.category,subcategory.subcategory FROM subcategory LEFT JOIN
                                                        category ON subcategory.category_id=category.category_id";

                                                $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $row["subcategory_id"]; ?></td>
                                                            <td><?php echo $row["category"]; ?></td>
                                                            <td><?php echo $row["subcategory"]; ?></td>
                                                            <td><a href="<?php echo 'subcategory_edit.php?subcategory_id=' . $row['subcategory_id']; ?>" class="btn btn-warning">Update</a></td>
                                                            <td><a data-id="<?php echo $row['subcategory_id']; ?>" class="delete btn btn-danger" href="#">Delete</a></td>
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
