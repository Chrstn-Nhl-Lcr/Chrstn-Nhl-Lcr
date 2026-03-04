<?php
// insert.php
// Purpose: Receives form data, validates it, inserts into DB, then redirects.

require __DIR__ . '/config.php';

// 1) Read and trim inputs
$full = trim($_POST['full_name'] ?? ' ');
$email = trim($_POST['email'] ?? ' ');

// 2) Simple validation
if ($full === '' || $email === '') {
  die('Please enter both name and email. <a href="../public/index.html">Back</a>');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die('Invalid email format. <a href="../public/index.html">Back</a>');
}

// 3) Insert safely (prepared statement)
try {
  $stmt = $pdo->prepare('INSERT INTO users (full_name, email) VALUES (?, ?)');
  $stmt->execute([$full, $email]);
} catch (PDOException $e) {
  if (strpos($e->getMessage(), 'Duplicate') !== false) {
    die('That email already exists. <a href="../public/index.html">Back</a>');
  }
  die('Database error.');
}

// 4) Redirect to list
header('Location: ../public/list.php');
exit;
?>
