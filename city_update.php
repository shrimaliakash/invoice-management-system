<?php

include ('connection.php');
if (isset($_POST['submit'])) {
    $city_id = $_REQUEST['city_id'];
    $city_name = $_REQUEST['city_name'];

    $qry = "UPDATE city SET city_name='$city_name' WHERE city_id='$city_id'";
    $result = mysqli_query($conn, $qry);

    if (!$result) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:city.php");
    }
}
?>





