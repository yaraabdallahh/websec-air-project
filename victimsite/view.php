<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WebSec Air | Travel Guides</title>
    <link rel="stylesheet" href="style_guides.css">
</head>
<body>

<header>
    <nav>
        <a href="dashboard.php">Dashboard</a> |
        <a href="comment.php">Santorini</a> |
        <a href="view.php">Guides</a>
    </nav>
</header>

<div class="hero">
    🌍 Explore Our Travel Guides
</div>

<div class="container">
    <h2>🧳 Select a Destination Guide:</h2>
    <div class="guide-links">
        <a href="view.php?file=about.txt">📘 About Us</a>
        <a href="view.php?file=santorini.txt">🌅 Santorini</a>
        <a href="view.php?file=hidden_gems.txt">💎 Hidden Gems</a>
    </div>

    <div class="card">
        <?php
        if (isset($_GET['file'])) {
            $file = $_GET['file'];
            $path = "files/" . $file;

            if (file_exists($path)) {
                echo htmlspecialchars(file_get_contents($path));
            } else {
                echo "File not found!";
            }
        } else {
            echo "No file selected.";
        }
        ?>
    </div>
</div>

</body>
</html>
