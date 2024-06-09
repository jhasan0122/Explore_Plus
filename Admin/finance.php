<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$sql = "SELECT t.tour_id ,t.place_name ,t.budget*t.capacity as total_budget ,
       (t.capacity - t.available_seat) as booked_seat ,(IFNULL(t.budget,0)*(t.capacity - t.available_seat))as revenue ,
       DATEDIFF(t.finish_date,t.start_date)  as duration,(breakfast_item.bcost*(t.capacity - t.available_seat)*DATEDIFF(t.finish_date,t.start_date)) as break_cost,
            (lunch_item.lcost*(t.capacity - t.available_seat)*DATEDIFF(t.finish_date,t.start_date))  as lunch_cost,
            (dinner_item.dcost*(t.capacity - t.available_seat)*DATEDIFF(t.finish_date,t.start_date))  as dinner_cost,
            (breakfast_item.bcost*(t.capacity - t.available_seat)*DATEDIFF(t.finish_date,t.start_date)) + (lunch_item.lcost*(t.capacity - t.available_seat)*DATEDIFF(t.finish_date,t.start_date)) + (dinner_item.dcost*(t.capacity - t.available_seat)*DATEDIFF(t.finish_date,t.start_date)) as food_cost
            , (h.price*CEIL((t.capacity - t.available_seat)/4)*DATEDIFF(t.finish_date,t.start_date)) as hotel_cost,
              ((SELECT sum(tr.price) from transport tr where tr.tour_id IS NOT NULL and tr.tour_id=t.tour_id)*(t.capacity - t.available_seat))as trans_cost, g.wage as guide_cost
            from tour t
            
            left join enrollment e  
            on t.tour_id = e.tour_id
            
            left join payment p 
            on e.payment_id = p.payment_id
            
            inner join hotel h 
            on t.hotel_id = h.hotel_id
            
            inner join menu
            on t.menu_id = menu.menu_id
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

            inner join guide g 
             on g.username = t.guide_username
         
            group by t.tour_id";


$result = mysqli_query($conn,$sql);

$tours = mysqli_fetch_all($result,MYSQLI_ASSOC);




?>


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

<main class="main main__table-container">
    <h1 class="center">Finance</h1>
    <table class="main__table">
        <thead>
        <tr>
            <th id="hotel-id" scope="col" class="table__head">Tour ID</th>
            <th id="type" scope="col" class="table__head">Place</th>
            <th id="name" scope="col" class="table__head">Total <br> Budget</th>
            <th id="price" scope="col" class="table__head">Booked<br>Seat</th>
            <th id="available-room" scope="col" class="table__head">Revenue</th>
            <th id="place" scope="col" class="table__head">Duration</th>
            <th id="map" scope="col" class="table__head">Breakfast <br> Cost</th>
            <th id="map" scope="col" class="table__head">Lunch <br> Cost</th>
            <th id="map" scope="col" class="table__head">Dinner <br> Cost</th>
            <th id="map" scope="col" class="table__head">Food <br> Cost</th>
            <th id="picture" scope="col" class="table__head">Transport <br> Cost</th>
            <th id="edit" scope="col" class="table__head">Hotel <br> Cost</th>
            <th id="edit" scope="col" class="table__head">Guide <br> Wage</th>
            <th id="edit" scope="col" class="table__head">Income</th>
        </tr>
        </thead>
        <tbody class="table__body">
        <?php foreach ($tours as $tour): ?>
            <tr>
                <td class="table__item"><?php echo htmlspecialchars($tour['tour_id'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['place_name'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['total_budget'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['booked_seat'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['revenue'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['duration'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['break_cost'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['lunch_cost'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['dinner_cost'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['food_cost'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['trans_cost'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['hotel_cost'])?></td>
                <td class="table__item"><?php echo htmlspecialchars($tour['guide_cost'])?></td>
                <td class="table__item"><?php echo ($tour['revenue'] - $tour['food_cost'] - $tour['trans_cost'] - $tour['hotel_cost'] - $tour['guide_cost'])?></td>
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
