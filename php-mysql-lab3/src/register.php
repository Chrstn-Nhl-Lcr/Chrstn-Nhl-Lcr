<?php
// register.php
require __DIR__ . '/../config/config.php';

// Read inputs
$first = trim($_POST['first_name']);
$middle = trim($_POST['middle_name']);
$last = trim($_POST['last_name']);
$suffix = trim($_POST['suffix']);
$email = trim($_POST['email']);
$pass = trim($_POST['password']);

if ($first === '' || $last === '' || $email === '' || $pass === '') {
  die('All required fields must be filled. <a href="../public/register.php">Back</a>');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die('Invalid email. <a href="../public/register.php">Back</a>');
}

// Password hashing
$hash = password_hash($pass, PASSWORD_DEFAULT);

try {
  $stmt = $pdo->prepare("
    INSERT INTO login_users (first_name, middle_name, last_name, suffix, email, password_hash)
    VALUES (?, ?, ?, ?, ?, ?)
  ");
  $stmt->execute([$first, $middle, $last, $suffix, $email, $hash]);
} catch (PDOException $e) {
  die('Email already exists. <a href="../public/register.html">Back</a>');
}

// Redirect to login page
header('Location: ../public/login.php');
exit;
