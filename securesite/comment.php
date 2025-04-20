<?php
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$message = "";

// Handle new comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['comment'];

    // Save as-is to DB (we sanitize on output)
    $stmt = $conn->prepare("UPDATE users SET comment=? WHERE username=?");
    $stmt->bind_param("ss", $comment, $username);
    $stmt->execute();
    $message = "✅ Comment posted safely!";
}

// Fetch all comments
$result = $conn->query("SELECT username, comment FROM users WHERE comment IS NOT NULL");
?>

<!DOCTYPE html>
<html>
<head>
    <title>WebSec Air | Safe Reviews</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="comment.php">Reviews</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="container">
    <h1>🧿 Santorini Reimagined</h1>
    <p>Now secured from XSS attacks. Drop your reviews — safely.</p>

    <img src="https://www.visitgreece.gr/images/1743x752/jpg/files/merakos_05_santorini-oia_1743x752.jpg" alt="Santorini" style="width:100%; border-radius: 8px; margin: 20px 0;">

    <form method="post" action="">
        <textarea name="comment" rows="4" cols="60" placeholder="Write your thoughts..."></textarea><br>
        <input type="submit" value="Post Review">
    </form>

    <?php if ($message): ?>
        <p style="color:green;"><?php echo $message; ?></p>
    <?php endif; ?>

    <h3>🛡️ Traveler Comments (Sanitized)</h3>
    <div class="card">
        <?php while ($row = $result->fetch_assoc()): ?>
            <p><strong><?php echo htmlspecialchars($row['username']); ?>:</strong> <?php echo htmlspecialchars($row['comment']); ?></p>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
