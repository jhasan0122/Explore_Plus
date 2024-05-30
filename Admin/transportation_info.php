<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$sql = "SELECT * from transport";

$result = mysqli_query($conn,$sql);

$transports = mysqli_fetch_all($result,MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transportation Info</title>
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
    <h1 class="center">Transport Information</h1>
    <table class="main__table transportation">
        <thead>
            <tr>
                <th id="transport-id" scope="col" class="table__head">ID</th>
                <th id="type" scope="col" class="table__head">Type</th>
                <th id="from" scope="col" class="table__head">From</th>
                <th id="to" scope="col" class="table__head">To</th>
                <th id="price" scope="col" class="table__head">Price</th>
                <th id="start-date" scope="col" class="table__head">Staring Date</th>
                <th id="start-time" scope="col" class="table__head">Starting Time</th>
                <th id="finish-date" scope="col" class="table__head">Finishing Date</th>
                <th id="finish-time" scope="col" class="table__head">Finishing Time</th>
                <th id="class" scope="col" class="table__head">Class</th>
                <th id="capacity" scope="col" class="table__head">Capacity</th>
                <th id="edit" scope="col" class="table__head">Edit</th>
            </tr>
        </thead>
        <tbody class="table__body">
        <?php foreach ($transports as $transport): ?>
            <tr>
                <td class="table__item"><?php echo htmlspecialchars($transport['transport_id'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($transport['type'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($transport['from_place'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($transport['to_place'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($transport['price'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($transport['start_date'])?> </td>
                <td class="table__item"><?php echo htmlspecialchars($transport['start_time'])?> </td>
                <td class="table__item"><?php echo htmlspecialchars($transport['finish_date'])?> </td>
                <td class="table__item"><?php echo htmlspecialchars($transport['finish_time'])?> </td>
                <td class="table__item"><?php echo htmlspecialchars($transport['class'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($transport['capacity'])?></td>
                <td class="table__item edit_option">
                    <button type="submit" class="table_edit"><a href="transport_crud/transport_edit.php?transport_id=<?php echo $transport['transport_id'] ?>">Edit</a></button>
                    <button type="submit" class="table_edit diff"><a href="transport_crud/transport_delete.php?transport_id=<?php echo $transport['transport_id'] ?>">Delete</a></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="12" class="table__footer">
                    <button type="submit" class="add_option" ><a href="transport_crud/transport_add.php">Add Transportation</a></button>
                </td>
            </tr>
        </tfoot>
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
