<?php
require 'config.php';
session_start();
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Records</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Student Records</h1>
    <?php if ($flash): ?>
      <div class="msg <?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['text']) ?></div>
    <?php endif; ?>

    <div class="card">
      <a class="btn btn-primary" href="create.php">+ Add Student</a>
    </div>

    <div class="card">
      <?php if ($result && $result->num_rows > 0): ?>
        <table>
          <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Age</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= (int)$row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['course']) ?></td>
                <td><?= (int)$row['age'] ?></td>
                <td>
                  <a class="btn btn-warn" href="edit.php?id=<?= (int)$row['id'] ?>">Edit</a>
                  <a class="btn btn-danger" href="delete.php?id=<?= (int)$row['id'] ?>" onclick="return confirm('Delete this student?');">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No students yet. Click "Add Student" to create one.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
