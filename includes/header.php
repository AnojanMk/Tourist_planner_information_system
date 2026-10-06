<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - One day Tourist Planner' : 'One day Tourist Planner'; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?php echo isset($basePath) ? $basePath : ''; ?>assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo isset($basePath) ? $basePath : ''; ?>index.php">
      <span class="brand-mark"></span>  DayLens 
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo isset($basePath) ? $basePath : ''; ?>index.php"><i class="bi bi-house-door me-1"></i>Home</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo isset($basePath) ? $basePath : ''; ?>places.php"><i class="bi bi-geo-alt me-1"></i>Places</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo isset($basePath) ? $basePath : ''; ?>map.php"><i class="bi bi-map me-1"></i>Map</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo isset($basePath) ? $basePath : ''; ?>planner.php"><i class="bi bi-bookmark-heart me-1"></i>My Plan
          <span class="badge rounded-pill plan-badge" id="planCountBadge">0</span>
        </a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo isset($basePath) ? $basePath : ''; ?>admin/login.php"><i class="bi bi-shield-lock me-1"></i>Admin</a></li>
      </ul>
    </div>
  </div>
</nav>
