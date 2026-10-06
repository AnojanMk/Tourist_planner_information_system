-- ============================================================
-- Mutur Local Tourist Day-Visit Planner and Information System
-- Database: mutur_tourist
-- Import this file via phpMyAdmin (XAMPP) to set up the DB
-- ============================================================

CREATE DATABASE IF NOT EXISTS mutur_tourist CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mutur_tourist;

-- ------------------------------------------------------------
-- Table: places
-- ------------------------------------------------------------
DROP TABLE IF EXISTS places;
CREATE TABLE places (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category ENUM('religious','nature','heritage','cultural','entertainment') NOT NULL,
    description TEXT,
    latitude DECIMAL(10,7) NOT NULL,
    longitude DECIMAL(10,7) NOT NULL,
    distance_km DECIMAL(5,2) NOT NULL,
    travel_time VARCHAR(50),
    opening_time TIME DEFAULT '08:00:00',
    closing_time TIME DEFAULT '18:00:00',
    travel_tips TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- Table: admins
-- ------------------------------------------------------------
DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Default admin login -> username: admin / password: admin123
-- (password is hashed with PHP password_hash on insert below)
INSERT INTO admins (username, password) VALUES
('admin', '$2y$10$iXKPh9QvPNgBzRE50kyts.QsavaO3xBnkSF3hKpQHZmcaN82p933y');
-- NOTE: the hash above corresponds to the plaintext password: admin123

-- ------------------------------------------------------------
-- Table: stakeholder_feedback (evidence for SRS requirement)
-- ------------------------------------------------------------
DROP TABLE IF EXISTS stakeholder_feedback;
CREATE TABLE stakeholder_feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stakeholder_name VARCHAR(100),
    question TEXT,
    response TEXT,
    date_collected DATE
);

-- ------------------------------------------------------------
-- Seed data: 10 places around Mutur (home point: 8.4579065, 81.2684019)
-- Coordinates below are VERIFIED from the Google Maps links you provided
-- (fetched on 2026-08-10).
-- ------------------------------------------------------------
INSERT INTO places (name, category, description, latitude, longitude, distance_km, travel_time, opening_time, closing_time, travel_tips, image_url) VALUES
('Sampur Beach', 'nature', 'A quiet, unspoiled coastal stretch on Koddiyar Bay near Sampur, popular for calm waters and peaceful evening walks.', 8.4870348, 81.2879746, 7.00, '10-15 min', '06:00:00', '18:30:00', 'Best visited in the early morning or at sunset. Carry drinking water as facilities are limited.', 'assets/img/sampur-beach.jpg'),
('Sampur Lighthouse (Foul Point)', 'heritage', 'A historic 1863 colonial-era lighthouse marking the southern entrance to Trincomalee Harbour, offering scenic coastal views.', 8.5253317, 81.3186886, 13.10, '35 min', '08:00:00', '17:00:00', 'The final stretch of road is unpaved and rough - a trishaw or 4WD is recommended. Best for sunrise or sunset photography.', 'assets/img/foul-point-lighthouse.jpg'),
('Sampur Paththirakaali Amman Kovil', 'religious', 'A revered Hindu temple dedicated to Goddess Paththirakaali, an important place of worship for the local community.', 8.4876304, 81.2980316, 7.60, '18 min', '06:00:00', '20:00:00', 'Dress modestly. Check for festival days (Kovil pooja times) before visiting for the full cultural experience.', 'assets/img/paththirakaali-kovil.jpg'),
('Mutur Entertainment Park', 'entertainment', 'A family-friendly recreational park in Mutur town with open spaces, seating areas, and evening activities for locals and visitors.', 8.4471493, 81.2551448, 2.50, '7 min', '15:00:00', '21:00:00', 'A good spot to relax with family in the evening. Small snack stalls are usually available nearby.', 'assets/img/mutur-entertainment-park.jpg'),
('Robert Knox\'s Tamarind Tree', 'heritage', 'A centuries-old tamarind tree linked to the legend of Robert Knox, the 17th-century English sailor held captive in Sri Lanka.', 8.4497945, 81.2579932, 2.00, '6 min', '07:00:00', '18:00:00', 'A short, easy visit that pairs well with a walk around Mutur town. Great for history enthusiasts.', 'assets/img/robert-knox-tamarind-tree.jpg'),
('Gangai Beach Resort', 'nature', 'A relaxing beachside resort area near Mutur offering scenic coastal views and a calm environment for a short getaway.', 8.4615518, 81.2324514, 7.20, '13 min', '07:00:00', '19:00:00', 'Good option if you want a short rest stop with refreshments during your day trip.', 'assets/img/gangai-beach-resort.jpg'),
('Kadatkaraichenai Beach', 'nature', 'A scenic, less-crowded beach along the Mutur coastline, ideal for a peaceful walk and photography.', 8.4693221, 81.2814015, 5.80, '8 min', '06:00:00', '18:30:00', 'Currents can be strong in places - swim with caution. Best light for photos is early morning.', 'assets/img/kadatkaraichenai-beach.jpg'),
('Kaddaiparichchan Katpaka Vinayagar Kovil', 'religious', 'A well-known Vinayagar (Ganesha) temple serving the local Hindu community, known for its peaceful atmosphere.', 8.4524481, 81.2877150, 3.70, '7 min', '06:00:00', '20:00:00', 'Remove footwear before entering. Visit during morning pooja hours for the full experience.', 'assets/img/katpaka-vinayagar-kovil.jpg'),
('Lankapatuna Samudragiri Viharaya', 'religious', 'A significant Buddhist temple and stupa complex by the sea, historically linked to the arrival of the Sacred Tooth Relic in Sri Lanka.', 8.3574019, 81.3898311, 22.70, '45 min', '06:00:00', '18:00:00', 'The longest trip on this list - plan it as your first or last stop of the day. Combine with a coastal drive.', 'assets/img/lankapatuna-samudragiri.jpg'),
('Galkanda Temple', 'religious', 'A tranquil Buddhist temple set in a quiet inland setting, valued for its cultural and spiritual significance to the area.', 8.4184668, 81.2698693, 7.00, '10-15 min', '06:00:00', '19:00:00', 'A peaceful stop away from the coast - good for combining with the Vinayagar Kovil visit nearby.', 'assets/img/galkanda-temple.jpg');
