<?php
require_once '../config/db.php';
require_once 'auth_check.php';
$pageTitle = 'Add Place';
$basePath = '../';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $distance_km = $_POST['distance_km'];
    $travel_time = trim($_POST['travel_time']);
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];
    $travel_tips = trim($_POST['travel_tips']);
    $image_url = trim($_POST['image_url']);

    if ($name === '' || $latitude === '' || $longitude === '') {
        $error = 'Name, latitude and longitude are required.';
    } else {
        $stmt = $conn->prepare("INSERT INTO places (name, category, description, latitude, longitude, distance_km, travel_time, opening_time, closing_time, travel_tips, image_url) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('sssddsssss', $name, $category, $description, $latitude, $longitude, $distance_km, $travel_time, $opening_time, $closing_time, $travel_tips, $image_url);
        $stmt->execute();
        header('Location: dashboard.php?msg=Place+added+successfully');
        exit;
    }
}

include '../includes/header.php';
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 admin-sidebar p-3">
      <h2 class="admin-brand"><i class="bi bi-compass"></i> Admin panel</h2>
      <a href="dashboard.php"><i class="bi bi-geo-alt"></i> Manage places</a>
      <a href="add.php" class="active"><i class="bi bi-plus-circle"></i> Add new place</a>
      <a href="../index.php"><i class="bi bi-box-arrow-up-right"></i> View site</a>
      <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Log out</a>
    </div>
    <div class="col-md-10 py-4">
      <span class="section-eyebrow">Admin</span>
      <h1 class="h4 section-title mb-4">Add new place</h1>
      <?php if ($error): ?><div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-1"></i><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

      <form method="post" class="admin-card p-4">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Place name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Category</label>
            <select name="category" class="form-select" required>
              <option value="religious">Religious</option>
              <option value="nature">Nature</option>
              <option value="heritage">Heritage</option>
              <option value="cultural">Cultural</option>
              <option value="entertainment">Entertainment</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
          </div>
          <div class="col-md-4">
            <label class="form-label">Latitude</label>
            <input type="text" name="latitude" class="form-control" placeholder="e.g. 8.4579065" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Longitude</label>
            <input type="text" name="longitude" class="form-control" placeholder="e.g. 81.2684019" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Distance from Mutur (km)</label>
            <input type="number" step="0.01" name="distance_km" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Travel time</label>
            <input type="text" name="travel_time" class="form-control" placeholder="e.g. 15 min">
          </div>
          <div class="col-md-4">
            <label class="form-label">Opening time</label>
            <input type="time" name="opening_time" class="form-control" value="08:00">
          </div>
          <div class="col-md-4">
            <label class="form-label">Closing time</label>
            <input type="time" name="closing_time" class="form-control" value="18:00">
          </div>
          <div class="col-12">
            <label class="form-label">Travel tips</label>
            <textarea name="travel_tips" class="form-control" rows="2"></textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Image URL or path (e.g. assets/img/yourphoto.jpg)</label>
            <input type="text" name="image_url" class="form-control" placeholder="assets/img/placeholder.jpg">
          </div>
        </div>
        <button type="submit" class="btn btn-brand mt-4"><i class="bi bi-check-lg me-1"></i>Save place</button>
        <a href="dashboard.php" class="btn btn-outline-secondary mt-4">Cancel</a>
      </form>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
