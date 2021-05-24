<?php

include('connection.php');
if ($_POST['id'] != "") {
    extract($_POST);
    $id = mysqli_real_escape_string($conn, $id);
    $sql = mysqli_query($conn, "DELETE FROM state WHERE state_id='$id'");
}
?>