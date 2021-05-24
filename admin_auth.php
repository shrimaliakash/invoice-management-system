<?php

if (isset($_SESSION['email']) && isset($_SESSION['email']) > 0) {
    // auth okay, setup session
    $login_session = $_SESSION['email'];
    // redirect to required page
} else {
    // didn't auth go back to loginform
    header("Location: index.php");
}
?>