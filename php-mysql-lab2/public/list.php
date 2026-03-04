<?php
// list.php - Show rows with Edit/Delete actions.
require __DIR__ . '/../app/config.php';

$users = [];
try {
  $stmt = $pdo->query(
    'SELECT id, first_name, middle_name, last_name, suffix, email, phone,
            gender, birthdate, barangay, city_municipality, province, postal_code, created_at
     FROM users ORDER BY id DESC'
  );
  $users = $stmt->fetchAll();
} catch (PDOException $e) { $users = []; }

function format_name($r){
  $first=$r['first_name']??''; $mid=$r['middle_name']??''; $last=$r['last_name']??''; $suf=$r['suffix']??'';
  $mi = ($mid!=='') ? strtoupper(mb_substr($mid,0,1)).'.' : '';
  $parts = array_filter([$last.',',$first,$mi,$suf]);
  return implode(' ',$parts);
}
function format_addr($r){
  $bits = array_filter([$r['barangay']??'', $r['city_municipality']??'', $r['province']??'', $r['postal_code']??'']);
  return empty($bits) ? '—' : implode(', ', $bits);
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CRUD Lab – Users</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Users</h1>
  <p><a class="btn" href="index.html">+ Add New</a></p>

  <?php if (empty($users)): ?>
    <p>No users yet.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th>
          <th>Gender</th><th>Birthdate</th><th>Address</th><th>Created</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><?= htmlspecialchars($u['id']) ?></td>
          <td><?= htmlspecialchars(format_name($u)) ?></td>
          <td><?= htmlspecialchars($u['email']) ?></td>
          <td><?= htmlspecialchars($u['phone'] ?: '—') ?></td>
          <td><?= htmlspecialchars($u['gender'] ?: '—') ?></td>
          <td><?= htmlspecialchars($u['birthdate'] ?: '—') ?></td>
          <td><?= htmlspecialchars(format_addr($u)) ?></td>
          <td><?= htmlspecialchars($u['created_at']) ?></td>
          <td class="actions">
            <a class="btn" href="edit.php?id=<?= urlencode($u['id']) ?>">Edit</a>
            <form action="../app/delete.php" method="post" onsubmit="return confirm('Delete this user?');">
              <input type="hidden" name="id" value="<?= htmlspecialchars($u['id']) ?>">
              <button class="btn" type="submit">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>
