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
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
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
                var customer_name = document.forms["user"]["customer_name"].value;
                var phone = document.forms["user"]["phone"].value;
                var email = document.forms["user"]["email"].value;
                var address = document.forms["user"]["address"].value;
                var contact_person = document.forms["user"]["contact_person"].value;
                var contact_no = document.forms["user"]["contact_no"].value;
                var country = document.forms["user"]["country"].value;
                var state = document.forms["user"]["state"].value;
                var city = document.forms["user"]["city"].value;
                var status = document.forms["user"]["status"].value;
                var letters = /^[A-Za-z\s]+$/;
                var numbers = /^[0-9]+$/;

                if (customer_name == "")
                {
                    document.getElementById("customer_name_error").innerHTML = "* please enter customer name";
                    return false;
                } else if (!customer_name.match(letters))
                {
                    document.getElementById("customer_name_error").innerHTML = "* invalid customer name";
                    return false;
                }
                if (phone == "")
                {
                    document.getElementById("customer_name_error").innerHTML = "*";
                    document.getElementById("phone_error").innerHTML = "* please enter mobile number";
                    return false;
                } else if (!phone.match(numbers))
                {
                    document.getElementById("phone_error").innerHTML = "* invalid mobile number";
                    return false;
                } else if (phone.lenght > 10)
                {
                    document.getElementById("phone_error").innerHTML = "* enter 10 digits mobile number";
                    return false;
                }
                if (email == "")
                {
                    document.getElementById("phone_error").innerHTML = "*";
                    document.getElementById("email_error").innerHTML = "* please enter email";
                    return false;
                } else if (email.indexOf("@") == -1)
                {
                    document.getElementById("email_error").innerHTML = "* please enter valid email";
                    return false;
                } else if (email.indexOf(".") == -1)
                {
                    document.getElementById("email_error").innerHTML = "* please enter valid email";
                    return false;
                }
                if (address == "")
                {
                    document.getElementById("email_error").innerHTML = "*";
                    document.getElementById("address_error").innerHTML = "* please enter address";
                    return false;
                }
                if (contact_person == "")
                {
                    document.getElementById("address_error").innerHTML = "*";
                    document.getElementById("contact_person_error").innerHTML = "* please enter contact person";
                    return false;
                }
                if (contact_no == "")
                {
                    document.getElementById("contact_person_error").innerHTML = "*";
                    document.getElementById("contact_no_error").innerHTML = "* please enter contact number";
                    return false;
                } else if (!contact_no.match(numbers))
                {
                    document.getElementById("contact_no_error").innerHTML = "* invalid contact number";
                    return false;
                }
                if (country == "")
                {
                    document.getElementById("contact_no_error").innerHTML = "*";
                    document.getElementById("country_error").innerHTML = "* please select country";
                    return false;
                }
                if (state == "")
                {
                    document.getElementById("country_error").innerHTML = "*";
                    document.getElementById("state_error").innerHTML = "* please select state";
                    return false;
                }
                if (city == "")
                {
                    document.getElementById("state_error").innerHTML = "*";
                    document.getElementById("city_error").innerHTML = "* please select city";
                    return false;
                }
                if (status == "")
                {
                    document.getElementById("city_error").innerHTML = "*";
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
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('submit', '#user', function () {
                    var url = "customer_ajax_insert.php";
                    $('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#user").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            $(".mains").append($(data));
                            $('#user')[0].reset();
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
                    var info = 'customer_id=' + del_id;
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "customer_ajax_delete.php",
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
                                    <h3 class="box-title">Customer Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="user" id="user" method="POST" onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="customer_name" class="col-sm-4 control-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Enter Name">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="customer_name_error" id="customer_name_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-4 control-label">Mobile No</label>
                                            <div class="col-sm-4">   
                                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Mobile Number">
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
                                    <!-- /.box -->
                                    <!-- general form elements disabled -->

                                    <!-- /.box -->
                
                            </form>
                            <!--/.col (right) -->
                        </div>

                    </div>

                    <!-- /.row -->
                </section>


                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Customer Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="mains table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Customer Id</th>
                                                <th>Customer Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Contact No</th>
                                                <th>Address</th>
                                                <th>Contact Person</th>
                                                <th>City</th>
                                                <th>Status</th>
                                                <th>Update</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $view_customer = mysqli_query($conn, "select customer.customer_id,customer.customer_name,customer.phone,customer.email,customer.contact_no,customer.address,customer.contact_person,city.city_name,customer.status FROM customer LEFT JOIN city ON customer.city=city.city_id");
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($view_customer)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row['customer_name']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['contact_no']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['contact_person']; ?></td>
                                                    <td><?php echo $row['city_name']; ?></td>
                                                    <td><?php echo $row['status']; ?></td>

                                                    <td><a href="<?php echo 'customer_edit.php?customer_id=' . $row['customer_id']; ?>" class="btn btn-warning">Update</a></td>
                                                    <td><a data-id="<?php echo $row['customer_id']; ?>" href="#" class="delete btn btn-danger">Delete</a></td>
                                                    <?php
                                                    $i++;
                                                    ?>

                                                    <?php
                                                }
                                                ?>
                                            </tr>
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