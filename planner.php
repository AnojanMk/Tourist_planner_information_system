<?php
require_once 'config/db.php';
$pageTitle = 'My Plan';
$basePath = '';
include 'includes/header.php';
?>

<div class="container my-4">
  <div class="mb-4 reveal">
    <span class="section-eyebrow">Your itinerary</span>
    <h1 class="h3 section-title mb-1">My one-day visit plan</h1>
    <p class="text-muted mb-0">Places you add from the list or detail pages appear here. This plan is saved in your browser only.</p>
  </div>

  <div id="planContainer" class="reveal">
    <div class="plan-empty" id="emptyPlanMsg">
      <i class="bi bi-bookmark-heart" style="font-size:2.2rem;color:#e0a72e;"></i>
      <p class="text-muted mt-2 mb-0">Your plan is empty. <a href="places.php">Browse places</a> to get started.</p>
    </div>
  </div>

  <div class="d-flex gap-2 mt-3" id="planActions" style="display:none;">
    <button class="btn btn-outline-danger" id="clearPlanBtn"><i class="bi bi-trash me-1"></i>Clear plan</button>
    <a href="map.php" class="btn btn-brand"><i class="bi bi-map me-1"></i>View selected places on map</a>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  renderPlan();

  document.getElementById('clearPlanBtn')?.addEventListener('click', function () {
    if (confirm('Remove all places from your plan?')) {
      clearPlan();
      renderPlan();
    }
  });
});

function renderPlan() {
  const plan = getPlan();
  const container = document.getElementById('planContainer');
  const emptyMsg = document.getElementById('emptyPlanMsg');
  const actions = document.getElementById('planActions');

  container.innerHTML = '';

  if (plan.length === 0) {
    container.appendChild(emptyMsg);
    actions.style.display = 'none';
    return;
  }

  actions.style.display = 'flex';

  let totalDistance = 0;
  plan.forEach((place, index) => {
    totalDistance += parseFloat(place.distance_km || 0);
    const item = document.createElement('div');
    item.className = 'plan-item d-flex justify-content-between align-items-center';
    item.style.animationDelay = (index * 0.05) + 's';
    item.innerHTML =
      '<div class="d-flex align-items-center gap-3">' +
        '<span class="badge bg-secondary">' + (index + 1) + '</span>' +
        '<div>' +
          '<strong>' + place.name + '</strong>' +
          '<div class="text-muted small">' + place.category + ' &middot; ' + place.distance_km + ' km &middot; ' + place.travel_time + '</div>' +
        '</div>' +
      '</div>' +
      '<div>' +
        '<a href="place-detail.php?id=' + place.id + '" class="btn btn-sm btn-outline-secondary me-2">Details</a>' +
        '<button class="btn btn-sm btn-outline-danger" onclick="removeAndRerender(' + place.id + ')"><i class="bi bi-x-lg"></i></button>' +
      '</div>';
    container.appendChild(item);
  });

  const summary = document.createElement('div');
  summary.className = 'alert alert-tips mt-3';
  summary.innerHTML = '<i class="bi bi-signpost-2 me-1"></i><strong>' + plan.length + '</strong> place(s) selected &middot; approx. <strong>' + totalDistance.toFixed(1) + ' km</strong> total one-way distance from Mutur';
  container.appendChild(summary);
}

function removeAndRerender(id) {
  removeFromPlan(id);
  renderPlan();
}
</script>

<?php include 'includes/footer.php'; ?>
