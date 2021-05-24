<?php

//Include database configuration file
include('config.php');


if (isset($_POST["customer_id"])) {
    //Get all subcategory data
    $query = mysqli_query($con, "SELECT address FROM customer WHERE customer_id = " . $_POST['customer_id'] . "");
}
?>