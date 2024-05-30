<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$type = $name = $price = $avai_room = $place = $map = $photo = "";

$error = array('type' =>'', 'name' =>'', 'price' =>'', 'avai_room' =>'', 'place' =>'', 'map' =>'', 'photo'=>'');
if(isset($_GET['submit'])){
    if(empty($_GET['type'])){
        $error['type'] = "Type is required";
    }
    else{
        $type = $_GET['type'];
    }

    if(empty($_GET['name'])){
        $error['name'] = "Name is required";
    }
    else{
        $name = $_GET['name'];
    }

    if(empty($_GET['price'])){
        $error['price'] = "Price is required";
    }
    else{
        $price = $_GET['price'];
    }

    if(empty($_GET['avai_room'])){
        $error['avai_room'] = "Available Room is required";
    }
    else{
        $avai_room = $_GET['avai_room'];
    }

    if(empty($_GET['place'])){
        $error['place'] = "Place is required";
    }
    else{
        $place = $_GET['place'];
    }

    if(empty($_GET['map'])){
        $error['map'] = "Map is required";
    }
    else{
        $map = $_GET['map'];
    }

    $photo = $_GET['photo'];


    if(array_filter($error)){

    }
    else{
        $type = mysqli_real_escape_string($conn,$_GET['type']);
        $name = mysqli_real_escape_string($conn,$_GET['name']);
        $price = mysqli_real_escape_string($conn,$_GET['price']);
        $avai_room = mysqli_real_escape_string($conn,$_GET['avai_room']);
        $place = mysqli_real_escape_string($conn,$_GET['place']);
        $map = mysqli_real_escape_string($conn,$_GET['map']);
        $photo = $_GET['picture'];


        $sql = "INSERT INTO hotel(type,name,price,available_room,place,map,photo) VALUES 
              ('{$type}','{$name}','{$price}','{$avai_room}','{$place}','{$map}','{$photo}')";

        if(mysqli_query($conn,$sql)){
            header('Location: http://localhost/explore_plus/Admin/hotel_info.php');
        }else{
            echo "Query error" . mysqli_error($conn);
        }

    }

    mysqli_close($conn);


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hotel Add</title>
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
  <form class="crud__all" action="hotel_add.php" method="get">
    <h3 class="crud__h3">Hotel Add:</h3>
    <fieldset class="crud__fieldset">
      <p class="crud__p">
        <label class="crud__label" for="type">Type:</label>
        <input class="crud__input" type="text" name="type" id="type"  required autofocus>
        <div class="danger center"><?php echo $error['type']; ?></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="name">Name</label>
        <input class="crud__input" type="text" name="name" id="name"  required autofocus>
          <div class="danger center"><?php echo $error['name']; ?></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="price">Price</label>
        <input class="crud__input" type="text" name="price" id="price"  required autofocus>
          <div class="danger center"><?php echo $error['price']; ?></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="avai_room">Avai Room</label>
        <input class="crud__input" type="text" name="avai_room" id="avai_room"  required autofocus>
          <div class="danger center"><?php echo $error['avai_room']; ?></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="place">Place</label>
        <input class="crud__input" type="text" name="place" id="place" required autofocus>
          <div class="danger center"><?php echo $error['place']; ?></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="map">Map</label>
        <input class="crud__input" type="text" name="map" id="map"  required autofocus>
          <div class="danger center"><?php echo $error['map']; ?></div>
      </p>
      <p class="crud__p">
        <label class="crud__label" for="picture">Picture</label>
        <input class="form__input file_up" type="file" name="picture" id="picture" >
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
