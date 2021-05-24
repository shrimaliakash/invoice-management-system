<?php

include('connection.php');
if ($_POST['country'] != "" && $_POST['city_name'] != "" && $_POST['state'] != ""):
    extract($_POST);
    $city_name = mysqli_real_escape_string($conn, $city_name);
    $country = mysqli_real_escape_string($conn, $country);
    $state = mysqli_real_escape_string($conn, $state);
    $sql = mysqli_query($conn, "INSERT INTO `city`(`city_name`,`country_id`,`state_id`) VALUES ('$city_name','$country','$state')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;
    if ($sql)
        $id1 = mysqli_query($conn, "select count(city_id) as city_id from city");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['city_id'];
    echo '<tr><td>' . $id3 . '</td><td>' . $country . '</td><td>' . $state . '</td><td>' .  $city_name. '</td>
            <td><a data-id=' . $id3 . ' class="update" href="#">Update</a></td>
           <td><a data-id=' . $id3 . ' class="delete" href="#">Delete</a></td></tr>';
endif;
?>

