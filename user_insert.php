<?php

include('connection.php');

if (isset($_POST['submit'])) {
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $address = $_REQUEST['address'];
    $mno = $_REQUEST['number'];
    $country = $_REQUEST['country'];
    $state = $_REQUEST['state'];
    $city = $_REQUEST['city'];
    $role = $_REQUEST['role'];
    $status = $_REQUEST['status'];

    $query = "INSERT INTO user(first_name,last_name,email,password,address,mobile_no,country,state,city,role,status) VALUES('$fname','$lname','$email','$password','$address','$mno','$country','$state','$city','$role','$status')";
    echo $query;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Values are not inserted!!!";
    } else {
        echo "dgg";
        header('Location:user_select.php');
    }
}
?>