# FUTA Career Services & Career Fair Portal (FCCP)

> **FUTA Career Fair 2026**  
> Theme: *FUTA NextGen: Careers, Skills, Innovation and Industry*

A full-stack career services and career fair management platform for the Federal University of Technology, Akure (FUTA). Built on CodeIgniter 3 (PHP), the portal connects students, employers, alumni and administrators for internships, recruitment, CV matching, QR-based event check-in and post-event career support.

[![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)]
(https://php.net)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-orange.svg)](https://codeigniter.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-blue.svg)]
(https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)]
(LICENSE)
---

## Table of Contents

1. [Project Overview](#1-project-overview)
2. [Live Demo](#2-live-demo)
3. [Features](#3-features)
4. [Technology Stack](#4-technology-stack)
5. [Project Structure](#5-project-structure)
6. [Installation & Setup](#6-installation--setup)
7. [Configuration](#7-configuration)
8. [Database Setup](#8-database-setup)
9. [User Roles & Access](#9-user-roles--access)
10. [URL Routes Reference](#10-url-routes-reference)
11. [Frontend Assets](#11-frontend-assets)
12. [QR Check-in System](#12-qr-check-in-system)
13. [Security](#13-security)
14. [Deployment](#14-deployment)
15. [Known Issues & Roadmap](#15-known-issues--roadmap)
16. [Contributing](#16-contributing)
17. [Licence](#17-licence)

---

## 1. Project Overview

The FUTA Career Services & Career Fair Portal (FCCP) is designed as a **permanent digital career ecosystem** — not just a single-event website. It supports:

- Annual Career Fair management (booths, speakers, QR check-in)
- Year-round job and internship opportunities
- CV upload and employer-side talent matching
- Alumni mentoring and community
- Super Admin control panel with analytics, audit logs and site settings

---

## 2. Live Demo

| Environment | URL |
|---|---|
| Production | https://career.futa.edu.ng |
| Local Dev | http://careerfair.test:9090 |

**Demo credentials (change immediately on production):**

| Role | URL | Username | Password |
|---|---|---|---|
| Super Admin | `/admin` | `admin` | `admin123` |
| Check-in Officer | `/checkin` | `admin` | `admin123` |

---

## 3. Features

### Public Site
- Responsive homepage with auto-advancing hero slider (3 images)
- Live countdown to Career Fair 2026
- News & announcements
- Career Fair schedule and venue page with embedded Google Map
- Photo gallery and video section

### Student Portal (`/student`)
- Registration with school, department, level, career interest
- CV upload (PDF/DOCX) with discipline classification metadata
- Printable / laminatable QR event pass (passport photo + QR code)
- Passport photo self-upload for event pass
- Opportunity browsing (internships, NYSC, graduate jobs)
- Notification inbox (shortlist alerts, interview invitations)

### Employer Portal (`/employer`)
- Organisation registration and profile
- Talent Vault — search students by school, skills, level, career interest
- Candidate shortlisting with tags (Interested / Strong / Interview / etc.)
- Job and internship posting
- Exhibition booth request
- Career talk request

### QR Check-in System (`/checkin`)
- Camera-based QR scanner (jsQR — offline capable, no app needed)
- Real-time scan → verify → check-in flow (<1 second)
- Live attendance board (auto-refreshes every 30 seconds)
- Full scan log / report with print support
- Works on any Android or iPhone browser (Chrome / Safari)

### Super Admin Panel (`/admin`)
- Dashboard with 8 live KPI cards
- Student management — search, filter, status toggle, profile view
- Employer management — approve, suspend, view profile
- Booth request allocation with booth number and location
- Career talk scheduling
- News & announcements CRUD with image upload
- QR pass issuance and revocation
- Job/internship opportunity moderation
- Analytics — registration by school (bar chart), employer sectors
- CV submission rate tracker
- Audit log — every admin action with timestamp and IP
- Site settings — contact info, social media handles, welcome text
- Admin user management (Super Admin only)

---

## 4. Technology Stack

| Layer | Technology |
|---|---|
| Backend framework | CodeIgniter 3.x (PHP 7.4+) |
| Database | MySQL 8.0+ |
| Frontend CSS | Custom `careerfair.css` + `portal.css` + `admin.css` + `home.css` |
| Icons | Font Awesome 5 Pro (local `.ttf` files — zero CDN) |
| Fonts | Google Fonts — DM Sans (loaded from CDN) |
| QR scanning | [jsQR v1.4.0](https://github.com/cozmo/jsQR) (bundled locally) |
| Modals / Alerts | SweetAlert2 (bundled locally) |
| Animations | WOW.js + Animate.css |
| Web server | Apache (mod_rewrite + mod_headers) |
| Deployment | Shared hosting / VPS behind Cloudflare |

---

## 5. Project Structure

```
careerfair/
├── .htaccess                      # URL rewriting + CSP security headers
├── index.php                      # CodeIgniter bootstrap
│
├── application/
│   ├── config/
│   │   ├── config.php             # Base URL, session, encryption key
│   │   ├── database.php           # DB credentials (env-aware)
│   │   ├── routes.php             # 64 explicit named routes
│   │   ├── autoload.php           # Libraries: database, session, form_validation
│   │   └── constants.php         # SITE_TITLE, SITE_LOGO_PATH
│   │
│   ├── controllers/
│   │   ├── Home.php               # Public-facing site (22 routes)
│   │   ├── Student.php            # Student portal (10 routes)
│   │   ├── Employer.php           # Employer portal (8 routes)
│   │   ├── Alumni_portal.php      # Alumni portal (2 routes)
│   │   ├── Admin.php              # Super Admin panel (26 routes)
│   │   ├── Checkin.php            # QR check-in system (8 routes)
│   │   └── dependency.php        # Shared public bootstrap (nav/footer data)
│   │
│   ├── models/
│   │   ├── Home_model.php         # Public site queries (news, slider, gallery)
│   │   ├── Admin_model.php        # Admin CRUD (settings, news, users, menus)
│   │   ├── Student_model.php      # Student portal queries
│   │   └── Employer_model.php     # Employer portal queries
│   │
│   └── views/
│       ├── global/                # Shared partials (header, footer, CSS, JS)
│       ├── public/                # 22 public-facing views
│       ├── student/               # 10 student portal views
│       ├── employer/              # 8 employer portal views
│       ├── admin/                 # 23 admin panel views
│       ├── checkin/               # 4 check-in system views
│       └── alumni_portal/         # 3 alumni portal views
│
├── assetsp/
│   ├── css/
│   │   ├── careerfair.css         # Master theme (colours, header, footer, nav)
│   │   ├── home.css               # Homepage-specific styles
│   │   ├── portal.css             # Student/Employer/Alumni dashboard shared CSS
│   │   ├── admin.css              # Admin panel CSS
│   │   └── fa-icons.css           # Local Font Awesome (FA5 + FA6 compatible)
│   ├── js/
│   │   ├── jquery.js              # jQuery
│   │   ├── jsQR.js                # QR code decoder (offline, 256KB)
│   │   ├── sweetalert2.min.js     # Modal alerts
│   │   └── wow.js                 # Scroll animations
│   ├── images/                    # Site images, logos, hero photos
│   └── fonts/                     # FA5 font files (fa-solid-900.ttf, etc.)
│
├── uploads/
│   ├── cvs/                       # Student CV files (PDF/DOCX)
│   ├── photos/                    # Student passport photos
│   ├── logos/                     # Employer logos
│   ├── events/                    # News thumbnail images
│   └── qr/                        # Generated QR images (future)
│
└── docs/
    └── careerfair_database_schema.sql   # Full 33-table DB schema
```

---

## 6. Installation & Setup

### Requirements
- PHP 7.4 or 8.x
- MySQL 8.0+
- Apache with `mod_rewrite` and `mod_headers` enabled
- (Optional) Laragon, XAMPP or WAMP for local development

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/YOUR-ORG/futa-careerfair.git
cd futa-careerfair

# 2. Create the database in phpMyAdmin or CLI
mysql -u root -p -e "CREATE DATABASE careerfair CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 3. Import the schema
mysql -u root -p careerfair < docs/careerfair_database_schema.sql

# 4. Configure the application (see Section 7)
cp application/config/config.php.example application/config/config.php
# Edit base_url, encryption_key, session settings

# 5. Point your web server document root to:
#    /path/to/futa-careerfair/
#    (index.php must be at the root)

# 6. Ensure uploads/ is writable
chmod -R 755 uploads/
chmod -R 755 application/logs/
chmod -R 755 application/cache/
```

---

## 7. Configuration

### `application/config/config.php`

```php
$config['base_url']      = 'https://career.futa.edu.ng/';
$config['index_page']    = '';          // clean URLs via .htaccess
$config['encryption_key']= 'YOUR-32-CHAR-RANDOM-KEY';
$config['sess_driver']   = 'files';
$config['sess_expiration']= 7200;       // 2 hours
```

### `application/config/database.php`

```php
// Development (auto-detected)
'hostname' => '127.0.0.1',
'username' => 'root',
'password' => '',
'database' => 'careerfair',

// Production (reads environment variables)
'username' => getenv('DB_USERNAME'),
'password' => getenv('DB_PASSWORD'),
'database' => getenv('DB_NAME'),
```

Set these environment variables on your production server:

```bash
export DB_USERNAME=your_db_user
export DB_PASSWORD=your_db_password
export DB_NAME=careerfair
```

Or create `application/config/env-database.php` (gitignored) with the production credentials.

### `application/config/constants.php`

```php
define('SITE_TITLE', 'FUTA Career Services');
define('SITE_LOGO_PATH', APPPATH.'/assetsp/images/logo.png');
```

---

## 8. Database Setup

The full schema is in `docs/careerfair_database_schema.sql`. It creates **33 tables**:

| Group | Tables |
|---|---|
| Core | `settings`, `profile_user`, `cf_career_fairs` |
| Academic | `cf_schools`, `cf_departments`, `cf_programmes`, `cf_industries` |
| Students | `cf_students`, `cf_student_cvs` |
| Employers | `cf_employers` |
| Alumni | `cf_alumni` |
| Career Fair | `cf_fair_registrations`, `cf_booth_requests`, `cf_career_talks` |
| Recruitment | `cf_job_opportunities`, `cf_applications`, `cf_candidate_shortlists`, `cf_interview_invitations` |
| Check-in | `cf_qr_passes`, `cf_event_checkins`, `cf_booth_scans` |
| Events | `cf_events`, `cf_event_registrations` |
| Content | `news`, `slider`, `services`, `gallery`, `menu`, `menusub`, `pages` |
| Communication | `cf_notifications`, `contactmess`, `newsletters` |
| System | `cf_audit_logs`, `cf_sponsorships` |

**Default admin account** (seeded by SQL):
- Username: `admin`
- Password: `admin123` (md5 hashed)
- **Change this immediately after installation**

---

## 9. User Roles & Access

| Role | Login URL | Capabilities |
|---|---|---|
| **Student** | `/home/login` → `/student/dashboard` | Profile, CV upload, QR pass, opportunities, events, notifications |
| **Employer** | `/home/login` → `/employer/dashboard` | Company profile, talent search, shortlisting, booth request, job postings |
| **Alumni** | `/home/login` → `/alumni/dashboard` | Dashboard, mentoring, career talks |
| **Admin** | `/admin` → `/admin/dashboard` | Full system access — students, employers, news, settings, audit log |
| **Super Admin** | `/admin` → `/admin/dashboard` | All Admin capabilities + admin user management |
| **Check-in Officer** | `/checkin` → `/checkin/scan` | QR scanner, attendance board |

---

## 10. URL Routes Reference

### Public Site (`Home` controller)
| Route | Method | Description |
|---|---|---|
| `/` | GET | Homepage |
| `/home/about` | GET | About page |
| `/home/careerfair` | GET | Career Fair 2026 info + schedule |
| `/home/venue` | GET | Venue & directions (Google Maps) |
| `/home/students` | GET | Student info page |
| `/home/employers` | GET | Employer info page |
| `/home/alumni` | GET | Alumni info page |
| `/home/register/:type` | GET | Registration (student/employer) |
| `/home/login` | GET | Login page |
| `/home/events` | GET | News & events listing |
| `/home/contact` | GET | Contact form |
| `/home/cv` | GET | CV submission info |
| `/home/do_login` | POST | AJAX login handler |
| `/home/do_register` | POST | Registration handler |
| `/home/submit_newsletter` | POST | Newsletter subscription |

### Student Portal (`Student` controller)
| Route | Description |
|---|---|
| `/student/dashboard` | Dashboard with stats |
| `/student/profile` | Edit profile |
| `/student/cv` | CV upload |
| `/student/qr` | QR event pass + passport photo upload |
| `/student/upload_passport` | AJAX: upload passport photo |
| `/student/opportunities` | Browse jobs/internships |
| `/student/events` | Career fair events |
| `/student/messages` | Notifications inbox |
| `/student/settings` | Change password |

### Admin Panel (`Admin` controller)
| Route | Description |
|---|---|
| `/admin` | Login |
| `/admin/dashboard` | Overview dashboard |
| `/admin/students` | Student management |
| `/admin/employers` | Employer management |
| `/admin/booths` | Booth allocation |
| `/admin/talks` | Career talk requests |
| `/admin/news` | News CRUD |
| `/admin/qr_passes` | QR pass management |
| `/admin/opportunities` | Opportunity moderation |
| `/admin/reports` | Analytics & charts |
| `/admin/audit_log` | System event trail |
| `/admin/settings` | Site settings |
| `/admin/messages` | Contact messages |
| `/admin/admins` | Admin user management |

### Check-in System (`Checkin` controller)
| Route | Description |
|---|---|
| `/checkin/login` | Officer login |
| `/checkin/scan` | Live QR camera scanner |
| `/checkin/verify` | AJAX API: validate pass + record |
| `/checkin/attendance` | Live attendance board |
| `/checkin/report` | Full scan log |

---

## 11. Frontend Assets

### Custom CSS files (`assetsp/css/`)

| File | Purpose |
|---|---|
| `careerfair.css` | Master theme — CSS variables, header, nav, footer, buttons, topbar |
| `home.css` | Homepage-only styles (hero slider, stats strip, role cards, CTA) |
| `portal.css` | Shared dashboard styles (sidebar, topbar, stat cards, tables, forms) |
| `admin.css` | Admin panel extensions (dark sidebar, a-table, a-badge, a-btn, login page) |
| `fa-icons.css` | Font Awesome 5 Pro served locally — supports both FA5 and FA6 class names |

### Brand colours

```css
--cf-maroon:  #6B0E20   /* Primary — FUTA maroon */
--cf-gold:    #C9A84C   /* Secondary — FUTA gold */
--cf-dark:    #1A1A2E   /* Text / dark backgrounds */
--cf-light:   #F8F6F0   /* Page background */
```

### Icon system
All icons use **local Font Awesome 5 Pro** `.ttf` files — no CDN required, works offline on fair day. Both FA5 class names (`fas`, `far`, `fab`) and FA6 class names (`fa-solid`, `fa-regular`, `fa-brands`) are supported via `fa-icons.css`.

---

## 12. QR Check-in System

The check-in system uses **jsQR v1.4.0** (bundled at `assetsp/js/jsQR.js`) for camera-based QR decoding entirely in the browser.

### How it works
```
Staff opens /checkin/scan on phone/tablet
  → getUserMedia() activates rear camera
  → requestAnimationFrame() captures frames at ~10fps
  → jsQR decodes each frame looking for a QR code
  → On decode: POST to /checkin/verify with pass_code
  → Server: validates code → records check-in → returns attendee info
  → Green result card shows name, photo, department (auto-closes 4s)
  → Scanner resets, ready for next person
```

### Pass code format
```
CF26-STU-9F2A7D8C     (student)
CF26-EMP-A1B2C3D4     (employer)
CF26-ALU-XXXXXXXX     (alumni)
```

### Offline capability
All scanning assets are local — jsQR, jQuery, SweetAlert2. The system works on the university's local network without internet access. Only the verify API call requires a connection to the server.

---

## 13. Security

| Measure | Implementation |
|---|---|
| URL rewriting | `.htaccess` mod_rewrite — `index.php` blocked from URL |
| CSRF protection | CodeIgniter security library — CSRF token on all forms and AJAX |
| Session auth | CI file-based sessions, 2-hour expiry, role check on every controller method |
| Password hashing | MD5 (current — **upgrade to `password_hash()` before production**) |
| CSP headers | `.htaccess` `mod_headers` — allows Cloudflare, inline scripts, Google, YouTube |
| Input sanitisation | `$this->input->post()` with XSS filtering |
| File upload validation | Type whitelist (jpg/png/pdf), size limit (2–5MB), extension check |
| Audit logging | Every admin action recorded to `cf_audit_logs` with user ID, IP, timestamp |
| Sensitive files | `application/` folder has its own `.htaccess` blocking direct access |

> ⚠️ **Production checklist:**
> - Change default admin password
> - Generate a new `encryption_key` (32 random characters)
> - Upgrade password hashing from `md5()` to `password_hash()` / `password_verify()`
> - Set `$config['sess_use_queries']` = FALSE unless using database sessions
> - Ensure `uploads/` is not directly executable (add `.htaccess` denying PHP execution)

---

## 14. Deployment

### Cloudflare (recommended)
The app is Cloudflare-compatible. The `.htaccess` already handles:
- `Content-Security-Policy` allowing Cloudflare CDN scripts
- `Header unset Content-Security-Policy-Report-Only` — prevents the Cloudflare email-decode script from triggering CSP warnings
- HTTPS enforcement should be enabled in Cloudflare dashboard

### Production `.htaccess` — base URL
Update `application/config/config.php`:
```php
$config['base_url'] = 'https://career.futa.edu.ng/';
```

### File permissions
```bash
chmod 755 uploads/
chmod 755 uploads/cvs/ uploads/photos/ uploads/logos/ uploads/events/ uploads/qr/
chmod 755 application/logs/
chmod 755 application/cache/
```

### Environment detection
`database.php` uses `ENVIRONMENT` constant:
```php
// development → uses root/blank credentials
// production  → reads DB_USERNAME, DB_PASSWORD, DB_NAME from environment
```

---

## 15. Known Issues & Roadmap

### Current Limitations
- Password hashing uses `md5()` — migrate to `password_hash()` before go-live
- QR codes are text-based (no actual QR image generated server-side yet — uses a sample image)
- No email notification system wired up yet (SMTP config exists, sending not implemented)
- Alumni dashboard is a stub — full mentoring features are Phase 2

### Planned (Phase 2)
- [ ] Real QR code image generation using `endroid/qr-code` or `BaconQrCode`
- [ ] SMTP email notifications (shortlist alerts, interview invitations, registration confirmation)
- [ ] Online payment integration for booth fees and sponsorships
- [ ] Native mobile app (PWA upgrade)
- [ ] AI-based CV matching (rules-based engine → ML in Phase 3)
- [ ] FUTAVerse — permanent alumni and career community
- [ ] Excel/PDF export for all admin reports
- [ ] Hackathon and startup exhibition modules

---

## 16. Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m "feat: describe your change"`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Open a Pull Request against `main`

### Commit message convention
```
feat:     new feature
fix:      bug fix
docs:     documentation only
style:    formatting, no logic change
refactor: code change, no feature or fix
chore:    build, config, dependency updates
```

---

## 17. Licence

This project is developed for the **Federal University of Technology, Akure (FUTA) Centre for Career Services**.

© 2026 Federal University of Technology, Akure. All rights reserved.

For licensing enquiries contact: careerservices@futa.edu.ng
