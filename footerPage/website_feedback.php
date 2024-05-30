<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

if(isset($_GET['pull'])) {

    session_start();
    $username = $_SESSION['username'];

    $rating = $_GET['rate'];

    $comment = $_GET['comment'];

    if (mysqli_query($conn, "insert into website(username,rating,comment) 
                            VALUES ('{$username}','{$rating}','{$comment}')")) {
        header('Location: http://localhost/explore_plus/User/main.php');
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website Feedback</title>
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
        <form class="search__bar" action="">
            <input class="search__input" type="text" placeholder="Search anything" name="search">
            <button class="search__button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <nav class="header__nav">
        <ul class="header__ul">
            <li><a href="../User/main.php">Home</a></li>
            <li><a href="../User/tour.php">Tour</a></li>
            <li><a href="../footerPage/contact_us.html">Contact</a></li>
            <li><a href="../User/user_profile.php">User</a></li>
        </ul>
    </nav>
    <div class="logout"><a href="../User/logout.php">Logout</a></div>
</header>

<main class="main__feed">
    <form action="website_feedback.php" method="get" class="feed__div">
        <fieldset class="feed_field">
             <section class="rate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
            </section>
            <section class="feed__write">
                <textarea name="comment" id="comment" class="write__here" cols="25" rows="10" placeholder="Write your experience..."></textarea>
            </section>
            <button type="submit" name="pull" class="sub_pull">Submit</button>
        </fieldset>
    </form>

<div class="feedback">
    <?php

    $result = mysqli_query($conn,"select * from website");
    $allComment = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach ($allComment as $Comment):
    ?>
    <div class="feedLine bold"><?php echo $Comment['username'] ?></div>
    <div class="feedLine"><?php echo $Comment['comment'] ?></div>
    <?php endforeach; ?>

</div>


</main>


<footer class="footer">
    <div class="footer__contact">
        <h3 class="footer__h3">Contact us:</h3>
        <ul class="footer__ul">
            <li><a href="contact_us.html">Contact</a></li>
            <li><a href="customer.html">Customer</a></li>
            <li><a href="#">Website Feedback</a></li>
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
            <li><a href="about__us.html">About Explore.com</a></li>
            <li><a href="terms_condition.html">Terms &amp; Conditions</a></li>
            <li><a href="privacy_statement.html">Privacy Statement</a></li>
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