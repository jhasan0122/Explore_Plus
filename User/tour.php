
<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}


$sql = "SELECT * FROM tourTable";

$minCOSTR = mysqli_query($conn,"SELECT min(budget) FROM tourTable");
$minCost = mysqli_fetch_assoc($minCOSTR);

$maxCOSTR = mysqli_query($conn,"SELECT max(budget) FROM tourTable");
$maxCost = mysqli_fetch_assoc($maxCOSTR);

if(isset($_GET['sort'])){
    if($_GET['sortOption']=='asc') {
        $sql = "SELECT * FROM tourTable ORDER BY budget ASC ";
    }
    else if($_GET['sortOption']=='desc') {
        $sql = "SELECT * FROM tourTable ORDER BY budget DESC ";
    }
}

if(isset($_GET['filter'])){
    $min = $_GET['min'];
    $max = $_GET['max'];
    $sql = "SELECT * FROM tourTable WHERE budget>='{$min}' and budget <= '{$max}'";
}

if(isset($_GET['filter_date'])){
    $startFrom=$_GET['start'];
    $till = $_GET['finish'];
    $sql = "SELECT * FROM tourTable WHERE start_date>='{$startFrom}' and finish_date <='{$till}'";
}


if(isset($_GET['searchSubmit'])){
    $find = $_GET['search'];
    $sql = "SELECT * FROM tourTable WHERE (continent LIKE '%{$find}%') or (country LIKE '%{$find}%') or (city LIKE '%{$find}%') or (place_name LIKE '%{$find}%')";
}

if(isset($_GET['category']) && isset($_GET['continent'])){
    echo "Print continent";
}




$result = mysqli_query($conn,$sql);

$tours = mysqli_fetch_all($result,MYSQLI_ASSOC);

mysqli_free_result($result);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour</title>
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
        <form class="search__bar" action="tour.php" method="get">
            <input class="search__input"  type="text" placeholder="Search anything" name="search">
            <button class="search__button" name="searchSubmit" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <nav class="header__nav">
        <ul class="header__ul">
            <li><a href="main.php">Home</a></li>
            <li><a href="tour.php">Tour</a></li>
            <li><a href="../footerPage/contact_us.html">Contact</a></li>
            <li><a href="user_profile.php">User</a></li>
        </ul>
    </nav>
    <div class="logout"><a href="logout.php">Logout</a></div>
</header>


<main class="main">

    <div class="card__container">
        <form action="tour.php" method="get" class="sort__form">
            <fieldset class="sort__fieldset">
                <div class="sort__Section">
                    <select class="sort__option" name="sortOption" id="sortOption">
                        <option>Sorted By</option>
                        <option value="asc">low to High Price</option>
                        <option value="desc">High to Low Price</option>
                    </select>
                    <button name="sort" class="sort_button">Sort</button>
                </div>
                <div class="sort__range">
                    <p class="sort__Write">Price Range</p>
                    <p class="sort__p">
                        <label for="min">Min:</label>
                        <input type="text" name="min" id="min" value="<?php echo $minCost['min(budget)'] ?>">
                        <label for="max"> - Max:</label>
                        <input type="text" name="max" id="max" value="<?php echo $maxCost['max(budget)'] ?>">
                    </p>
                    <button name="filter" class="sort_button">Filter</button>
                </div>
                <div class="sort__time">
                    <p class="date__p">
                        <div class="date__div">
                        <label for="start">Start from:</label>
                        <input type="date" name="start" id="start">
                        </div>
                        <div class="date__div">
                            <label for="finish">Finish Till:</label>
                            <input type="date" name="finish" id="finish">
                        </div>
                    </p>
                    <button name="filter_date" class="sort_button btn_date">Filter Date</button>
                </div>
                <div class="sort__Section">
<!--                    <p class="sort__Write">Catagories</p>-->
                    <select class="sort__option" name="categories" id="categories">
                        <option >Sort by Area</option>
                        <option value="continent">Continent</option>
                        <option value="country">Country</option>
                        <option value="city">City</option>
                        <option value="place_name">Place</option>
                    </select>
                    <button name="category" class="sort_button btn_date">Categories</button>
                    <button name="remove" class="sort_button btn_date">Remove</button>
                </div>
            </fieldset>
        </form>

        <?php

        if(isset($_GET['category'])){
            $cata = $_GET['categories'];



//            echo $cata;
            if($cata == "continent"){
                $resultCat = mysqli_query($conn,"SELECT continent,count(tour_id)
                                                    from tour 
                                                    group by continent");

            }
            else if($cata == "country"){
                $resultCat = mysqli_query($conn,"SELECT country,count(tour_id)
                                                    from tour 
                                                    group by country");
            }
            else if($cata == "city"){
                $resultCat = mysqli_query($conn,"SELECT city,count(tour_id)
                                                    from tour 
                                                    group by city");
            }
            else{
                $resultCat = mysqli_query($conn,"SELECT place_name,count(tour_id)
                                                    from tour 
                                                    group by place_name");
            }

            $catagorys = mysqli_fetch_all($resultCat,MYSQLI_ASSOC);


            ?>
            <table class="main__table transportation">
                <thead>
                <tr>
                    <th id="transport-id" scope="col" class="table__head head_col"><?php echo $cata ?></th>
                    <th id="type" scope="col" class="table__head head_col">No of result</th>
                    <th id="type" scope="col" class="table__head head_col">Show</th>

                </tr>
                </thead>
                <tbody class="table__body">
                <?php foreach ($catagorys as $catagory): ?>
                <tr>
                    <?php
                    if($cata == "continent"){
                        
                    ?>
                    <td class="table__item"><?php echo $catagory['continent']?></td>
                     <td class="table__item"><?php echo $catagory['count(tour_id)']?></td>
                     <td class="table__item"><button type="submit" name="continent" ><a href="search/continent.php?location=<?php echo $catagory['continent']?>">Search</a></button></td>
                    <?php
                    }
                    else if($cata == "country"){

                    ?>
                        <td class="table__item"><?php echo $catagory['country']?></td>
                        <td class="table__item"><?php echo $catagory['count(tour_id)']?></td>
                        <td class="table__item"><button type="submit" name="country"><a href="search/continent.php?location=<?php echo $catagory['country']?>">Search</a></button></td>

                        <?php
                    }
                    else if($cata == "city"){
                    ?>
                        <td class="table__item"><?php echo $catagory['city']?></td>
                        <td class="table__item"><?php echo $catagory['count(tour_id)']?></td>
                        <td class="table__item"><button type="submit" name="city"><a href="search/continent.php?location=<?php echo $catagory['city']?>">Search</a></button></td>

                    <?php }
                    else{
                    ?>
                    <td class="table__item"><?php echo $catagory['place_name']?></td>
                    <td class="table__item"><?php echo $catagory['count(tour_id)']?></td>
                    <td class="table__item"><button type="submit" name="place_name"><a href="search/continent.php?location=<?php echo $catagory['place_name']?>">Search</a></button></td>

                        <?php
                    }
                    ?>

<!--                    <td class="table__item">--><?php //echo $catagory['count(tour_id)']?><!--</td>-->
<!--                    <td class="table__item"><button name="show" value="--><?php // ?><!--">Show</button></td>-->

                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


        <?php

        }
        if(isset($_GET['remove'])){
            unset($_GET['category']);
        }


        ?>




        <div class="card__list">
            <?php foreach ($tours as $tour): ?>
            <div class="card__item">
                <a href="tour_info.php?tour_id=<?php echo $tour['tour_id'] ?>">
                    <div class="card__pic">
                        <figure>
                            <img src="../img/tours/<?php echo $tour['photo'] ?>" alt="card1" width="1200" height="900">
                        </figure>
                    </div>
                    <div class="card__desc">
                        <div class="card__location">
                            <h3><?php echo htmlspecialchars($tour['place_name']) . " , " . htmlspecialchars($tour['country'])?></h3>
                        </div>
                        <div class="card__write">
                            <p><?php echo htmlspecialchars($tour['about'])?></p>
                        </div>
                        <div class="card__start-end">
                            <p><?php echo htmlspecialchars($tour['start_date']) . " To " . htmlspecialchars($tour['finish_date'])?></p>
                        </div>
                        <div class="card__budget">
                            <h3>$ <?php echo htmlspecialchars($tour['budget'])?></h3>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach;
            mysqli_close($conn);
            ?>


        </div>
    </div>

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

