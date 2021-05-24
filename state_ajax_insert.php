<?php

include('connection.php');
if ($_POST['country'] != "" && $_POST['state_name'] != ""):
    extract($_POST);
    $country = mysqli_real_escape_string($conn, $country);
    $state_name = mysqli_real_escape_string($conn, $state_name);
    $sql = mysqli_query($conn, "INSERT INTO `state`(`country_id`,`state_name`) VALUES ('$country','$state_name')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;
    if ($sql)
        $id1 = mysqli_query($conn, "select count(state_id) as state_id from state");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['state_id'];
    echo '<tr><td>' . $id3 . '</td><td>' . $country . '</td><td>' . $state_name . '</td>
            <td><a data-id=' . $id3 . ' class="update btn btn-warning" href="#">Update</a></td>
           <td><a data-id=' . $id3 . ' class="delete btn btn-danger" href="#">Delete</a></td></tr>';
endif;
?>

