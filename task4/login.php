<?php
require 'db.php';
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        $errors[] = "Invalid credentials.";
    }
}
?>
echo '<link rel="stylesheet" href="style.css">';


<form method="post">
  Username: <input name="username" required><br>
  Password: <input type="password" name="password" required><br>
  <button type="submit">Login</button>
</form>
<?php foreach ($errors as $e) echo "<p>$e</p>"; ?>