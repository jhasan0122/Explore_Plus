<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$tourId = $_POST['tid'];

$about = $place = $city = $country = $continent = $budget = $capacity = $Transport = $Hotel = $Menu = $Guide = $startDateTime = $finishDateTime = $map = $faq = $pic = "";

$error = array('about' => '', 'place' => '', 'city' => '', 'country' => '','continent' => '', 'budget' => '', 'capacity' => '', 'transport' => '', 'hotel' => '', 'menu' => '', 'guide' => '', 'startDateTime' => '', 'finishDateTime' => '', 'map' => '', 'faq' => '');

if(isset($_POST['edit_trip'])){
    $about = $_POST['about'];
    $place = $_POST['place'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $continent = $_POST['continent'];
    $budget = $_POST['budget'];
    $capacity = $_POST['capacity'];
   if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
       if(isset($_POST['transport'])) {
           $Transports = $_POST['transport'];
       }
    }
    $Menu = $_POST['restaurant'];
    $Guide = $_POST['guide'];
    $Hotel = $_POST['hotel'];
    $map = $_POST['map'];
    $faq = $_POST['faq'];
    $startDateTime = $_POST['from'];
    $finishDateTime = $_POST['to'];
    $pic = $_POST['pic'];

    $sql = "UPDATE tour 
            SET about = '{$about}',place_name = '{$place}',country = '{$country}',continent = '{$continent}',city = '{$city}',budget='{$budget}',available_seat= '{$capacity}',start_date = '{$startDateTime}',finish_date = '{$finishDateTime}',map='{$map}',FAQ='{$faq}',menu_id = '{$Menu}',hotel_id='{$Hotel}',guide_username = '{$Guide}',photo='{$pic}' 
             WHERE tour.tour_id = '{$tourId}'";

    if(mysqli_query($conn,$sql)){
        if(mysqli_query($conn,"UPDATE transport 
                                        SET tour_id = NULL
                                        WHERE tour_id = '{$tourId}'")){
            foreach ($Transports as $oneTransport){
                if(mysqli_query($conn,"UPDATE transport
                                            SET tour_id = '{$tourId}'
                                            WHERE transport_id = '{$oneTransport}'")){
                    header('Location: http://localhost/explore_plus/Admin/tour_condition.php');
                }
                else{
                    echo "The Transport is already taken" . mysqli_error($conn);
                }
            }
        }
        else{
            echo "The Transport is already taken" . mysqli_error($conn);
        }

    }
    else{
        echo mysqli_error($conn);
    }


}

?>
