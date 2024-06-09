<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$about = $place = $city = $country = $continent = $budget = $capacity = $Transport = $Hotel = $Menu = $Guide = $startDateTime = $finishDateTime = $map = $faq = $pic = "";

$error = array('about' => '', 'place' => '', 'city' => '', 'country' => '', 'continent' => '', 'budget' => '', 'capacity' => '', 'transport' => '', 'hotel' => '', 'menu' => '', 'guide' => '', 'startDateTime' => '', 'finishDateTime' => '', 'map' => '', 'faq' => '');

if(isset($_POST['add_trip'])){
    if(empty($_POST['about'])){
        $error['about'] = "About is required";
    }
    else{
        $about = $_POST['about'];
    }

    if(empty($_POST['place'])){
        $error['place'] = "Place is required";
    }
    else{
        $place= $_POST['place'];
    }

    if(empty($_POST['city'])){
        $error['city'] = "City is required";
    }
    else{
        $city = $_POST['city'];
    }

    if(empty($_POST['country'])){
        $error['country'] = "Country is required";
    }
    else{
        $country = $_POST['country'];
    }

    if(empty($_POST['continent'])){
        $error['continent'] = "continent is required";
    }
    else{
        $continent = $_POST['continent'];
    }


    if(empty($_POST['budget'])){
        $error['budget'] = "Budget is required";
    }
    else{
        $budget = $_POST['budget'];
    }
    if(empty($_POST['capacity'])){
        $error['capacity'] = "Capacity is required";
    }
    else{
        $capacity = $_POST['capacity'];
    }

//    if(empty($_POST['transport'])){
//        $error['transport'] = "Transport is required";
//    }
//    else{
//        $Transport= $_POST['transport'];
//    }
    if(isset($_POST['transport'])){
        $Transport = $_POST['transport'];
    }

    if(empty($_POST['hotel'])){
        $error['hotel'] = "Hotel is required";
    }
    else{
        $Hotel = $_POST['hotel'];
    }

    if(empty($_POST['restaurant'])){
        $error['restaurant'] = "Menu is required";
    }
    else{
        $Menu = $_POST['restaurant'];
    }

    if(empty($_POST['guide'])){
        $error['guide'] = "Guide is required";
    }
    else{
        $Guide = $_POST['guide'];
    }

    if(empty($_POST['from'])){
        $error['startDateTime'] = "Start Date-Time is required";
    }
    else{
        $startDateTime = $_POST['from'];
//        $Sdate = DateTime::createFromFormat('Y-m-d H:i:s', $startDateTime);
//        $Sdate_only = $Sdate->format('Y-m-d');
//        $Stime_only = date("H:i:s", strtotime($startDateTime));
    }

    if(empty($_POST['to'])){
        $error['finishDateTime'] = "Finish Date-Time is required";
    }
    else{
        $finishDateTime = $_POST['to'];
//        $Fdate = DateTime::createFromFormat('Y-m-d H:i:s', $finishDateTime);
//        $Fdate_only = $Fdate->format('Y-m-d');
//        $Ftime_only = date("H:i:s", strtotime($finishDateTime));
    }

    if(empty($_POST['map'])){
        $error['map'] = "Map is required";
    }
    else{
        $map = $_POST['map'];
    }

    if(empty($_POST['faq'])){
        $error['faq'] = "FAQ is required";
    }
    else{
        $faq = $_POST['faq'];
    }

    if(array_filter($error)){
        echo "ROOROROROOROR";
    }
    else{
        $about = mysqli_real_escape_string($conn,$_POST['about']);
        $place = mysqli_real_escape_string($conn,$_POST['place']);
        $city = mysqli_real_escape_string($conn,$_POST['city']);
        $country = mysqli_real_escape_string($conn,$_POST['country']);
        $continent = mysqli_real_escape_string($conn,$_POST['continent']);
        $budget = mysqli_real_escape_string($conn,$_POST['budget']);
        $capacity = mysqli_real_escape_string($conn,$_POST['capacity']);
//        $Transport = mysqli_real_escape_string($conn,$_POST['transport']);
        $Menu = mysqli_real_escape_string($conn,$_POST['restaurant']);
        $Guide = mysqli_real_escape_string($conn,$_POST['guide']);
        $map = mysqli_real_escape_string($conn,$_POST['map']);
        $faq = mysqli_real_escape_string($conn,$_POST['faq']);
        $startDateTime = mysqli_real_escape_string($conn,$_POST['from']);
        $finishDateTime = mysqli_real_escape_string($conn,$_POST['to']);
        $pic = mysqli_real_escape_string($conn,$_POST['pic']);

        mysqli_query($conn, "START TRANSACTION");


        $sql = "INSERT INTO tour (about,place_name,country,continent,city,budget,capacity,available_seat,start_date,finish_date,map,FAQ,menu_id,hotel_id,guide_username,photo) 
                VALUES ('{$about}','{$place}','{$country}','{$continent}','{$city}','{$budget}','{$capacity}','{$capacity}','{$startDateTime}','{$finishDateTime}','{$map}','{$faq}','{$Menu}','{$Hotel}','{$Guide}','{$pic}')";


        if(mysqli_query($conn,$sql)){
            $result = mysqli_query($conn, "SELECT LAST_INSERT_ID()");
            $row = mysqli_fetch_assoc($result);
            $Id = $row['LAST_INSERT_ID()'];

            foreach ($Transport as $oneTransport){
                if(mysqli_query($conn,"UPDATE transport
                                            SET tour_id = '{$Id}' 
                                            WHERE transport_id = '{$oneTransport}'")){
                    mysqli_query($conn,"COMMIT");
                    header('Location: http://localhost/explore_plus/Admin/tour_condition.php');
                }
                else{
                    echo "The Transport is already taken" . mysqli_error($conn);
                }
            }
//
        }
        else{
            echo "MYSQL ERROR " . mysqli_error($conn);
        }
    }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip Adding</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<header class="header admin">
    <div class="header__logo">
        <figure>
            <img src="../../img/logo3.png" alt="logo" title="logo" height="115" width="600">
        </figure>
    </div>
<!--    <div class="header_search">-->
<!--        <form class="search__bar" action="">-->
<!--            <input class="search__input" type="text" placeholder="Search anything" name="search">-->
<!--            <button class="search__button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>-->
<!--        </form>-->
<!--    </div>-->
    <nav class="header__nav nav__admin">
        <ul class="header__ul header__admin">
            <li><a href="../admin.php">Admin</a></li>
            <li><a href="../transaction.php">Transaction</a></li>
            <li><a href="../finance.php">Finance</a></li>
            <li><a href="../guide.php">Guide</a></li>
            <li><a href="../user_list.php">User</a></li>

        </ul>
        <ul class="header__ul header__admin">
            <li><a href="../tour_condition.php">Tour</a></li>
            <li><a href="../trip_crud/trip_adding.php">Trip Adding</a></li>
            <li><a href="../transportation_info.php">Transport</a></li>
            <li><a href="../hotel_info.php">Hotel</a></li>
            <li><a href="../restaurant_info.php">Restaurant</a></li>
        </ul>
    </nav>
    <div class="admin__logout"><a href="../admin_login.php">Logout</a></div>
</header>


<main class="main__form">
    <form class="form__all spcecial__form" action="trip_adding.php" method="post">
        <h3 class="form__h3">Enter a tour:</h3>
        <fieldset class="form__fieldset">
            <p class="form__p p_spci">
                <label class="form__label" for="about">About:</label>
                <input  type="hidden"  required autofocus>
                <textarea class="form__textarea" name="about" id="about" cols="20" rows="7"></textarea>
            </p>
            <p class="form__p">
                <label class="form__label" for="place">Place:</label>
                <input class="form__input" type="text" name="place" id="place"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="city">City:</label>
                <input class="form__input" type="text" name="city" id="city"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="country">Country</label>
                <input class="form__input" type="text" name="country" id="country"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="continent">Continent</label>
                <input class="form__input" type="text" name="continent" id="continent"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="budget">Budget</label>
                <input class="form__input" type="text" name="budget" id="budget"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="capacity">Capacity</label>
                <input class="form__input" type="text" name="capacity" id="capacity"  required autofocus>
            </p>
            <div class="form__checkboxList">
                <?php
                $sqlTrans = mysqli_query($conn,"SELECT * FROM transport");
                $transports = mysqli_fetch_all($sqlTrans,MYSQLI_ASSOC);

                ?>

                <label class="form__label form__txt">Transport</label>

                    <?php foreach ($transports as $transport): ?>
                        <p class="checkBoxItem">
                            <?php
                            $available = "";
                            if($transport['tour_id'] === null) {
                                $available = " (Free) ";
                            }
                            else{
                                $available = " (" . $transport['tour_id'] .")";
                            }
                            ?>
                            <label for="transport"><?php echo $transport['transport_id'] . ". " . $transport['type'] . " - (" . $transport['from_place'] ." - " .  $transport['to_place'] . ")" .  $available  ?></label>
                            <input type="checkbox" name="transport[]" value="<?php echo $transport['transport_id'] ?>">
                        </p>

                    <?php endforeach; ?>

            </div>

            <p class="form__p p_option">
                <?php
                $sqlhotel = mysqli_query($conn,"SELECT * FROM hotel");
                $hotels = mysqli_fetch_all($sqlhotel,MYSQLI_ASSOC);

                ?>
                <label class="form__label form__txt">Hotel</label>
                <select class="form__select" name="hotel">
                    <?php foreach ($hotels as $hotel): ?>
                        <option value="<?php echo $hotel['hotel_id'] ?>"><?php echo  $hotel['hotel_id'] . ". " .  $hotel['name'] . " - " . $hotel['place'] . " - [" . $hotel['available_room'] . "]" ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p class="form__p p_option">
                <?php

                $sqlRestaurant = "select menu.menu_id as menu_id , breakfast_item.breakfast , lunch_item.lunch , dinner_item.dinner
                            from menu
                            left join menu_breakfast mb
                            on menu.menu_id = mb.menu_id

                            left join breakfast_item
                            on mb.breakfast = breakfast_item.breakfast

                            left join menu_lunch
                            on menu.menu_id = menu_lunch.menu_id

                            inner join lunch_item
                            on menu_lunch.lunch = lunch_item.lunch

                            inner join menu_dinner
                            on menu.menu_id = menu_dinner.menu_id

                            inner join dinner_item
                            on menu_dinner.dinner = dinner_item.dinner
                            group BY menu.menu_id ASC;
                            ";
//                $sqlRestaurant = "SELECT * FROM menu";
                $restaurantResult = mysqli_query($conn,$sqlRestaurant);
                $restaurants = mysqli_fetch_all($restaurantResult,MYSQLI_ASSOC);

                ?>
                <label class="form__label form__txt">Menu-item</label>
                <select class="form__select" name="restaurant">
                    <?php foreach ($restaurants as $restaurant): ?>
                        <option value="<?php echo $restaurant['menu_id'] ?>"><?php echo  $restaurant['menu_id'] . ". " . $restaurant['breakfast'] ." - ". $restaurant['lunch'] ." - ". $restaurant['dinner']?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p class="form__p">
                <?php
                $guideSql = mysqli_query($conn,"SELECT * FROM guide");
                $guides = mysqli_fetch_all($guideSql,MYSQLI_ASSOC);
                ?>
                <label class="form__label" for="guide">Guide Name</label>
                <select class="form__select" name="guide">
                    <?php foreach ($guides as $guide): ?>
                    <option value="<?php echo $guide['username'] ?>"><?php echo $guide['username'] . " - " . $guide['nationality'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p class="form__p">
                <label for="from" class="form__label">Start Date-Time</label>
                <input type="datetime-local" class="form__input" name="from" id="from" required>

            </p>
            <p class="form__p">
                <label for="to" class="form__label">Finish Date-Time</label>
                <input type="datetime-local" class="form__input" name="to" id="to" required>
            </p>
            <p class="form__p">
                <label class="form__label" >Map:</label>
                <input class="form__input" type="url" name="map" id="map" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" >Photo:</label>
                <input class="form__input file_up" type="file" name="pic" id="pic" >
            </p>
            <p class="form__p  p_spci">
                <label class="form__label" for="faq">FAQ &nbsp;&nbsp;&nbsp;&nbsp;</label>
                <textarea class="form__textarea" name="faq" id="faq" cols="10" rows="3"></textarea>
            </p>
<!--            <p class="form__p">-->
<!--                <button class="form__btn" type="submit">Submit</button>-->
<!--            </p>-->
        </fieldset>
        <div class="crud__div">
            <button class="crud__btn" type="submit" name="add_trip">Submit</button>
            <button class="crud__btn diff2" type="reset">Reset</button>
        </div>

    </form>
</main>
<footer class="footer admin-foot">
    <div class="footer__contact">
        <h3 class="footer__h3">Contact us:</h3>
        <ul class="footer__ul">
            <li><a href="../../footerPage/contact_us.html">Contact</a></li>
            <li><a href="../../footerPage/customer.html">Customer</a></li>
            <li><a href="../../footerPage/website_feedback.php">Website Feedback</a></li>
        </ul>
        <div class="footer__icons">
            <i class="fa-brands fa-square-facebook"></i>
            <i class="fa-brands fa-square-instagram"></i>
            <i class="fa-brands fa-square-twitter"></i>
            <i class="fa-brands fa-square-youtube"></i>
        </div>
    </div>
    <div class="footer__about">
        <h3 class="footer__h3">About us:</h3>
        <ul class="footer__ul">
            <li><a href="../../footerPage/about__us.html">About Explore.com</a></li>
            <li><a href="../../footerPage/terms_condition.html">Terms &amp; Conditions</a></li>
            <li><a href="../../footerPage/privacy_statement.html">Privacy Statement</a></li>
        </ul>
        <h4 class="footer__h3">Payment Method</h4>
        <div class="footer__icons">
            <i class="fa-brands fa-cc-mastercard"></i>
            <i class="fa-brands fa-cc-paypal"></i>
            <i class="fa-brands fa-cc-amazon-pay"></i>
            <i class="fa-brands fa-apple-pay"></i>
            <i class="fa-brands fa-google-pay"></i>
        </div>
    </div>
</footer>

</body>
</html>