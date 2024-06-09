<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


$username = $password = "";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$v_code){
    require ('../PHPMailer/PHPMailer.php');
    require ('../PHPMailer/SMTP.php');
    require ('../PHPMailer/Exception.php');

    require ('../config.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings
//
//        $mail->isSMTP();                                            //Send using SMTP
//        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//        $mail->Username   = 'jhasan0122@gmail.com';                     //SMTP username
//        $mail->Password   = '9248@Ramos@WithSiuuu';                               //SMTP password
//        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
//        $mail->Port       = 587; (465)


        $mail = new PHPMailer();
        $mail->SMTPDebug = 2;
//        $mail->Debugoutput = 'html';

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jhasan0122@gmail.com';
        $mail->Password = '9248@Ramos@WithSiuuu';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;


        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('jhasan0122@gmail.com', 'Jehan Hasan');
        $mail->addAddress("jhasan2201@gmail.com");     //Add a recipient
        //$_POST['email']

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification from Explore Plus';
        $mail->Body    = "Thanks for registration <br>
                          Click the link below to varify
                          <a href='http://localhost/explore_plus/Security/varify_email.php?email=$email&vcode=$v_code'>verify</a>";

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo $e;
        return false;
    }
}



if(isset($_POST['varify_email'])){
    if(!empty($_POST['email'])){
        if(sendMail($_POST['email'],'455643')){
            echo "Donneeee";
        }
        else{
            echo "nottt";
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!--<div class="admin__access">-->
<!--    <h3><a href="../Admin/admin_login.php">Admin</a></h3>-->
<!--</div>-->

<section class="login">
    <div class="login__contaner">
        <form action="" method="post">
            <h1 class="login__h1">Enter your email to change password:</h1>
<!--            <div class="login__item">-->
<!--                <label for="username">Username:</label>-->
<!--                <input class="login__input" type="text" name="username" id="username" placeholder="Enter your name">-->
<!--            </div>-->
            <div class="login__item">
                <label for="password">Email :</label>
                <input class="login__input" type="email" name="email" id="email" placeholder="Enter your password">
            </div>
            <button class="login__button" type="submit" name="varify_email">Varify Email</button>
            <p class="login__p">Do not Have an Account? Register</p>
            <button class="login__button" type="submit" name="signup"><a href="../User/signup.php">Register</a></button>
        </form>
    </div>
</section>
</body>
</html>
