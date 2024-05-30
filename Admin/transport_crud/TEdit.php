<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


$transportId =  $type = $from = $to = $price = $start_date = $start_time = $finish_date = $finish_time = $class = $capacity = "";


if(isset($_POST['editDone'])){
    $transportId= $_POST['transport_id'];
    $type = $_POST['type'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $price = $_POST['price'];
    $start_date = $_POST['start_date'];
    $start_date = $_POST['start_time'];
    $finish_date = $_POST['finish_date'];
    $finish_time = $_POST['finish_time'];
    $class = $_POST['class'];
    $capacity = $_POST['capacity'];

    $sql = "UPDATE transport
            SET type = '{$type}',from_place = '{$from}',to_place = '{$to}',price = '{$price}',start_date = '{$start_date}',finish_date = '{$finish_date}',start_time = '{$start_time}',finish_time = '{$finish_time}',class = '{$class}',capacity = '{$capacity}'
            WHERE transport_id = '{$transportId}'";
    if(mysqli_query($conn,$sql)){
        header("Location: http://localhost/explore_plus/Admin/transportation_info.php");
    }
    else{
        echo "Query error" . mysqli_error($conn);
    }


}



?>
