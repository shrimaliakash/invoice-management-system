<?php

include ('connection.php');
if (isset($_POST['submit'])) {

    $country_id = $_REQUEST['country_id'];
    $country_name = $_REQUEST['country_name'];

    $qry = "UPDATE country SET country_name='$country_name' WHERE country_id='$country_id'";

    echo $qry;


    $result = mysqli_query($conn, $qry);

    if (!$result) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:country.php");
    }
}
?>





