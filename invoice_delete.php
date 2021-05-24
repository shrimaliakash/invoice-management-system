<?php

include "connection.php";

$invoice_id = $_REQUEST["invoice_id"];

$query = "delete from invoice where invoice_id='$invoice_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error in Query Execution!";
    die;
} else {
    header("Location:invoice-list.php");
}
$query1 = "delete from invoice_details where invoice_id='$invoice_id'";
$result1 = mysqli_query($conn, $query1);

if (!$result1) {
    echo "Error in Query Execution!";
    die;
} else {
    header("Location:invoice-list.php");
}
?>