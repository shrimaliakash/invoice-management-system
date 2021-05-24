<?php

include('connection.php');

$aid = $_GET['admin_id'];

$query = "DELETE FROM admin WHERE admin_id='$aid'";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "record not deleted!!!";
} else {
    header('Location:admin_select.php');
}
?>