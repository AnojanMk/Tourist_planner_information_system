<?php
require_once __DIR__ . '/config/db.php';

if (!isset($conn) || !$conn) {
  die('Database connection failed.');
}

$pageTitle = 'Home';
$basePath = '';

// Fetch a few featured places (max 3) for the homepage preview
$featured = $conn->query("SELECT * FROM places ORDER BY distance_km ASC LIMIT 3");
$totalPlaces = $conn->query("SELECT COUNT(*) AS c FROM places")->fetch_assoc()['c'];

include 'includes/header.php';
?>

<section class="hero">
  <div class="container position-relative">
    <span class="eyebrow"><i class="bi bi-geo-alt-fill"></i> Koddiyar Bay, Eastern Sri Lanka</span>
    <h1>Discover Mutur in a day</h1>
    <p class="lead-sub">Plan a one-day visit to <?php echo $totalPlaces; ?> documented places of interest within 25km of Mutur &mdash; beaches, temples, heritage sites and more.</p>
    <div class="hero-actions">
      <a href="places.php" class="btn btn-amber btn-lg me-2"><i class="bi bi-compass me-1"></i>Explore places</a>
      <a href="planner.php" class="btn btn-outline-light btn-lg"><i class="bi bi-bookmark-plus me-1"></i>Start planning</a>
    </div>
  </div>
</section>

<div class="container my-5 pt-4">
  <div class="text-center mb-5 reveal">
    <span class="section-eyebrow">How it works</span>
    <h2 class="h3 section-title">Three steps to your day trip</h2>
  </div>
  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="step-card reveal">
        <div class="step-num mb-2">01 / BROWSE</div>
        <h3 class="h5 mb-2"><i class="bi bi-grid text-success"></i> Browse places</h3>
        <p class="text-muted mb-0">View religious, nature, heritage and cultural spots around Mutur, filtered by category.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="step-card reveal">
        <div class="step-num mb-2">02 / LOCATE</div>
        <h3 class="h5 mb-2"><i class="bi bi-map text-primary"></i> Check the map</h3>
        <p class="text-muted mb-0">See exact locations, distance from Mutur, and travel time for each place.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="step-card reveal">
        <div class="step-num mb-2">03 / PLAN</div>
        <h3 class="h5 mb-2"><i class="bi bi-bookmark-heart text-danger"></i> Build your plan</h3>
        <p class="text-muted mb-0">Select the places you want to visit and put together your own one-day itinerary.</p>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-end mb-4 reveal">
    <div>
      <span class="section-eyebrow">Nearby &amp; popular</span>
      <h2 class="h4 section-title mb-0">Places close to home</h2>
    </div>
    <a href="places.php" class="btn btn-sm btn-outline-secondary d-none d-sm-inline-block">View all <?php echo $totalPlaces; ?> places <i class="bi bi-arrow-right"></i></a>
  </div>

  <div class="row g-4">
    <?php while ($place = $featured->fetch_assoc()): ?>
    <div class="col-md-4 reveal">
      <div class="card place-card">
        <div class="card-img-wrap">
          <img src="<?php echo htmlspecialchars($place['image_url'] ?: 'assets/img/placeholder.jpg'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($place['name']); ?>" onerror="this.src='assets/img/placeholder.jpg'">
        </div>
        <div class="card-body">
          <span class="category-pill cat-<?php echo $place['category']; ?>"><?php echo $place['category']; ?></span>
          <h3 class="h6 mt-2 mb-1"><?php echo htmlspecialchars($place['name']); ?></h3>
          <p class="distance-tag mb-3"><span class="dot"><i class="bi bi-signpost-split"></i></span> <?php echo $place['distance_km']; ?> km from Mutur &middot; <?php echo htmlspecialchars($place['travel_time']); ?></p>
          <a href="place-detail.php?id=<?php echo $place['id']; ?>" class="btn btn-sm btn-brand">View details</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
