<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

//session_start();

//$_SESSION['username'] = "";
//session_destroy();
$_COOKIE['username']="";

header('Location: http://localhost/explore_plus/index.php');

?>
