<?php

$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}



if(isset($_POST['checkout'])){
    ob_start();
    session_start();
    $username = $_SESSION['username'];
    $booking_id = $_SESSION['booking_id'];
    $tour = $_POST['tour_id'];
    $payment = $_POST['payment_method'];


    if(mysqli_query($conn, "START TRANSACTION")){
        $moneyQ = "Select budget from tour where tour_id = '{$tour}'";
        $resultQ = mysqli_query($conn, $moneyQ);
        $moneyQ = mysqli_fetch_assoc($resultQ);
        $money = $moneyQ['budget'];

        if(mysqli_query($conn,"INSERT INTO payment(amount) VALUES (NULL)")){
            $payment_id = mysqli_insert_id($conn);
            mysqli_query($conn, "insert into pay_method(payment_id,method) VALUES('.$payment_id.','{$payment}')");

            $availableSeatQ = mysqli_query($conn, "SELECT available_seat
                                                            FROM tour t 
                                                            where t.tour_id = '{$tour}'");
            $availableSeat = mysqli_fetch_assoc($availableSeatQ);
            $avail_Seat=(int)$availableSeat['available_seat'];




            if(mysqli_query($conn, "update enrollment
                                set payment_id = '{$payment_id}'
                                where booking_id = '{$booking_id}'
                                ")){
                $bookSeatQ = mysqli_query($conn, "SELECT (b.child+b.adult+b.senior) as totalPerson
                                                    FROM tour t 
                                                    INNER JOIN enrollment e 
                                                    on t.tour_id = e.tour_id
                                                    INNER JOIN booking b 
                                                    on e.booking_id = b.booking_id
                                                    INNER join payment p 
                                                    on p.payment_id=e.payment_id
                                                    where p.payment_id = '{$payment_id}'");
                $bookSeatR = mysqli_fetch_assoc($bookSeatQ);
                $bookSeat = $bookSeatR['totalPerson'];

                if($avail_Seat >= $bookSeat){
                    if(mysqli_query($conn,"update payment
                                               set amount = '{$money}'*{$bookSeat} 
                                               WHERE payment_id={$payment_id}")){
                        mysqli_query($conn, "COMMIT");
                        $sql = "UPDATE tour t                            
                                        SET t.available_seat = (t.available_seat - '{$bookSeat}')
                                        where t.tour_id = {$tour};";
                        if (mysqli_query($conn, $sql)) {

                            header("Location: http://localhost/explore_plus/User/main.php");
                            echo "Success";
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                    else{
                        echo "ERROR1";
                    }
                }
                else{
                    echo "Booking limit exceed";
                }
            }
            else{
                echo mysqli_error($conn);
            }
        }
        else{
            echo "ERROR4";
        }
    }
    else{
        echo "ERROR5";
    }

}


?>