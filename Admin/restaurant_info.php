<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$sql = "select menu.menu_id , breakfast_item.breakfast,breakfast_item.bcost , lunch_item.lunch,lunch_item.lcost , dinner_item.dinner , dinner_item.dcost
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
    group by menu.menu_id

;";


$result = mysqli_query($conn,$sql);

$menuList = mysqli_fetch_all($result,MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Info</title>
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
    <h1 class="center">Restaurant Information</h1>
    <table class="main__table transportation">
        <thead>
        <tr>
            <th id="menu-id" scope="col" class="table__head">Menu Id</th>
            <th id="breakfast" scope="col" class="table__head">Breakfast</th>
            <th id="breakfast-cost" scope="col" class="table__head">Breakfast Cost</th>
            <th id="lunch" scope="col" class="table__head">Lunch</th>
            <th id="lunch-cost" scope="col" class="table__head">Lunch Cost</th>
            <th id="dinner" scope="col" class="table__head">Dinner</th>
            <th id="dinner-cost" scope="col" class="table__head">Dinner Cost</th>
            <th id="edit" scope="col" class="table__head">Edit</th>
        </tr>
        </thead>
        <tbody class="table__body">
        <?php foreach ($menuList as $menu): ?>
        <tr>
            <td class="table__item"><?php echo $menu['menu_id'] ?></td>
            <td class="table__item"><?php echo $menu['breakfast'] ?></td>
            <td class="table__item"><?php echo $menu['bcost'] ?></td>
            <td class="table__item"><?php echo $menu['lunch'] ?></td>
            <td class="table__item"><?php echo $menu['lcost'] ?></td>
            <td class="table__item"><?php echo $menu['dinner'] ?></td>
            <td class="table__item"><?php echo $menu['dcost'] ?></td>
            <td class="table__item edit_option">
                <button type="submit" class="table_edit"><a href="restaurant_crud/restaurant_edit.php?menu_id=<?php echo $menu['menu_id'] ?>">Edit</a></button>
                <button type="submit" class="table_edit diff"><a href="restaurant_crud/restaurant_delete.php?menu_id=<?php echo $menu['menu_id'] ?>">Delete</a></button>
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>

        <tfoot>
        <tr>
            <td colspan="12" class="table__footer">
                <button type="submit" class="add_option" ><a href="restaurant_crud/restaurant_add.php">Add Menu</a></button>
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
