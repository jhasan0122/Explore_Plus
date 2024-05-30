<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$enrolId =$_GET['enrolment_id'];

$enrollRes = mysqli_query($conn,"SELECT booking_id,payment_id,tour_id
                                    from enrollment e 
                                    WHERE e.enrolment_id = '{$enrolId}'");

$enroll = mysqli_fetch_assoc($enrollRes);
$payment_id = $enroll['payment_id'];
$booking_id = $enroll['booking_id'];
$tourId = $enroll['tour_id'];

if(mysqli_query($conn,"DELETE FROM pay_method WHERE payment_id = '{$payment_id}'")){
    if(mysqli_query($conn,"DELETE FROM enrollment WHERE enrolment_id = '{$enrolId}'")) {
        if (mysqli_query($conn, "DELETE FROM payment WHERE payment_id = '{$payment_id}'")) {
            $result = mysqli_query($conn,"select (child + adult + senior) from booking where booking_id = {$booking_id}");
            $personQ = mysqli_fetch_assoc($result);
            $person = (int)$personQ['(child + adult + senior)'];
            if(mysqli_query($conn,"update tour 
                                        set available_seat = (available_seat + {$person})
                                        where tour_id = {$tourId}")){
                if (mysqli_query($conn, "DELETE FROM booking WHERE booking_id = '{$booking_id}'")) {
                    header('Location: http://localhost/explore_plus/Admin/transaction.php');
                }
            }

        }
    }
}
else{
    echo mysqli_error($conn);
}




?>
