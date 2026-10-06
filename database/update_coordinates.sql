-- ============================================================
-- Run this ONLY if you already imported schema.sql earlier and
-- just want to fix the 10 places' GPS coordinates.
-- Import via phpMyAdmin -> mutur_tourist database -> Import tab
-- (or SQL tab -> paste and Go).
-- Verified against the Google Maps links supplied on 2026-08-10.
-- ============================================================
USE mutur_tourist;

UPDATE places SET latitude = 8.4870348, longitude = 81.2879746 WHERE name = 'Sampur Beach';
UPDATE places SET latitude = 8.5253317, longitude = 81.3186886 WHERE name = 'Sampur Lighthouse (Foul Point)';
UPDATE places SET latitude = 8.4876304, longitude = 81.2980316 WHERE name = 'Sampur Paththirakaali Amman Kovil';
UPDATE places SET latitude = 8.4471493, longitude = 81.2551448 WHERE name = 'Mutur Entertainment Park';
UPDATE places SET latitude = 8.4497945, longitude = 81.2579932 WHERE name = 'Robert Knox\'s Tamarind Tree';
UPDATE places SET latitude = 8.4615518, longitude = 81.2324514 WHERE name = 'Gangai Beach Resort';
UPDATE places SET latitude = 8.4693221, longitude = 81.2814015 WHERE name = 'Kadatkaraichenai Beach';
UPDATE places SET latitude = 8.4524481, longitude = 81.2877150 WHERE name = 'Kaddaiparichchan Katpaka Vinayagar Kovil';
UPDATE places SET latitude = 8.3574019, longitude = 81.3898311 WHERE name = 'Lankapatuna Samudragiri Viharaya';
UPDATE places SET latitude = 8.4184668, longitude = 81.2698693 WHERE name = 'Galkanda Temple';
