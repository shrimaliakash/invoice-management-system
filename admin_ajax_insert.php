<?php

include('connection.php');
if ($_POST['admin_name'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['admin_image'] != ""):
    extract($_POST);
    $admin_name = mysqli_real_escape_string($conn, $admin_name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $admin_image = mysqli_real_escape_string($conn, $admin_image);
    $sql = mysqli_query($conn, "INSERT INTO `admin`(`username`, `email`, `password`, `admin_image`) VALUES ('$admin_name','$email','$password','$admin_image')");
    $id = mysqli_insert_id($conn);
    if ($sql)
        $id1 = mysqli_query($conn, "select count(admin_id) as admin_id from admin");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['admin_id'];
    header('Location:admin_select.php');
endif;
?>

