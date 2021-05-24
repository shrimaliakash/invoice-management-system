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
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <!-- select multiple autocomplete text --> 
        <link rel="stylesheet" href="css/select2.min.css">
        <!-- /select multiple autocomplete text --> 
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">


        <style>
            .error {color: #FF0000;}
        </style>
        <script type="text/javascript">
            function validateForm()
            {
                var vendor_name = document.forms["vendor"]["vendor_name"].value;
                var phone = document.forms["vendor"]["phone"].value;
                var email = document.forms["vendor"]["email"].value;
                var vat_no = document.forms["vendor"]["vat_no"].value;
                var tin_no = document.forms["vendor"]["tin_no"].value;
                var address = document.forms["vendor"]["address"].value;
                var contact_person = document.forms["vendor"]["contact_person"].value;
                var contact_no = document.forms["vendor"]["contact_no"].value;
                var country = document.forms["vendor"]["country"].value;
                var state = document.forms["vendor"]["state"].value;
                var city = document.forms["vendor"]["city"].value;
                var status = document.forms["vendor"]["status"].value;

                if (vendor_name == "")
                {
                    document.getElementById("vendor_name_error").innerHTML = "* please enter vendor name";
                    return false;
                }
                if (phone == "")
                {
                    document.getElementById("phone_error").innerHTML = "* please enter mobile number";
                    return false;
                }
                if (email == "")
                {
                    document.getElementById("email_error").innerHTML = "* please enter email";
                    return false;
                }
                if (vat_no == "")
                {
                    document.getElementById("vat_no_error").innerHTML = "* please enter vat number";
                    return false;
                }
                if (tin_no == "")
                {
                    document.getElementById("tin_no_error").innerHTML = "* please enter tin number";
                    return false;
                }
                if (address == "")
                {
                    document.getElementById("address_error").innerHTML = "* please enter address";
                    return false;
                }
                if (contact_person == "")
                {
                    document.getElementById("contact_person_error").innerHTML = "* please enter contact person";
                    return false;
                }
                if (contact_no == "")
                {
                    document.getElementById("contact_no_error").innerHTML = "* please enter contact number";
                    return false;
                }
                if (country == "")
                {
                    document.getElementById("country_error").innerHTML = "* please select country";
                    return false;
                }
                if (state == "")
                {
                    document.getElementById("state_error").innerHTML = "* please select state";
                    return false;
                }
                if (city == "")
                {
                    document.getElementById("city_error").innerHTML = "* please select city";
                    return false;
                }
                if (status == "")
                {
                    document.getElementById("status_error").innerHTML = "* please select status";
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
        <script>
            $(document).ready(function () {
                $(document).on('submit', '#vendor', function () {
                    var url = "vendor_ajax_insert.php";
                    $('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#vendor").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            $(".mains").append($(data));
                            $('#vendor')[0].reset();
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
                    var info = 'vendor_id=' + del_id;
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "vendor_ajax_delete.php",
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
                                    <h3 class="box-title">Vendor Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="vendor" id="vendor" method="POST" onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="vendor_name" class="col-sm-4 control-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="vendor_name" class="form-control" id="vendor_name" placeholder="Enter Name">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="vendor_name_error" id="vendor_name_error">*</span>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-4 control-label">Phone No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Number">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="phone_error" id="phone_error">*</span>
                                            </div> 
                                        </div>    
                                        <div class="form-group">
                                            <label for="lname" class="col-sm-4 control-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="email_error" id="email_error">*</span>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="vat_no" class="col-sm-4 control-label">VAT No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="vat_no" class="form-control" id="vat_no" placeholder="Enter VAT Number">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="vat_no_error" id="vat_no_error">*</span>
                                            </div> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="tin_no" class="col-sm-4 control-label">TIN No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tin_no" class="form-control" id="tin_no" placeholder="Enter TIN Number">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="tin_no_error" id="tin_no_error">*</span>
                                            </div> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="address" class="col-sm-4 control-label">Address</label>
                                            <div class="col-sm-4">
                                                <textarea placeholder="Enter Address" type="text" name="address" class="form-control" id="address"></textarea>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="address_error" id="address_error">*</span>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_person" class="col-sm-4 control-label">Contact Person</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Enter Contact Person">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="contact_person_error" id="contact_person_error">*</span>
                                            </div> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="contact_no" class="col-sm-4 control-label">Contact No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="contact_no" class="form-control" id="contact_no" placeholder="Enter Contact Number">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="contact_no_error" id="contact_no_error">*</span>
                                            </div> 
                                        </div>
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
                                                <label for="sountry" class="col-sm-4 control-label">Country</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control select2" name="country" id="country">
                                                        <option value="">Select Country</option>
                                                        <?php
                                                        if ($rowCount > 0) {
                                                            while ($row = $query->fetch_assoc()) {
                                                                echo '<option value="' . $row['country_id'] . '">' . $row['country_name'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">Country not available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="country_error" id="country_error">*</span>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <label for="state" class="col-sm-4 control-label">State</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control select2" name="state" id="state">
                                                        <option value="">Select country first</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="state_error" id="state_error">*</span>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <label for="city" class="col-sm-4 control-label">City</label>
                                                <div class="col-sm-4">
                                                    <select  class="form-control select2" name="city" id="city">
                                                        <option value="">Select state first</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="city_error" id="city_error">*</span>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="col-sm-4 control-label">Status</label>
                                                <div class="col-sm-4">
                                                    <div class="radio" name="status">
                                                        <label for="status" class="radio-inline">
                                                            <input type="radio" name="status" id="active" value="active">
                                                            Active
                                                        </label>
                                                        <label for="status" class="radio-inline">
                                                            <input type="radio" name="status" id="inactive" value="inactive">
                                                            Inactive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="status_error" id="status_error">*</span>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">ADD</button>	 
                                        </div>


                                    </div>
                                </form>
                                <!-- /.box -->
                                <!-- general form elements disabled -->

                                <!-- /.box -->
                            </div>

                            <!--/.col (right) -->
                        </div>

                    </div>

                    <!-- /.row -->
                </section>


                  <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <!-- /.box -->

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Vendor Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="mains table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Vendor Id</th>
                                                <th>Vendor Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>VAT No</th>
                                                <th>TIN No</th>
                                                <th>Address</th>
                                                <th>Contact Person</th>
                                                <th>Contact Number</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                include('connection.php');

                                                $sql = "SELECT vendor.vendor_id,vendor.vendor_name,vendor.phone,vendor.email,vendor.vat_no,vendor.tin_no,
                                                        vendor.address,vendor.contact_person,vendor.contact_no,city.city_name,vendor.status FROM vendor 
                                                        LEFT JOIN city ON vendor.city=city.city_id";

                                                $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $row["vendor_id"]; ?></td>
                                                            <td><?php echo $row["vendor_name"]; ?></td>
                                                            <td><?php echo $row["phone"]; ?></td>
                                                            <td><?php echo $row["email"]; ?></td>
                                                            <td><?php echo $row["vat_no"]; ?></td>
                                                            <td><?php echo $row["tin_no"]; ?></td>
                                                            <td><?php echo $row["address"]; ?></td>
                                                            <td><?php echo $row["contact_person"]; ?></td>
                                                            <td><?php echo $row["contact_no"]; ?></td>
                                                            <td><?php echo $row["city_name"]; ?></td>
                                                            <td><?php echo $row["status"]; ?></td>
                                                            <td><a href="<?php echo 'vendor_edit.php?vendor_id=' . $row['vendor_id']; ?>" class="btn btn-warning">Update</a></td>
                                                            <td><a data-id="<?php echo $row['vendor_id']; ?>" class="delete btn btn-danger" href="#">Delete</a></td>
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