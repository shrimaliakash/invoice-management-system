<?php

include('connection.php');
if ($_POST['category_id'] != "" && $_POST['subcategory'] != ""):
    extract($_POST);
    $category_id = mysqli_real_escape_string($conn, $category_id);
    $subcategory = mysqli_real_escape_string($conn, $subcategory);
    $sql = mysqli_query($conn, "INSERT INTO `subcategory`(`category_id`,`subcategory`) VALUES ('$category_id','$subcategory')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;
    if ($sql)
        $id1 = mysqli_query($conn, "select count(subcategory_id) as subcategory_id from subcategory");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['subcategory_id'];
    echo '<tr><td>' . $id3 . '</td><td>' . $category_id . '</td><td>' . $subcategory . '</td>
            <td><a data-id=' . $id3 . ' class="update" href="#">Update</a></td>
           <td><a data-id=' . $id3 . ' class="delete" href="#">Delete</a></td></tr>';
   
endif;
?>

