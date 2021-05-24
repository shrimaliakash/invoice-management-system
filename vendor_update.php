<?php

include('connection.php');

if (isset($_POST['submit'])) {
    $vendor_id = $_REQUEST['vendor_id'];
    $vendor_name = $_REQUEST['vendor_name'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $vat_no = $_REQUEST['vat_no'];
    $tin_no = $_REQUEST['tin_no'];
    $contact_no = $_REQUEST['contact_no'];
    $address = $_REQUEST['address'];
    $contact_person = $_REQUEST['contact_person'];
    $city = $_REQUEST['city'];
    $status = $_REQUEST['status'];

    echo $query = "UPDATE vendor SET vendor_name='$vendor_name',phone='$phone',email='$email',vat_no='$vat_no',tin_no='$tin_no',contact_no='$contact_no',address='$address',
                 contact_person='$contact_person',city='$city',status='$status' WHERE vendor_id='$vendor_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "values not updated";
    } else {
        header("Location:vendor.php");
    }
}
?>