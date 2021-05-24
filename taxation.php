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



        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('submit', '#user_add', function () {
                    var url = "taxation_ajax_insert.php";
                    $('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#user_add").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            $(".mains").append($(data));
                            $('#user_add')[0].reset();
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
                            url: "taxation_ajax_delete.php",
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
        <style>
            .error {color: #FF0000;}
        </style>
        <script type="text/javascript">
            function validateForm()
            {

                var tax = document.forms["user_add"]["tax"].value;
                var tax_name = document.forms["user_add"]["tax_name"].value;
                var tax_percentage = document.forms["user_add"]["tax_percentage"].value;

                if (tax == "")
                {
                    document.getElementById("tax_error").innerHTML = "* please enter tax";
                    return false;
                }

                if (tax_name == "")
                {
                    document.getElementById("tax_name_error").innerHTML = "* select tax name";
                    return false;
                }

                if (tax_percentage == "")
                {
                    document.getElementById("tax_percentage_error").innerHTML = "* please enter tax percentage";
                    return false;
                }

            }
        </script>
    </head>
    <body class="skin-blue sidebar-mini">
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

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-10">
                            <!-- Horizontal Form -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Taxation Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="user_add" id="user_add"  method="POST" onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="tax" class="col-sm-4 control-label">Tax</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tax" class="form-control" id="tax" placeholder="Enter Tax">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="tax_error">*</span> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="tax_name" class="col-sm-4 control-label">Tax Name</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="tax_name" id="tax_name">
                                                    <option value="">--Select Tax--</option>
                                                    <?php
                                                    $link = mysqli_query($conn, "select * from taxation");
                                                    while ($d = mysqli_fetch_assoc($link)) {
                                                        echo "<option value='" . $d['tax_name'] . "'>" . $d['tax_name'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="error" id="tax_name_error">*</span> 
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="tax_percentage" class="col-sm-4 control-label">Percentage</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tax_percentage" class="form-control" id="tax_percentage" placeholder="Enter Percentage">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class ="error" name="tax_percentage_error" id="tax_percentage_error">*</span>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-info pull-right">ADD</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>

                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">


                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Taxation Data With Full Features</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table  border='1' class="mains" style="width:100%">
                                        <tr>
                                            <th>Taxation Id</th>
                                            <th>Tax</th>
                                            <th>Tax Name</th>
                                            <th>Percentage</th>
                                            <th colspan="2">Action</th>
                                        </tr>


                                        <?php
                                        $view_user = mysqli_query($conn, "SELECT * FROM taxation");
                                        $i = 1;
                                        foreach ($view_user as $key => $users):
                                            ?>
                                            <tr>
                                                <td><?php echo $users['taxation_id']; ?></td>
                                                <td><?php echo $users['tax']; ?></td>
                                                <td><?php echo $users['tax_name']; ?></td>
                                                <td><?php echo $users['tax_percentage']; ?></td>
                                                <td><a href="<?php echo 'taxation_edit.php?taxation_id=' . $users['taxation_id']; ?>" class="update" href="taxation_edit.php">Update</a></td>
                                                <td><a data-id="<?php echo $users['taxation_id']; ?>" class="delete" href="#">Delete</a></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        endforeach;
                                        ?>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- /.content -->
                </section>
            </div>
            <!-- /.content-wrapper -->
            <?php
            include('settings.php');
            ?>

            <?php
            include('footer.php');
            ?>

            <!-- Control Sidebar -->

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
    </body>
</html>