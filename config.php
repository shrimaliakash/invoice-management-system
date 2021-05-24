<?php

//Database credentails
define('DB_HOST', 'localhost');
define('DB_NAME', 'invoice');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');


$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (mysqli_connect_error())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
