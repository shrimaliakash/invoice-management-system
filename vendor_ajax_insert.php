<?php

include('connection.php');
if ($_POST['vendor_name'] != "" && $_POST['phone'] != "" && $_POST['email'] != "" && $_POST['vat_no'] != "" && $_POST['tin_no'] != "" && $_POST['contact_no'] != "" && $_POST['city'] != "" && $_POST['status'] != ""):
    extract($_POST);
    $vendor_name = mysqli_real_escape_string($conn, $vendor_name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $vat_no = mysqli_real_escape_string($conn, $vat_no);
    $tin_no = mysqli_real_escape_string($conn, $tin_no);
    $contact_no = mysqli_real_escape_string($conn, $contact_no);
    $address = mysqli_real_escape_string($conn, $address);
    $contact_person = mysqli_real_escape_string($conn, $contact_person);
    $city = mysqli_real_escape_string($conn, $city);
    $status = mysqli_real_escape_string($conn, $status);

    echo $query = mysqli_query($conn, "INSERT INTO vendor(vendor_name,phone,email,vat_no,tin_no,contact_no,address,contact_person,city,status)
        VALUES('$vendor_name','$phone','$email','$vat_no','$tin_no','$contact_no','$address','$contact_person','$city','$status')");
    $id = mysqli_insert_id($conn);


    if ($query)
        $id1 = mysqli_query($conn, "select count(vendor_id) as vendor_id from vendor");
    $id2 = mysqli_fetch_array($id1);
    $val = $id2['vendor_id'];
    echo '<tr><td>' . $val . '</td><td>' . $vendor_name . '</td><td>' . $phone . '</td><td>' . $email . '</td><td>' . $vat_no . '</td><td>' . $tin_no . '</td><td>' . $contact_no . '</td>
                <td>' . $address . '</td><td>' . $contact_person . '</td><td>' . $city . '</td><td>' . $status . '</td>
                <td><a data-id=' . $id . ' href="#">Update</a></td>           
                <td><a data-id=' . $id . ' class="delete" href="#">Delete</a></td></tr>';
endif;
?>