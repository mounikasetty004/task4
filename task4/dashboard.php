<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
echo '<link rel="stylesheet" href="style.css">';


$user = $_SESSION['user'];
echo "<h2>Welcome, {$user['username']} ({$user['role']})</h2>";

if (in_array($user['role'], ['admin', 'editor'])) {
    echo "<a href='create_post.php'>Create Post</a><br>";
}

echo "<a href='view_posts.php'>View Posts</a><br>";
echo "<a href='logout.php'>Logout</a>";
?>