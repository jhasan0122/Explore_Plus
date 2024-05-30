<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


    $id_for_delete = $_GET['hotel_id'];

    $sql = "DELETE FROM hotel WHERE hotel_id = '{$id_for_delete}'";

    if(mysqli_query($conn,$sql)){
        header("Location: http://localhost/explore_plus/Admin/hotel_info.php");
    }
    else{
        echo "Query error" . mysqli_error($conn);
    }


?>
