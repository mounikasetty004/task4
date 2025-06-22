<?php
require 'db.php';
session_start();

echo '<link rel="stylesheet" href="style.css">';
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'editor'])) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));

    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, author_id) VALUES (?, ?, ?)");
        $stmt->execute([$title, $content, $_SESSION['user']['id']]);
        echo "Post created!";
    } else {
        echo "All fields required.";
    }
}
?>


<form method="post">
  Title: <input name="title" required><br>
  Content: <textarea name="content" required></textarea><br>
  <button type="submit">Publish</button>
</form>