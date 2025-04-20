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
    <title>WebSec Air | Dashboard</title>
    <link rel="stylesheet" href="style_dashboard.css">
</head>
<body>

<header>
    <nav>
        <a href="dashboard.php">🏠 Dashboard</a>
        <a href="comment.php">📝 Reviews</a>
        <a href="view.php">📚 Guides</a>
        <a href="profile.php?user=1">👤 Profile</a>
    </nav>
</header>

<div class="hero">
    <div class="hero-text">
        Welcome to WebSec Air, <?php echo htmlspecialchars($username); ?>!
    </div>
</div>

<div class="container">
    <p class="intro">Your gateway to exploring secure skies and stunning destinations. Choose an option below to begin your journey:</p>

    <div class="card-grid">
        <a class="card" href="comment.php">
            ✍️ Leave a Review
        </a>
        <a class="card" href="profile.php?user=1">
            👤 View Your Profile
        </a>
        <a class="card" href="view.php">
            🌍 Explore Guides
        </a>
    </div>
</div>

</body>
</html>
