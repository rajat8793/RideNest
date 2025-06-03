<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle = trim($_POST['vehicle']);
    $pickup = trim($_POST['pickup']);
    $drop = trim($_POST['drop']);
    $date = trim($_POST['date']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, vehicle, pickup, drop_location, ride_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $vehicle, $pickup, $drop, $date);

    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Booking failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
