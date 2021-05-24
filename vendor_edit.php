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


$vendor_id = $_REQUEST['vendor_id'];
$query = "SELECT vendor.vendor_name,vendor.phone,vendor.email,vendor.vat_no,vendor.tin_no,vendor.contact_no,vendor.address,vendor.contact_person,city.city_name,vendor.status FROM vendor LEFT JOIN city ON vendor.city=city.city_id where vendor_id='$vendor_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$vendor_name = $row['vendor_name'];
$phone = $row['phone'];
$email = $row['email'];
$vat_no = $row['vat_no'];
$tin_no = $row['tin_no'];
$contact_no = $row['contact_no'];
$address = $row['address'];
$contact_person = $row['contact_person'];
$city = $row['city_name'];
$status = $row['status'];

$query1 = "SELECT city.city_id FROM vendor LEFT JOIN city ON vendor.city=city.city_id  where vendor_id='$vendor_id'";
$result1 = mysqli_query($conn, $query1);
$rows = mysqli_fetch_array($result1);
$city_id = $rows["city_id"];

$query2 = "SELECT country.country_id,country.country_name FROM country LEFT JOIN city ON country.country_id=city.country_id  where city_id='$city_id'";
$result2 = mysqli_query($conn, $query2);
$rowss = mysqli_fetch_array($result2);
$country_id = $rowss["country_id"];
$country_name = $rowss["country_name"];

$query3 = "SELECT state.state_id,state.state_name FROM state LEFT JOIN city ON state.state_id=city.state_id  where city_id='$city_id'";
$result3 = mysqli_query($conn, $query3);
$rowsss = mysqli_fetch_array($result3);
$state_id = $rowsss["state_id"];
$state_name = $rowsss["state_name"];
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
        </style>
        <script type="text/javascript">
            function validateForm()
            {
                var vendor_name = document.forms["vendor"]["vendor_name"].value;
                var phone = document.forms["vendor"]["phone"].value;
                var email = document.forms["vendor"]["email"].value;
                var vat_no = document.forms["vendor"]["vat_no"].value;
                var tin_no = document.forms["vendor"]["tin_no"].value;
                var contact_no = document.forms["vendor"]["contact_no"].value;
                var address = document.forms["vendor"]["address"].value;
                var contact_person = document.forms["vendor"]["contact_person"].value;
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
                if (contact_no == "")
                {
                    document.getElementById("contact_no_error").innerHTML = "* please enter contact number";
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
                                <form class="form-horizontal" action="vendor_update.php" name="vendor" id="vendor" method="POST" onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="vendor_id" class="form-control" id="vendor_id" value="<?php echo $vendor_id; ?>">
                                            <label for="vendor_name" class="col-sm-4 control-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="vendor_name" class="form-control" id="vendor_name" placeholder="Enter Name" value="<?php echo $vendor_name; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="vendor_name_error" id="vendor_name_error">*</span>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-4 control-label">Phone No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Number" value="<?php echo $phone; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="phone_error" id="phone_error">*</span>
                                            </div> 
                                        </div>    
                                        <div class="form-group">
                                            <label for="lname" class="col-sm-4 control-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $email; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="email_error" id="email_error">*</span>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="vat_no" class="col-sm-4 control-label">VAT No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="vat_no" class="form-control" id="vat_no" placeholder="Enter VAT Number" value="<?php echo $vat_no; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="vat_no_error" id="vat_no_error">*</span>
                                            </div> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="tin_no" class="col-sm-4 control-label">TIN No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tin_no" class="form-control" id="tin_no" placeholder="Enter TIN Number" value="<?php echo $tin_no; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="tin_no_error" id="tin_no_error">*</span>
                                            </div> 
                                        </div> 
                                        
                                        <div class="form-group">
                                            <label for="address" class="col-sm-4 control-label">Address</label>
                                            <div class="col-sm-4">
                                                <textarea type="text" name="address" class="form-control" id="address" placeholder="Enter Address"><?php echo $address; ?>
                                                </textarea>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="address_error" id="address_error">*</span>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_person" class="col-sm-4 control-label">Contact Person</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Enter Contact Person" value="<?php echo $contact_person; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="contact_person_error" id="contact_person_error">*</span>
                                            </div> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="contact_no" class="col-sm-4 control-label">Contact No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="contact_no" class="form-control" id="contact_no" placeholder="Enter Contact Number" value="<?php echo $contact_no; ?>">
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
                                                        <?php
                                                        if ($rowCount > 0) {
                                                            while ($row = $query->fetch_assoc()) {?>
                                                               <option value='<?php echo $row['country_id']; ?>' <?php if($row['country_name']==$country_name) { echo "selected=selected";} ?>><?php echo $row['country_name']; ?></option>
                                                        <?php }}
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
                                                        <option value="<?php echo $state_id; ?>"><?php echo $state_name; ?></option>
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
                                                        <option value="<?php echo $city_id; ?>"><?php echo $city; ?></option>
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
                                                            <input type="radio" name="status" value="Active" <?php if (!empty($status) && $status == 'Active') echo 'checked = "status"'; ?>>
                                                            Active
                                                        </label>
                                                        <label for="status" class="radio-inline">
                                                            <input type="radio" name="status" value="Inactive" <?php if (!empty($status) && $status == 'Inactive') echo 'checked = "status"'; ?>>
                                                            Inactive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="status_error" id="status_error">*</span>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" id="submit" class="btn btn-primary pull-right">UPDATE</button>	 
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


               

            </div>
            <!-- /.content -->

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