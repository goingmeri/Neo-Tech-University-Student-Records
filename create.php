<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $age    = (int)($_POST['age'] ?? 0);

    if ($name && $email && $course && $age > 0) {
        $stmt = $conn->prepare("INSERT INTO students (name, email, course, age) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sssi', $name, $email, $course, $age);
        if ($stmt->execute()) {
            $_SESSION['flash'] = ['type' => 'ok', 'text' => 'Student added successfully.'];
            header('Location: index.php'); exit;
        } else {
            $error = 'Could not add student: ' . $stmt->error;
        }
    } else {
        $error = 'Please fill all fields with valid values.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Add Student</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div class="container">
    <h1>Add Student</h1>
    <?php if (!empty($error)): ?><div class="msg err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <div class="card">
      <form method="post">
        <div class="row">
          <div><label>Name</label><input name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"></div>
          <div><label>Email</label><input name="email" type="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></div>
        </div>
        <div class="row">
          <div><label>Course</label><input name="course" required value="<?= htmlspecialchars($_POST['course'] ?? '') ?>"></div>
          <div><label>Age</label><input name="age" type="number" min="1" required value="<?= htmlspecialchars($_POST['age'] ?? '') ?>"></div>
        </div>
        <div style="margin-top:16px">
          <button class="btn btn-success" type="submit">Save</button>
          <a class="btn btn-muted" href="index.php">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
