<?php

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state= $_POST['state'];
$zipcode = $_POST['zipcode'];
$nameoncard = $_POST['nameoncard'];
$cardno = $_POST['cardno'];
$expmonth = $_POST['expmonth'];
$expyear = $_POST['expyear'];
$cvv = $_POST['cvv'];

$conn = new mysqli('localhost','root','','pglife');
if($conn->connect_error){
    die('Connection Failed :' .$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into payment_details(fullname, email, address, city, state, zipcode, nameoncard, cardno, expmonth, expyear, cvv) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisisii",$fullname, $email, $address, $city, $state, $zipcode, $nameoncard, $cardno, $expmonth, $expyear, $cvv);
    $stmt->execute();
    echo "Booking Confirmed";
    $stmt->close();
    $conn->close();
}
?>




