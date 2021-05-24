<?php

include('connection.php');
if ($_POST['date'] != "" && $_POST['from_date'] != "" && $_POST['expire_date'] != "" && $_POST['customer_name'] != "" && $_POST['number'] != "" && $_POST['address'] != "" && $_POST['total_amount'] != "" && $_POST['gross_amount'] != "" && $_POST['discount'] != "" && $_POST['tax'] != "" && $_POST['additional_tax'] != ""):
    extract($_POST);
    $date = mysqli_real_escape_string($conn, $date);
    $from_date = mysqli_real_escape_string($conn, $from_date);
    $expire_date = mysqli_real_escape_string($conn, $expire_date);
    $customer_name = mysqli_real_escape_string($conn, $customer_name);
    $number = mysqli_real_escape_string($conn, $number);
    $address = mysqli_real_escape_string($conn, $address);
    $total_amount = mysqli_real_escape_string($conn, $total_amount);
    $gross_amount = mysqli_real_escape_string($conn, $gross_amount);
    $discount = mysqli_real_escape_string($conn, $discount);
    $tax = mysqli_real_escape_string($conn, $tax);
    $additional_tax = mysqli_real_escape_string($conn, $additional_tax);


    $query = mysqli_query($conn, "INSERT INTO quotation(date,from_date,expire_date,customer_name,number,address,total_amount,gross_amount,discount,tax,additional_tax)
        VALUES('$date','$from_date','$expire_date','$customer_name','$number','$address','$total_amount','$gross_amount','$discount','$tax','$additional_tax')");
    $id = mysqli_insert_id($conn);


    if ($query)
        $id1 = mysqli_query($conn, "select count(quotation_id) as quotation_id from quotation");
    $id2 = mysqli_fetch_array($id1);
    $val = $id2['vendor_id'];
    echo '<tr><td>' . $val . '</td><td>' . $date . '</td><td>' . $from_date . '</td><td>' . $expire_date . '</td><td>' . $customer_name . '</td><td>' . $number . '</td><td>' . $address . '</td>
                <td>' . $total_amount . '</td><td>' . $gross_amount . '</td><td>' . $discount . '</td><td>' . $tax . '</td><td>' . $additional_tax . '</td>
                <td><a data-id=' . $id . ' href="#">Update</a></td>           
                <td><a data-id=' . $id . ' class="delete" href="#">Delete</a></td></tr>';
endif;
?>