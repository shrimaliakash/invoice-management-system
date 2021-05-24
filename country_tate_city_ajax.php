<?php

//Include database configuration file
include('connection.php');

if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
    //Get all state data
    $query = mysqli_query($conn, "SELECT * FROM state WHERE country_id = " . $_POST['country_id'] . "");

    //Count total number of rows
    $rowCount = mysqli_num_rows($query);

    //Display states list
    if ($rowCount > 0) {
        echo '<option value="">Select state</option>';
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<option value="' . $row['state_id'] . '">' . $row['state_name'] . '</option>';
        }
    } else {
        echo '<option value="">State not available</option>';
    }
}

if (isset($_POST["state_id"]) && !empty($_POST["state_id"])) {
    //Get all city data
    $query = mysqli_query($conn, "SELECT * FROM city WHERE state_id = " . $_POST['state_id'] . "");

    //Count total number of rows
    $rowCount = mysqli_num_rows($query);

    //Display cities list
    if ($rowCount > 0) {
        echo '<option value="">Select city</option>';
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<option value="' . $row['city_id'] . '">' . $row['city_name'] . '</option>';
        }
    } else {
        echo '<option value="">City not available</option>';
    }
}
?>