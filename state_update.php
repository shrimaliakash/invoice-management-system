<?php

include ('connection.php');
if (isset($_POST['submit'])) {

    $state_id = $_REQUEST['state_id'];
    $country_id = $_REQUEST['country_id'];  
    $state_name = $_REQUEST['state_name'];

    $qry = "UPDATE state SET country_id='$country_id',state_name='$state_name' WHERE state_id='$state_id'";

    echo $qry;


    $result = mysqli_query($conn, $qry);

    if (!$result) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:state.php");
    }
}
?>





