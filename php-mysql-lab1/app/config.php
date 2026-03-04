
<?php
// config.php
// Purpose: Holds DB settings and creates a PDO connection.

$DB_HOST = '127.0.0.1';
$DB_PORT = '3306';
$DB_NAME = 'sample_db';
$DB_USER = 'root';   // XAMPP local default
$DB_PASS = '';       // empty on many XAMPP installs

$DSN = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4";

try {
  $pdo = new PDO($DSN, $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (PDOException $e) { 
  die('Database connection failed. Is MySQL running?');
}
?>

