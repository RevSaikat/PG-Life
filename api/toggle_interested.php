<?php
session_start();

require "../includes/database_connect.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(array("success" => false, "is_logged_in" => false));
    return;
}

$user_id = $_SESSION['user_id'];
$property_id = $_GET["property_id"];

// Check if already interested using prepared statement
$sql_1 = "SELECT * FROM interested_users_properties WHERE user_id = ? AND property_id = ?";
$stmt_1 = mysqli_prepare($conn, $sql_1);
mysqli_stmt_bind_param($stmt_1, "ii", $user_id, $property_id);
mysqli_stmt_execute($stmt_1);
$result_1 = mysqli_stmt_get_result($stmt_1);

if (!$result_1) {
    echo json_encode(array("success" => false, "message" => "Something went wrong"));
    return;
}

if (mysqli_num_rows($result_1) > 0) {
    // Delete interest using prepared statement
    $sql_2 = "DELETE FROM interested_users_properties WHERE user_id = ? AND property_id = ?";
    $stmt_2 = mysqli_prepare($conn, $sql_2);
    mysqli_stmt_bind_param($stmt_2, "ii", $user_id, $property_id);
    $result_2 = mysqli_stmt_execute($stmt_2);
    
    if (!$result_2) {
        echo json_encode(array("success" => false, "message" => "Something went wrong"));
        return;
    } else {
        echo json_encode(array("success" => true, "is_interested" => false, "property_id" => $property_id));
        return;
    }
} else {
    // Insert interest using prepared statement
    $sql_3 = "INSERT INTO interested_users_properties (user_id, property_id) VALUES (?, ?)";
    $stmt_3 = mysqli_prepare($conn, $sql_3);
    mysqli_stmt_bind_param($stmt_3, "ii", $user_id, $property_id);
    $result_3 = mysqli_stmt_execute($stmt_3);
    
    if (!$result_3) {
        echo json_encode(array("success" => false, "message" => "Something went wrong"));
        return;
    } else {
        echo json_encode(array("success" => true, "is_interested" => true, "property_id" => $property_id));
        return;
    }
}
