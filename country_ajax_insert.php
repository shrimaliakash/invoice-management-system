<?php

include('connection.php');
if ($_POST['country_name'] != ""):
    extract($_POST);
    $country_name = mysqli_real_escape_string($conn, $country_name);
    $sql = mysqli_query($conn, "INSERT INTO `country`(`country_name`) VALUES ('$country_name')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;
    if ($sql)
        $id1 = mysqli_query($conn, "select count(country_id) as country_id from country");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['country_id'];
    echo '<tr><td>' . $id3 . '</td><td>' . $country_name . '</td>
            <td><a data-id=' . $id3 . ' class="update btn btn-warning" href="country_edit.php?country_id=' . $id3.'">Update</a></td>
           <td><a data-id=' . $id3 . ' class="delete btn btn-danger" href="#">Delete</a></td></tr>';
endif;
?>

