<?php
// Include your database connection
include('db.php');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "User not logged in";
    exit;
}

$username = $_SESSION['username'];
$message = $_POST['message']; // Get message sent by user

// Insert the message into the messages table
$query = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
mysqli_query($conn, $query);
?>
