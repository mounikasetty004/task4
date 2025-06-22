<?php
require 'db.php';

echo '<link rel="stylesheet" href="style.css">';

$limit = 5;
$page = $_GET['page'] ?? 1;
$start = ($page - 1) * $limit;

$stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.author_id = users.id ORDER BY created_at DESC LIMIT ?, ?");
$stmt->bindValue(1, $start, PDO::PARAM_INT);
$stmt->bindValue(2, $limit, PDO::PARAM_INT);
$stmt->execute();

$posts = $stmt->fetchAll();
foreach ($posts as $p) {
    echo "<h3>{$p['title']} by {$p['username']}</h3><p>{$p['content']}</p><hr>";
}

$total = $pdo->query("SELECT COUNT(*) FROM posts")->fetchColumn();
for ($i = 1; $i <= ceil($total / $limit); $i++) {
    echo "<a href='?page=$i'>$i</a> ";
}
?>