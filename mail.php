<?php

$to = 'akashshrimali123@yahoo.com';
$subject = 'Test mail';
$message = 'Hello, How are you?';
$headers = 'From:akashshrimali1995@gmail.com' . "\r\n" .
        'Cc: parmardhruv992@gmail.com' . "\r\n";

$mail = mail($to, $subject, $message, $headers);

if ($mail) {
    echo "Mail successfully sent!";
} else {
    echo "not sent!";
}
?> 
