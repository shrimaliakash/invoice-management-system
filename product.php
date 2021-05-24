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
include ('connection.php');

$query = mysqli_query($conn, "SELECT * FROM category");
$rowCount = mysqli_num_rows($query);
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
                var category_id = document.forms["product"]["category_id"].value;
                var subcategory_id = document.forms["product"]["subcategory_id"].value;
                var product_name = document.forms["product"]["product_name"].value;
                var purchase_amount = document.forms["product"]["purchase_amount"].value;
                var discount = document.forms["product"]["discount"].value;
                var tax = document.forms["product"]["tax"].value;
                var additional_tax = document.forms["product"]["additional_tax"].value;
                var sales_amount = document.forms["product"]["sales_amount"].value;



                if (category_id == "")
                {
                    document.getElementById("category_error").innerHTML = "* please select category";
                    return false;
                }
                if (subcategory_id == "")
                {
                    document.getElementById("category_error").innerHTML = "*";
                    document.getElementById("sub_category_error").innerHTML = "* please select sub category";
                    return false;
                }
                if (product_name == "")
                {
                    document.getElementById("sub_category_error").innerHTML = "*";
                    document.getElementById("product_name_error").innerHTML = "* please enter product name";
                    return false;
                }
                if (purchase_amount == "")
                {
                    document.getElementById("product_name_error").innerHTML = "*";
                    document.getElementById("purchase_amount_error").innerHTML = "* please enter purchase amount";
                    return false;
                }
                if (discount == "")
                {
                    document.getElementById("purchase_amount_error").innerHTML = "*";
                    document.getElementById("discount_error").innerHTML = "* please enter discount";
                    return false;
                }
                if (tax == "")
                {
                    document.getElementById("discount_error").innerHTML = "*";
                    document.getElementById("tax_error").innerHTML = "* please enter tax";
                    return false;
                }
                if (additional_tax == "")
                {
                    document.getElementById("tax_error").innerHTML = "*";
                    document.getElementById("additional_tax_error").innerHTML = "* please enter additional tax";
                    return false;
                }
                if (sales_amount == "")
                {
                    document.getElementById("additional_tax_error").innerHTML = "*";
                    document.getElementById("sales_amount_error").innerHTML = "* please sales amount";
                    return false;
                }

            }
        </script>  

        <script src="jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#category_id').on('change', function () {
                    var categoryID = $(this).val();
                    if (categoryID) {
                        $.ajax({
                            type: 'POST',
                            url: 'category_ajax.php',
                            data: 'category_id=' + categoryID,
                            success: function (html) {
                                $('#subcategory_id').html(html);
                            }
                        });
                    } else {
                        $('#subcategory_id').html('<option value="">Select category first</option>');
                    }
                });
            });
        </script>


        <script src="//js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(document).on('submit', '#product', function () {
                    var url = "product_ajax_insert.php";
                    $('#logerror').html('<img src="ajax.gif" align="absmiddle"> Please wait...');
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#product").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            $(".mains").append($(data));
                            $('#product')[0].reset();
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
                    var info = 'product_code=' + del_id;
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "product_ajax_delete.php",
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

        <script>
            function doMath() {
                var purchase_amount = document.getElementById("purchase_amount").value;
                var discount = purchase_amount * document.getElementById("discount").value / 100;
                var tax = purchase_amount * document.getElementById("tax").value / 100;
                var additional_tax = purchase_amount * document.getElementById("additional_tax").value / 100;

                var gross_amount = purchase_amount - discount + tax + additional_tax;
                document.getElementById('gross_amount').value = gross_amount;
            }

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
                                    <h3 class="box-title">Product Form</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" name="product" id="product" method="POST" onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="category_id">Category</label>
                                            <div class="col-sm-4">
                                                <select class="col-sm-4 form-control select2" name="category_id" id="category_id" style="width: 100%;">
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    if ($rowCount > 0) {
                                                        while ($row = $query->fetch_assoc()) {
                                                            echo '<option value="' . $row['category_id'] . '">' . $row['category'] . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">Category not available</option>';
                                                    }
                                                    ?> 
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="category_error" id="category_error">*</span>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-4" for="subcategory_id">SubCategory</label>
                                            <div class="col-sm-4">                   
                                                <select class="col-sm-4 form-control select2" name="subcategory_id" id="subcategory_id" style="width: 100%;">
                                                    <option value="">Select Sub Category</option>
                                                </select>
                                            </div>    
                                            <div class="col-sm-4">
                                                <span class="error" name="sub_category_error" id="sub_category_error">*</span>
                                            </div> 
                                        </div> 


                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-4 control-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Name">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="product_name_error" id="product_name_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="purchase_amount" class="col-sm-4 control-label">Purchase Amount</label>
                                            <div class="col-sm-4">   
                                                <input type="text" name="purchase_amount" class="form-control" id="purchase_amount" placeholder="Enter Purchase Amount" onBlur="doMath();">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="purchase_amount_error" id="purchase_amount_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount" class="col-sm-4 control-label">Discount</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="discount" class="form-control" id="discount" placeholder="Enter Discount" onBlur="doMath();">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="discount_error" id="discount_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tax" class="col-sm-4 control-label">Tax</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tax" class="form-control" id="tax" placeholder="Enter Tax" onBlur="doMath();">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="tax_error" id="tax_error">*</span>
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label for="additional_tax" class="col-sm-4 control-label">Additional Tax</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="additional_tax" class="form-control" id="additional_tax" placeholder="Enter Additional Tax" onBlur="doMath();">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="additional_tax_error" id="additional_tax_error">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="gross_amount" class="col-sm-4 control-label">Gross Amount</label>
                                            <div class="col-sm-4"> 
                                                <input type="text" name="gross_amount" class="form-control" id="gross_amount" placeholder="Enter Gross Amount" readonly="true">
                                            </div>

                                        </div> 
                                        <div class="form-group">
                                            <label for="sales_amount" class="col-sm-4 control-label">Sales Amount</label>
                                            <div class="col-sm-4"> 
                                                <input type="text" name="sales_amount" class="form-control" id="sales_amount" placeholder="Enter Sales Amount">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="sales_amount_error" id="sales_amount_error">*</span>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary pull-right">ADD</button>	  


                                    </div>
                                    <!-- /.box -->
                                    <!-- general form elements disabled -->
                                </form>
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
                                    <h3 class="box-title">Product Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="mains table table-bordered table-striped">
                                      <thead>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Category Id</th>
                                            <th>Subcategory Id</th>		
                                            <th>Product Name</th>
                                            <th>Purchase Amount</th>
                                            <th>Discount</th>
                                            <th>Tax</th>
                                            <th>Additional Tax</th>
                                            <th>Gross Amount</th>
                                            <th>Sales Amount</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                        <?php
                                        $view_customer = mysqli_query($conn, "select category.`category`,subcategory.`subcategory`,product.`product_code`,product.`product_name`,product.`purchase_amount`,product.`discount`,product.`tax`,product.`additional_tax`,product.`gross_amount`,product.`sales_amount` FROM product LEFT JOIN category ON product.category_id=category.category_id LEFT JOIN subcategory ON product.subcategory_id=subcategory.subcategory_id");
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($view_customer)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['category']; ?></td>
                                                <td><?php echo $row['subcategory']; ?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td><?php echo $row['purchase_amount']; ?></td>
                                                <td><?php echo $row['discount']; ?></td>
                                                <td><?php echo $row['tax']; ?></td>
                                                <td><?php echo $row['additional_tax']; ?></td>
                                                <td><?php echo $row['gross_amount']; ?></td>
                                                <td><?php echo $row['sales_amount']; ?></td>
                                                <td><a href="<?php echo 'product_edit.php?product_code=' . $row['product_code']; ?>" class="btn btn-warning">Update</a></td>
                                                <td><a data-id="<?php echo $row['product_code']; ?>" class="delete btn btn-danger" href="#">Delete</a></td>
                                                <?php
                                                $i++;
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
