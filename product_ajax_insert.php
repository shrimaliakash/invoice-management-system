<?php

include "connection.php";

if ($_POST['category_id'] != "" && $_POST['subcategory_id'] != "" && $_POST['product_name'] != "" && $_POST['purchase_amount'] != "" && $_POST['tax'] != "" && $_POST['additional_tax'] != "" && $_POST['discount'] != "" && $_POST['gross_amount'] != "" && $_POST['sales_amount'] != ""):
    extract($_POST);



    $category_id = mysqli_real_escape_string($conn, $category_id);
    $subcategory_id = mysqli_real_escape_string($conn, $subcategory_id);
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $purchase_amount = mysqli_real_escape_string($conn, $purchase_amount);
    $tax = mysqli_real_escape_string($conn, $tax);
    $additional_tax = mysqli_real_escape_string($conn, $additional_tax);
    $discount = mysqli_real_escape_string($conn, $discount);
    $gross_amount = mysqli_real_escape_string($conn, $gross_amount);
    $sales_amount = mysqli_real_escape_string($conn, $sales_amount);




    $qry = mysqli_query($conn, "INSERT INTO `product`(`category_id`, `subcategory_id`, `product_name`, `purchase_amount`, `tax`, `additional_tax`, `discount`, `gross_amount`, `sales_amount`)
		VALUES 
		('$category_id', '$subcategory_id', '$product_name', '$purchase_amount', '$tax', '$additional_tax', '$discount', '$gross_amount', '$sales_amount')");

    $id = mysqli_insert_id($conn);
    $id3 = $id++;
    if ($qry)
        $id1 = mysqli_query($conn, "select count(product_code) as product_code from product");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['product_code'];

    echo '<tr><td>' . $category_id . '</td><td>' . $subcategory_id . '</td><td>' . $id3 . '</td><td>' . $product_name . '</td><td>' . $purchase_amount . '</td>
			<td>' . $tax . '</td><td>' . $additional_tax . '</td><td>' . $discount . '</td><td>' . $gross_amount . '</td>
			<td>' . $sales_amount . '</td>
           <td><a data-id=' . $id3 . ' class="edit" href="#">Update</a></td>
		   <td><a data-id=' . $id3 . ' class="delete" href="#">Delete</a></td></tr>';



endif;
?>	