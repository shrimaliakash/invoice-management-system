<?php

include ('connection.php');
if (isset($_POST['submit'])) {

    $category_id = $_REQUEST['category_id'];
    $category_name = $_REQUEST['category_name'];

    $qry = "UPDATE category SET category='$category_name' WHERE category_id='$category_id'";

    echo $qry;


    $result = mysqli_query($conn, $qry);

    if (!$result) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:category.php");
    }
}
?>





