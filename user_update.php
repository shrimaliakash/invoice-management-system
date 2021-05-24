<?php

include ('connection.php');
if (isset($_POST['submit'])) {
    $uid = $_REQUEST['u_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $address = $_REQUEST['address'];
    $mobile_no = $_REQUEST['mobile_no'];
    $country = $_REQUEST['country'];
    $state = $_REQUEST['state'];
    $city = $_REQUEST['city'];
    $role = $_REQUEST['role'];
    $status = $_REQUEST['status'];

    $qry = "UPDATE user SET first_name='$first_name',last_name='$last_name',email='$email',password='$password',address='$address',
	mobile_no='$mobile_no',country='$country',state='$state',city='$city',role='$role',status='$status' WHERE u_id='$uid'";



    $result = mysqli_query($conn, $qry);

    if (!$result) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:user.php");
    }
}
?>





