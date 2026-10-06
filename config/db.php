<?php
// ============================================================
// Database connection (XAMPP default: user root, no password)
// ============================================================
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'mutur_tourist';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

// Home reference point: Mutur, Sri Lanka
define('HOME_LAT', 8.4579065);
define('HOME_LNG', 81.2684019);
