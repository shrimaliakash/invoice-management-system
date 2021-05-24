<?php

$target = "uploads/";
$target = $target . basename($_FILES["fileupload"]["name"]);
$ok = 1;
$imagefiletype = pathinfo($target, PATHINFO_EXTENSION);

//Check if image file is actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image-" . $check["mime"] . ".";
        $ok = 1;
    } else {
        echo "File is not a image.";
        $ok = 0;
    }
}

//Check if file already exists
if (file_exists($target)) {
    echo "sorry,file alradey exists.";
    $ok = 0;
}

if (isset($_FILES["fileupload"])) {
    //code to get image and move to folder or upload it

    $file_name = $_FILES["fileupload"]["name"];
    echo "<img src='uploads/$file_name' .$file_name.  height=200 width=300 />";

    //code to store image in database
}

//Allow certain file formats
if ($imagefiletype != "jpg" && $$imagefiletype != "png" && $imagefiletype != "jpeg" && $imagefiletype != "gif") {
    echo "sorry,only JPG,PNG,JPEG & GIF  files are allowed.";
    $ok = 0;
}

//Ckech if $ok is set to 0 by an error
if ($ok == 0) {
    echo "sorry,your file was not uploaded.";
    //if everything is ok,try to upload image
} else {
    if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target)) {
        echo "The file " . basename($_FILES["fileupload"]["name"]) . "has been uploaded.";
    } else {
        echo "sorry,there was an error uploading your file.";
    }
}
?>