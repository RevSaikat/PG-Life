<?php
require "../includes/database_connect.php";

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zipcode'];
$nameoncard = $_POST['nameoncard'];
$cardno = $_POST['cardno'];
$expmonth = $_POST['expmonth'];
$expyear = $_POST['expyear'];
$cvv = $_POST['cvv'];

// Use prepared statement for insertion
$sql = "INSERT INTO payment_details (fullname, email, address, city, state, zipcode, nameoncard, cardno, expmonth, expyear, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Something went wrong!");
}

mysqli_stmt_bind_param($stmt, "sssssisisii", $fullname, $email, $address, $city, $state, $zipcode, $nameoncard, $cardno, $expmonth, $expyear, $cvv);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo "Booking Confirmed";
} else {
    echo "Something went wrong!";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
