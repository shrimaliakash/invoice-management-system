<?php

session_start();
//Include database configuration file
include('connection.php');

//code for fetch category data using session

if (isset($_POST["category_id"]) && !empty($_POST["category_id"])) {
    //Get all subcategory data
    $query = mysqli_query($conn, "SELECT * FROM subcategory WHERE category_id = " . $_POST['category_id'] . "");
    //Count total number of rows
    $rowCount = mysqli_num_rows($query);

    //Display states list
    if ($rowCount > 0) {
        echo '<option value="">Select Sub Category</option>';
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<option value="' . $row['subcategory_id'] . '">' . $row['subcategory'] . '</option>';
        }
    } else {
        echo '<option value="">Sub Category not available</option>';
    }

    $_SESSION['category_id'] = $_POST['category_id'];
}

//code for fetch sub category data using session
else if (isset($_POST["subcategory_id"]) && !empty($_POST["subcategory_id"])) {
    //Get all subcategory data
    $query = mysqli_query($conn, "SELECT product_code, product_name, purchase_amount FROM product WHERE subcategory_id = " . $_POST['subcategory_id'] . "");


    $_SESSION['subcategory_id'] = $_POST['subcategory_id'];
}


//code for fetch customer_address data using session
else if (isset($_POST["customer_id"]) && !empty($_POST["customer_id"])) {
    //Get all subcategory data
    $query = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id = " . $_POST["customer_id"] . "");

    $_SESSION['customer_id'] = $_POST['customer_id'];
}
?>