<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

//session_start();
//echo $_SESSION['guide_username'];
//session_destroy();

$username = $password = "";

$error = array('username' =>'',  'password' => '');


if(isset($_POST['login'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        if(empty($_POST['username'])){
            $error['username'] = "Username is required";
        }
        else{
            $username = $_POST['username'];
        }

        if(empty($_POST['password'])){
            $error['password'] = "Password is required";
        }
        else{
            $password = $_POST['password'];
        }


        if(array_filter($error)){
            echo "Login Unsuccessful";
        }
        else{
            $username = $_POST['username'];
            $password = $_POST['password'];

            if($username=="Admin" and $password=='keypass'){
                header('Location: http://localhost/explore_plus/Admin/admin.php');
            }
            else{
                $sql = "SELECT guide.password 
                    FROM guide 
                    WHERE guide.username = '{$username}'";
                $result = mysqli_query($conn,$sql);

                $pass = mysqli_fetch_assoc($result);


                if(password_verify($password,$pass['password'])){
                    session_start();

                    $_SESSION['guide_username'] = $username;
//                    $_COOKIE['guide_username'] = $username;
//                   setcookie("guide_username", $username, time() + 1800, "/");

//                    echo $username;

                    header('Location: http://localhost/explore_plus/Admin/guide_profile.php');
                }
                else{
                    echo "login unsuccessful";
                }
            }

        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="admin__access user__access">
    <h3><a href="../index.php">User</a></h3>
</div>


<section class="admin__login">
    <div class="login__contaner">
        <form action="admin_login.php" method="post">
            <h1 class="login__h1">Login / Sign-up</h1>
            <div class="login__item">
                <label for="username">Username:</label>
                <input class="login__input" type="text" name="username" id="username" placeholder="Enter your name">
            </div>
            <div class="login__item">
                <label for="password">Password :</label>
                <input class="login__input" type="password" name="password" id="password" placeholder="Enter your password">
            </div>
            <button class="login__button" type="submit" name="login">Login</button>
            <p class="login__p">Do not Have an Account? Register</p>
            <button class="login__button" type="submit" name="signup"><a href="guide_signup.php">Register</a></button>
        </form>
    </div>
</section>
</body>
</html>
