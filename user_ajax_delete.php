<?php

include('connection.php');
if ($_POST['u_id'] != "") {
    extract($_POST);
    $u_id = mysqli_real_escape_string($conn, $u_id);
    $sql = mysqli_query($conn, "DELETE FROM user WHERE u_id='$u_id'");
}
?>