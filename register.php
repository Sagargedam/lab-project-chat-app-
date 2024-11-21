<?php
session_start();

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('db.php');  // Include database connection file

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username already exists
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error = "Username already taken. Please choose another one.";
    } else {
        // Insert new user into the database
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['username'] = $username;  // Set session for logged in user
            header("Location: chat.php");  // Redirect to chat page
            exit;
        } else {
            $error = "Error in registration. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS -->
</head>
<body>

    <!-- Registration Form -->
    <div class="register-container">
        <h2>Register</h2>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>

        <!-- Already Registered Message -->
        <p>Already have an account? <a href="login.php" class="login-link">Login here</a></p>
    </div>

</body>
</html>
