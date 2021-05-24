<?php

include('connection.php');

if ($_POST['vendor_id'] != "") {
    extract($_POST);
    $vendor_id = mysqli_real_escape_string($conn, $vendor_id);
    $sql = mysqli_query($conn, "DELETE FROM vendor WHERE vendor_id='$vendor_id'");
}
?>