<?php
// update.php - Validate & update a user by ID.
require __DIR__ . '/config.php';

$id=(int)($_POST['id']??0);
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

if($id<=0){ die('Invalid ID. <a href="../public/list.php">Back</a>'); }
if($first===''||$last===''||$email===''){
  die('First name, Last name, and Email are required. <a href="../public/edit.php?id='.urlencode($id).'">Back</a>');
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  die('Invalid email format. <a href="../public/edit.php?id='.urlencode($id).'">Back</a>');
}
if($phone!=='' && !preg_match('/^09[0-9]{9}$/',$phone)){
  die('Phone must be PH format 09xxxxxxxxx. <a href="../public/edit.php?id='.urlencode($id).'">Back</a>');
}
if($postal_code!=='' && !preg_match('/^[0-9]{4,5}$/',$postal_code)){
  die('Postal code must be 4–5 digits. <a href="../public/edit.php?id='.urlencode($id).'">Back</a>');
}

$middle = ($middle==='')?null:$middle;
$suffix = ($suffix==='')?null:$suffix;
$phone  = ($phone==='')?null:$phone;
$gender = ($gender==='')?null:$gender;
$birthdate = ($birthdate==='')?null:$birthdate;
$barangay  = ($barangay==='')?null:$barangay;
$city_municipality = ($city_municipality==='')?null:$city_municipality;
$province  = ($province==='')?null:$province;
$postal_code = ($postal_code==='')?null:$postal_code;

try{
  $stmt=$pdo->prepare(
    'UPDATE users
     SET first_name=?, middle_name=?, last_name=?, suffix=?, email=?, phone=?,
         gender=?, birthdate=?, barangay=?, city_municipality=?, province=?, postal_code=?
     WHERE id=?'
  );
  $stmt->execute([$first,$middle,$last,$suffix,$email,$phone,$gender,$birthdate,$barangay,$city_municipality,$province,$postal_code,$id]);
}catch(PDOException $e){
  if(stripos($e->getMessage(),'duplicate')!==false){
    die('That email already exists. <a href="../public/edit.php?id='.urlencode($id).'">Back</a>');
  }
  die('Database error.');
}

header('Location: ../public/list.php');
exit;
