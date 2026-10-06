<?php
require_once '../config/db.php';
require_once 'auth_check.php';
$pageTitle = 'Admin Dashboard';
$basePath = '../';

$result = $conn->query("SELECT * FROM places ORDER BY id ASC");

include '../includes/header.php';
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 admin-sidebar p-3">
      <h2 class="admin-brand"><i class="bi bi-compass"></i> Admin panel</h2>
      <p class="mb-3 small" style="opacity:0.75;">Logged in as <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></p>
      <a href="dashboard.php" class="active"><i class="bi bi-geo-alt"></i> Manage places</a>
      <a href="add.php"><i class="bi bi-plus-circle"></i> Add new place</a>
      <a href="../index.php"><i class="bi bi-box-arrow-up-right"></i> View site</a>
      <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Log out</a>
    </div>

    <div class="col-md-10 py-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <span class="section-eyebrow">Admin</span>
          <h1 class="h4 section-title mb-0">Manage places (<?php echo $result->num_rows; ?>)</h1>
        </div>
        <a href="add.php" class="btn btn-brand"><i class="bi bi-plus-lg me-1"></i>Add new place</a>
      </div>

      <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success"><i class="bi bi-check-circle me-1"></i><?php echo htmlspecialchars($_GET['msg']); ?></div>
      <?php endif; ?>

      <div class="table-responsive admin-card p-2">
        <table class="table table-admin align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Category</th>
              <th>Distance</th>
              <th>Travel time</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($p = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $p['id']; ?></td>
              <td><?php echo htmlspecialchars($p['name']); ?></td>
              <td><span class="category-pill cat-<?php echo $p['category']; ?>"><?php echo $p['category']; ?></span></td>
              <td><?php echo $p['distance_km']; ?> km</td>
              <td><?php echo htmlspecialchars($p['travel_time']); ?></td>
              <td>
                <a href="edit.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i> Edit</a>
                <a href="delete.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this place?');"><i class="bi bi-trash"></i> Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
