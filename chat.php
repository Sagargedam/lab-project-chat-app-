<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="style.css"> <!-- Link your CSS file -->
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>
    <div id="messages"></div>
    <div class="input-area">
        <input type="text" id="message-input" placeholder="Type a message..." autocomplete="off" />
        <button id="send-btn">Send</button>
    </div>
    <a href="logout.php">Logout</a>

    <script>
        const messagesDiv = document.getElementById("messages");
        const messageInput = document.getElementById("message-input");
        const sendBtn = document.getElementById("send-btn");

        // Fetch messages every 2 seconds
        setInterval(() => {
            fetch('getMessages.php')
                .then(response => response.json())
                .then(messages => {
                    messagesDiv.innerHTML = ''; // Clear current messages
                    messages.forEach(msg => {
                        const messageDiv = document.createElement('div');
                        messageDiv.textContent = `${msg.username}: ${msg.message}`;
                        messagesDiv.appendChild(messageDiv);
                    });
                });
        }, 2000);

        // Send a message
        sendBtn.addEventListener("click", () => {
            const formData = new FormData();
            formData.append("username", "<?php echo $username; ?>");
            formData.append("message", messageInput.value);

            fetch('sendMessage.php', {
                method: 'POST',
                body: formData
            }).then(() => {
                messageInput.value = ""; // Clear input after sending message
            });
        });
    </script>
</body>
</html>
