<?php
require_once '../config/db.php';
session_start();
$pageTitle = 'Admin Login';
$basePath = '../';

if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}

include '../includes/header.php';
?>

<div class="hero" style="padding:70px 0 110px;">
  <div class="container position-relative">
    <span class="eyebrow"><i class="bi bi-shield-lock"></i> Restricted area</span>
    <h1 style="font-size:2rem;">Admin login</h1>
  </div>
</div>

<div class="container" style="margin-top:-70px; margin-bottom: 60px;">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="login-card p-4 p-md-5">
        <?php if ($error): ?>
          <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-1"></i><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post">
          <div class="mb-3">
            <label class="form-label fw-semibold">Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
          </div>
          <div class="mb-4">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-brand w-100"><i class="bi bi-box-arrow-in-right me-1"></i>Log in</button>
        </form>
        <p class="text-muted small mt-3 mb-0 text-center">Default demo login: <code>admin</code> / <code>admin123</code></p>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
