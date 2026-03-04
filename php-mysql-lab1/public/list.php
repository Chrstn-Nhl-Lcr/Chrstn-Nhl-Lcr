<?php
// list.php
// Purpose: Shows the latest rows from the users table.

require __DIR__ . '/../app/config.php';

$users = [];
try {
  $stmt = $pdo->query('SELECT id, full_name, email, created_at FROM users ORDER BY id DESC LIMIT 10');
  $users = $stmt->fetchAll();
} catch (PDOException $e) {
  $users = [];
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PHP ⇄ MySQL Lab (List)</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Latest Users</h1>
  <p><a href="index.html">← Back to Form</a></p>

  <?php if (empty($users)): ?>
    <p>No users yet. Add one from the form.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Created</th></tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>
            <td><?= htmlspecialchars($u['id']) ?></td>
            <td><?= htmlspecialchars($u['full_name']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>
