<?php

session_start();
include('admin_auth.php');
$conn = mysqli_connect('localhost', 'root', '', 'invoice');

$user_check = $_SESSION['email'];

$sql = mysqli_query($conn, "SELECT username,admin_image FROM admin WHERE email='$user_check'");
$row = mysqli_fetch_assoc($sql);
$login_session1 = $row['username'];
$image = $row['admin_image'];
?>

<?php

$con = mysqli_connect("localhost", "root", "", "invoice");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['submit'])) {
    extract($_POST);

    if (isset($_FILES['admin_image']['name'])) {
        $file_name_all = "";
        for ($i = 0; $i < count($_FILES['admin_image']['name']); $i++) {
            $tmpFilePath = $_FILES['admin_image']['tmp_name'][$i];
            if ($tmpFilePath != "") {
                $path = "uploads/"; // create folder 
                $name = $_FILES['admin_image']['name'][$i];
                $size = $_FILES['admin_image']['size'][$i];


                //list($txt, $ext) = explode(",", $name);
                //$file= time().substr(str_replace(" ", "_", $txt), 0);
                $info = pathinfo($name, PATHINFO_EXTENSION);
                $filename = $name . "." . $ext;
                $image2 = rand(1, 10000);
                $image3 = $image2 . "." . $info;

                if (move_uploaded_file($_FILES['admin_image']['tmp_name'][$i], $path . $image3)) {
                    $file_name_all.=$image3 . ",";
                }
            }
        }
        $filepath = rtrim($file_name_all, '*');
        $query = mysqli_query($con, "INSERT into admin (`admin_image`) VALUES('" . addslashes($filepath) . "'); ");
        mysqli_error($con);
        if ($query) {
            header("Location:admin_profile.php");
        }
    } else {
        $filepath = "";
    }
}
?>