<?php

$conn = mysqli_connect('localhost', 'root', '', 'invoice');

session_start();
$user_check = $_SESSION['email'];

$sql = mysqli_query($conn, "SELECT first_name,last_name FROM user WHERE email='$user_check'");
$row = mysqli_fetch_assoc($sql);
$login_session1 = $row['first_name'] . ' ' . $row['last_name'];
if (!isset($login_sesion1)) {
    mysqli_close($conn);
    //header('Location:login.php');
}
?>