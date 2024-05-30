<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$name = $user_name = $password = $email = $dob = $phone = $city = $country = $gender = $language = $past_trip = $profile_pic = "";

$error = array('name' => '', 'user_name' => '','password'=>'' , 'email' => '', 'dob' => '', 'phone' => '', 'city' => '', 'country' => '', 'gender' => '', 'language' => '', 'past_trip' => '', 'profile_pic' => '');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$v_code){
    require ('../PHPMailer/PHPMailer.php');
    require ('../PHPMailer/SMTP.php');
    require ('../PHPMailer/Exception.php');

    $mail = new PHPMailer(true);

    try {
        //Server settings

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'jhasan0122@gmail.com';                     //SMTP username
        $mail->Password   = '9248@Ramos@WithSiuuu';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('jhasan0122@gmail.com', 'Jehan Hasan');
        $mail->addAddress($email);     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email verification from Explore Plus';
        $mail->Body    = "Thanks for registration <br>
                          Click the link below to varify
                          <a href='http://localhost/explore_plus/Security/varify_email.php?email=$email&vcode=$v_code'>verify</a>";


        $mail->send();
        return true;
    } catch (Exception $e) {
        echo $e;
    }
}




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
        $error['password'] = "Username is required";
    }
    else{
        $password = $_POST['password'];
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

    if(empty($_POST['gender'])){
        $error['gender'] = "Gender is required";
    }
    else{
        $gender = $_POST['gender'];
    }

    if(empty($_POST['language'])){
        $error['language'] = "Language is required";
    }
    else{
        $language = $_POST['language'];
    }

        $past_trip = $_POST['past_trip'];
        $profile_pic = $_POST['profile_pic'];



    if(array_filter($error)){

    }
    else{
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $v_code = bin2hex(random_bytes(16));
//        echo $v_code;
        $hash = password_hash($password,PASSWORD_DEFAULT);

        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $dob = mysqli_real_escape_string($conn,$_POST['dob']);
        $phone = mysqli_real_escape_string($conn,$_POST['phone']);
        $city = mysqli_real_escape_string($conn,$_POST['city']);
        $country = mysqli_real_escape_string($conn,$_POST['country']);
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $language = mysqli_real_escape_string($conn,$_POST['language']);
        $past_trip = mysqli_real_escape_string($conn,$_POST['past_trip']);
//        $profile_pic = mysqli_real_escape_string($conn,$_POST['profile_pic']);


        $sql = "INSERT INTO userpro (name,username,password,email,date_of_birth,phone,city,country,gender,language,past_trip,varification_code,is_varified)
            VALUES ('{$name}','{$user_name}','{$hash}','{$email}','{$dob}','{$phone}','{$city}','{$country}','{$gender}','{$language}','{$past_trip}','$v_code','0')";

        if(mysqli_query($conn,$sql)){

            session_start();
            $_SESSION['username'] = $_POST['user_name'];

            echo "
            <script>
                alert('Your have successfully signed up');
            </script>";
            header('Location: http://localhost/explore_plus/User/main.php');
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<header class="header">
    <div class="header__logo">
        <figure>
            <img src="../img/logo2.png" alt="logo" title="logo" height="115" width="603">
        </figure>
    </div>
    <div class="header_search">
        <form class="search__bar" action="">
            <input class="search__input" type="text" placeholder="Search anything" name="search">
            <button class="search__button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
<!--    <nav class="header__nav">-->
<!--        <ul class="header__ul">-->
<!--            <li><a href="main.php">Home</a></li>-->
<!--            <li><a href="tour.php">Tour</a></li>-->
<!--            <li><a href="../footerPage/contact_us.html">Contact</a></li>-->
<!--            <li><a href="user_profile.php">User</a></li>-->
<!--        </ul>-->
<!--    </nav>-->
</header>

<main class="main__form background__change">

    <form class="form__all" action="signup.php" method="post">
        <h3 class="form__h3">About Yourself:</h3>
        <fieldset class="form__fieldset">
            <p class="form__p">
                <label class="form__label" for="name">Name:</label>
                <input class="form__input" type="text" name="name" id="name"  required autofocus>
                <div class="danger center"><p><?php echo $error['name'] ?></p></div>
            </p>
            <p class="form__p">
                <label class="form__label" for="user_name">Username:</label>
                <input class="form__input" type="text" name="user_name" id="user_name"  required autofocus>
                <div class="danger center"><p><?php echo $error['user_name'] ?></p></div>
            </p>
            <p class="form__p">
                <label class="form__label" for="password">Password:</label>
                <input class="form__input" type="password" name="password" id="password"  required autofocus>
                <div class="danger center"><p><?php echo $error['password'] ?></p></div>
            </p>
            <p class="form__p">
                <label class="form__label" for="email">Email</label>
                <input class="form__input" type="email" name="email" id="email"  required autofocus>
                <div class="danger center"><p><?php echo $error['email'] ?></p></div>
            </p>
            <p class="form__p">
                <label class="form__label" for="dob">Date Of Birth</label>
                <input class="form__input" type="date" name="dob" id="dob"  required autofocus>
                <div class="danger center"><p><?php echo $error['dob'] ?></p></div>
            </p>
            <p class="form__p">
                <label class="form__label" for="phone">Phone</label>
                <input class="form__input" type="number" name="phone" id="phone"  required autofocus>
                <div class="danger center"><p><?php echo $error['phone'] ?></p></div>
            </p>
            <p class="form__p">
                <label class="form__label" for="city">City</label>
                <input class="form__input" type="text" name="city" id="city" required autofocus>
                <div class="danger center"><p><?php echo $error['city'] ?></p></div>
            </p>
            <p class="form__p">
                <label class="form__label" for="country">Country</label>
                <input class="form__input" type="text" name="country" id="country"  required autofocus>
                <div class="danger center"><p><?php echo $error['country'] ?></p></div>
            </p>

            <p class="form__p radio__p">
                <label class="form__label">Gender</label>
            <div class="radio__div">
                <input class="radio__input" type="radio" name="gender" value="male">
                <label class="radio__label" for="male">Male</label>
            </div>
            <div class="radio__div">
                <input class="radio__input" type="radio" name="gender" value="female">
                <label class="radio__label" for="female">Female</label>
                <div class="danger center"><p><?php echo $error['gender'] ?></p></div>
            </div>
            </p>
            <p class="form__p">
                <label class="form__label" for="language">Language</label>
                <input class="form__input" type="text" name="language" id="language"  required autofocus>
                <div class="danger center"><p><?php echo $error['language'] ?></p></div>
            </p>
            <p class="form__p form_area">
                <label class="form__label" for="past_trip">Past Trip</label>
                <textarea class="form__textarea" name="past_trip" id="past_trip" cols="10" rows="6"></textarea>
            </p>
            <p class="form__p">
                <label class="form__label" for="profile_pic">Profile Pic&nbsp;&nbsp;&nbsp;</label>
                <input class="file_up" type="file" name="profile_pic" id="profile_pic">
            </p>
            <p class="form__p">
                <button class="login__button form_spc" type="submit" name="register">Register</button>
            </p>


        </fieldset>

    </form>

</main>


<footer class="footer">
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