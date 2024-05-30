<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

session_start();
$guide_username = $_SESSION['guide_username'];

$sql = "SELECT t.tour_id , h.name,(t.capacity - t.available_seat) as booked_seat, h.price*(t.capacity - t.available_seat) as hote_budget
        FROM tour t
        INNER JOIN guide g 
         ON t.guide_username = g.username
         INNER JOIN hotel h
         ON t.hotel_id = h.hotel_id
        
         WHERE g.username = '{$guide_username}'
        ";


$result = mysqli_query($conn,$sql);

$tours = mysqli_fetch_all($result,MYSQLI_ASSOC);

mysqli_free_result($result);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guide Control Tour</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header class="header admin">
    <div class="header__logo">
        <figure>
            <img src="../img/logo3.png" alt="logo" title="logo" height="115" width="600">
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
            <li><a href="guide_profile.php">Guide Profile</a></li>
            <li><a href="guide_tour.php">Guide Tour</a></li>
            <li><a href="guide_restaurant.php">Restaurant</a></li>
            <!--            <li><a href="tour_condition.php">Tour</a></li>-->
        </ul>
        <ul class="header__ul header__admin">
            <li><a href="guide_hotel.php">Hotel</a></li>
            <li><a href="guide_transport.php">Transport</a></li>
            <!--            <li><a href="hotel_info.php">Hotel</a></li>-->
            <!--            <li><a href="restaurant_info.php">Restaurant</a></li>-->
        </ul>
    </nav>
    <div class="admin__logout"><a href="admin_login.php">Logout</a></div>
</header>

<main class="main main__table-container">
    <h1 class="center">Guide Control Hotel</h1>
    <table class="main__table transportation">
        <thead>
        <tr>
            <th id="tour-id" scope="col" class="table__head">Tour Id</th>
            <th id="hotel" scope="col" class="table__head">Hotel</th>
            <th id="hotel" scope="col" class="table__head">Booked Seat</th>
            <th id="restaurant" scope="col" class="table__head">Budget</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tours as $tour): ?>
            <tr>
                <td class="table__item"><?php echo $tour['tour_id']?></td>
                <td class="table__item"><?php echo $tour['name']?></td>
                <td class="table__item"><?php echo $tour['booked_seat']?></td>
                <td class="table__item"><?php echo $tour['hote_budget']?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</main>

<footer class="footer admin-foot">
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

