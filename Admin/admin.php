<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Info</title>
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
<main class="main">
    <div class="admin__menu">
        <div class="admin__menu-list">
            <a href="restaurant_info.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/food.png" alt="restaurant" width="489" height="461">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>Restaurant</h4></div>
            </a>
        </div>
        <div class="admin__menu-list">
            <a href="transportation_info.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/transport.png" alt="transport" width="444" height="387">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>Transport</h4></div>
            </a>
        </div>
        <div class="admin__menu-list">
            <a href="tour_condition.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/tour.png" alt="transport" width="388" height="386">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>Tour</h4></div>
            </a>
        </div>
        <div class="admin__menu-list">
            <a href="guide.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/tour_guide.png" alt="transport" width="567" height="541">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>Tour Guide</h4></div>
            </a>
        </div>
        <div class="admin__menu-list">
            <a href="hotel_info.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/hotel.png" alt="transport" width="451" height="435">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>Hotel</h4></div>
            </a>
        </div>
        <div class="admin__menu-list">
            <a href="finance.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/finance.png" alt="transport" width="403" height="355">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>Finance</h4></div>
            </a>
        </div>
<!--        <div class="admin__menu-list">-->
<!--            <a href="customer_info.php">-->
<!--                <div class="admin_menu-fig">-->
<!--                    <figure>-->
<!--                        <img src="../img/admin-icon/customer.png" alt="transport" width="397" height="366">-->
<!--                    </figure>-->
<!--                </div>-->
<!--                <div class="admin__menu-item"><h4>Customer</h4></div>-->
<!--            </a>-->
<!--        </div>-->
        <div class="admin__menu-list">
            <a href="user_list.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/user.png" alt="transport" width="425" height="432">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>User</h4></div>
            </a>
        </div>
        <div class="admin__menu-list">
            <a href="transaction.php">
                <div class="admin_menu-fig">
                    <figure>
                        <img src="../img/admin-icon/transaction.png" alt="transport" width="357" height="366">
                    </figure>
                </div>
                <div class="admin__menu-item"><h4>Transaction</h4></div>
            </a>
        </div>
        <?php
        $conn = mysqli_connect("localhost","root","","explore_plus");

        if(!$conn){
            echo "Connection Error" . mysqli_connect_error() . '<br>';
        }

        $customerSql=mysqli_query($conn,"SELECT u.username,COUNT(e.enrolment_id)
                                            from userpro u
                                            INNER join enrollment e 
                                            on u.username = e.username
                                            WHERE e.status = 'approved'
                                            GROUP by u.username                        
                                            ORDER by COUNT(e.enrolment_id) DESC");
        $customers = mysqli_fetch_all($customerSql,MYSQLI_ASSOC);
        ?>
    </div>
    <table class="main__table transportation">
        <thead>
        <tr>
            <th id="tour-id" scope="col" class="table__head">Username</th>
            <th id="place" scope="col" class="table__head">No of Enrollment</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td class="table__item"><?php echo $customer['username']?></td>
                <td class="table__item"><?php echo $customer['COUNT(e.enrolment_id)']?></td>
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

</body>
</html>