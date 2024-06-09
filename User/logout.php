<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}



?>
<!doctype html>
<html lang="en">
<script>
    var confirmation = confirm("Do you want to logout?");

    // Check the user's response
    if (confirmation) {
        // User clicked "OK"
        // alert("You clicked OK!");
        window.location.href = "http://localhost/explore_plus/alert/logoutDone.php";
    } else {
        // User clicked "Cancel" or closed the dialog
        // alert("You clicked Cancel or closed the dialog!");
        // window.location.href = "http://localhost/explore_plus/index.php";
        window.location.href = "http://localhost/explore_plus/User/main.php";
    }
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
</body>

</html>


