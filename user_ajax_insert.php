<?php

include('connection.php');
if ($_POST['first_name'] != "" && $_POST['last_name'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['address'] != "" && $_POST['mobile_no'] != "" && $_POST['country'] != "" && $_POST['state'] != "" && $_POST['city'] != "" && $_POST['role'] != "" && $_POST['status'] != ""):
    extract($_POST);
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $address = mysqli_real_escape_string($conn, $address);
    $mobile_no = mysqli_real_escape_string($conn, $mobile_no);
    $country = mysqli_real_escape_string($conn, $country);
    $state = mysqli_real_escape_string($conn, $state);
    $city = mysqli_real_escape_string($conn, $city);
    $role = mysqli_real_escape_string($conn, $role);
    $status = mysqli_real_escape_string($conn, $status);

    $query = mysqli_query($conn, "INSERT INTO user(first_name,last_name,email,password,address,mobile_no,country,state,city,role,status)
        VALUES('$first_name','$last_name','$email','$password','$address','$mobile_no','$country','$state','$city','$role','$status')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;


    if ($query)
        $id1 = mysqli_query($conn, "select count(u_id) as u_id from user");
    $id2 = mysqli_fetch_assoc($id1);
    $val = $id2['u_id'];
    echo '<tr><td>' . $val . '</td><td>' . $first_name . '</td><td>' . $last_name . '</td><td>' . $email . '</td><td>' . $password . '</td>
                <td>' . $address . '</td><td>' . $mobile_no . '</td><td>' . $country . '</td><td>' . $state . '</td><td>' . $city . '</td><td>' . $role . '</td><td>' . $status . '</td>
                <td><a data-id=' . $val . ' href="#">Update</a></td>           
                <td><a data-id=' . $val . ' class="delete" href="#">Delete</a></td></tr>';
endif;
?>