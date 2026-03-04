<?php
// login.php
session_start();
require __DIR__ . '/../config/config.php';

$email = trim($_POST['email']);
$pass = trim($_POST['password']);

$stmt = $pdo->prepare("SELECT * FROM login_users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user){
    header("Location: ../public/login.php?error=emailnotfound");
    exit;
}

if ($email === '' || $pass === '') {
    header("Location: ../public/login.php?error=empty");
    exit;
}

if (!password_verify($pass, $user['password_hash'])) {
   header("Location: ../public/login.php?error=wrongpassword");
  exit;
}

// Save login
$_SESSION['user'] = $user['first_name'];

header('Location: ../public/welcome.php');
exit;
