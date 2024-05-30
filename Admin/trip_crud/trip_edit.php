
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trip Edit</title>
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
    <?php

    $conn = mysqli_connect("localhost","root","","explore_plus");

    if(!$conn){
        echo "Connection Error" . mysqli_connect_error() . '<br>';
    }

    $tourId = $_GET['tour_id'];

    $sql = "SELECT * FROM tour WHERE tour_id = '{$tourId}'";
    $result = mysqli_query($conn,$sql);
    $tour = mysqli_fetch_assoc($result);


    ?>
    <form class="form__all spcecial__form" action="TPEdit.php" method="post">
        <h3 class="form__h3">Enter a tour:</h3>
        <fieldset class="form__fieldset">
            <p class="form__p p_spci">
                <label class="form__label" for="about">About:</label>
                <input  type="hidden" name="tid" value="<?php echo $tourId?>">
                <textarea class="form__textarea" name="about" id="about" cols="20" rows="7"><?php echo $tour['about'] ?></textarea>
            </p>
            <p class="form__p">
                <label class="form__label" for="place">Place:</label>
                <input class="form__input" type="text" name="place" id="place" value="<?php echo $tour['place_name'] ?>" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="city">City:</label>
                <input class="form__input" type="text" name="city" id="city"  value="<?php echo $tour['city'] ?>" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="country">Country</label>
                <input class="form__input" type="text" name="country" id="country"  value="<?php echo $tour['country'] ?>" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="continent">Continent</label>
                <input class="form__input" type="text" name="continent" id="continent"  value="<?php echo $tour['continent'] ?>" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="budget">Budget</label>
                <input class="form__input" type="text" name="budget" id="budget"  value="<?php echo $tour['budget'] ?>" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="capacity">Capacity</label>
                <input class="form__input" type="text" name="capacity" id="capacity"  value="<?php echo $tour['available_seat'] ?>" required autofocus>
            </p>
            <div class="form__checkboxList">
                <?php

                $sqlTrans = mysqli_query($conn,"SELECT * FROM transport");
                $transports = mysqli_fetch_all($sqlTrans,MYSQLI_ASSOC);

                $myTransportSql = " SELECT transport_id
                                    FROM tour tr
                                    INNER JOIN transport t
                                    ON tr.tour_id = t.tour_id
                                    WHERE tr.tour_id = '{$tourId}'";
                $myTrResult = mysqli_query($conn,$myTransportSql);
                $myTransport = mysqli_fetch_all($myTrResult,MYSQLI_ASSOC);
                ?>

                <label class="form__label form__txt">Transport</label>

                <?php foreach ($transports as $transport):
                    $select = '';
                    foreach ($myTransport as $myTran):
                        if($myTran['transport_id']==$transport['transport_id']){
                            $select = "checked";
                            break;
                        }
                        else{
                            $select = "";
                        }
                    endforeach;

                    ?>
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
                        <label for="transport"><?php echo $transport['transport_id'] . ". " . $transport['type'] . " - (" . $transport['from_place'] ." - " .  $transport['to_place'] . ")".  $available  ?></label>
                        <input type="checkbox" name="transport[]" value="<?php echo $transport['transport_id'] ?>" <?php echo $select ?>>
                    </p>

                <?php endforeach; ?>

            </div>

            <p class="form__p p_option">
                <?php
                $sqlhotel = mysqli_query($conn,"SELECT * FROM hotel");
                $hotels = mysqli_fetch_all($sqlhotel,MYSQLI_ASSOC);

                ?>
                <label class="form__label form__txt">Hotel</label>>
                <select class="form__select" name="hotel">
                    <?php foreach ($hotels as $hotel):
                        if($hotel['hotel_id']==$tour['hotel_id']){
                            $select = 'selected';
                        }
                        else{
                            $select = '';
                        }
                        ?>
                        <option <?php echo $select ?> value="<?php echo $hotel['hotel_id'] ?>"><?php echo  $hotel['hotel_id'] . ". " .  $hotel['name'] . " - " . $hotel['place'] . " - [" . $hotel['available_room'] . "]" ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p class="form__p p_option">
                <?php

                $sqlRestaurant = "select menu.menu_id , breakfast_item.breakfast , lunch_item.lunch , dinner_item.dinner
                            from menu
                            inner join menu_breakfast mb
                            on menu.menu_id = mb.menu_id

                            inner join breakfast_item
                            on mb.breakfast = breakfast_item.breakfast

                            inner join menu_lunch
                            on menu.menu_id = menu_lunch.menu_id

                            inner join lunch_item
                            on menu_lunch.lunch = lunch_item.lunch

                            inner join menu_dinner
                            on menu.menu_id = menu_dinner.menu_id

                            inner join dinner_item
                            on menu_dinner.dinner = dinner_item.dinner
                            ORDER BY menu.menu_id ASC;
                            ";
                //                $sqlRestaurant = "SELECT * FROM menu";
                $restaurantResult = mysqli_query($conn,$sqlRestaurant);
                $restaurants = mysqli_fetch_all($restaurantResult,MYSQLI_ASSOC);

                ?>
                <label class="form__label form__txt">Menu-item</label>
                <select class="form__select" name="restaurant">
                    <?php foreach ($restaurants as $restaurant):
                        if($restaurant['menu_id'] == $tour['menu_id']){
                            $select = 'selected';
                        }else{
                            $select = "";
                        } ?>
                        <option <?php echo $select ?> value="<?php echo $restaurant['menu_id'] ?>"><?php echo  $restaurant['menu_id'] . ". " . $restaurant['breakfast'] ." - ". $restaurant['lunch'] ." - ". $restaurant['dinner']?></option>
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
                    <?php foreach ($guides as $guide):
                        if($guide['username'] == $tour['guide_username']){
                            $select = 'selected';
                        }else{
                            $select = "";
                        }?>
                        <option <?php echo $select ?> value="<?php echo $guide['username'] ?>"><?php echo $guide['username'] . " - " . $guide['nationality'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p class="form__p">
                <label for="from" class="form__label">Start Date-Time</label>
                <input type="datetime-local" class="form__input" name="from" id="from" value="<?php echo $tour['start_date'] ?>" <?php echo $tour['tour_id'] ?> required>

            </p>
            <p class="form__p">
                <label for="to" class="form__label">Finish Date-Time</label>
                <input type="datetime-local" class="form__input" name="to" id="to" value="<?php echo $tour['finish_date'] ?>" required>
            </p>
            <p class="form__p">
                <label class="form__label" >Map:</label>
                <input class="form__input" type="url" name="map" id="map" value="<?php echo $tour['map'] ?>">
            </p>
            <p class="form__p">
                <label class="form__label" >Photo:</label>
                <input class="form__input file_up" type="file" name="pic" id="pic" value="<?php echo $tour['photo'] ?>" >
            </p>
            <p class="form__p  p_spci">
                <label class="form__label" for="faq">FAQ &nbsp;&nbsp;&nbsp;&nbsp;</label>
                <textarea class="form__textarea" name="faq" id="faq" cols="10" rows="3"><?php echo $tour['FAQ'] ?></textarea>
            </p>
            <!--            <p class="form__p">-->
            <!--                <button class="form__btn" type="submit">Submit</button>-->
            <!--            </p>-->
        </fieldset>
        <div class="crud__div">
            <button class="crud__btn" type="submit" name="edit_trip">Submit</button>
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