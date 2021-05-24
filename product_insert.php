<?php

include "connection.php";
if (isset($_POST['submit'])) {



    $product_name = $_REQUEST['product_name'];
    $purchase_amount = $_REQUEST['purchase_amount'];
    $tax = $_REQUEST['tax'];
    $additional_tax = $_REQUEST['additional_tax'];
    $discount = $_REQUEST['discount'];
    $gross_amount = $_REQUEST['gross_amount'];
    $sales_amount = $_REQUEST['sales_amount'];


    if (isset($_REQUEST['status']) && $_REQUEST['status'] == "on") {
        $Status = 1;
    } else {
        $Status = 0;
    }

    $qry = "INSERT INTO `tblproduct`(`product_name`, `purchase_amount`, `tax`, `additional_tax`, `discount`, `gross_amount`, `sales_amount`, `status`) 
		VALUES 
		('$product_name', '$purchase_amount', '$tax', '$additional_tax', '$discount', '$gross_amount', '$sales_amount', '$Status')";

    $res = mysqli_query($conn, $qry);
    if (!$res) {

        echo "Nothing has to be done ..please try again";
        die;
    } else {

        echo "Successfully Done";
    }
}
?>
