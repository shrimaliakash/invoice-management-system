<?php

include('connection.php');

if ($_POST['customer_id'] != "") {
    extract($_POST);
    $customer_id = mysqli_real_escape_string($conn, $customer_id);
    $sql = mysqli_query($conn, "DELETE FROM customer WHERE customer_id='$customer_id'");
}
?>