<?php
$servername = "localhost";  // Database host (for XAMPP/WAMP, it's localhost)
$username = "root";         // Default MySQL username for XAMPP/WAMP is 'root'
$password = "";             // Default MySQL password for XAMPP/WAMP is empty
$dbname = "chat_app";       // Name of your database (make sure it's the same as in MySQL)

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
