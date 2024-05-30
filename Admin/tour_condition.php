<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$sql = "SELECT t.tour_id,t.place_name,t.country,t.city,t.budget,t.available_seat,t.map,t.start_date,t.finish_date,t.guide_username,mb.breakfast,ml.lunch,md.dinner,h.name,t.continent 
        FROM tour t
    
         left JOIN hotel h
         ON t.hotel_id = h.hotel_id
        left JOIN transport trn
        on trn.tour_id = t.tour_id

         left JOIN menu m
        ON m.menu_id = t.menu_id
            
            
        left join menu_breakfast mb 
        on m.menu_id = mb.menu_id
        
        
        left join menu_lunch ml
        on m.menu_id = ml.menu_id
        
        
        left join menu_dinner md
        on m.menu_id = md.menu_id
        
        group by t.tour_id  
        
    
        ";

$result = mysqli_query($conn,$sql);

$tours = mysqli_fetch_all($result,MYSQLI_ASSOC);

mysqli_free_result($result);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour Condition</title>
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
    <h1 class="center">Tour Condition</h1>
    <table class="main__table transportation">
        <thead class="sticky__head">
        <tr>
            <th id="tour-id" scope="col" class="table__head">Tour Id</th>
            <th id="place" scope="col" class="table__head">place</th>
            <th id="country" scope="col" class="table__head">country</th>
            <th id="continent" scope="col" class="table__head">continent</th>
            <th id="city" scope="col" class="table__head">city</th>
            <th id="budget" scope="col" class="table__head">budget</th>
            <th id="seat" scope="col" class="table__head">seat</th>
            <th id="map" scope="col" class="table__head">map</th>
            <th id="guide" scope="col" class="table__head">guide</th>
            <th id="start-date" scope="col" class="table__head">start-date</th>
            <th id="finish-date" scope="col" class="table__head">finish-date</th>
            <th id="hotel" scope="col" class="table__head">Hotel</th>
            <th id="restaurant" scope="col" class="table__head">Restaurant</th>
            <th id="transport" scope="col" class="table__head">Transport</th>
            <th id="edit" scope="col" class="table__head">Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tours as $tour): ?>
        <tr>
            <td class="table__item"><?php echo $tour['tour_id']?></td>
            <td class="table__item"><?php echo $tour['place_name']?></td>
            <td class="table__item"><?php echo $tour['country']?></td>
            <td class="table__item"><?php echo $tour['continent']?></td>
            <td class="table__item"><?php echo $tour['city']?></td>
            <td class="table__item"><?php echo $tour['budget']?></td>
            <td class="table__item"><?php echo $tour['available_seat']?></td>
            <td class="table__item"><a href="<?php echo $tour['map']?>"><div class="table_edit">Click Me</div></a></td>
            <td class="table__item"><?php echo $tour['guide_username']?></td>
            <td class="table__item"><?php
                $date = new DateTime((string)$tour['start_date']);
                $dateOnly = $date->format('Y-m-d');
                $timeOnly =$date->format('H:i:s')
                ?>
                <div><?php  echo $dateOnly; ?></div>
                <div><?php echo $timeOnly?></div>
            </td>

            <td class="table__item"><?php
                $date = new DateTime((string)$tour['finish_date']);
                $dateOnly = $date->format('Y-m-d');
                $timeOnly =$date->format('H:i:s')
                ?>
                <div><?php  echo $dateOnly; ?></div>
                <div><?php echo $timeOnly?></div>
            </td>
            <td class="table__item"><?php echo $tour['name']?></td>
            <td class="table__item">
                <div><?php echo $tour['breakfast']?></div>
                <div><?php echo $tour['lunch']?></div>
                <div><?php echo $tour['dinner']?></div>
            </td>
            <td class="table__item">
                <?php
                $transportsSql =mysqli_query($conn,"SELECT from_place , to_place , type ,trn.start_date ,trn.start_time
                                                                FROM tour t
                                                                INNER JOIN guide g 
                                                                ON t.guide_username = g.username
                                                                INNER join transport trn
                                                                on trn.tour_id = t.tour_id
                                                                where t.tour_id = '{$tour['tour_id']}'");
                $transports = mysqli_fetch_all($transportsSql,MYSQLI_ASSOC);
                foreach ($transports as $transport):
                    echo $transport['type'] . '<br>';
                    echo $transport['from_place'] . " - ".$transport['to_place'].'<br>';
                    echo $transport['start_date'] . "  Time:  " . $transport['start_time'].'<br>';
                endforeach;
                ?>

            </td>
            <td class="table__item edit_option">
                <button type="submit" class="table_edit"><a href="trip_crud/trip_edit.php?tour_id=<?php echo $tour['tour_id'] ?>">Edit</a></button>
<!--                <button type="submit" class="table_edit diff">Delete</button>-->
            </td>
        </tr>
        <?php endforeach; ?>

        </tbody>

        <tfoot>
        <tr>
            <td colspan="12" class="table__footer">
                <button type="submit" class="add_option" ><a href="trip_crud/trip_adding.php">Add Trip</a></button>
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
