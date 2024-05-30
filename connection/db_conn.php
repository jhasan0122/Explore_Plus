<?php
    $conn = mysqli_connect("localhost","root","","explore_plus");

    if(!$conn){
        echo "Connection Error" . mysqli_connect_error() . '<br>';
    }




?>
