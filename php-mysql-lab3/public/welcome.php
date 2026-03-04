<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.html');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Welcome</title></head>
<link rel="stylesheet" href="style.css">
<body>
    <div class="container2">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>

        <p>You are now logged in.</p>
        
        <a href="logout.php">Log out</a>
    </div>
</body>
</html>