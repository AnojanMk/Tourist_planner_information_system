<?php
require_once 'config/db.php';
$basePath = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $conn->prepare("SELECT * FROM places WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$place = $stmt->get_result()->fetch_assoc();

if (!$place) {
    header('Location: places.php');
    exit;
}

$pageTitle = $place['name'];
$placeJson = htmlspecialchars(json_encode([
    'id' => (int)$place['id'],
    'name' => $place['name'],
    'category' => $place['category'],
    'distance_km' => (float)$place['distance_km'],
    'travel_time' => $place['travel_time'],
]), ENT_QUOTES);

include 'includes/header.php';
?>

<div class="container my-4">
  <nav aria-label="breadcrumb" class="reveal">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="places.php">Places</a></li>
      <li class="breadcrumb-item active"><?php echo htmlspecialchars($place['name']); ?></li>
    </ol>
  </nav>

  <div class="row g-4">
    <div class="col-md-7 reveal">
      <img src="<?php echo htmlspecialchars($place['image_url'] ?: 'assets/img/placeholder.jpg'); ?>" class="detail-hero-img mb-3" alt="<?php echo htmlspecialchars($place['name']); ?>" onerror="this.src='assets/img/placeholder.jpg'">

      <span class="category-pill cat-<?php echo $place['category']; ?>"><?php echo $place['category']; ?></span>
      <h1 class="h3 mt-2"><?php echo htmlspecialchars($place['name']); ?></h1>
      <p class="lead"><?php echo nl2br(htmlspecialchars($place['description'])); ?></p>

      <?php if ($place['travel_tips']): ?>
      <div class="alert alert-tips">
        <strong><i class="bi bi-lightbulb me-1"></i>Travel tips:</strong> <?php echo nl2br(htmlspecialchars($place['travel_tips'])); ?>
      </div>
      <?php endif; ?>

      <button class="btn btn-brand btn-add-plan" data-place='<?php echo $placeJson; ?>'><i class="bi bi-bookmark-plus me-1"></i>Add to my visit plan</button>
      <a href="map.php" class="btn btn-outline-secondary"><i class="bi bi-map me-1"></i>View on full map</a>
    </div>

    <div class="col-md-5 reveal">
      <div class="detail-info-card p-4 mb-3">
        <h2 class="h6 mb-3"><i class="bi bi-info-circle me-1"></i>Essential details</h2>
        <ul class="list-unstyled mb-0">
          <li class="d-flex justify-content-between"><span class="text-muted">Distance from Mutur</span><strong><?php echo $place['distance_km']; ?> km</strong></li>
          <li class="d-flex justify-content-between"><span class="text-muted">Travel time</span><strong><?php echo htmlspecialchars($place['travel_time']); ?></strong></li>
          <li class="d-flex justify-content-between"><span class="text-muted">Opening hours</span><strong><?php echo date('g:i A', strtotime($place['opening_time'])); ?> - <?php echo date('g:i A', strtotime($place['closing_time'])); ?></strong></li>
          <li class="d-flex justify-content-between"><span class="text-muted">Category</span><strong><?php echo ucfirst($place['category']); ?></strong></li>
        </ul>
      </div>
      <div id="detailMap"></div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
 const map = L.map('detailMap', { zoomControl: true }).setView([<?php echo $place['latitude']; ?>, <?php echo $place['longitude']; ?>], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

const routingControl = L.Routing.control({
  waypoints: [
    L.latLng(<?php echo HOME_LAT; ?>, <?php echo HOME_LNG; ?>),
    L.latLng(<?php echo $place['latitude']; ?>, <?php echo $place['longitude']; ?>)
  ],
  routeWhileDragging: false,
  addWaypoints: false,
  draggableWaypoints: false,
  fitSelectedRoutes: true,
  show: true,
  lineOptions: {
    styles: [{ color: '#1c6e62', weight: 5, opacity: 0.8 }]
  },
  createMarker: function(i, wp) {
    const label = i === 0 ? 'Mutur (home point)' : '<?php echo addslashes($place['name']); ?>';
    return L.marker(wp.latLng).bindPopup(label);
  }
}).addTo(map);
</script>

<?php include 'includes/footer.php'; ?>
