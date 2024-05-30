<?php

$conn = mysqli_connect("localhost","root","","explore_plus");


if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$guide = $_GET['guide_username'];

$money = $_GET['wage'];

if(isset($_GET['guide_submit'])){
    if(mysqli_query($conn,"update guide
                                 set wage = {$money}  
                                 where username = '{$guide}'")){
        header('Location: http://localhost/explore_plus/Admin/guide.php');
    }
}


?>
