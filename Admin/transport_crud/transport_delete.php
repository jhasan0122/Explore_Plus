<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


$id_for_delete = $_GET['transport_id'];

$sql = "DELETE FROM transport WHERE transport_id = '{$id_for_delete}'";

if(mysqli_query($conn,$sql)){
    header("Location: http://localhost/explore_plus/Admin/transportation_info.php");
}
else{
    echo "Query error" . mysqli_error($conn);
}


?>
