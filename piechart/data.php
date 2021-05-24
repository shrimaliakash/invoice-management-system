<?php
$con = mysqli_connect("localhost","root","invoice");

$result = mysqli_query("SELECT product_name, purchase_amount FROM product");

$rows = array();
while($r = mysqli_fetch_array($result)) {
	$row[0] = $r[0];
	$row[1] = $r[1];
	array_push($rows,$row);
}

print json_encode($rows, JSON_NUMERIC_CHECK);

mysqli_close($con);
?> 
