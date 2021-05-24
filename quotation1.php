<?php
require_once 'quotation-save1.php';
include 'connection.php';
if (!empty($_POST)) {
    try {
        $data = saveQuotation1($_POST);

        if (isset($data['success']) && $data['success']) {
            $_SESSION['success'] = 'quotation Saved Successfully!';
            header('Location: quotation-list.php');
            exit;
        } else {
            $_SESSION['success'] = 'quotation Save failed, try again.';
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}
?>

<?php
$query = mysqli_query($conn, "SELECT * FROM category");
$rowCount = mysqli_num_rows($query);
?>

<?php
$query1 = mysqli_query($conn, "SELECT * FROM customer");
$rowCount1 = mysqli_num_rows($query1);
?>

<?php
$query2 = mysqli_query($conn, "SELECT * FROM quotation");
$rowCount2 = mysqli_num_rows($query2);
$rowCount3 = $rowCount2 + 1;
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">  
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <meta name="author" content="muni">
        <meta name="description" content="Save Multiple Rows of quotation Data In MySQL Database Using PHP, jQuery and Bootstrap 3">
        <meta name="keywords" content="jquery autocomplete quotation, jquery autocomplete quotation module, quotation using jqueryautocomplete, jquery quotation module  autocomplete, quotation using jquery autocomplete">



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
                                $('#quotation_save').html(html);
                            }
                        });
                    } else {

                    }
                });
            });
        </script>





    </head>

    <body>  
        <?php include_once './templates/nav1.php'; ?>
        <!-- Insert your HTML here -->
        <div class="container content">
            <?php include_once './templates/message.php'; ?>
            <form class="form-horizontal quotation-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="quotation-form" method="post" role="form" novalidate>
                <div class='row no-margin'>
                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <div class="logo">
                            <img src="img/tct.jpg" alt="Company Logo">
                        </div>
                        <h4>TCT quotation</h4>
                        <p>
                            410,Ashwamegh Avenue,Mithkhali under Bridge,
                            Navaranpura,Ahmedabad - 380009.
                        </p>

                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <button data-loading-text="Saving quotation..." type="submit" name="quotation_btn" class="btn btn-success submit_btn quotation-save-top form-control"> <i class="fa fa-floppy-o"></i>  Save quotation </button>

                    </div>
                </div>
                <hr>
                <div class="row no-margin">
                    <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
                        <h4>quotation To</h4>




                        <select class="form-control select2" id="customer_id" name="customer_id">
                            <option value="">Select Customer</option>

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

                        <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12' id="quotation_save">
                            <div class="form-group">
                                <input type="text" data-type="customerName" name="data[0][customer_name]" id="customer_name" class="form-control autocomplete_txt1" autocomplete="on" placeholder="Customer Name">
                            </div>

                            <div class="form-group">
                                <input type="text" data-type="customerNo" name="data[0][phone]" id="phone" class="form-control autocomplete_txt1" autocomplete="on" placeholder="Customer Number">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control autocomplete_txt1" rows='3' data-type="customerAddress" name="data[0][address]" id="address" placeholder="customer Address" autocomplete="on"  ondrop="return false;" onpaste="return false;"></textarea>						
                            </div>                        
                        </div>

                    </div>
                    <div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
                        <h4>&nbsp;</h4>

                        <!-- <div class="form-group">
                                 <input type="text" class="form-control autocomplete_txt1" name="quotation_id" id="quotation_id" placeholder="quotation Id" value="">
                         </div>-->
                        <div class="form-group">
                            <input type="text" class="form-control autocomplete_txt1" name="quotationDate" id="quotationDate" placeholder="quotation Date" value="<?php date_default_timezone_set("Asia/Calcutta");
                            echo date("d/m/Y"); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control autocomplete_txt1" name="from_date" id="from_date" placeholder="From Date">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control autocomplete_txt1" name="expire_date" id="expire_date" placeholder="Expire Date">
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
                        <table class="table table-bordered table-hover" id="quotationTable">
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
                                <tr>
                                    <td><input class="case" type="checkbox"/></td>
                                    <td><input type="text" data-type="productCode" name="data[0][product_id]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
                                    <td><input type="text" data-type="productName" name="data[0][product_name]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
                                    <td><input type="number" name="data[0][price]" id="price_1" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>
                                    <td><input type="number" name="data[0][quantity]" id="quantity_1" class="form-control changesNo" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>
                                    <td><input type="number" name="data[0][total]" id="total_1" class="form-control totalLinePrice" autocomplete="off"  ondrop="return false;" onpaste="return false;"></td>
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
                            <textarea class="form-control" rows='5' name="notes" id="notes" placeholder="Your Notes"></textarea>
                        </div>
                    </div>

                    <div class='col-xs-offset-2 col-xs-9 col-sm-offset-2 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-3 col-lg-3'>

                        <div class="form-group">
                            <label>Subtotal: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="number" class="form-control" name="quotation_subtotal" id="subTotal" placeholder="Subtotal" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Discount: &nbsp;</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="discount" id="discount" placeholder="Discount" ondrop="return false;" onpaste="return false;">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Discount Amount: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="number" class="form-control" name="discountAmount" id="discountAmount" placeholder="Discount" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tax: &nbsp;</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="tax" id="tax" placeholder="Tax" ondrop="return false;" onpaste="return false;">
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
                            <label>Additonal Tax: &nbsp;</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="additonaltax" id="additonaltax" placeholder="Tax"  ondrop="return false;" onpaste="return false;">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Additional Tax Amount: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="number" class="form-control" name="additonaltaxAmount" id="additonaltaxAmount" placeholder="Tax" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total: &nbsp;</label>
                            <div class="input-group">
                                <div class="input-group-addon">Rs.</div>
                                <input type="number" class="form-control" name="quotation_total" id="totalAftertax" placeholder="Total" ondrop="return false;" onpaste="return false;">
                            </div>
                        </div>							

                    </div>
                </div>

                <div class='row'>
                    <div class="col-xs-12 col-sm-12">
                        <div class="text-center">
                            <button data-loading-text="Saving quotation..." type="submit" name="quotation_btn" class="btn btn-success submit_btn quotation-save-bottom form-control"> <i class="fa fa-floppy-o"></i>  Save quotation </button>
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
        <script src="js/auto1.js"></script>

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