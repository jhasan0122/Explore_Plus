<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


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
        }
        else{
            $username = mysqli_real_escape_string($conn,$_POST['username']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);


            $sql = "SELECT userpro.password 
                    FROM userpro 
                    WHERE userpro.username = '{$username}'";

            $result = mysqli_query($conn,$sql);

            $pass = mysqli_fetch_assoc($result);


            if(password_verify($password,$pass['password'])){
                session_start();

                $_SESSION['username'] = $username;

                 ?>
                <?php

//                setcookie("username", $username, time() + 1800, "/");
//                header('Location: http://localhost/explore_plus/alert/loginDone.php');
                header('Location: http://localhost/explore_plus/User/main.php');

            }
            else{
                echo "<script>
                    alert('login unsuccessful,You have entered wrong username or password ');
                </script>";
            }

        }
    }


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="admin__access">
    <h3><a href="Admin/admin_login.php">Admin</a></h3>
</div>

<section class="login">
    <div class="login__contaner">
        <form action="index.php" method="post">
            <h1 class="login__h1">Login / Sign-up</h1>
            <div class="login__item">
                <label for="username">Username:</label>
                <input class="login__input" type="text" name="username" id="username" placeholder="Enter your name" value="<?php echo htmlspecialchars($username) ?>">
                <div class="error"><?php echo $error['username'] ?></div>
            </div>
            <div class="login__item">
                <label for="password">Password :</label>
                <input class="login__input" type="password" name="password" id="password" placeholder="Enter your password">
                <div class="error"><?php echo $error['password'] ?></div>
            </div>

            <button class="login__button" type="submit" name="login">Login</button>
            <p class="login__p">Do not Have an Account? Register</p>
            <button class="login__button" type="submit" name="signup"><a href="User/signup.php">Register</a></button>
<!--            <p class="login__p"><a href="User/forget_password.php">Forget password?</a></p>-->
        </form>
    </div>
</section>
</body>
</html>
