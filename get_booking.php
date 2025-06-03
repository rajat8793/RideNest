<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT vehicle, pickup, drop_location, ride_date FROM bookings WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

echo json_encode($bookings);

$stmt->close();
$conn->close();
?>
