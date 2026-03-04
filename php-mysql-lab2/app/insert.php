<?php
// insert.php - Validate & insert a new user, then redirect.
require __DIR__ . '/config.php';

$first  = trim($_POST['first_name'] ?? '');
$middle = trim($_POST['middle_name'] ?? '');
$last   = trim($_POST['last_name'] ?? '');
$suffix = trim($_POST['suffix'] ?? '');
$email  = trim($_POST['email'] ?? '');
$phone  = trim($_POST['phone'] ?? '');
$gender = trim($_POST['gender'] ?? '');
$birthdate = trim($_POST['birthdate'] ?? '');
$barangay = trim($_POST['barangay'] ?? '');
$city_municipality = trim($_POST['city_municipality'] ?? '');
$province = trim($_POST['province'] ?? '');
$postal_code = trim($_POST['postal_code'] ?? '');

if ($first === '' || $last === '' || $email === '') {
  die('First name, Last name, and Email are required. <a href="../public/index.html">Back</a>');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  die('Invalid email format. <a href="../public/index.html">Back</a>');
}
if ($phone !== '' && !preg_match('/^09[0-9]{9}$/', $phone)) {
  die('Phone must be PH format 09xxxxxxxxx. <a href="../public/index.html">Back</a>');
}
if ($postal_code !== '' && !preg_match('/^[0-9]{4,5}$/', $postal_code)) {
  die('Postal code must be 4–5 digits. <a href="../public/index.html">Back</a>');
}

$middle = ($middle === '') ? null : $middle;
$suffix = ($suffix === '') ? null : $suffix;
$phone  = ($phone  === '') ? null : $phone;
$gender = ($gender === '') ? null : $gender;
$birthdate = ($birthdate === '') ? null : $birthdate;
$barangay  = ($barangay === '') ? null : $barangay;
$city_municipality = ($city_municipality === '') ? null : $city_municipality;
$province = ($province === '') ? null : $province;
$postal_code = ($postal_code === '') ? null : $postal_code;

try {
  $stmt = $pdo->prepare(
    'INSERT INTO users
     (first_name, middle_name, last_name, suffix, email, phone, gender, birthdate, barangay, city_municipality, province, postal_code)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
  );
  $stmt->execute([$first,$middle,$last,$suffix,$email,$phone,$gender,$birthdate,$barangay,$city_municipality,$province,$postal_code]);
} catch (PDOException $e) {
  if (stripos($e->getMessage(), 'duplicate') !== false) {
    die('That email already exists. <a href="../public/index.html">Back</a>');
  }
  die('Database error.');
}

header('Location: ../public/list.php');
exit;
