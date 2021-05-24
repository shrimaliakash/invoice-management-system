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

        <style>
            .error {color: #FF0000;}
        </style>
        <script type="text/javascript">
            function validateForm()
            {
                var first_name = document.forms["user"]["first_name"].value;
                var last_name = document.forms["user"]["last_name"].value;
                var email = document.forms["user"]["email"].value;
                var password = document.forms["user"]["password"].value;
                var address = document.forms["user"]["address"].value;
                var mobile_no = document.forms["user"]["mobile_no"].value;
                var country = document.forms["user"]["country"].value;
                var state = document.forms["user"]["state"].value;
                var city = document.forms["user"]["city"].value;
                var role = document.forms["user"]["role"].value;
                var status = document.forms["user"]["status"].value;
                var letters = /^[A-Za-z\s]+$/;
                var numbers = /^[0-9]+$/;


                if (first_name == "")
                {
                    document.getElementById("first_name_error").innerHTML = "* please enter first name";
                    return false;
                } else if (!first_name.match(letters))
                {
                    document.getElementById("first_name_error").innerHTML = "* invalid first name";
                    return false;
                }
                if (last_name == "")
                {
                    document.getElementById("first_name_error").innerHTML = "*";
                    document.getElementById("last_name_error").innerHTML = "* please enter last name";
                    return false;
                } else if (!last_name.match(letters))
                {
                    document.getElementById("last_name_error").innerHTML = "* invalid last name";
                    return false;
                }
                if (email == "")
                {
                    document.getElementById("last_name_error").innerHTML = "*";
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
                if (password == "")
                {
                    document.getElementById("email_error").innerHTML = "*";
                    document.getElementById("password_error").innerHTML = "* please enter password";
                    return false;
                }
                if (address == "")
                {
                    document.getElementById("password_error").innerHTML = "*";
                    document.getElementById("address_error").innerHTML = "* please enter address";
                    return false;
                }
                if (mobile_no == "")
                {
                    document.getElementById("address_error").innerHTML = "*";
                    document.getElementById("mobile_no_error").innerHTML = "* please enter mobile number";
                    return false;
                } else if (!mobile_no.match(numbers))
                {
                    document.getElementById("mobile_no_error").innerHTML = "* invalid mobile number";
                    return false;
                }
                if (country == "")
                {
                    document.getElementById("mobile_no_error").innerHTML = "*";
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
                if (role == "")
                {
                    document.getElementById("city_error").innerHTML = "*";
                    document.getElementById("role_error").innerHTML = "* please select role";
                    return false;
                }
                if (status == "")
                {
                    document.getElementById("role_error").innerHTML = "*";
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
        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('submit', '#user', function () {
                    var url = "user_ajax_insert.php";
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
                    var info = 'u_id=' + del_id;
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "user_ajax_delete.php",
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
                                    <h3 class="box-title">User Registration Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="user" id="user" method="POST" onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="fname" class="col-sm-4 control-label">First Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter First Name">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="first_name_error" id="first_name_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lname" class="col-sm-4 control-label">Last Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter Last Name">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="last_name_error" id="last_name_error">*</span>
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
                                            <label for="lname" class="col-sm-4 control-label">Password</label>
                                            <div class="col-sm-4">
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="password_error" id="password_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class="col-sm-4 control-label">Address</label>
                                            <div class="col-sm-4">
                                                <textarea  row="5" name="address" class="form-control" id="address" placeholder="Enter Address"></textarea>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="address_error" id="address_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-sm-4 control-label">Mobile No</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Enter Number">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="mobile_no_error" id="mobile_no_error">*</span>
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
                                                <label for="city" class="col-sm-4 control-label">Country</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="country" id="country">
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
                                                <label for="city" class="col-sm-4 control-label">State</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="state" id="state">
                                                        <option value="">Select country first</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="state_error" id="state_error">*</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="state" class="col-sm-4 control-label">City</label>
                                                <div class="col-sm-4">
                                                    <select  class="form-control" name="city" id="city">
                                                        <option value="">Select state first</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="city_error" id="city_error">*</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="role" class="col-sm-4 control-label">Role</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="role" id="role">
                                                        <option value="">Select Role</option>
                                                        <?php
                                                        $query = mysqli_query($conn, "select *from role");
                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                            echo '<option value="' . $row['role_id'] . '">' . $row['role_name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="role_error" id="role_error">*</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="col-sm-4 control-label">Status</label>
                                                <div class="radio" name="status">
                                                    <label for="status" class="col-sm-2 control-label">
                                                        <input type="radio" name="status" id="active" value="active">
                                                        Active
                                                    </label>
                                                    <label for="status"class="col-sm-2 control-label">
                                                        <input type="radio" name="status" id="inactive" value="inactive">
                                                        Inactive
                                                    </label>  
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="error" name="status_error" id="status_error">*</span>
                                                </div>

                                            </div>
                                            <button type="submit" name="submit" class="btn btn-info pull-right">ADD</button>

                                        </div>
                                        <!-- /.box -->
                                        <!-- general form elements disabled -->

                                        <!-- /.box -->
                                    </div>
                                </form>
                                <!--/.col (right) -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">


                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">User Data With Full Features</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="mains" border='1' style="width:100%">
                                        <tr>
                                            <th>User Id</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Address</th>
                                            <th>Mobile No</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th colspan="2">Action</th>
                                        </tr>


                                        <?php
                                        $view_user = mysqli_query($conn, "SELECT user.u_id,user.first_name,user.last_name,user.email,user.password,user.address,user.mobile_no,country.country_name,state.state_name,city.city_name,role.role_name,user.status FROM user LEFT JOIN country ON user.country=country.country_id LEFT JOIN state ON user.state=state.state_id LEFT JOIN city ON user.city=city.city_id LEFT JOIN role ON user.role=role.role_id");
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($view_user)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['first_name']; ?></td>
                                                <td><?php echo $row['last_name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['password']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><?php echo $row['mobile_no']; ?></td>
                                                <td><?php echo $row['country_name']; ?></td>
                                                <td><?php echo $row['state_name']; ?></td>
                                                <td><?php echo $row['city_name']; ?></td>
                                                <td><?php echo $row['role_name']; ?></td>
                                                <td><?php echo $row['status']; ?></td>

                                                <td><a href="<?php echo 'user_edit.php?u_id=' . $row['u_id']; ?>">Update</a></td>
                                                <td><a data-id="<?php echo $row['u_id']; ?>" class="delete" href="#">Delete</a></td>
                                                <?php
                                                $i++;
                                            }
                                            ?>

                                        </tr>



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