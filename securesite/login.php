<?php
session_start();
include("db.php");

$message = "";

// Initialize brute-force counter
if (!isset($_SESSION['fail_count'])) {
    $_SESSION['fail_count'] = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Brute-force lockout (optional)
    if ($_SESSION['fail_count'] >= 5) {
        $message = "🚫 Too many failed attempts. Try again later.";
    } else {
        // Secure Login: Prepared Statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['fail_count'] = 0; // reset on success
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['fail_count']++;
            sleep(1); // simple delay
            $message = "Invalid login. Attempts: " . $_SESSION['fail_count'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>WebSec Air | Secure Login</title>
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
        ✈️ WebSec Air – Your Passport to Security
    </div>
</div>

<div class="container">
    <div class="left">
        <h2>🔒 Welcome to the Secure Portal</h2>
        <p>This portal is protected against SQL injection and brute-force attacks.</p>
        <blockquote>💬 “Security is not a feature, it's a mindset.”</blockquote>
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
        </div>
    </div>
</div>

</body>
</html>
