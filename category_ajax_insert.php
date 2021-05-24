<?php

include('connection.php');
if ($_POST['category_name'] != ""):
    extract($_POST);
    $category_name = mysqli_real_escape_string($conn, $category_name);
    $sql = mysqli_query($conn, "INSERT INTO `category`(`category`) VALUES ('$category_name')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;
    if ($sql)
        $id1 = mysqli_query($conn, "select count(category_id) as category_id from category");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['category_id'];
    echo '<tr><td>' . $id3 . '</td><td>' . $category_name . '</td>
            <td><a data-id=' . $id3 . ' class="update btn btn-warning" href="#">Update</a></td>
           <td><a data-id=' . $id3 . ' class="delete btn btn-danger" href="#">Delete</a></td></tr>';
endif;
?>

