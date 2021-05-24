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

<?php
$product_code = $_REQUEST['product_code'];
$query1 = "SELECT category.category,subcategory.subcategory,product.product_name,product.purchase_amount,product.tax,product.additional_tax,product.discount,product.gross_amount,product.sales_amount FROM `product` LEFT JOIN category ON product.category_id = category.category_id LEFT JOIN subcategory ON product.subcategory_id = subcategory.subcategory_id where product_code='$product_code'";
$result = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result);
$category_name = $row['category'];
$subcategory_name = $row['subcategory'];
$product_name = $row['product_name'];
$purchase_amount = $row['purchase_amount'];
$discount = $row['discount'];
$tax = $row['tax'];
$additional_tax = $row['additional_tax'];
$gross_amount = $row['gross_amount'];
$sales_amount = $row['sales_amount'];

$query1 = "SELECT category.category_id,subcategory.subcategory_id FROM `product` LEFT JOIN category ON product.category_id = category.category_id LEFT JOIN subcategory ON product.subcategory_id = subcategory.subcategory_id where product_code='$product_code'";
$result1 = mysqli_query($conn, $query1);
$rows = mysqli_fetch_array($result1);

$category_id = $rows['category_id'];
$subcategory_id = $rows['subcategory_id'];
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


        <script src="/js/jquery-1.10.2.min.js"></script>
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
                                <form class="form-horizontal" action="product_update.php" name="product" id="product" method="POST" onclick="return validateForm();">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <input type="hidden" name="product_code" class="form-control" id="product_code" placeholder="Enter Name" value="<?php echo $product_code; ?>">
                                            <label class="control-label col-sm-4" for="category_id">Category</label>
                                            <div class="col-sm-4">
                                                <select class="col-sm-4 form-control select2" name="category_id" id="category_id" style="width: 100%;">
                                                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
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
                                                    <option value="<?php echo $subcategory_id; ?>"><?php echo $subcategory_name; ?></option>
                                                </select>
                                            </div>    
                                            <div class="col-sm-4">
                                                <span class="error" name="sub_category_error" id="sub_category_error">*</span>
                                            </div> 
                                        </div> 


                                        <div class="form-group">
                                            <label for="product_name" class="col-sm-4 control-label">Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Name" value="<?php echo $product_name; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="product_name_error" id="product_name_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="purchase_amount" class="col-sm-4 control-label">Purchase Amount</label>
                                            <div class="col-sm-4">   
                                                <input type="text" name="purchase_amount" class="form-control" id="purchase_amount" placeholder="Enter Purchase Amount" onBlur="doMath();" value="<?php echo $purchase_amount; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="purchase_amount_error" id="purchase_amount_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount" class="col-sm-4 control-label">Discount</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="discount" class="form-control" id="discount" placeholder="Enter Discount" onBlur="doMath();" value="<?php echo $discount; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="discount_error" id="discount_error">*</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tax" class="col-sm-4 control-label">Tax</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="tax" class="form-control" id="tax" placeholder="Enter Tax" onBlur="doMath();" value="<?php echo $tax; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="tax_error" id="tax_error">*</span>
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label for="additional_tax" class="col-sm-4 control-label">Additional Tax</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="additional_tax" class="form-control" id="additional_tax" placeholder="Enter Additional Tax" onBlur="doMath();" value="<?php echo $additional_tax; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="additional_tax_error" id="additional_tax_error">*</span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="gross_amount" class="col-sm-4 control-label">Gross Amount</label>
                                            <div class="col-sm-4"> 
                                                <input type="text" name="gross_amount" class="form-control" id="gross_amount" placeholder="Enter Gross Amount" readonly="true" value="<?php echo $gross_amount; ?>">
                                            </div>

                                        </div> 
                                        <div class="form-group">
                                            <label for="sales_amount" class="col-sm-4 control-label">Sales Amount</label>
                                            <div class="col-sm-4"> 
                                                <input type="text" name="sales_amount" class="form-control" id="sales_amount" placeholder="Enter Sales Amount" value="<?php echo $sales_amount; ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="error" name="sales_amount_error" id="sales_amount_error">*</span>
                                            </div>
                                        </div>

                                        <button type="submit" name="submit" id="submit" class="btn btn-primary pull-right">UPDATE</button>	  


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

            </div>
            <!-- /.content -->

            <!-- /.content-wrapper -->
            <div class="control-sidebar-bg"></div>
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