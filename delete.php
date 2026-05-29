<?php
require 'config.php';
session_start();

$id = (int)($_GET['id'] ?? 0);
if ($id) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $_SESSION['flash'] = ['type' => 'ok', 'text' => 'Student deleted.'];
    } else {
        $_SESSION['flash'] = ['type' => 'err', 'text' => 'Could not delete: ' . $stmt->error];
    }
}
header('Location: index.php');
exit;
