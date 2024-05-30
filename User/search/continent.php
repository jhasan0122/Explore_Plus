<?php

$loc = $_GET['location'];

$_GET['search'] = true;

//if(isset($_GET['search'])){
//
//}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<form class="search__bar" action="../tour.php" method="get">
    <input class="search__input"  type="hidden" placeholder="Search anything" name="search" value="<?php echo $loc ?>">

    <div class="confims">
        <button class="con_btn" name="searchSubmit" type="submit">Confirm</button>
        <button class="con_btn" name="calcel" type="submit"><a href="../tour.php">Cancel</a></button>
    </div>


</form>

</body>
</html>