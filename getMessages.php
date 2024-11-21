<?php
// Include your database connection
include('db.php');

// Fetch the latest messages
$query = "SELECT * FROM messages ORDER BY timestamp DESC LIMIT 10";  // Adjust the limit if needed
$result = mysqli_query($conn, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;  // Add each message to the array
}

// Return the messages as a JSON response
echo json_encode($messages);
?>
