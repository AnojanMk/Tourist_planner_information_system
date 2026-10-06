# Local Tourist Day-Visit Planner and Information System — Mutur

ITE2953 Programming Group Project (25S1) — individual project by [your name].
A tourism information and one-day visit-planning web app for **Mutur, Sri Lanka**
and places of interest within a 25km radius.

## Tech stack
- HTML5, CSS3, JavaScript, Bootstrap 5
- PHP (runs on XAMPP)
- MySQL (runs on XAMPP)
- Leaflet.js + OpenStreetMap for maps
- Git + GitHub for version control

## Setup instructions (XAMPP)

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**.
2. Copy this whole `mutur-tourist-planner` folder into `htdocs`:
   - Windows: `C:\xampp\htdocs\mutur-tourist-planner`
   - Mac: `/Applications/XAMPP/htdocs/mutur-tourist-planner`
3. Open `http://localhost/phpmyadmin`, click **Import**, and import
   `database/schema.sql`. This creates the `mutur_tourist` database with the
   `places`, `admins`, and `stakeholder_feedback` tables, plus 10 seeded places.
4. Visit `http://localhost/mutur-tourist-planner/` in your browser.
5. Admin panel: `http://localhost/mutur-tourist-planner/admin/login.php`
   - Username: `admin`
   - Password: `admin123`
   - **Change this password (or the seeded hash) before your final submission.**

## Project structure
```
mutur-tourist-planner/
├── admin/              # Admin panel (login, dashboard, add/edit/delete)
├── assets/
│   ├── css/style.css
│   ├── img/            # Place photos (replace placeholders with real photos)
│   └── js/planner.js   # localStorage-based visit planner logic
├── config/db.php       # DB connection + Mutur home coordinates
├── database/schema.sql # Full schema + 10 seeded places
├── includes/           # header.php / footer.php (shared layout)
├── index.php           # Home page
├── places.php          # List + category filter
├── place-detail.php    # Single place details + mini map
├── map.php             # Full map (all places + 25km radius circle)
└── planner.php         # One-day visit plan builder (localStorage)
```

## Place coordinates — verified
The GPS coordinates in `database/schema.sql` for the 10 places were
**verified directly from the Google Maps links you provided** (fetched
2026-08-10). If you already imported the database earlier with the older
estimated coordinates, run `database/update_coordinates.sql` in
phpMyAdmin (Import or SQL tab) to correct them without re-importing
everything.

## Places currently documented (10)
| # | Place | Category | Distance | Travel time |
|---|-------|----------|----------|--------------|
| 1 | Sampur Beach | Nature | 7 km | 10-15 min |
| 2 | Sampur Lighthouse (Foul Point) | Heritage | 13.1 km | 35 min |
| 3 | Sampur Paththirakaali Amman Kovil | Religious | 7.6 km | 18 min |
| 4 | Mutur Entertainment Park | Entertainment | 2.5 km | 7 min |
| 5 | Robert Knox's Tamarind Tree | Heritage | 2 km | 6 min |
| 6 | Gangai Beach Resort | Nature | 7.2 km | 13 min |
| 7 | Kadatkaraichenai Beach | Nature | 5.8 km | 8 min |
| 8 | Kaddaiparichchan Katpaka Vinayagar Kovil | Religious | 3.7 km | 7 min |
| 9 | Lankapatuna Samudragiri Viharaya | Religious | 22.7 km | 45 min |
| 10 | Galkanda Temple | Religious | 7 km | 10-15 min |

## Features implemented
**Tourist:** view all places, filter by category, view place details
(description, opening times, travel tips, distance), view all locations on
a map, build a one-day visit plan (saved in browser via localStorage).

**Administrator:** secure login, add / edit / delete place information.

## Still needed for full deliverables (per project spec)
- [ ] SRS document, including stakeholder consultation evidence
- [ ] ER diagram, UI mockups
- [ ] Replace placeholder images in `assets/img/` with real photos
- [ ] Verify all 10 coordinates against Google Maps (see above)
- [ ] Git commit history throughout development (see `.git` in this repo)
- [ ] Final presentation and demo script
