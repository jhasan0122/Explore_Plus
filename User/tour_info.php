<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$tour_id = $_GET['tour_id'];

$sql = "SELECT * FROM tour WHERE tour_id = {$tour_id}";

$result = mysqli_query($conn,$sql);

$tour = mysqli_fetch_assoc($result);

mysqli_free_result($result);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour Info</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<header class="header">
    <div class="header__logo">
        <figure>
            <img src="../img/logo2.png" alt="logo" title="logo" height="115" width="603">
        </figure>
    </div>
    <div class="header_search">
        <form class="search__bar" action="tour.php" method="get">
            <input class="search__input"  type="text" placeholder="Search anything" name="search">
            <button class="search__button" name="searchSubmit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <nav class="header__nav">
        <ul class="header__ul">
            <li><a href="main.php">Home</a></li>
            <li><a href="tour.php">Tour</a></li>
            <li><a href="../footerPage/contact_us.html">Contact</a></li>
            <li><a href="user_profile.php">User</a></li>
        </ul>
    </nav>
    <div class="logout"><a href="logout.php">Logout</a></div>
</header>

<main class="main">
    <div class="tour-info__container">
        <div class="tour-info__inner">
            <div class="tour-info__pic">
                <figure>
                    <img src="../img/tours/<?php echo htmlspecialchars($tour['photo']) ?>" alt="card1" height="900" width="1200">
                </figure>
            </div>
            <div class="tour-info__place">
                <h2 class="tour-info__h2"><?php echo htmlspecialchars($tour['place_name']) . ' , ' . htmlspecialchars($tour['country'])?></h2>
                <p class="tour-info__p"></p>
            </div>

            <h2 class="tour-info__about-h2" >About this place</h2>
            <div class="tour-info__about">
               <?php echo htmlspecialchars($tour['about'])?>
            </div>

            <div class="tour-info__element-collection">
                <div class="tour-info__element">
                    <i class="fa-solid fa-globe"></i>
                    <h4>Country:</h4>
                    <div class="tour-info__country"><?php echo htmlspecialchars($tour['country']) ?></div>
                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-mountain-city"></i>
                    <h4>City:</h4>
                    <div class="tour-info__city"><?php echo htmlspecialchars($tour['city']) ?></div>
                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-dollar-sign"></i>
                    <h4>Budget:</h4>
                    <div class="tour-info__budget">$ <?php echo htmlspecialchars($tour['budget']) ?></div>
                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-couch"></i>
                    <h4>Available Seat:</h4>
                    <div class="tour-info__available-seat"><?php echo htmlspecialchars($tour['available_seat']) ?></div>
                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-bus"></i>
                    <h4>Transports:</h4>
                    <ul class="transport__ul">

                        <?php

                        $transportSql = "SELECT transport.type , transport.from_place , transport.to_place , transport.class
                                        from tour 
                                        inner join transport 
                                        on tour.tour_id = transport.tour_id
                                        where tour.tour_id = {$tour_id}";
                        $transportResult = mysqli_query($conn,$transportSql);
                        $transports = mysqli_fetch_all($transportResult,MYSQLI_ASSOC);

                        ?>

                        <?php foreach ($transports as $transport): ?>
                        <li>
                            <h4 class="transport__head"><?php echo $transport['type'] ?></h4>
                            <div class="tour-info__fromTo">
                                <span class="tour-info__name">From:</span>
                                <span class="tour-info__data"><?php echo htmlspecialchars($transport['from_place']) ?></span>
                            </div>
                            <div class="tour-info__fromTo">
                                <span class="tour-info__name">To:</span>
                                <span class="tour-info__data"><?php echo htmlspecialchars($transport['to_place']) ?></span>
                            </div>
                            <div class="tour-info__fromTo">
                                <span class="tour-info__name">Class:</span>
                                <span class="tour-info__data"><?php echo htmlspecialchars($transport['class']) ?></span>
                            </div>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <div class="tour-info__element">
                    <?php
                        $dayDurationSql = "SELECT DATEDIFF(finish_date,start_date)   FROM tour WHERE tour_id = {$tour_id}";
                        $dayDurationResult = mysqli_query($conn,$dayDurationSql);
                        $dayDuration = mysqli_fetch_assoc($dayDurationResult);
                    ?>


                    <i class="fa-regular fa-calendar-days"></i>
                    <h4>Tour Duration:</h4>
                    <?php foreach ($dayDuration as $day): ?>
                    <div class="tour-info__tour-duration"><?php echo $day ?> days</div>
                    <?php endforeach; ?>
                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-bed"></i>
                    <?php

                    $hotelSql = "SELECT hotel.name,hotel.type
                                FROM tour 
                                INNER join hotel  
                                on tour.hotel_id = hotel.hotel_id
                                WHERE tour.tour_id = {$tour_id}";
                    $hotelResult = mysqli_query($conn,$hotelSql);

                    $hotel = mysqli_fetch_assoc($hotelResult);

                    ?>

                    <h4>Hotel:</h4>
                    <div class="hotel_duo">
                        <div class="tour-info__hotel">
                            <span class="hotel__head">Hotel Name:</span>
                            <span class="hotel__information"><?php echo $hotel['name'] ?></span>
                        </div>
                        <div class="tour-info__hotel">
                            <span class="hotel__head">Type:</span>
                            <span class="hotel__information"><?php echo $hotel['type'] ?></span>
                        </div>
                    </div>


                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <div class="tour-info__hotel-location">
                        <div class="tour-info__hotel-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7303.601946231943!2d90.41696320056211!3d23.754475732684583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9f7f1391ff3%3A0x131528f2c22e4974!2sArman%20Travels%20International!5e0!3m2!1sen!2sbd!4v1707619220563!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-utensils"></i>
                    <h4>Menu-Items:</h4>
                    <div class="tour-info__menu-item">
                        <ul class="menu-item__ul">
                            <?php

                            $menuSql = "select breakfast_item.breakfast, lunch_item.lunch , dinner_item.dinner
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
                                        
                                        inner join tour 
                                        on tour.menu_id = menu.menu_id
                                        
                                        where tour.tour_id = {$tour_id} ";

                            $menuResult = mysqli_query($conn,$menuSql);

                            $menus = mysqli_fetch_all($menuResult,MYSQLI_ASSOC);

                            ?>


                            <?php foreach ($menus as $menu): ?>
                            <li>
                                <div class="tour-info__fromTo">
                                    <span class="tour-info__name">Breakfast:</span>
                                    <span class="tour-info__data"><?php echo $menu['breakfast'] ?></span>
                                </div>
                                <div class="tour-info__fromTo">
                                    <span class="tour-info__name">lunch:</span>
                                    <span class="tour-info__data"><?php echo $menu['lunch'] ?></span>
                                </div>
                                <div class="tour-info__fromTo">
                                    <span class="tour-info__name">Dinner:</span>
                                    <span class="tour-info__data"><?php echo $menu['dinner']?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="tour-info__element tour-pairs">
                    <div class="tour-pair">
                        <i class="fa-solid fa-plane-departure"></i>
                        <h4>Start Date:</h4>
                        <div class="tour-info__start"><?php echo htmlspecialchars($tour['start_date']) ?></div>
                    </div>
                    <div class="tour-pair">
                        <i class="fa-solid fa-plane-arrival"></i>
                        <h4>End Date:</h4>
                        <div class="tour-info__end"><?php echo htmlspecialchars($tour['finish_date']) ?></div>
                    </div>

                </div>
                <div class="tour-info__element">
                    <i class="fa-solid fa-question"></i>
                    <h4>FAQ:</h4>
                    <div class="tour-info__query"><?php echo htmlspecialchars($tour['FAQ']) ?></div>
                </div>
                <nav class="main__tour">
                    <a href="booking.php?tour_id=<?php echo $tour_id ?>"><span class="main__sp book">Book Now</span></a>
                </nav>
            </div>
        </div>
    </div>



</main>

<footer class="footer">
    <div class="footer__contact">
        <h3 class="footer__h3">Contact us:</h3>
        <ul class="footer__ul">
            <li><a href="../footerPage/contact_us.html">Contact</a></li>
            <li><a href="../footerPage/customer.html">Customer</a></li>
            <li><a href="../footerPage/website_feedback.php">Website Feedback</a></li>
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
            <li><a href="../footerPage/about__us.html">About Explore.com</a></li>
            <li><a href="../footerPage/terms_condition.html">Terms &amp; Conditions</a></li>
            <li><a href="../footerPage/privacy_statement.html">Privacy Statement</a></li>
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
