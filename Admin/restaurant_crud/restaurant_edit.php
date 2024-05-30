

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Restaurant Edit</title>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<header class="header admin">
    <div class="header__logo">
        <figure>
            <img src="../../img/logo3.png" alt="logo" title="logo" height="115" width="600">
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
            <li><a href="../admin.php">Admin</a></li>
            <li><a href="../transaction.php">Transaction</a></li>
            <li><a href="../finance.php">Finance</a></li>
            <li><a href="../guide.php">Guide</a></li>
            <li><a href="../user_list.php">User</a></li>

        </ul>
        <ul class="header__ul header__admin">
            <li><a href="../tour_condition.php">Tour</a></li>
            <li><a href="../trip_crud/trip_adding.php">Trip Adding</a></li>
            <li><a href="../transportation_info.php">Transport</a></li>
            <li><a href="../hotel_info.php">Hotel</a></li>
            <li><a href="../restaurant_info.php">Restaurant</a></li>
        </ul>
    </nav>
    <div class="admin__logout"><a href="../admin_login.php">Logout</a></div>
</header>


<main class="main__crud">
    <h1 class="center"></h1>
    <form class="crud__all select__all" action="REdit.php" method="get">
        <h3 class="crud__h3">Restaurant Edit Item:</h3>
        <fieldset class="crud__fieldset">
            <input type="hidden" name="menu_id" value="<?php echo $_GET['menu_id']?>">
            <div class="select__whole">
                <div class="crud__p select_div">
                    <label class="crud__label select__label" for="breakfast">Breakfast:</label>
                    <div class="select_item">
                        <?php
                        $conn = mysqli_connect("localhost","root","","explore_plus");

                        if(!$conn){
                            echo "Connection Error" . mysqli_connect_error() . '<br>';
                        }


                        $sql = "SELECT * from breakfast_item";

                        $result = mysqli_query($conn,$sql);

                        $breakfasts = mysqli_fetch_all($result,MYSQLI_ASSOC);

                        mysqli_free_result($result);

                        $menuSelectBQ =mysqli_query($conn,"SELECT * from menu_breakfast where menu_id = '{$_GET['menu_id']}'");
                        $menuSelectB = mysqli_fetch_assoc($menuSelectBQ);


                        ?>

                        <select name="breakfast" id="breakfast">
                            <?php foreach ($breakfasts as $food):
                                if($food['breakfast'] == $menuSelectB['breakfast']){
                                    $select = "selected";
                                }
                                else{
                                    $select = "";
                                }
                                ?>

                                <option <?php echo $select ?> value="<?php echo htmlspecialchars($food['breakfast']) ?>"><?php echo htmlspecialchars($food['breakfast']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="crud__add__btn"><a href="breakfast/breakfast_add.php">Add Breakfast</a></div>

                </div>


                <div class="crud__p select_div">
                    <label class="crud__label" for="lunch">Lunch</label>
                    <div class="select_item">
                        <?php


                        $sql2 = "SELECT * from lunch_item";

                        $result2 = mysqli_query($conn,$sql2);

                        $lunchs = mysqli_fetch_all($result2,MYSQLI_ASSOC);

                        mysqli_free_result($result2);

                        $menuSelectLQ =mysqli_query($conn,"SELECT * from menu_lunch where menu_id = '{$_GET['menu_id']}'");
                        $menuSelectL = mysqli_fetch_assoc($menuSelectLQ);



                        ?>

                        <select name="lunch" id="lunch">
                            <?php foreach ($lunchs as $food2):
                                if($food2['lunch'] == $menuSelectL['lunch']){
                                    $select = "selected";
                                }
                                else{
                                    $select = "";
                                }
                                ?>

                                ?>
                                <option <?php echo $select ?> value="<?php echo htmlspecialchars($food2['lunch']) ?>"><?php echo htmlspecialchars($food2['lunch']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="crud__add__btn"><a href="lunch/lunch_add.php">Add Lunch</a></div>
                </div>

                <div class="crud__p select_div">
                    <label class="crud__label" for="dinner">Dinner</label>
                    <div class="select_item">
                        <?php


                        $sql3 = "SELECT * from dinner_item";

                        $result3 = mysqli_query($conn,$sql3);

                        $dinners = mysqli_fetch_all($result3,MYSQLI_ASSOC);

                        mysqli_free_result($result3);

                        $menuSelectDQ =mysqli_query($conn,"SELECT * from menu_dinner where menu_id = '{$_GET['menu_id']}'");
                        $menuSelectD = mysqli_fetch_assoc($menuSelectDQ);


                        ?>
                        <select name="dinner" id="dinner">
                            <?php foreach ($dinners as $food3):
                                if($food3['dinner'] == $menuSelectD['dinner']){
                                    $select = "selected";
                                }
                                else{
                                    $select = "";
                                }

                                ?>
                                <option <?php echo $select ?> value="<?php echo htmlspecialchars($food3['dinner']) ?>"><?php echo htmlspecialchars($food3['dinner']) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php mysqli_close($conn) ?>
                    </div>
                    <div class="crud__add__btn"><a href="dinner/dinner_add.php">Add Dinner</a></div>
                </div>
            </div>

        </fieldset>
        <div class="crud__div">
            <button class="crud__btn" type="submit" name="submit">Submit</button>
            <button class="crud__btn diff2" type="reset">Reset</button>
        </div>
    </form>

</main>



<footer class="footer admin-foot">
    <div class="footer__contact">
        <h3 class="footer__h3">Contact us:</h3>
        <ul class="footer__ul">
            <li><a href="../../footerPage/contact_us.html">Contact</a></li>
            <li><a href="../../footerPage/customer.html">Customer</a></li>
            <li><a href="../../footerPage/website_feedback.php">Website Feedback</a></li>
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
            <li><a href="../../footerPage/about__us.html">About Explore.com</a></li>
            <li><a href="../../footerPage/terms_condition.html">Terms &amp; Conditions</a></li>
            <li><a href="../../footerPage/privacy_statement.html">Privacy Statement</a></li>
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
