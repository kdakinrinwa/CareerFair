<!DOCTYPE html>
<html lang="en">
<head>
    <title>FUTA Career Fair 2026 – FUTA NextGen: Careers, Skills, Innovation and Industry</title>
    <?php echo $css; ?>
    <!-- Homepage-specific styles (extracted to separate file) -->
    <link href="<?php echo base_url(); ?>assetsp/css/home.css" rel="stylesheet">
</head>
<body class="home-page">

<?php echo $header; ?>

<!-- ============================================================
     1. HERO SLIDER  –  3 real images, auto-advance every 5s
============================================================ -->
<section class="hp-hero" id="home" aria-label="Career Fair Hero Banner">

    <!-- Slides -->
    <div class="hp-slides" aria-hidden="true">

        <div class="hp-slide hp-slide-1 active">
            <div class="hp-slide-img"></div>
            <div class="hp-slide-overlay"></div>
        </div>

        <div class="hp-slide hp-slide-2">
            <div class="hp-slide-img"></div>
            <div class="hp-slide-overlay"></div>
        </div>

        <div class="hp-slide hp-slide-3">
            <div class="hp-slide-img"></div>
            <div class="hp-slide-overlay"></div>
        </div>

    </div>

    <!-- Content -->
    <div class="hp-hero-content-wrap">
        <div class="container">
            <div class="hp-hero-content">
                <div class="hp-hero-official">Official Career Fair Portal</div>
                <h1>FUTA Career Fair <span>2026</span></h1>
                <p class="hp-hero-theme">FUTA NextGen: Careers, Skills, Innovation and Industry</p>
                <p class="hp-hero-desc">
                    Connecting FUTA students, alumni, employers and industry partners for internships,
                    jobs, mentorship and career development opportunities.
                </p>
                <div class="hp-hero-meta">
                    <span><i class="fa-regular fa-calendar-days"></i> Wed – Thu, Nov 12–13, 2026</span>
                    <span><i class="fa-solid fa-location-dot"></i> FUTA 2500-Seater Hall, Akure</span>
                </div>
                <div class="hp-hero-btns">
                    <a href="<?php echo base_url(); ?>home/register/student" class="hp-btn hp-btn-maroon">
                        <i class="fa-solid fa-graduation-cap"></i> Register as Student
                    </a>
                    <a href="<?php echo base_url(); ?>home/register/employer" class="hp-btn hp-btn-gold">
                        <i class="fa-solid fa-building"></i> Register as Employer
                    </a>
                    <a href="<?php echo base_url(); ?>home/cv" class="hp-btn hp-btn-ghost">
                        <i class="fa-regular fa-file-lines"></i> Submit CV
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Prev / Next arrows -->
    <button class="hp-slide-prev" id="hp-prev" aria-label="Previous slide">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button class="hp-slide-next" id="hp-next" aria-label="Next slide">
        <i class="fa-solid fa-chevron-right"></i>
    </button>

    <!-- Indicator dots -->
    <div class="hp-slide-dots" role="tablist" aria-label="Slide navigation">
        <button class="hp-slide-dot active" data-slide="0" role="tab" aria-selected="true"  aria-label="Slide 1"></button>
        <button class="hp-slide-dot"        data-slide="1" role="tab" aria-selected="false" aria-label="Slide 2"></button>
        <button class="hp-slide-dot"        data-slide="2" role="tab" aria-selected="false" aria-label="Slide 3"></button>
    </div>

</section>

<!-- ============================================================
     2. STATS STRIP  –  3 counters + live countdown
============================================================ -->
<div class="hp-stats" aria-label="Career Fair key statistics">
    <div class="container">
        <div class="hp-stats-grid">

            <div class="hp-stat">
                <div class="hp-stat-icon maroon"><i class="fa-solid fa-user-graduate"></i></div>
                <div>
                    <div class="hp-stat-num">2000+</div>
                    <div class="hp-stat-label">Students</div>
                    <div class="hp-stat-sub">Talented and ready</div>
                </div>
            </div>

            <div class="hp-stat">
                <div class="hp-stat-icon gold"><i class="fa-solid fa-building-columns"></i></div>
                <div>
                    <div class="hp-stat-num gold">100+</div>
                    <div class="hp-stat-label">Companies</div>
                    <div class="hp-stat-sub">Across diverse industries</div>
                </div>
            </div>

            <div class="hp-stat">
                <div class="hp-stat-icon maroon"><i class="fa-solid fa-handshake"></i></div>
                <div>
                    <div class="hp-stat-num" style="font-size:15px;line-height:1.3;">Internships &amp; Jobs</div>
                    <div class="hp-stat-label">Real opportunities</div>
                    <div class="hp-stat-sub">Brighter futures</div>
                </div>
            </div>

            <!-- Live countdown to Career Fair 2026 -->
            <div class="hp-countdown-cell" aria-label="Career Fair countdown">
                <div class="hp-countdown-icon"><i class="fa-solid fa-clock"></i></div>
                <div>
                    <div class="hp-countdown-label">Career Fair Countdown</div>
                    <div class="hp-countdown-units">
                        <div class="hp-cd-unit"><div class="hp-cd-num" id="cd-days">--</div><div class="hp-cd-lbl">Days</div></div>
                        <div class="hp-cd-sep">:</div>
                        <div class="hp-cd-unit"><div class="hp-cd-num" id="cd-hours">--</div><div class="hp-cd-lbl">Hrs</div></div>
                        <div class="hp-cd-sep">:</div>
                        <div class="hp-cd-unit"><div class="hp-cd-num" id="cd-mins">--</div><div class="hp-cd-lbl">Min</div></div>
                        <div class="hp-cd-sep">:</div>
                        <div class="hp-cd-unit"><div class="hp-cd-num" id="cd-secs">--</div><div class="hp-cd-lbl">Sec</div></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ============================================================
     3. WHO THE PORTAL SERVES
============================================================ -->
<section class="hp-section hp-section-bg">
    <div class="container">
        <div class="hp-title-row">
            <div>
                <div class="hp-sec-label">Together for Greater Futures</div>
                <h2 class="hp-sec-h2">Who the Portal Serves</h2>
            </div>
        </div>

        <div class="hp-role-row">

            <div class="hp-role-card wow fadeInUp" data-wow-delay="0ms">
                <div class="hp-role-bg" style="background-image:url('<?php echo base_url(); ?>assetsp/images/student2.png'); background-position:center 15%;"></div>
                <div class="hp-role-gradient"></div>
                <div class="hp-role-card-body">
                    <div class="hp-role-header">
                        <div class="hp-role-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <h4>Students</h4>
                    </div>
                    <p>Discover opportunities, connect with employers, attend career sessions and build your future.</p>
                    <a href="<?php echo base_url(); ?>home/students" class="hp-role-link">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="hp-role-card wow fadeInUp" data-wow-delay="100ms">
                <div class="hp-role-bg" style="background-image:url('<?php echo base_url(); ?>assetsp/images/employer1.png'); background-position:center 15%;"></div>
                <div class="hp-role-gradient"></div>
                <div class="hp-role-card-body">
                    <div class="hp-role-header">
                        <div class="hp-role-icon"><i class="fa-solid fa-building"></i></div>
                        <h4>Employers</h4>
                    </div>
                    <p>Access top talent, showcase your brand, recruit and build lasting partnerships with FUTA.</p>
                    <a href="<?php echo base_url(); ?>home/employers" class="hp-role-link">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="hp-role-card wow fadeInUp" data-wow-delay="200ms">
                <div class="hp-role-bg" style="background-image:url('<?php echo base_url(); ?>assetsp/images/alumni1.png'); background-position:center 10%;"></div>
                <div class="hp-role-gradient"></div>
                <div class="hp-role-card-body">
                    <div class="hp-role-header">
                        <div class="hp-role-icon"><i class="fa-solid fa-user-tie"></i></div>
                        <h4>Alumni</h4>
                    </div>
                    <p>Give back, mentor the next generation and connect with emerging talent at FUTA.</p>
                    <a href="<?php echo base_url(); ?>home/alumni" class="hp-role-link">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="hp-role-card wow fadeInUp" data-wow-delay="300ms">
                <div class="hp-role-bg" style="background-image:url('<?php echo base_url(); ?>assetsp/images/student1.png'); background-position:center 10%;"></div>
                <div class="hp-role-gradient"></div>
                <div class="hp-role-card-body">
                    <div class="hp-role-header">
                        <div class="hp-role-icon"><i class="fa-solid fa-gear"></i></div>
                        <h4>Career Services Admin</h4>
                    </div>
                    <p>Manage programmes, facilitate connections and track impact across the career ecosystem.</p>
                    <a href="<?php echo base_url(); ?>admin" class="hp-role-link">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     4. KEY FEATURES
============================================================ -->
<section class="hp-section">
    <div class="container">
        <div class="hp-title-row">
            <div>
                <div class="hp-sec-label">More Connections. Greater Opportunities.</div>
                <h2 class="hp-sec-h2">Key Features</h2>
                <p class="hp-sec-p">Powerful tools for a seamless career fair experience</p>
            </div>
        </div>

        <div class="hp-features-grid">

            <div class="hp-feat wow fadeInUp" data-wow-delay="0ms">
                <div class="hp-feat-icon"><i class="fa-regular fa-file-lines"></i></div>
                <h5>CV Upload</h5><p>by Field of Study</p>
            </div>
            <div class="hp-feat wow fadeInUp" data-wow-delay="60ms">
                <div class="hp-feat-icon"><i class="fa-solid fa-sliders"></i></div>
                <h5>Employer Filtering</h5><p>by Industry</p>
            </div>
            <div class="hp-feat wow fadeInUp" data-wow-delay="120ms">
                <div class="hp-feat-icon"><i class="fa-solid fa-briefcase"></i></div>
                <h5>Internship &amp; Job</h5><p>Opportunities</p>
            </div>
            <div class="hp-feat wow fadeInUp" data-wow-delay="180ms">
                <div class="hp-feat-icon"><i class="fa-solid fa-store"></i></div>
                <h5>Booth Request</h5><p>for Employers</p>
            </div>
            <div class="hp-feat wow fadeInUp" data-wow-delay="240ms">
                <div class="hp-feat-icon"><i class="fa-solid fa-microphone-lines"></i></div>
                <h5>Career Talk</h5><p>Request</p>
            </div>
            <div class="hp-feat wow fadeInUp" data-wow-delay="0ms">
                <div class="hp-feat-icon"><i class="fa-solid fa-bullhorn"></i></div>
                <h5>Advertisement</h5><p>Interest</p>
            </div>
            <div class="hp-feat wow fadeInUp" data-wow-delay="60ms">
                <div class="hp-feat-icon"><i class="fa-solid fa-people-arrows"></i></div>
                <h5>Recruit at the Fair</h5><p>Meet top candidates</p>
            </div>
            <div class="hp-feat wow fadeInUp" data-wow-delay="120ms">
                <div class="hp-feat-icon"><i class="fa-solid fa-list-check"></i></div>
                <h5>Shortlisting &amp; Interaction</h5><p>During the Fair</p>
            </div>

            <!-- QR Pass – spans 2 columns -->
            <div class="hp-feat hp-feat-wide wow fadeInUp" data-wow-delay="180ms">
                <div style="display:flex;align-items:center;gap:14px;flex:1;min-width:0;">
                    <div class="hp-feat-icon" style="flex-shrink:0;"><i class="fa-solid fa-qrcode"></i></div>
                    <div>
                        <h5 style="text-align:left;font-size:13.5px;">QR Code Event Pass / Check-in Card</h5>
                        <p style="text-align:left;">Digital passes for event entry, booth scanning and attendance tracking.</p>
                    </div>
                </div>
                <div class="hp-qr-card">
                    <div class="qr-top">FUTA CAREER FAIR 2026</div>
                    <div class="qr-pass">
                        <div class="qr-photo"><img src="<?php echo base_url(); ?>assetsp/images/pass.png" alt="Passport Photo"></div>
                        <div>
                            <div class="qr-name">Adebola Adebayo</div>
                            <div class="qr-sub">Computer Eng &middot; 400L</div>
                        </div>
                    </div>
                    <div class="qr-img"><img src="<?php echo base_url(); ?>assetsp/images/QR.png" alt="QR Code"></div>
                    <div style="font-size:8.5px;opacity:.55;margin-bottom:3px;">CF26-STU-9F2A7D8C</div>
                    <div class="qr-valid"><i class="fa-solid fa-circle-check"></i> STUDENT – VALID PASS</div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     5. CAREER FAIR JOURNEY
============================================================ -->
<section class="hp-section hp-section-bg">
    <div class="container">
        <div style="text-align:center;margin-bottom:40px;">
            <div class="hp-sec-label" style="justify-content:center;">From Registration to Real Opportunities</div>
            <h2 class="hp-sec-h2">Career Fair Journey</h2>
        </div>

        <div class="hp-journey">
            <div class="hp-jstep wow fadeInUp" data-wow-delay="0ms">
                <div class="hp-jstep-num active">1</div>
                <div class="hp-jstep-icon"><i class="fa-solid fa-user-plus"></i></div>
                <h5>Register</h5><p>Create your account</p>
            </div>
            <div class="hp-jstep wow fadeInUp" data-wow-delay="80ms">
                <div class="hp-jstep-num">2</div>
                <div class="hp-jstep-icon"><i class="fa-regular fa-file-lines"></i></div>
                <h5>Upload CV</h5><p>Showcase your skills</p>
            </div>
            <div class="hp-jstep wow fadeInUp" data-wow-delay="160ms">
                <div class="hp-jstep-num">3</div>
                <div class="hp-jstep-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                <h5>Company Review</h5><p>Employers review profiles</p>
            </div>
            <div class="hp-jstep wow fadeInUp" data-wow-delay="240ms">
                <div class="hp-jstep-num">4</div>
                <div class="hp-jstep-icon"><i class="fa-solid fa-list-check"></i></div>
                <h5>Shortlist</h5><p>Get noticed</p>
            </div>
            <div class="hp-jstep wow fadeInUp" data-wow-delay="320ms">
                <div class="hp-jstep-num">5</div>
                <div class="hp-jstep-icon"><i class="fa-solid fa-id-badge"></i></div>
                <h5>QR Badge Generated</h5><p>Your event pass</p>
            </div>
            <div class="hp-jstep wow fadeInUp" data-wow-delay="400ms">
                <div class="hp-jstep-num">6</div>
                <div class="hp-jstep-icon"><i class="fa-solid fa-people-group"></i></div>
                <h5>Meet Recruiters</h5><p>Attend, network, get hired!</p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     6. PRE-CAREER DAY  +  FEATURED PROGRAMMES  (side-by-side)
============================================================ -->
<section class="hp-section">
    <div class="container">
        <div class="hp-two-col">

            <!-- LEFT: Pre-Career Day Readiness Runway -->
            <div>
                <div style="margin-bottom:24px;">
                    <div class="hp-sec-label">Be ready. Be confident. Be FUTA.</div>
                    <h2 class="hp-sec-h2">Pre-Career Day<br>Readiness Runway</h2>
                </div>

                <div class="hp-readiness-item wow fadeInLeft" data-wow-delay="0ms">
                    <div class="hp-rnum">1</div>
                    <div><h5>Digital Alignment</h5><p>Update your profile, CV and online presence to make a strong first impression.</p></div>
                </div>
                <div class="hp-readiness-item wow fadeInLeft" data-wow-delay="100ms">
                    <div class="hp-rnum">2</div>
                    <div><h5>Portfolio Audit</h5><p>Refine your skills, projects and achievements to align with employer expectations.</p></div>
                </div>
                <div class="hp-readiness-item wow fadeInLeft" data-wow-delay="200ms">
                    <div class="hp-rnum">3</div>
                    <div><h5>Pitch &amp; Mock Interviews</h5><p>Practice, get feedback and build the confidence you need on the day.</p></div>
                </div>
            </div>

            <!-- RIGHT: Featured Programmes & Events -->
            <div>
                <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:8px;">
                    <div>
                        <div class="hp-sec-label">Engage. Learn. Network. Grow.</div>
                        <h2 class="hp-sec-h2">Featured Programmes &amp; Events</h2>
                    </div>
                    <a href="<?php echo base_url(); ?>home/events" class="hp-link-more">
                        View All <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <?php
                    $programmes = [
                        ['fa-regular fa-file-lines', 'CV Clinics',            'Get expert feedback on your CV from career professionals.'],
                        ['fa-solid fa-comments',      'Mock Interviews',       'Practice with industry professionals and get real feedback.'],
                        ['fa-brands fa-linkedin',     'LinkedIn Optimization', 'Build a professional online presence that gets noticed.'],
                        ['fa-solid fa-users',         'Industry Panels',       'Insights from top industry leaders on careers.'],
                        ['fa-solid fa-magnifying-glass','Internship Matching', 'Find and apply for internships matched to your skills.'],
                        ['fa-solid fa-rocket',        'Startup Booths',        'Discover and connect with innovative startups.'],
                    ];
                    foreach ($programmes as $i => $prog): ?>
                    <div class="hp-prog-card wow fadeInRight" data-wow-delay="<?php echo $i * 60; ?>ms">
                        <div class="hp-prog-icon"><i class="<?php echo $prog[0]; ?>"></i></div>
                        <h5><?php echo $prog[1]; ?></h5>
                        <p><?php echo $prog[2]; ?></p>
                        <a href="<?php echo base_url(); ?>home/events" class="hp-join-link">
                            Join Session <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     7. LATEST NEWS (only rendered if DB records exist)
============================================================ -->
<?php if (!empty($events)): ?>
<section class="hp-section hp-section-bg">
    <div class="container">
        <div class="hp-title-row">
            <div>
                <div class="hp-sec-label">Stay Informed</div>
                <h2 class="hp-sec-h2">News &amp; Announcements</h2>
            </div>
            <a href="<?php echo base_url(); ?>home/events" class="hp-link-more">
                View All <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="hp-news-grid">
            <?php foreach ($events as $i => $row):
                if ($i >= 3) break; ?>
            <div class="hp-news-card wow fadeInUp" data-wow-delay="<?php echo $i * 100; ?>ms">
                <?php if (!empty($row->thumbnail)): ?>
                <div class="hp-news-img">
                    <img src="<?php echo base_url().'uploads/'.htmlspecialchars($row->thumbnail); ?>"
                         alt="<?php echo htmlspecialchars($row->title); ?>"
                         loading="lazy">
                </div>
                <?php endif; ?>
                <div class="hp-news-body">
                    <div class="hp-news-meta">
                        <span class="hp-badge"><?php echo htmlspecialchars($row->category ?? 'News'); ?></span>
                        <span class="hp-news-date">
                            <i class="fa-regular fa-calendar fa-fw"></i>
                            <?php echo $row->eventday ? date('M d, Y', strtotime($row->eventday)) : ''; ?>
                        </span>
                    </div>
                    <h5>
                        <a href="<?php echo site_url('home/viewevent').'/'.$row->newsid; ?>">
                            <?php echo htmlspecialchars(substr($row->title, 0, 68)); ?>
                        </a>
                    </h5>
                    <a href="<?php echo site_url('home/viewevent').'/'.$row->newsid; ?>" class="hp-join-link">
                        Read More <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================
     8. CTA  –  cta-students.png is the full section background
============================================================ -->
<section class="hp-cta" aria-label="Call to action">
    <div class="hp-cta-bg" aria-hidden="true"></div>
    <div class="hp-cta-overlay" aria-hidden="true"></div>
    <div class="container">
        <div class="hp-cta-glass wow fadeInUp" data-wow-duration="900ms">
            <h2>Your Next Opportunity<br>Starts Here</h2>
            <p>Join thousands of FUTA students and connect with top employers at the FUTA Career Fair 2026.</p>
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <a href="<?php echo base_url(); ?>home/register" class="hp-btn hp-btn-gold">
                    Get Started Today <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="<?php echo base_url(); ?>home/careerfair" class="hp-btn hp-btn-ghost">
                    View Fair Programme
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     FOOTER  (rendered by dependency.php global partial)
============================================================ -->
<?php echo $footer; ?>

<!-- ============================================================
     FOOTER BOTTOM BAR  –  dark navy background
============================================================ -->
<div class="hp-footer-bar">
    <div class="container">
        <div class="hp-footer-bar-inner">
            <p>&copy; <?php echo date('Y'); ?> Federal University of Technology, Akure. All rights reserved.</p>
            <div class="hp-footer-bar-links">
                <a href="<?php echo base_url(); ?>home/page/privacy">Privacy Policy</a>
                <a href="<?php echo base_url(); ?>home/page/terms">Terms of Use</a>
                <a href="<?php echo base_url(); ?>home/contact">FAQs</a>
            </div>
            <p>Built for a Brighter Future <i class="fa-solid fa-bolt" style="color:#C9A84C;"></i></p>
        </div>
    </div>
</div>

<!-- Scroll to top button -->
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<?php echo $js; ?>

<!-- ============================================================
     PAGE-SPECIFIC SCRIPTS  (hero slider + countdown)
     These are minimal and belong in the view, not global JS.
============================================================ -->
<script>
/* ── Hero Slider ─────────────────────────────────────────── */
(function () {
    var slides  = document.querySelectorAll('.hp-slide');
    var dots    = document.querySelectorAll('.hp-slide-dot');
    var current = 0;
    var total   = slides.length;
    var timer;

    function goTo(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        dots[current].setAttribute('aria-selected', 'false');
        current = (n + total) % total;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
        dots[current].setAttribute('aria-selected', 'true');
    }

    function startTimer() {
        timer = setInterval(function () { goTo(current + 1); }, 5000);
    }
    function resetTimer() { clearInterval(timer); startTimer(); }

    document.getElementById('hp-prev').addEventListener('click', function () { goTo(current - 1); resetTimer(); });
    document.getElementById('hp-next').addEventListener('click', function () { goTo(current + 1); resetTimer(); });
    dots.forEach(function (dot) {
        dot.addEventListener('click', function () { goTo(parseInt(this.dataset.slide)); resetTimer(); });
    });

    startTimer();
}());

/* ── Countdown to Career Fair: 12 Nov 2026 08:00 WAT ────── */
(function () {
    var target = new Date('2026-11-12T08:00:00').getTime();
    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function tick() {
        var diff = target - Date.now();
        if (diff <= 0) {
            ['cd-days','cd-hours','cd-mins','cd-secs'].forEach(function (id) {
                document.getElementById(id).textContent = '00';
            });
            return;
        }
        document.getElementById('cd-days').textContent  = pad(Math.floor(diff / 86400000));
        document.getElementById('cd-hours').textContent = pad(Math.floor((diff % 86400000) / 3600000));
        document.getElementById('cd-mins').textContent  = pad(Math.floor((diff % 3600000)  / 60000));
        document.getElementById('cd-secs').textContent  = pad(Math.floor((diff % 60000)    / 1000));
    }
    tick();
    setInterval(tick, 1000);
}());
</script>

</body>
</html>
