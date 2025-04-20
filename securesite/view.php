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
        // Step 1: Whitelist valid filenames
        $allowed_files = ["about.txt", "santorini.txt", "hidden_gems.txt"];

        if (isset($_GET['file'])) {
            $file = $_GET['file'];

            //  Step 2: Only proceed if file is allowed
            if (in_array($file, $allowed_files)) {
                $path = "files/" . $file;

                //  Step 3: Check if file actually exists
                if (file_exists($path)) {
                    echo nl2br(htmlspecialchars(file_get_contents($path)));
                } else {
                    echo "❌ File not found.";
                }
            } else {
                echo "🚫 Invalid file access.";
            }
        } else {
            echo "📂 No file selected.";
        }
        ?>
    </div>
</div>

</body>
</html>
