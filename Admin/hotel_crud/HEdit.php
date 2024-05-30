<?php
$conn = mysqli_connect("localhost","root","","explore_plus");


if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


$type = $name = $price = $availabe_room = 0;

if(isset($_GET['submit'])) {

    $hotelId = $_GET['hid'];
    $type = $_GET['type'];
    $name = $_GET['name'];
    $price = $_GET['price'];
    $availabe_room = $_GET['avai_room'];
    $place = $_GET['place'];


    $sql = "UPDATE hotel 
        SET type = '{$type}', name = '{$name}', price= '{$price}', available_room = '{$availabe_room}', place = '{$place}'
        WHERE hotel_id = '{$hotelId}'";

    if (mysqli_query($conn, $sql)) {
        header('Location: http://localhost/explore_plus/Admin/hotel_info.php');
    } else {
        echo "Query Error " . mysqli_error($conn);
    }
}
?>
