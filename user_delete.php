<?php

include('connection.php');

$id = $_GET['u_id'];

$query = "DELETE FROM user WHERE u_id='$id'";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "recoed not deleted!!!";
} else {
    header('Location:user_select.php');
}
?>