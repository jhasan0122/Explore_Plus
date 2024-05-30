<?php
$conn = mysqli_connect("localhost","root","","explore_plus");

if(!$conn){
    echo "Connection Error" . mysqli_connect_error() . '<br>';
}

$enrolId =$_GET['enrolment_id'];

if(mysqli_query($conn,"UPDATE enrollment 
                                SET status = 'approved'
                                WHERE enrolment_id = '{$enrolId}'")){
    header("Location: http://localhost/explore_plus/Admin/transaction.php");
}
else{
    mysqli_error($conn);
}


?>