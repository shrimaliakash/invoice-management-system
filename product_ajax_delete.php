<?php

include "connection.php";
if ($_POST['product_code'] != ""):
    extract($_POST);
    $product_code = mysqli_real_escape_string($conn, $product_code);
    $sql = mysqli_query($conn, "DELETE FROM `product` WHERE product_code = '$product_code'");
endif;
?>