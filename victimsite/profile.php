<?php
session_start();
include("db.php");

// Block unauthenticated users
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if a user ID is passed
if (!isset($_GET['user'])) {
    echo "No user selected.";
    exit;
}

$user_id = $_GET['user'];

// Vulnerable to IDOR: No validation if current user owns this profile
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

// Handle invalid IDs
if ($result->num_rows == 0) {
    echo "User not found.";
    exit;
}

$row = $result->fetch_assoc();
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
        <a href="profile.php?user=<?php echo $row['id']; ?>">My Profile</a>
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
