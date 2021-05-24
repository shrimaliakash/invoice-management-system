<?php 
 session_start();
 require 'class/myclass.php';
include('connection.php');
 
 if($_POST)
 {
     $name = mysqli_real_escape_string($conn,$_POST['mail']);
     
     
     $q = mysqli_query($conn,"select * from admin where email='{$name}'") or die(mysql_error());
     $data=  mysqli_fetch_array($q);
     if($data)
     {
      
            require 'class/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'akashshrimali1995@gmail.com';                 // SMTP username
            $mail->Password = 'akash@12345';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            $mail->setFrom('akashshrimali1995@gmail.com', 'akashshrimali1995@gmail.com');
            $mail->addAddress($name, $name);     // Add a recipient
           
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Forgor Password For Invoice Management System';
            $mail->Body    = 'Your Password is '.$data['password'];

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
                header('Location:index.php');
            }
         
     }
     else
     {
         echo "Sorry You have Enter Wrong Email!!!!!";
     }
 }
 ?>