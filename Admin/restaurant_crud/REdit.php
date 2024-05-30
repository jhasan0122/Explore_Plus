<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$menuId = $_GET['menu_id'];

$breakfast = $lunch = $dinner = "";

$error = array('breakfast' => '' , 'lunch' => '' , 'dinner'=>'');

if(isset($_GET['submit'])) {

    if (empty($_GET['breakfast'])) {
        $error['breakfast'] = "Breakfast is required";
    } else {
        $breakfast = $_GET['breakfast'];
    }

    if (empty($_GET['lunch'])) {
        $error['lunch'] = "Lunch is required";
    } else {
        $lunch = $_GET['lunch'];
    }

    if (empty($_GET['dinner'])) {
        $error['dinner'] = "Dinner is required";
    } else {
        $dinner = $_GET['dinner'];
    }

    if (array_filter($error)) {

    } else {
        echo $breakfast . $lunch . $dinner;
        $breakfast = mysqli_real_escape_string($conn, $_GET['breakfast']);
        $lunch = mysqli_real_escape_string($conn, $_GET['lunch']);
        $dinner = mysqli_real_escape_string($conn, $_GET['dinner']);




        // Insert into menu_breakfast
        mysqli_query($conn, "UPDATE menu_breakfast SET breakfast = '{$breakfast}' WHERE menu_id = '{$menuId}'");
        mysqli_query($conn, "UPDATE menu_lunch SET lunch = '{$lunch}' WHERE menu_id = '{$menuId}'");
        mysqli_query($conn, "UPDATE menu_dinner SET dinner = '{$dinner}' WHERE menu_id = '{$menuId}'");

        header('Location: http://localhost/explore_plus/Admin/restaurant_info.php');

    }
}
?>
