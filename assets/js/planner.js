// ============================================================
// Visit Planner - localStorage based (no login required)
// ============================================================
const PLAN_KEY = 'muturVisitPlan';

function getPlan() {
  const raw = localStorage.getItem(PLAN_KEY);
  return raw ? JSON.parse(raw) : [];
}

function savePlan(plan) {
  localStorage.setItem(PLAN_KEY, JSON.stringify(plan));
  updatePlanBadge();
}

function addToPlan(place) {
  const plan = getPlan();
  if (plan.some(p => p.id === place.id)) {
    return { added: false, reason: 'already-in-plan' };
  }
  plan.push(place);
  savePlan(plan);
  return { added: true };
}

function removeFromPlan(placeId) {
  let plan = getPlan();
  plan = plan.filter(p => p.id !== placeId);
  savePlan(plan);
}

function clearPlan() {
  localStorage.removeItem(PLAN_KEY);
  updatePlanBadge();
}

function updatePlanBadge() {
  const badge = document.getElementById('planCountBadge');
  if (badge) badge.textContent = getPlan().length;
}

// Handle "Add to plan" buttons present on any page (data-place attribute holds JSON)
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.btn-add-plan');
  if (!btn) return;
  e.preventDefault();
  const place = JSON.parse(btn.getAttribute('data-place'));
  const result = addToPlan(place);
  if (result.added) {
    btn.textContent = 'Added to plan';
    btn.classList.remove('btn-brand');
    btn.classList.add('btn-secondary');
    btn.disabled = true;
  } else {
    btn.textContent = 'Already in plan';
    btn.disabled = true;
  }
});

document.addEventListener('DOMContentLoaded', updatePlanBadge);
