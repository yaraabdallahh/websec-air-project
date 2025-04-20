<?php
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$message = "";

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'];

    // XSS vulnerability: no sanitization!
	$comment = addslashes($_POST['comment']);
    $sql = "UPDATE users SET comment='$comment' WHERE username='$username'";
    $conn->query($sql);
    $message = "Thanks for sharing your thoughts!";
}

// Fetch all comments (for display)
$result = $conn->query("SELECT username, comment FROM users WHERE comment IS NOT NULL");
?>

<!DOCTYPE html>
<html>
<head>
    <title>WebSec Air | Santorini Reviews</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="comment.php">Santorini</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <h1>🧿 Discovering Santorini</h1>
    <p>
        Perched on the cliffs of the Aegean Sea, Santorini dazzles with its whitewashed homes, blue domes, and volcanic charm.
        Whether you're watching sunsets in Oia or exploring ancient ruins in Akrotiri, it's an unforgettable escape.
    </p>
    <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1d/81/30/3f/caption.jpg?w=1400&h=1400&s=1&cx=1846&cy=1833&chk=v1_6ae0a81ae3361e988707" alt="Santorini" style="width:100%; border-radius: 8px; margin: 20px 0;">

    <h3>📝 Share Your Experience</h3>
    <form method="post" action="">
        <textarea name="comment" rows="4" cols="60" placeholder="Write your thoughts..."></textarea><br>
        <input type="submit" value="Post Review">
    </form>

    <?php if ($message): ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <h3>🌍 Traveler Comments</h3>
    <div class="card">
        <?php while ($row = $result->fetch_assoc()): ?>
            <p><strong><?php echo htmlspecialchars($row['username']); ?>:</strong> <?php echo $row['comment']; ?></p>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
