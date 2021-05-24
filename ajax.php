<?php

session_start();
require_once 'config.php';

if (!empty($_POST['type'])) {


    $category = $_SESSION['category_id'];

    $subcategory = $_SESSION['subcategory_id'];

    if (isset($category) && isset($subcategory)) {
        $type = $_POST['type'];
        $name = $_POST['name_startsWith'];
        $query = "SELECT product_code, product_name, sales_amount FROM product WHERE category_id='$category' AND subcategory_id='$subcategory'";
        $result = mysqli_query($con, $query);
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['product_code'] . '|' . $row['product_name'] . '|' . $row['sales_amount'];
            array_push($data, $name);
        }
        echo json_encode($data);
        exit;
    }
}
?>

