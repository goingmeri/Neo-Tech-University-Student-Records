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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Records</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">

    <div class="page-header">
      <h1><span class="sub">Neo Tech University</span>Student Records</h1>
      <a class="btn btn-primary" href="create.php">+ Add Student</a>
    </div>

    <?php if ($flash): ?>
      <div class="alert <?= $flash['type'] === 'ok' ? 'alert-success' : 'alert-error' ?>">
        <?= htmlspecialchars($flash['text']) ?>
      </div>
    <?php endif; ?>

    <div class="table-wrap">
      <?php if ($result && $result->num_rows > 0): ?>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Course</th>
              <th>Age</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $display_id = 1; // 1. Start our visual counter at 1
            while ($row = $result->fetch_assoc()): 
            ?>
              <tr>
                <td class="id-cell"><?= str_pad($display_id, 3, '0', STR_PAD_LEFT) ?></td>
                <td class="name-cell"><?= htmlspecialchars($row['name']) ?></td>
                <td class="email-cell"><?= htmlspecialchars($row['email']) ?></td>
                <td><span class="badge badge-course"><?= htmlspecialchars($row['course']) ?></span></td>
                <td><span class="badge badge-age"><?= (int)$row['age'] ?></span></td>
                <td>
                  <div class="actions">
                    <a class="btn btn-warning btn-sm" href="edit.php?id=<?= (int)$row['id'] ?>">Edit</a>
                    <a class="btn btn-danger btn-sm" href="delete.php?id=<?= (int)$row['id'] ?>"
                       onclick="return confirm('Delete this student?');">Delete</a>
                  </div>
                </td>
              </tr>
            <?php 
            $display_id++; // 4. Bump the counter up by 1 for the next row
            endwhile; 
            ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="empty-state">
          <span class="icon">◈</span>
          <p>No students yet — click <strong>+ Add Student</strong> to create one.</p>
        </div>
      <?php endif; ?>
    </div>

  </div>
</body>
</html>