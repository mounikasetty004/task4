<?php
require 'db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'user';

    if (!$username || !$email || strlen($password) < 6) {
        $errors[] = "Invalid input fields.";
    } else {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");

        try {
            $stmt->execute([$username, $email, $hash, $role]);
            echo "Registration successful. <a href='login.php'>Login</a>";
        } catch (PDOException $e) {
            $errors[] = "Username or email already exists.";
        }
    }
}
?>

<form method="post" onsubmit="return validateForm();">
  Username: <input name="username" required><br>
  Email: <input name="email" type="email" required><br>
  Password: <input name="password" type="password" required><br>
  Role: 
  <select name="role">
    <option value="user">User</option>
    <option value="editor">Editor</option>
    <option value="admin">Admin</option>
  </select><br>
  <button type="submit">Register</button>
</form>

<script src="validation.js"></script>
<?php foreach ($errors as $e) echo "<p>$e</p>"; ?>