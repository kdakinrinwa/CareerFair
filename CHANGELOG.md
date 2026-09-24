# Changelog

All notable changes to the FUTA Career Services & Career Fair Portal are documented here.

Format follows [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

---

## [1.0.0] – 2026-09-17 — Initial Production Release

### Added

#### Public Website
- Full FUTA-branded homepage with 3-slide auto-advancing hero banner
- Live countdown timer to Career Fair 2026 (Nov 12–13, 2026)
- "Who the Portal Serves" full-image role cards (Student, Employer, Alumni, Admin)
- Key Features grid with QR pass preview card
- Career Fair Journey 6-step infographic
- Pre-Career Day Readiness Runway section
- Featured Programmes & Events grid
- News & Announcements (DB-driven)
- "Your Next Opportunity Starts Here" CTA with full-bleed background image
- Venue & Directions page with embedded Google Maps (FUTA, Akure)
- Career Fair 2026 schedule page (Day 1 & Day 2 programme)
- About page (mission, vision, lifecycle)
- Contact page with AJAX form submission + CAPTCHA
- Students, Employers, Alumni info pages
- Gallery (album grid), Videos (YouTube embeds), Programmes listing
- Newsletter subscription (AJAX)
- Responsive navigation with sticky header, dropdown menus, mobile accordion

#### Registration & Login
- Student registration — split layout with `st.png` image right panel
- Employer registration — split layout with `emp.png` image right panel
- Alumni tab removed from public registration
- Login page with Student / Employer tabs only; Admin link at bottom
- AJAX login handler with role-based redirect

#### Student Portal (`/student`)
- Dashboard — profile completion bar, stat cards, shortlist panel, upcoming events
- Profile editor — name, phone, school, level, skills, career interest, links
- CV upload — drag & drop, PDF/DOCX validation, consent checkbox, active CV display
- QR Event Pass — printable white card matching physical pass design
  - Passport photo upload with live preview
  - FUTA branding header, photo, QR code, STUDENT badge, gold "VALID EVENT PASS" footer
  - `@media print` support for direct printing and lamination
- Opportunities — filterable job/internship listing
- Events — career fair session listing
- Notifications inbox (read/unread state)
- Settings — change password

#### Employer Portal (`/employer`)
- Dashboard — shortlist count, booth status, recent CV matches
- Talent Vault — search students by school, level, skill, career interest
- Shortlist — tag candidates (Interested / Strong / Interview / etc.)
- Booth Request — size selection, requirements, admin approval workflow
- Company Profile editor
- Job/Internship postings CRUD

#### Alumni Portal (`/alumni`)
- Dashboard with mentor, career talk, opportunity and alumni network cards

#### Super Admin Panel (`/admin`)
- Login page (dark navy gradient, FUTA branding)
- Dashboard — 8 KPI cards, recent students table, employer approval quick actions, audit trail
- Students management — search, filter, status toggle, full profile view (CV + QR + shortlists)
- Employers management — approve/suspend, full profile view
- Booth Requests — allocate booth number and location
- Career Talks — approve/decline/schedule
- News & Events — create, edit, delete with image upload and preview
- QR Passes — issue, revoke
- Opportunities — activate/close employer postings
- Reports — bar charts for registration by school, employer sectors, CV rate
- Audit Log — full event trail (last 200 entries)
- Site Settings — contact info, social media handles, welcome text, system info
- Contact Messages & Newsletter subscriber list
- Admin Users management (Super Admin only)
- Change Password

#### QR Check-in System (`/checkin`)
- Dedicated login page for check-in officers
- Camera-based QR scanner (jsQR v1.4.0 — offline capable)
  - Continuous frame scanning at ~10fps
  - 3-second debounce (prevents double-scan)
  - Animated result card (green ✓ / amber ↩ / red ✗)
  - Auto-close after 4 seconds with countdown progress bar
  - Camera switch (front/rear) button
  - Running scan counter
- Verify API (`/checkin/verify`) — validates pass, records check-in, auto-activates student
- Live Attendance Board — today's unique attendees, filter by type, client-side search, 30s auto-refresh
- Full Scan Report — all scan events, printable

#### Database
- 33-table schema in `docs/careerfair_database_schema.sql`
- Tables: students, employers, alumni, QR passes, check-ins, booth requests, career talks, opportunities, shortlists, notifications, audit logs, and all legacy content tables

#### Frontend
- `careerfair.css` — master theme (CSS variables, header, footer, nav, buttons)
- `home.css` — homepage-specific (hero, stats, role cards, features, journey, CTA)
- `portal.css` — shared dashboard (sidebar, topbar, stat cards, tables, forms)
- `admin.css` — admin panel (dark sidebar, data tables, badges, login page)
- `fa-icons.css` — local Font Awesome 5 Pro, FA5 + FA6 class name compatible
- `jsQR.js` bundled locally (256KB) — no internet required on fair day
- Global font scale bumped to `html { font-size: 17px }`

#### Security
- `.htaccess` CSP headers — allows Cloudflare scripts, YouTube, Google Maps
- `Content-Security-Policy-Report-Only` header removed (fixes Cloudflare console errors)
- X-Frame-Options, X-Content-Type-Options, Referrer-Policy headers set
- CSRF token on all forms and AJAX requests
- Role-based auth guard on every controller method
- Audit logging for all admin actions

---

## [0.1.0] – 2026-09-01 — CodeIgniter Skeleton

### Added
- CodeIgniter 3 skeleton with existing controllers (Home, Admin)
- Legacy `Admin_model` and `Home_model` from previous project
- Base URL set to `http://careerfair.test:9090/`
- Database configuration pointing to `careerfair` MySQL database
- `dependency.php` shared constructor bootstrap pattern
- Existing `assetsp/` folder with Bootstrap, WOW.js, SweetAlert2, Swiper
- Existing admin panel assets in `assetsa/`
