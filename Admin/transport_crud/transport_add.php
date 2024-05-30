<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$type = $from = $to = $price = $start_date = $start_time = $finish_date = $finish_time = $class = $capacity = "";

$error = array('type' =>'', 'from' =>'', 'to' =>'', 'price' =>'', 'start_date' =>'', 'start_time' =>'', 'finish_date' =>'', 'finish_time' =>'', 'class' =>'', 'capacity' =>'');

if(isset($_GET['submit'])){

    if(empty($_GET['type'])){
        $error['type'] = "Type is required";
    }
    else{
        $type = $_GET['type'];
    }

    if(empty($_GET['from'])){
        $error['from'] = "From place is required";
    }
    else{
        $from = $_GET['from'];
    }


    if(empty($_GET['to'])){
        $error['to'] = "To place is required";
    }
    else{
        $to = $_GET['to'];
    }



    if(empty($_GET['price'])){
        $error['price'] = "Price is required";
    }
    else{
        $price = $_GET['price'];
    }



    if(empty($_GET['start_date'])){
        $error['start_date'] = "Start date is required";
    }
    else{
        $start_date = $_GET['start_date'];
    }


    if(empty($_GET['start_time'])){
        $error['start_time'] = "Start time is required";
    }
    else{
        $start_time = $_GET['start_time'];
    }



    if(empty($_GET['finish_date'])){
        $error['finish_date'] = "Finish Date is required";
    }
    else{
        $finish_date = $_GET['finish_date'];
    }


    if(empty($_GET['finish_time'])){
        $error['finish_time'] = "Finish time is required";
    }
    else{
        $finish_time = $_GET['finish_time'];
    }


    if(empty($_GET['class'])){
        $error['class'] = "Class is required";
    }
    else{
        $class = $_GET['class'];
    }

    if(empty($_GET['capacity'])){
        $error['capacity'] = "Capacity is required";
    }
    else{
        $capacity = $_GET['capacity'];
    }

    if(array_filter($error)){

    }
    else{
        $type = mysqli_real_escape_string($conn,$_GET['type']);
        $from = mysqli_real_escape_string($conn,$_GET['from']);
        $to = mysqli_real_escape_string($conn,$_GET['to']);
        $price = mysqli_real_escape_string($conn,$_GET['price']);
        $start_date = mysqli_real_escape_string($conn,$_GET['start_date']);
        $start_time = mysqli_real_escape_string($conn,$_GET['start_time']);
        $finish_date = mysqli_real_escape_string($conn,$_GET['finish_date']);
        $finish_time = mysqli_real_escape_string($conn,$_GET['finish_time']);
        $class = mysqli_real_escape_string($conn,$_GET['class']);
        $capacity = mysqli_real_escape_string($conn,$_GET['capacity']);

        $sql = "INSERT INTO transport(type,from_place,to_place,price,start_date,finish_date,start_time,finish_time,class,capacity)
            VALUES ('{$type}','{$from}','{$to}','{$price}','{$start_date}','{$finish_date}','{$start_time}','{$finish_time}','{$class}','{$capacity}')";

        if(mysqli_query($conn,$sql)){
            header('Location: http://localhost/explore_plus/Admin/transportation_info.php');
        }
        else{
            echo "Query error" . mysqli_error($conn);
        }

    }
}


    mysqli_close($conn);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Transport Add</title>
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
  <form class="crud__all" action="transport_add.php" method="get">
    <h3 class="crud__h3">Transport Add:</h3>
    <fieldset class="crud__fieldset">
      <p class="crud__p">
        <label class="crud__label" for="type">Type:</label>
        <input class="crud__input" type="text" name="type" id="type"  required autofocus>
          <div class="danger center"><p><?php echo htmlspecialchars($error['type'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="from">From</label>
        <input class="crud__input" type="text" name="from" id="from"  required autofocus>
         <div class="danger center"><p><?php echo htmlspecialchars($error['from'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="to">To</label>
        <input class="crud__input" type="text" name="to" id="to"  required autofocus>
         <div class="danger center"><p><?php echo htmlspecialchars($error['to'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="price">Price</label>
        <input class="crud__input" type="text" name="price" id="price"  required autofocus>
         <div class="danger center"><p><?php echo htmlspecialchars($error['price'])?></p></div>
      </p>

      <p class="crud__p">
        <label class="crud__label" for="start_date">Starting Date</label>
        <input class="crud__input" type="date" name="start_date" id="start_date" required autofocus>
         <div class="danger center"><p><?php echo htmlspecialchars($error['start_date'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="start_time">Starting Time</label>
        <input class="crud__input" type="time" name="start_time" id="start_time"  required autofocus>
         <div class="danger center"><p><?php echo htmlspecialchars($error['start_time'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="finish_date">Finish Date</label>
        <input class="crud__input" type="date" name="finish_date" id="finish_date"  required autofocus>
         <div class="danger center"><p><?php echo htmlspecialchars($error['finish_date'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="finish_time">Finish Time</label>
        <input class="crud__input" type="time" name="finish_time" id="finish_time"  required autofocus>
        <div class="danger center"><p><?php echo htmlspecialchars($error['finish_time'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="class">Class</label>
        <input class="crud__input" type="text" name="class" id="class"  required autofocus>
        <div class="danger center"><p><?php echo htmlspecialchars($error['class'])?></p></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="capacity">Capacity</label>
        <input class="crud__input" type="text" name="capacity" id="capacity"  required autofocus>
        <div class="danger center"><p><?php echo htmlspecialchars($error['capacity'])?></p></div>
      </p>
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
