<?php
require_once 'config/db.php';
$pageTitle = 'Places';
$basePath = '';

$category = isset($_GET['category']) ? $_GET['category'] : '';
$allowedCategories = ['religious', 'nature', 'heritage', 'cultural', 'entertainment'];

if ($category !== '' && in_array($category, $allowedCategories, true)) {
    $stmt = $conn->prepare("SELECT * FROM places WHERE category = ? ORDER BY distance_km ASC");
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM places ORDER BY distance_km ASC");
}

$catIcons = [
    'religious' => 'bi-flower1',
    'nature' => 'bi-tree',
    'heritage' => 'bi-bank',
    'cultural' => 'bi-palette',
    'entertainment' => 'bi-controller',
];

include 'includes/header.php';
?>

<div class="container my-4">
  <div class="mb-4 reveal">
    <span class="section-eyebrow">Places of interest</span>
    <h1 class="h3 section-title mb-0">All documented places near Mutur</h1>
  </div>

  <div class="filter-bar mb-4 reveal">
    <form method="get" class="d-flex flex-wrap gap-2 align-items-center">
      <label for="category" class="fw-semibold me-2 mb-0"><i class="bi bi-funnel me-1"></i>Filter by category:</label>
      <select name="category" id="category" class="form-select w-auto" onchange="this.form.submit()">
        <option value="">All categories</option>
        <?php foreach ($allowedCategories as $cat): ?>
          <option value="<?php echo $cat; ?>" <?php echo $category === $cat ? 'selected' : ''; ?>><?php echo ucfirst($cat); ?></option>
        <?php endforeach; ?>
      </select>
      <?php if ($category): ?>
        <a href="places.php" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-circle me-1"></i>Clear filter</a>
      <?php endif; ?>
    </form>
  </div>

  <div class="row g-4">
    <?php if ($result->num_rows === 0): ?>
      <p class="text-muted">No places found in this category.</p>
    <?php endif; ?>
    <?php while ($place = $result->fetch_assoc()):
      $placeJson = htmlspecialchars(json_encode([
        'id' => (int)$place['id'],
        'name' => $place['name'],
        'category' => $place['category'],
        'distance_km' => (float)$place['distance_km'],
        'travel_time' => $place['travel_time'],
      ]), ENT_QUOTES);
      $icon = $catIcons[$place['category']] ?? 'bi-geo-alt';
    ?>
    <div class="col-sm-6 col-md-4 reveal">
      <div class="card place-card">
        <div class="card-img-wrap">
          <img src="<?php echo htmlspecialchars($place['image_url'] ?: 'assets/img/placeholder.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($place['name']); ?>" onerror="this.src='assets/img/placeholder.jpg'">
        </div>
        <div class="card-body d-flex flex-column">
          <span class="category-pill cat-<?php echo $place['category']; ?>"><i class="bi <?php echo $icon; ?>"></i> <?php echo $place['category']; ?></span>
          <h3 class="h6 mt-2 mb-1"><?php echo htmlspecialchars($place['name']); ?></h3>
          <p class="distance-tag mb-3"><span class="dot"><i class="bi bi-signpost-split"></i></span> <?php echo $place['distance_km']; ?> km from Mutur &middot; <?php echo htmlspecialchars($place['travel_time']); ?></p>
          <div class="mt-auto d-flex gap-2">
            <a href="place-detail.php?id=<?php echo $place['id']; ?>" class="btn btn-sm btn-brand">Details</a>
            <button class="btn btn-sm btn-outline-secondary btn-add-plan" data-place='<?php echo $placeJson; ?>'><i class="bi bi-bookmark-plus"></i> Add</button>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
