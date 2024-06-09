
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guide Info</title>
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
            <li><a href="admin.php">Admin</a></li>
            <li><a href="transaction.php">Transaction</a></li>
            <li><a href="finance.php">Finance</a></li>
            <li><a href="guide.php">Guide</a></li>
            <li><a href="user_list.php">User</a></li>

        </ul>
        <ul class="header__ul header__admin">
            <li><a href="tour_condition.php">Tour</a></li>
            <li><a href="trip_crud/trip_adding.php">Trip Adding</a></li>
            <li><a href="transportation_info.php">Transport</a></li>
            <li><a href="hotel_info.php">Hotel</a></li>
            <li><a href="restaurant_info.php">Restaurant</a></li>
        </ul>
    </nav>
    <div class="admin__logout"><a href="admin_login.php">Logout</a></div>
</header>

<main class="main main__table-container">
    <h1 class="center">Guide Information</h1>
    <table class="main__table transportation">
        <thead>
        <tr>
            <th  scope="col" class="table__head">Username</th>
            <th  scope="col" class="table__head">Name</th>
            <th  scope="col" class="table__head">Email</th>
            <th  scope="col" class="table__head">Phone</th>
            <th scope="col" class="table__head">Nationality</th>
            <th  scope="col" class="table__head">Gender</th>
            <th scope="col" class="table__head">Visa exp</th>
            <th scope="col" class="table__head">Languages</th>
            <th scope="col" class="table__head">Wage</th>
<!--            <th  scope="col" class="table__head">Photo</th>-->
            <th  scope="col" class="table__head">Edit</th>
        </tr>
        </thead>
        <?php
        $conn = mysqli_connect("localhost","root","","explore_plus");

        if(!$conn){
            echo "Connection Error" . mysqli_connect_error() . '<br>';
        }
        $result = mysqli_query($conn,"SELECT * FROM guide g");

        $guides = mysqli_fetch_all($result,MYSQLI_ASSOC);


        ?>

        <tbody class="table__body">
        <?php foreach ($guides as $guide): ?>
            <tr>
                <td class="table__item"><?php echo htmlspecialchars($guide['username'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($guide['name'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($guide['email'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($guide['phone'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($guide['nationality'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($guide['gender'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($guide['visa_expiry_date'])?></td>
                <td class="table__item"><?php
                    $username = $guide['username'];
                    $languageSql = "SELECT language 
                                    FROM guide g 
                                    INNER JOIN guide_speak gs
                                    ON g.username = gs.username
                                    WHERE g.username = '{$username}'";
                    $languageRes = mysqli_query($conn,$languageSql);
                    $languages = mysqli_fetch_all($languageRes,MYSQLI_ASSOC);

                    foreach ($languages as $language ):
                        echo $language['language'] . '<br>';
                    endforeach;
                    ?></td>
                <td class="table__item"><?php echo htmlspecialchars($guide['wage'])?></td>
<!--                <td class="table__item">-->
<!--                    <div class="hotel__pic">-->
<!--                        <figure>-->
<!--                            <img src="../img/hotel/vojtech-bruzek-Yrxr3bsPdS0-unsplash.jpg" alt="hotel1" width="4608" height="3072">-->
<!--                        </figure>-->
<!--                    </div>-->
                </td>
                <td class="table__item edit_option">
                    <button type="submit" name="edit" class="table_edit"><a href="guide_edit.php?guide_username=<?php echo $guide['username']?>">Edit</a></button>
                </td>
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
