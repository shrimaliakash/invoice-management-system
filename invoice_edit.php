
<?php
include('connection.php');
require_once 'invoice-save1.php';

$invoice_id = $_REQUEST['invoice_id'];
$query4 = "select * from invoice where invoice_id='$invoice_id'";
$result = mysqli_query($conn, $query4);
$row = mysqli_fetch_array($result);

$invoice_id = $row["invoice_id"];
$date = $row["date"];
$from_date = $row["from_date"];
$expire_date = $row["expire_date"];
$customer_id = $row["customer_id"];
$customer_name = $row["customer_name"];
$number = $row["number"];
$address = $row["address"];
$gross_amount = $row["gross_amount"];
$discount = $row["discount"];
$tax = $row["tax"];
$additional_tax = $row["additional_tax"];
$total_amount = $row["total_amount"];
$notes = $row["notes"];
?>

<?php
$invoice_id = $_REQUEST['invoice_id'];
$query1 = "select * from invoice_details where invoice_id='$invoice_id'";
$result1 = mysqli_query($conn, $query1);
$rows = mysqli_fetch_array($result1);

$invoice_id = $rows["invoice_id"];
$product_code = $rows["product_code"];
$price = $rows["price"];
$quantity = $rows["quantity"];
$total = $rows["total"];
?>

<?php
$invoice_id = $_REQUEST['invoice_id'];
$query2 = "select invoice_details.`product_code`,product.`product_name` FROM invoice_details LEFT JOIN product ON invoice_details.product_code=product.product_code where invoice_id='$invoice_id'";
$result2 = mysqli_query($conn, $query2);
$rowss = mysqli_fetch_array($result2);


$product_name = $rowss["product_name"];
?>

<?php
$query = mysqli_query($conn, "SELECT * FROM category");
$rowCount = mysqli_num_rows($query);
?>

<?php
$query1 = mysqli_query($conn, "SELECT * FROM customer");
$rowCount1 = mysqli_num_rows($query1);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <meta name="author" content="muni">
        <meta name="description" content="Save Multiple Rows of Invoice Data In MySQL Database Using PHP, jQuery and Bootstrap 3">
        <meta name="keywords" content="jquery autocomplete invoice, jquery autocomplete invoice module, invoice using jqueryautocomplete, jquery invoice module  autocomplete, invoice using jquery autocomplete">



        <title>Invoice Management</title>
        <link href="css/jquery-ui.min.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/datepicker.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <script src="jquery.min.js"></script>
        <!-- select multiple autocomplete text --> 
        <link rel="stylesheet" href="css/select2.min.css">
        <!-- /select multiple autocomplete text --> 


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

        <script src="jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#subcategory_id').on('change', function () {
                    var subcategoryID = $(this).val();
                    if (subcategoryID) {
                        $.ajax({
                            type: 'POST',
                            url: 'subcategory_ajax.php',
                            data: 'subcategory_id=' + subcategoryID,
                            success: function (html) {

                            }
                        });
                    } else {

                    }
                });
            });
        </script>

        <script src="jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#customer_id').on('change', function () {
                    var customerID = $(this).val();

                    if (customerID) {
                        $.ajax({
                            type: 'POST',
                            url: 'ajax1.php',
                            data: 'customer_id=' + customerID,
                            success: function (html) {
                                $('#invoice_save').html(html);
                            }
                        });
                    } else {

                    }
                });
            });
        </script>



    </head>

    <body>  
        <?php include_once './templates/nav.php'; ?>
        <!-- Insert your HTML here -->
        <div class="container content">
            <?php include_once './templates/message.php'; ?>
            <form class="form-horizontal invoice-form" action="invoice1.php" id="invoice-form" method="post" role="form" onclick="calculateTotal1();
                    calculateTotal();
                    calculateTotal2();">
                <div class='row no-margin'>
                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <div class="logo">
                            <img src="img/tct.jpg" alt="Company Logo">
                        </div>
                        <h4>TCT Invoice</h4>
                        <p>
                            410,Ashwamegh Avenue,Mithkhali under Bridge,
                            Navaranpura,Ahmedabad - 380009.
                        </p>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <button data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" class="btn btn-success submit_btn invoice-save-top form-control"> <i class="fa fa-floppy-o"></i>  Save Invoice </button>
                    </div>
                </div>
                <hr>
                <div class="row no-margin">
                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <h4>Invoice To</h4>




                        <select class="form-control select2" id="customer_id" name="customer_id">
                            <option value=""><?php echo $customer_name; ?></option>

                            <?php
                            if ($rowCount1 > 0) {
                                while ($rows = $query1->fetch_assoc()) {
                                    echo '<option value="' . $rows['customer_id'] . '">' . $rows['customer_name'] . '</option>';
                                }
                            } else {
                                echo '<option value="">Customers not available</option>';
                            }
                            ?> 

                        </select>
                        <br><br>

                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' id="invoice_save">
                            <div class="form-group">
                                <input type="text" data-type="customerName" name="data[0][customer_name]" id="customer_name" class="form-control autocomplete_txt1" autocomplete="on" placeholder="Customer Name" value="<?php echo $customer_name; ?>">
                            </div>

                            <div class="form-group">
                                <input type="text" data-type="customerNo" name="data[0][phone]" id="phone" class="form-control autocomplete_txt1" autocomplete="on" placeholder="Customer Number" value="<?php echo $number; ?>">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control autocomplete_txt1" rows='3' data-type="customerAddress" name="data[0][address]" id="address" placeholder="customer Address" autocomplete="on"  ondrop="return false;" onpaste="return false;"><?php echo $address; ?></textarea>						
                            </div>                        
                        </div>

                    </div>
                    <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <input type="text" class="form-control autocomplete_txt1" name="invoice_id" id="invoice_id" placeholder="Invoice Id" value="<?php echo $invoice_id; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control autocomplete_txt1" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date" value="<?php echo date('m/d/Y' , strtotime($date)) ; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control autocomplete_txt1" name="from_date" id="from_date" placeholder="From Date" value="<?php echo date('m/d/Y' , strtotime($from_date)); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control autocomplete_txt1" name="expire_date" id="expire_date" placeholder="Expire Date" value="<?php echo date('m/d/Y' , strtotime($expire_date)); ?>">
                        </div>

                    </div>
                </div>
                <hr>
                <div class='row'>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="category_id">Category</label>
                        <div class="col-sm-3">
                            <select class="form-control select2" name="category_id" id="category_id" style="width: 100%;">
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


                        <label class="control-label col-sm-2" for="subcategory_id">SubCategory</label>
                        <div class="col-sm-3">                   
                            <select class="form-control  select2" name="subcategory_id" id="subcategory_id" style="width: 100%;">
                                <option value="">Select Sub Category</option>
                                <?php
                                if ($rowCount > 0) {
                                    while ($row = $query->fetch_assoc()) {
                                        echo '<option value="' . $row['subcategory_id'] . '">' . $row['subcategory'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">subCategory not available</option>';
                                }
                                ?> 
                            </select>
                        </div>     
                    </div> 

                    <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                        <table class="table table-bordered table-hover" id="invoiceTable">
                            <thead>
                                <tr>
                                    <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                    <th width="15%">Product Code</th>
                                    <th width="38%">Product Name</th>
                                    <th width="15%">Price</th>
                                    <th width="15%">Quantity</th>
                                    <th width="15%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $view_customer = mysqli_query($conn, "select invoice_details.`invoice_id`,invoice_details.`product_code`,product.`product_name`,invoice_details.`price`,invoice_details.`quantity`,invoice_details.`total` FROM invoice_details LEFT JOIN product ON invoice_details.product_code=product.product_code where invoice_id='$invoice_id'");

                                while ($row = mysqli_fetch_assoc($view_customer)) {
                                    ?>

                                    <tr>

                                        <td><input class="case" type="checkbox"/></td>
                                        <td><input type="text" data-type="productCode" name="data[0][product_id]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off" value="<?php echo $row['product_code']; ?>"></td>
                                        <td><input type="text" data-type="productName" name="data[0][product_name]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off" value="<?php echo $row['product_name']; ?>"></td>
                                        <td><input type="number" name="data[0][price]" id="price_1" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;" value="<?php echo $row['price']; ?>"></td>
                                        <td><input type="number" name="data[0][quantity]" id="quantity_1" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;" value="<?php echo $row['quantity']; ?>"></td>
                                        <td><input type="number" name="data[0][total]" id="total_1" class="form-control totalLinePrice" autocomplete="off"  ondrop="return false;" onpaste="return false;" value="<?php echo $row['total']; ?>"></td>

                                        <?php
                                    }
                                    ?>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
                        <button id="delete" class="btn btn-danger delete" type="button">- Delete</button>
                        <button id="addmore" class="btn btn-success addmore" type="button">+ Add More</button>
                        <h2>Notes: </h2>
                        <div class="form-group">
                            <textarea class="form-control" rows='5' name="notes" id="notes" placeholder="Your Notes"><?php echo $notes; ?></textarea>
                        </div>
                    </div>

                    <div class='col-xs-offset-2 col-xs-9 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3'>

                        <div class="form-group">
                            <label>Subtotal: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="text" class="form-control" name="invoice_subtotal" id="subTotal" placeholder="Subtotal" ondrop="return false;" onpaste="return false;" value="<?php echo $gross_amount; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Discount: &nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount" ondrop="return false;" onpaste="return false;" value="<?php echo $discount; ?>">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Discount Amount: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="text" class="form-control" name="discountAmount" id="discountAmount" placeholder="Discount" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tax: &nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="tax" id="tax" placeholder="Tax" ondrop="return false;" onpaste="return false;" value="<?php echo $tax; ?>">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tax Amount: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax" ondrop="return false;" onpaste="return false;">	
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Additional Tax: &nbsp;</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="additonaltax" id="additonaltax" placeholder="Tax"  ondrop="return false;" onpaste="return false;" value="<?php echo $additional_tax; ?>">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Additional Tax Amount: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="text" class="form-control" name="additonaltaxAmount" id="additonaltaxAmount" placeholder="Tax" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="text" class="form-control" name="invoice_total" id="totalAftertax" placeholder="Total" ondrop="return false;" onpaste="return false;" value="<?php echo $total_amount; ?>">
                            </div>
                        </div>



                    </div>
                </div>

                <div class='row'>
                    <div class="col-xs-12 col-sm-12">
                        <div class="text-center">
                            <button data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" class="btn btn-success submit_btn invoice-save-bottom form-control"> <i class="fa fa-floppy-o"></i>  Save Invoice </button>
                        </div>
                    </div>
                </div>

            </form>
        </div> <!-- /container -->

        <?php include_once './templates/footer.php'; ?>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/auto.js"></script>

        <!-- multiple autocomplete -->       
        <!-- Bootstrap 3.3.6 -->
        <script src="js/bootstrap.min.js"></script>
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