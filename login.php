<?php
// Include the db.php file to establish the database connection
include('db.php');  // Ensure this path is correct

session_start();

// Check if user is already logged in, if so, redirect to chat page
if (isset($_SESSION['username'])) {
    header("Location: chat.php");
    exit;
}

// Handle login if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user from database
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;  // Set session
        header("Location: chat.php");  // Redirect to chat page
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS -->
</head>
<body>

    <!-- Login Form -->
    <div class="login-container">
        <h2>Login</h2>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <!-- Register Link -->
        <p>Don't have an account? <a href="register.php" class="register-link">Register here</a></p>
    </div>

</body>
</html>
