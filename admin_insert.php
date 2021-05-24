<?php

include('connection.php');
$username = $_POST['admin_name'];
$email = $_POST['email'];
$password = $_POST['password'];

$target_dir = "uploads/";
$image = $_FILES['admin_image']['name'];
$imageType = pathinfo($image, PATHINFO_EXTENSION);
$imageTemp = $_FILES['admin_image']['tmp_name'];
$image2 = rand(1, 10000);
$image3 = $image2 . "." . $imageType;
$query = mysqli_query($conn, "INSERT INTO admin(username,email,password,admin_image) VALUES('$username','$email','$password','$image3')");

$move = (move_uploaded_file($imageTemp, $target_dir . $image3));
header('Location:admin_select.php');
?>