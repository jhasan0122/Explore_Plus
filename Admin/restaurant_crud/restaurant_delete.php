
<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


$id_for_delete = $_GET['menu_id'];

mysqli_query($conn,"DELETE from menu_breakfast where menu_id = '{$id_for_delete}'");
mysqli_query($conn,"DELETE from menu_lunch where menu_id = '{$id_for_delete}'");
mysqli_query($conn,"DELETE from menu_dinner where menu_id = '{$id_for_delete}'");

$sql = "DELETE from menu where menu_id = '{$id_for_delete}'";

if(mysqli_query($conn,$sql)){
    header("Location: http://localhost/explore_plus/Admin/restaurant_info.php");
}
else{
    echo "Query error" . mysqli_error($conn);
}


?>