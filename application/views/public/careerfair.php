<!DOCTYPE html>
<html lang="en">
<head>
    <title>Career Fair 2026 – FUTA NextGen</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>FUTA Career Fair 2026</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>Career Fair 2026</li></ul>
    </div>
</div>

<!-- Fair Overview -->
<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:grid; grid-template-columns:2fr 1fr; gap:40px; flex-wrap:wrap;" class="row">
            <div style="padding:0 12px;">
                <span class="cf-label">Official Career Fair Portal</span>
                <h2 style="font-size:clamp(26px,4vw,44px); font-weight:800; color:var(--cf-dark); margin:10px 0 16px; line-height:1.2;">
                    FUTA NextGen: Careers, Skills,<br>Innovation and Industry
                </h2>
                <p style="font-size:15.5px; color:var(--cf-grey); line-height:1.75; margin-bottom:24px;">
                    The FUTA Career Fair 2026 is the Federal University of Technology, Akure's flagship career and recruitment event. It brings together final-year students, postgraduate students, fresh graduates, industry employers, alumni, mentors and career professionals under one roof for two days of networking, recruitment, career talks, CV reviews and industry engagement.
                </p>
                <p style="font-size:15.5px; color:var(--cf-grey); line-height:1.75; margin-bottom:32px;">
                    This year's theme — <strong style="color:var(--cf-maroon);">FUTA NextGen: Careers, Skills, Innovation and Industry</strong> — reflects the university's commitment to preparing graduates not just for employment, but for leadership, entrepreneurship and global impact.
                </p>

                <!-- Key Details -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <?php
                    $details = [
                        ['fa-calendar-days','Dates','Wednesday – Thursday, November 12–13, 2026'],
                        ['fa-location-dot','Venue','FUTA 2500-Seater Hall, Federal University of Technology, Akure'],
                        ['fa-clock','Time','8:00 AM – 6:00 PM (both days)'],
                        ['fa-users','Expected Attendance','2,000+ Students, 100+ Employers, Alumni & Partners'],
                    ];
                    foreach ($details as $d):
                    ?>
                    <div style="display:flex; gap:14px; padding:16px; background:white; border-radius:var(--cf-radius); border:1px solid var(--cf-border);">
                        <div style="width:40px; height:40px; background:rgba(107,14,32,0.08); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:17px; color:var(--cf-maroon); flex-shrink:0;">
                            <i class="fa-solid <?php echo $d[0]; ?>"></i>
                        </div>
                        <div>
                            <div style="font-size:12px; font-weight:700; text-transform:uppercase; color:var(--cf-grey); letter-spacing:0.5px;"><?php echo $d[1]; ?></div>
                            <div style="font-size:14px; font-weight:600; color:var(--cf-dark); margin-top:3px;"><?php echo $d[2]; ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Sidebar: Register Card -->
            <div style="padding:0 12px;">
                <div style="background:white; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg); border-top:4px solid var(--cf-maroon); padding:28px; position:sticky; top:90px;">
                    <h4 style="font-size:20px; font-weight:800; color:var(--cf-dark); margin:0 0 6px;">Register Now</h4>
                    <p style="font-size:13.5px; color:var(--cf-grey); margin:0 0 22px;">Secure your place at FUTA Career Fair 2026. Registration is free.</p>

                    <a href="<?php echo base_url(); ?>home/register/student" class="cf-btn cf-btn-primary" style="width:100%; justify-content:center; margin-bottom:12px;">
                        <i class="fa-solid fa-graduation-cap"></i> Register as Student
                    </a>
                    <a href="<?php echo base_url(); ?>home/register/employer" class="cf-btn cf-btn-outline" style="width:100%; justify-content:center; margin-bottom:12px; border-color:var(--cf-gold); color:var(--cf-gold-dark);">
                        <i class="fa-solid fa-building"></i> Register as Employer
                    </a>
                    <a href="<?php echo base_url(); ?>home/register/alumni" class="cf-btn cf-btn-outline" style="width:100%; justify-content:center; color:var(--cf-dark); border-color:var(--cf-border);">
                        <i class="fa-solid fa-user-tie"></i> Register as Alumni
                    </a>

                    <div style="margin-top:20px; padding-top:20px; border-top:1px solid var(--cf-border);">
                        <div style="font-size:12px; font-weight:700; text-transform:uppercase; color:var(--cf-grey); letter-spacing:1px; margin-bottom:10px;">Registration Deadline</div>
                        <div style="font-size:16px; font-weight:800; color:var(--cf-maroon);">Friday, November 7, 2026</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Programme Schedule -->
<section class="cf-section">
    <div class="container">
        <div class="cf-section-title centered">
            <span class="cf-label">Plan Your Day</span>
            <h2>Programme Schedule</h2>
        </div>

        <!-- Day 1 -->
        <h4 style="font-size:18px; font-weight:800; color:var(--cf-maroon); margin-bottom:20px; padding-left:16px; border-left:4px solid var(--cf-maroon);">
            Day 1 – Wednesday, November 12, 2026
        </h4>
        <div style="display:flex; flex-direction:column; gap:12px; margin-bottom:36px;">
            <?php
            $day1 = [
                ['08:00–09:00','Registration & QR Check-in','Main Entrance','fa-qrcode'],
                ['09:00–10:00','Opening Ceremony & Welcome Address','Main Hall','fa-microphone'],
                ['10:00–12:00','Employer Exhibition & CV Submission','Exhibition Hall','fa-store'],
                ['12:00–13:00','CV Clinic – Engineering & Technology','Seminar Room A','fa-file-lines'],
                ['13:00–14:00','Lunch Break','Cafeteria','fa-utensils'],
                ['14:00–15:30','Career Talk: Future of Tech in Nigeria','Main Hall','fa-comments'],
                ['15:30–16:30','Industry Panel: Oil & Gas, Engineering, ICT','Panel Room','fa-users'],
                ['16:30–18:00','Networking & Booth Interactions','Exhibition Hall','fa-handshake'],
            ];
            foreach ($day1 as $row):
            ?>
            <div style="display:flex; align-items:center; gap:16px; padding:14px 18px; background:white; border-radius:var(--cf-radius); border:1px solid var(--cf-border);">
                <div style="min-width:110px; font-size:12.5px; font-weight:700; color:var(--cf-maroon);"><?php echo $row[0]; ?></div>
                <div style="width:36px; height:36px; background:rgba(107,14,32,0.07); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:15px; color:var(--cf-maroon); flex-shrink:0;">
                    <i class="fa-solid <?php echo $row[3]; ?>"></i>
                </div>
                <div style="flex:1;">
                    <div style="font-size:14px; font-weight:700; color:var(--cf-dark);"><?php echo $row[1]; ?></div>
                    <div style="font-size:12px; color:var(--cf-grey);"><i class="fa-solid fa-location-dot fa-fw"></i> <?php echo $row[2]; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Day 2 -->
        <h4 style="font-size:18px; font-weight:800; color:var(--cf-maroon); margin-bottom:20px; padding-left:16px; border-left:4px solid var(--cf-gold);">
            Day 2 – Thursday, November 13, 2026
        </h4>
        <div style="display:flex; flex-direction:column; gap:12px;">
            <?php
            $day2 = [
                ['08:30–09:00','QR Check-in & Morning Networking','Main Entrance','fa-qrcode'],
                ['09:00–11:00','Employer Exhibition & Booth Scanning','Exhibition Hall','fa-store'],
                ['11:00–12:30','Mock Interview Sessions','Interview Rooms','fa-comments'],
                ['12:30–13:30','Lunch Break','Cafeteria','fa-utensils'],
                ['13:30–15:00','Workshop: LinkedIn & Digital Career Branding','Computer Lab','fa-brands fa-linkedin'],
                ['15:00–16:00','Startup Exhibition & Innovation Showcase','Exhibition Hall','fa-rocket'],
                ['16:00–17:00','Alumni Panel: From FUTA to Global Industry','Main Hall','fa-graduation-cap'],
                ['17:00–18:00','Closing Ceremony & Prize Giving','Main Hall','fa-award'],
            ];
            foreach ($day2 as $row):
            ?>
            <div style="display:flex; align-items:center; gap:16px; padding:14px 18px; background:white; border-radius:var(--cf-radius); border:1px solid var(--cf-border);">
                <div style="min-width:110px; font-size:12.5px; font-weight:700; color:var(--cf-gold-dark);"><?php echo $row[0]; ?></div>
                <div style="width:36px; height:36px; background:rgba(201,168,76,0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:15px; color:var(--cf-gold-dark); flex-shrink:0;">
                    <i class="fa-solid <?php echo $row[3]; ?>"></i>
                </div>
                <div style="flex:1;">
                    <div style="font-size:14px; font-weight:700; color:var(--cf-dark);"><?php echo $row[1]; ?></div>
                    <div style="font-size:12px; color:var(--cf-grey);"><i class="fa-solid fa-location-dot fa-fw"></i> <?php echo $row[2]; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
</body>
</html>
