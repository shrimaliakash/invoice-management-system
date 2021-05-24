<?php

include "connection.php";

$quotation_id = $_REQUEST["quotation_id"];

$query = "delete from quotation where quotation_id='$quotation_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error in Query Execution!";
    die;
} else {
    header("Location:quotation-list.php");
}
$query1 = "delete from quotation_details where quotation_id='$quotation_id'";
$result1 = mysqli_query($conn, $query1);

if (!$result1) {
    echo "Error in Query Execution!";
    die;
} else {
    header("Location:quotation-list.php");
}
?>