<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$name = $user_name = $password = $email = $dob = $phone = $city = $country = $gender = $language1 =$language2 =$language3 =$language4  = $nationality = $nid_no = $visa_exp = "";

$error = array('name' => '', 'user_name' => '','password'=>'' , 'email' => '', 'dob' => '', 'phone' => '', 'city' => '', 'country' => '', 'gender' => '', 'nationality' => '', 'nid_no' => '', 'visa_exp'=>'');


if(isset($_POST['register'])){

    if(empty($_POST['name'])){
        $error['name'] = "Name is required";
    }
    else{
        $name = $_POST['name'];
    }

    if(empty($_POST['user_name'])){
        $error['user_name'] = "Username is required";
    }
    else{
        $user_name = $_POST['user_name'];
    }

    if(empty($_POST['password'])){
        $error['password'] = "Password is required";
    }
    else{
        $password = $_POST['password'];
    }

    if(empty($_POST['nid_no'])){
        $error['nid_no'] = "NID is required";
    }
    else{
        $nid_no = $_POST['nid_no'];
    }

    if(empty($_POST['email'])){
        $error['email'] = "Email is required";
    }
    else{
        $email = $_POST['email'];
    }

    if(empty($_POST['dob'])){
        $error['dob'] = "Date of Birth is required";
    }
    else{
        $dob = $_POST['dob'];
    }

    if(empty($_POST['phone'])){
        $error['phone'] = "Phone is required";
    }
    else{
        $phone = $_POST['phone'];
    }

    if(empty($_POST['city'])){
        $error['city'] = "City is required";
    }
    else{
        $city = $_POST['city'];
    }

    if(empty($_POST['country'])){
        $error['country'] = "Country is required";
    }
    else{
        $country = $_POST['country'];
    }

    if(empty($_POST['nationality'])){
        $error['nationality'] = "Nationality is required";
    }
    else{
        $nationality = $_POST['nationality'];
    }

    if(empty($_POST['gender'])){
        $error['gender'] = "Gender is required";
    }
    else{
        $gender = $_POST['gender'];
    }

    if(empty($_POST['visa_expr'])){
        $error['visa_expr'] = "Visa expire date is required";
    }
    else{
        $visa_exp = $_POST['visa_expr'];
    }


    $profile_pic = $_POST['photo'];



    if(array_filter($error)){
        echo "ERRRRORRR";
    }
    else{
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $hash = password_hash($password,PASSWORD_DEFAULT);

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $dob = mysqli_real_escape_string($conn,$_POST['dob']);
        $nationality = mysqli_real_escape_string($conn,$_POST['nationality']);
        $phone = mysqli_real_escape_string($conn,$_POST['phone']);
        $city = mysqli_real_escape_string($conn,$_POST['city']);
        $country = mysqli_real_escape_string($conn,$_POST['country']);
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $visa_exp = mysqli_real_escape_string($conn,$_POST['visa_expr']);
        $nid_no = mysqli_real_escape_string($conn,$_POST['nid_no']);



        $sql = "INSERT INTO guide (name,username,password,email,date_of_birth,phone,city,country,gender,photo,visa_expiry_date,nationality,NID)
            VALUES ('{$name}','{$user_name}','{$hash}','{$email}','{$dob}','{$phone}','{$city}','{$country}','{$gender}','{$profile_pic}','{$visa_exp}','{$nationality}','{$nid_no}')";

        if(mysqli_query($conn,$sql)){
            if(!empty($_POST['first_lang'])){
                $language1 = $_POST['first_lang'];
                mysqli_query($conn,"INSERT INTO guide_speak(username,language) values('{$user_name}','{$language1}')");
            }
            if(!empty($_POST['second_lang'])){
                $language2 = $_POST['second_lang'];
                mysqli_query($conn,"INSERT INTO guide_speak(username,language) values('{$user_name}','{$language2}')");
            }
            if(!empty($_POST['third_lang'])){
                $language3 = $_POST['third_lang'];
                mysqli_query($conn,"INSERT INTO guide_speak(username,language) values('{$user_name}','{$language3}')");
            }
            if(!empty($_POST['fourth_lang'])){
                $language4 = $_POST['fourth_lang'];
                mysqli_query($conn,"INSERT INTO guide_speak(username,language) values('{$user_name}','{$language4}')");
            }

            session_start();
            $_SESSION['guide_username'] = $_POST['user_name'];

            header('Location: http://localhost/explore_plus/Admin/guide_profile.php');
        }
        else{
            echo "Query error" . mysqli_error($conn);
        }

        mysqli_close($conn);

    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guide Profile</title>
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
            <li><a href="transaction.php">Transaction</a></li>
            <li><a href="finance.php">Finance</a></li>
            <li><a href="guide.php">Guide</a></li>
            <li><a href="tour_condition.php">Tour</a></li>
        </ul>
        <ul class="header__ul header__admin">
            <li><a href="trip_crud/trip_adding.php">Trip Adding</a></li>
            <li><a href="transportation_info.php">Transport</a></li>
            <li><a href="hotel_info.php">Hotel</a></li>
            <li><a href="restaurant_info.php">Restaurant</a></li>
        </ul>
    </nav>
    <div class="admin__logout"><a href="admin_login.php">Logout</a></div>
</header>

<main class="main__form background__change">

    <form class="form__all" action="guide_signup.php" method="post">
        <h3 class="form__h3">Guide Information:</h3>
        <fieldset class="form__fieldset">
            <p class="form__p">
                <label class="form__label" for="name">Name:</label>
                <input class="form__input" type="text" name="name" id="name"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="user_name">User Name:</label>
                <input class="form__input" type="text" name="user_name" id="user_name"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="password">Password:</label>
                <input class="form__input" type="password" name="password" id="password"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="nid_no">NID-No:</label>
                <input class="form__input" type="text" name="nid_no" id="nid_no"  required autofocus>
            </p>

            <p class="form__p">
                <label class="form__label" for="email">Email</label>
                <input class="form__input" type="email" name="email" id="email"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="dob">Date Of Birth</label>
                <input class="form__input" type="date" name="dob" id="dob"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="phone">Phone</label>
                <input class="form__input" type="number" name="phone" id="phone"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="city">City</label>
                <input class="form__input" type="text" name="city" id="city" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="country">Country</label>
                <input class="form__input" type="text" name="country" id="country"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="nationality">Nationality</label>
                <input class="form__input" type="text" name="nationality" id="nationality"  required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="age">Age</label>
                <input class="form__input" type="text" name="age" id="age"  required autofocus>
            </p>
            <p class="form__p radio__p">
                <label class="form__label">Gender</label>
                <div class="radio__div">
                    <input class="radio__input" type="radio" name="gender" id="male" value="male">
                    <label class="radio__label" for="male">Male</label>
                </div>
                <div class="radio__div">
                    <input class="radio__input" type="radio" name="gender" id="female" value="female">
                    <label class="radio__label" for="female">Female</label>
                </div>
            </p>
            <p class="form__p p_spci">
                <label class="form__label" for="language">Speaking Language</label>
                <input class="form__input" type="text" name="first_lang"  placeholder="first_lang"  >
                <input class="form__input2" type="text" name="second_lang" placeholder="second_lang" >
                <input class="form__input2" type="text" name="third_lang"  placeholder="third_lang" >
                <input class="form__input2" type="text" name="fourth_lang" placeholder="fourth_lang" >
            </p>
            <p class="form__p">
                <label class="form__label" for="visa_expr">Visa Expire Date</label>
                <input class="form__input" type="date" name="visa_expr" id="visa_expr" required autofocus>
            </p>
            <p class="form__p">
                <label class="form__label" for="photo">Photo</label>
                <input class="form__input file_up" type="file" name="photo" id="photo">
            </p>
            <p class="form__p">
                <button class="login__button form_spc" type="submit" name="register">Register</button>
            </p>

        </fieldset>

    </form>

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
