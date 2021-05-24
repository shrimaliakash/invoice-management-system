<?php

session_start();
include('admin_auth.php');
$conn = mysqli_connect('localhost', 'root', '', 'invoice');

$user_check = $_SESSION['email'];

$sql = mysqli_query($conn, "SELECT username,admin_image FROM admin WHERE email='$user_check'");
$row = mysqli_fetch_assoc($sql);
$login_session1 = $row['username'];
$image = $row['admin_image'];
?>

<?php

include ('connection.php');
if (isset($_POST['submit'])) {
    $tid = $_REQUEST['taxation_id'];
    $tax = $_REQUEST['tax'];
    $taxname = $_REQUEST['taxname'];
    $percentage = $_REQUEST['percentage'];


    $qry = "UPDATE taxation SET tax='$tax',tax_name='$taxname',tax_percentage='$percentage' WHERE taxation_id='$tid'";
    echo $qry;


    $result = mysqli_query($conn, $qry);

    if (!$result) {
        echo "Error in Query Execution!" . mysqli_error($conn);
    } else {
        echo "Values are updated!";
        header("Location:taxation.php");
    }
}
?>





