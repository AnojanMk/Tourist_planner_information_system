<?php
require_once 'config/db.php';
$pageTitle = 'Map';
$basePath = '';

$result = $conn->query("SELECT id, name, category, latitude, longitude, distance_km, travel_time FROM places");
$places = [];
while ($row = $result->fetch_assoc()) {
    $places[] = $row;
}

include 'includes/header.php';
?>

<div class="container my-4">
  <div class="mb-4 reveal">
    <span class="section-eyebrow">Interactive map</span>
    <h1 class="h3 section-title mb-1">Places near Mutur</h1>
    <p class="text-muted mb-0">All <?php echo count($places); ?> documented places within the 25km planning radius of Mutur, Sri Lanka.</p>
  </div>
  <div id="map" class="reveal"></div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const homeLat = <?php echo HOME_LAT; ?>;
  const homeLng = <?php echo HOME_LNG; ?>;
  const places = <?php echo json_encode($places); ?>;

  const map = L.map('map').setView([homeLat, homeLng], 10);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // Home marker
  L.marker([homeLat, homeLng], {
    icon: L.divIcon({ className: 'home-marker', html: '<div style="background:#e0a72e;color:#0a3630;padding:4px 10px;border-radius:20px;font-size:12px;font-weight:700;white-space:nowrap;box-shadow:0 2px 8px rgba(0,0,0,0.25);">Mutur (Home)</div>' })
  }).addTo(map);

  // 25km planning radius
  L.circle([homeLat, homeLng], {
    radius: 25000,
    color: '#1c6e62',
    fillColor: '#1c6e62',
    fillOpacity: 0.06,
    weight: 1.5,
    dashArray: '6 6'
  }).addTo(map);

  // Place markers
  places.forEach(p => {
    L.marker([parseFloat(p.latitude), parseFloat(p.longitude)])
      .addTo(map)
      .bindPopup(
        '<strong>' + p.name + '</strong><br>' +
        p.category.charAt(0).toUpperCase() + p.category.slice(1) + '<br>' +
        p.distance_km + ' km &middot; ' + p.travel_time +
        '<br><a href="place-detail.php?id=' + p.id + '">View details</a>'
      );
  });
</script>

<?php include 'includes/footer.php'; ?>
