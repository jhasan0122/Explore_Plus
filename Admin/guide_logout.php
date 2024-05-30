<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

session_start();
$_SESSION['guide_username'] = "";
//$_COOKIE['guide_username'] = "";
session_destroy();

header('Location: http://localhost/explore_plus/Admin/admin_login.php');

?>