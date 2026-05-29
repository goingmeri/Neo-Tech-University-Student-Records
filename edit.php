<?php
require 'config.php';
session_start();

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if (!$id) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $age    = (int)($_POST['age'] ?? 0);

    if ($name && $email && $course && $age > 0) {
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, course=?, age=? WHERE id=?");
        $stmt->bind_param('sssii', $name, $email, $course, $age, $id);
        if ($stmt->execute()) {
            $_SESSION['flash'] = ['type' => 'ok', 'text' => 'Student updated successfully.'];
            header('Location: index.php'); exit;
        } else {
            $error = 'Could not update: ' . $stmt->error;
        }
    } else {
        $error = 'Please fill all fields with valid values.';
    }
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
$stmt->bind_param('i', $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
if (!$student) { $_SESSION['flash'] = ['type'=>'err','text'=>'Student not found.']; header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Edit Student</title><link rel="stylesheet" href="style.css"></head>
<body>
  <div class="container">
    <h1>Edit Student</h1>
    <?php if (!empty($error)): ?><div class="msg err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <div class="card">
      <form method="post">
        <input type="hidden" name="id" value="<?= (int)$student['id'] ?>">
        <div class="row">
          <div><label>Name</label><input name="name" required value="<?= htmlspecialchars($student['name']) ?>"></div>
          <div><label>Email</label><input name="email" type="email" required value="<?= htmlspecialchars($student['email']) ?>"></div>
        </div>
        <div class="row">
          <div><label>Course</label><input name="course" required value="<?= htmlspecialchars($student['course']) ?>"></div>
          <div><label>Age</label><input name="age" type="number" min="1" required value="<?= (int)$student['age'] ?>"></div>
        </div>
        <div style="margin-top:16px">
          <button class="btn btn-success" type="submit">Update</button>
          <a class="btn btn-muted" href="index.php">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
