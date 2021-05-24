<?php
include ('connection.php');
if (isset($_POST['submit'])) {

    $subcategory_id = $_REQUEST['subcategory_id'];
    $category_id = $_REQUEST['category_id'];
    $subcategory_name = $_REQUEST['subcategory_name'];

    $qry = "UPDATE subcategory SET category_id='$category_id',subcategory='$subcategory_name' WHERE subcategory_id='$subcategory_id'";

    echo $qry;


    $result = mysqli_query($conn, $qry);

    if (!$result) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:subcategory.php");
    }
}
?>





