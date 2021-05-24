<?php

include('connection.php');

if (isset($_POST['submit'])) {
    $customer_id = $_REQUEST['customer_id'];
    $customer_name = $_REQUEST['customer_name'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $contact_no = $_REQUEST['contact_no'];
    $address = $_REQUEST['address'];
    $contact_person = $_REQUEST['contact_person'];
    $city = $_REQUEST['city'];
    $status = $_REQUEST['status'];

    $query = "UPDATE customer SET customer_name='$customer_name',phone='$phone',email='$email',contact_no='$contact_no',address='$address',
                 contact_person='$contact_person',city='$city',status='$status' WHERE customer_id='$customer_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "values not updated";
    } else {
        header("Location:customer.php");
    }
}
?>