<?php

session_start();
//Include database configuration file
include('connection.php');
if (isset($_POST["subcategory_id"]) && !empty($_POST["subcategory_id"])) {
    //Get all subcategory data
    $query = mysqli_query($conn, "SELECT product_code, product_name, purchase_amount FROM product WHERE subcategory_id = " . $_POST['subcategory_id'] . "");


    $_SESSION['subcategory_id'] = $_POST['subcategory_id'];
} else {
    $query1 = mysqli_query($conn, "SELECT * FROM product");
}
?>