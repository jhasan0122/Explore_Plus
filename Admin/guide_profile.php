<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

session_start();
$user = $_SESSION['guide_username'];

//echo $user;

$sql = "SELECT * FROM guide WHERE username = '{$user}'";

$result = mysqli_query($conn,$sql);

$info = mysqli_fetch_assoc($result);

//mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Guide Profile</title>
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

<main class="main">
  <div class="profile__container">
    <div class="profile__back">
      <figure>
        <img src="../img/background-5.jpg" alt="background" height="1327" width="4711">
      </figure>
    </div>
    <div class="profile__pic">
      <figure>
        <img src="../img/userdp/IMG-20231216-WA0025.jpg" alt="dp" width="750" height="750">
      </figure>
    </div>

    <div class="profile__about">
      <div class="profile__info">
        <div class="profile__label"><h3>Username</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['username'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Name</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['name'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Email</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['email'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Date of Birth</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['date_of_birth'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>City</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['city'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Country</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['country'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Gender</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['gender'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Phone</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['phone'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>NID</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['NID'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Nationality</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['nationality'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Visa expire date</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['visa_expiry_date'])?></div>
      </div>
      <div class="profile__info">
        <div class="profile__label"><h3>Wage</h3></div>
        <div class="profile__data"><?php echo htmlspecialchars($info['wage']).'$'?></div>
      </div>
        <div class="profile__info">
            <?php

            $languageSql = "SELECT language 
                            FROM guide_speak gs
                            INNER JOIN guide g
                            ON gs.username = g.username
                            WHERE gs.username = '{$user}'";

            $languRes = mysqli_query($conn,$languageSql);
            $languages = mysqli_fetch_all($languRes,MYSQLI_ASSOC);

            ?>
            <div class="profile__label"><h3>Language</h3></div>
            <?php foreach ($languages as $lang): ?>
                <div class="profile__data"><?php echo $lang['language'] ?></div>
            <?php endforeach; ?>
        </div>
    </div>

  </div>



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
