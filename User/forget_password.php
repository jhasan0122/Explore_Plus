<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


$username = $password = "";


$error = array('username' =>'',  'password' => '');


if(isset($_POST['varify_email'])){
    if(isset($_POST['email'])){

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
