<?php
// edit.php - Load row by id and show prefilled update form.
require __DIR__ . '/../app/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id<=0){ die('Invalid ID. <a href="list.php">Back</a>'); }

try {
  $stmt=$pdo->prepare(
    'SELECT id, first_name, middle_name, last_name, suffix, email, phone,
            gender, birthdate, barangay, city_municipality, province, postal_code
     FROM users WHERE id=?'
  );
  $stmt->execute([$id]);
  $user=$stmt->fetch();
} catch(PDOException $e){ die('Database error.'); }

if(!$user){ die('User not found. <a href="list.php">Back</a>'); }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CRUD Lab – Edit User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Edit User</h1>

  <form action="../app/update.php" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

    <h3>Name</h3>
    <label>First name *</label>
    <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>

    <label>Middle name (optional)</label>
    <input type="text" name="middle_name" value="<?= htmlspecialchars($user['middle_name'] ?? '') ?>">

    <label>Last name *</label>
    <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

    <label>Suffix (optional)</label>
    <input type="text" name="suffix" value="<?= htmlspecialchars($user['suffix'] ?? '') ?>">

    <h3>Contact</h3>
    <label>Email *</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Phone (optional, PH 09xxxxxxxxx)</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">

    <h3>Other Details (optional)</h3>
    <label>Gender</label>
    <select name="gender">
      <?php
      $opts=['','Male','Female','Prefer not to say'];
      foreach($opts as $g){
        $sel = ($g === ($user['gender'] ?? '')) ? 'selected' : '';
        echo '<option '.$sel.'>'.htmlspecialchars($g===''?'-- Select --':$g).'</option>';
      }
      ?>
    </select>

    <label>Birthdate</label>
    <input type="date" name="birthdate" value="<?= htmlspecialchars($user['birthdate'] ?? '') ?>">

    <h3>Address (optional)</h3>
    <label>Barangay</label>
    <input type="text" name="barangay" value="<?= htmlspecialchars($user['barangay'] ?? '') ?>">

    <label>City/Municipality</label>
    <input type="text" name="city_municipality" value="<?= htmlspecialchars($user['city_municipality'] ?? '') ?>">

    <label>Province</label>
    <input type="text" name="province" value="<?= htmlspecialchars($user['province'] ?? '') ?>">

    <label>Postal Code</label>
    <input type="text" name="postal_code" value="<?= htmlspecialchars($user['postal_code'] ?? '') ?>">

    <button class="btn" type="submit">Update</button>
    <a class="btn" href="list.php">Cancel</a>
  </form>
</body>
</html>
