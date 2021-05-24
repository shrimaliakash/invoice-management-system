<?php

include "connection.php";
if (isset($_POST['submit'])) {

    $product_code = $_REQUEST['product_code'];
    $category_id = $_REQUEST['category_id'];
    $subcategory_id = $_REQUEST['subcategory_id'];
    $product_name = $_REQUEST['product_name'];
    $purchase_amount = $_REQUEST['purchase_amount'];
    $tax = $_REQUEST['tax'];
    $additional_tax = $_REQUEST['additional_tax'];
    $discount = $_REQUEST['discount'];
    $gross_amount = $_REQUEST['gross_amount'];
    $sales_amount = $_REQUEST['sales_amount'];

    echo $qry = "update `product` SET `category_id`='$category_id',`subcategory_id`='$subcategory_id',`product_name`='$product_name', `purchase_amount`='$purchase_amount', `tax`='$tax',
	`additional_tax`='$additional_tax', `discount`='$discount', `gross_amount`='$gross_amount', `sales_amount`='$sales_amount' WHERE `product_code`='$product_code'";


    $result = mysqli_query($conn, $qry);
    if (!$result) {
        echo "Error in Query Execution!";
        die;
    } else {
        echo "Values are updated!";
        header("Location:product.php");
    }
}
?>





