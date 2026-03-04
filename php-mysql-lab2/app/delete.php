<?php
// delete.php - Delete a user by ID (POST from list page).
require __DIR__ . '/config.php';

$id=(int)($_POST['id']??0);
if($id<=0){ die('Invalid ID. <a href="../public/list.php">Back</a>'); }

try{
  $stmt=$pdo->prepare('DELETE FROM users WHERE id=?');
  $stmt->execute([$id]);
}catch(PDOException $e){ die('Database error.'); }

header('Location: ../public/list.php');
exit;
