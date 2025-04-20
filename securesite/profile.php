<?php
session_start();
include("db.php");

// Block unauthenticated users
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Get logged-in user's username from session
$current_user = $_SESSION['username'];

//  Lookup the logged-in user's ID securely (do not trust URL!)
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $current_user);
$stmt->execute();
$result = $stmt->get_result();

// If session username is invalid
if ($result->num_rows === 0) {
    echo "User not found.";
    exit;
}

$row = $result->fetch_assoc();
$user_id = $row['id']; // Now we can use it in nav if you want
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WebSec Air | Traveler Profile</title>
    <link rel="stylesheet" href="style_profile.css">
</head>
<body>

<header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="comment.php">Santorini</a>
        <a href="view.php">Guides</a>
        <a href="profile.php">My Profile</a> <!-- no user ID needed -->
    </nav>
</header>

<div class="profile-card">
    <h2>🌍 Traveler Profile</h2>
    <p><span>Username:</span> <?php echo htmlspecialchars($row['username']); ?></p>
    <p><span>Email:</span> <?php echo htmlspecialchars($row['email']); ?></p>
    <p><span>Comment:</span> <?php echo htmlspecialchars($row['comment']); ?></p>
</div>

</body>
</html>
