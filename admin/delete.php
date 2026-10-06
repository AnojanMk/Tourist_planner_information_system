<?php
require_once '../config/db.php';
require_once 'auth_check.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM places WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
}

header('Location: dashboard.php?msg=Place+deleted');
exit;
