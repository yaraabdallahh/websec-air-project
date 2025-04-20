<?php
session_start();
include("db.php");

// Vulnerable login logic
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL Injection vulnerability
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

     if ($result && $result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Invalid login.";
    }
}

// ✨ GenAI Travel Quotes
$quotes = [
    "“Not all those who wander are lost.” – J.R.R. Tolkien",
    "“Travel far enough, you meet yourself.” – David Mitchell",
    "“Jobs fill your pocket, but adventures fill your soul.”",
    "“To travel is to live.” – Hans Christian Andersen",
    "“Adventure may hurt you, but monotony will kill you.”"
];
$quote_of_the_day = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html>
<head>
    <title>WebSec Air | Secure Skies Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </nav>
</header>

<div class="hero">
    <div class="hero-overlay">
        ✈️ WebSec Air – Your Passport to Exploration
    </div>
</div>

<div class="container">
    <div class="left">
        <h2>🌍 Welcome to WebSec Air</h2>
        <p>Join a global community of digital nomads, weekend adventurers, and cultural explorers. Log in to unlock personalized destination picks, secret itineraries, and user-shared travel hacks.</p>
        <blockquote>💬 <?php echo $quote_of_the_day; ?></blockquote>
    </div>

    <div class="right">
        <div class="login-card">
            <h3>🔐 Traveler Login</h3>
            <form method="post" action="">
                <label>Username:</label>
                <input type="text" name="username" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <input type="submit" value="Access Portal">
            </form>
            <p style="color:red;"><?php echo $message; ?></p>
            <p><strong>Demo users:</strong> yara / lovecsec123 | leen / lovecats123 | omar / mohmd123</p>
        </div>
    </div>
</div>

</body>
</html>
