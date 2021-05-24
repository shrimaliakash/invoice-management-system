<?php

include('connection.php');
if ($_POST['tax'] != "" && $_POST['tax_name'] != "" && $_POST['tax_percentage'] != ""):
    extract($_POST);
    $tax = mysqli_real_escape_string($conn, $tax);
    $tax_name = mysqli_real_escape_string($conn, $tax_name);
    $tax_percentage = mysqli_real_escape_string($conn, $tax_percentage);
    $sql = mysqli_query($conn, "INSERT INTO `taxation`(`tax`, `tax_name`, `tax_percentage`) VALUES ('$tax','$tax_name','$tax_percentage')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;
    if ($sql)
        $id1 = mysqli_query($conn, "select count(taxation_id) as taxation_id from taxation");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['taxation_id'];
    echo '<tr><td>' . $id3 . '</td><td>' . $tax . '</td><td>' . $tax_name . '</td><td>' . $tax_percentage . '</td>
            <td><a data-id=' . $id3 . ' class="update" href="#">Update</a></td>
           <td><a data-id=' . $id3 . ' class="delete" href="#">Delete</a></td></tr>';
endif;
?>

