<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$sql = "SELECT * from hotel";

$result = mysqli_query($conn,$sql);

$hotels = mysqli_fetch_all($result,MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel</title>
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
    <h1 class="center">Hotel Information</h1>
    <table class="main__table">
        <thead>
            <tr>
                <th id="hotel-id" scope="col" class="table__head">Hotel ID</th>
                <th id="type" scope="col" class="table__head">Type</th>
                <th id="name" scope="col" class="table__head">Name</th>
                <th id="price" scope="col" class="table__head">Price</th>
                <th id="available-room" scope="col" class="table__head">Avai Room</th>
                <th id="place" scope="col" class="table__head">Place</th>
                <th id="map" scope="col" class="table__head">Map</th>
                <th id="picture" scope="col" class="table__head">Picture</th>
                <th id="edit" scope="col" class="table__head">Edit</th>
            </tr>
        </thead>
        <tbody class="table__body">
        <?php foreach ($hotels as $hotel):
            $data = $hotel['photo'];
            $imageData = base64_encode($data);

            ?>
            <tr>
                <td class="table__item"><?php echo htmlspecialchars($hotel['hotel_id'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($hotel['type'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($hotel['name'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($hotel['price'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($hotel['available_room'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($hotel['place'])?></td>
                <td class="table__item"><a href="<?php echo $hotel['map']?>"><div class="table_edit clickSp">Click Me</div></a></td>

                <td class="table__item">
                    <div class="hotel__pic">
                        <figure>
<!--                            <img src="../img/hotel/--><?php // $imageData ?><!--" alt="hotel1" width="460" height="307">-->
                            <?php echo '<img src="data:image;base64,' . $imageData . '"width="460" height="307"">' ?>
                        </figure>
                    </div>
                </td>
                <td class="table__item edit_option">
                    <button type="submit" name="edit" class="table_edit"><a href="hotel_crud/hotel_edit.php?hotel_id=<?php echo $hotel['hotel_id'] ?>">Edit</a></button>
                    <button type="submit" name="deleteButton" class="table_edit diff"><a href="hotel_crud/hotel_delete.php?hotel_id=<?php echo $hotel['hotel_id'] ?>">Delete</a></button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="12" class="table__footer">
                    <button type="submit" class="add_option" ><a href="hotel_crud/hotel_add.php">Add Hotel</a></button>
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
