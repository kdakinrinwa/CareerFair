<!DOCTYPE html>
<html lang="en">
<head>
    <title>About – FUTA Career Services &amp; Career Fair Portal</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>About the Portal</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>About</li></ul>
    </div>
</div>

<!-- About Section -->
<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:flex; align-items:center; gap:48px; flex-wrap:wrap;">
            <div style="flex:1; min-width:280px;">
                <span class="cf-label">About FUTA Career Services</span>
                <h2 style="font-size:clamp(26px,4vw,44px); font-weight:800; color:var(--cf-dark); margin:10px 0 18px; line-height:1.2;">
                    FUTA Career Services<br>&amp; Career Fair Portal
                </h2>
                <div style="font-size:15.5px; color:var(--cf-grey); line-height:1.85; margin-bottom:24px;">
                    <?php echo isset($info->about) && $info->about ? nl2br(htmlspecialchars($info->about)) :
                    'The FUTA Career Services &amp; Career Fair Portal (FCCP) is the official digital career ecosystem of the Federal University of Technology, Akure. Developed by the Centre for Career Services, the platform bridges the gap between FUTA\'s talented graduates and top employers across Nigeria and beyond.<br><br>
                    Beyond the annual Career Fair, the portal supports year-round career development activities including internship placement, job opportunities, employer engagement, mentoring, career resources and community building through the FUTAVerse initiative.'; ?>
                </div>
                <div style="display:flex; gap:40px; flex-wrap:wrap; margin-bottom:28px;">
                    <?php
                    $stats = [['2000+','Students Registered'],['100+','Partner Companies'],['5+','Career Programmes'],['10+','Years of Excellence']];
                    foreach ($stats as $s):
                    ?>
                    <div style="text-align:center;">
                        <div style="font-size:28px; font-weight:800; color:var(--cf-maroon);"><?php echo $s[0]; ?></div>
                        <div style="font-size:12.5px; color:var(--cf-grey); font-weight:600;"><?php echo $s[1]; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div style="flex-shrink:0; max-width:380px; width:100%;">
                <img src="<?php echo base_url(); ?>assetsp/images/student1.png" alt="FUTA Career Services"
                     style="width:100%; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg);">
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="cf-section">
    <div class="container">
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:24px;">
            <?php
            $mvv = [
                ['fa-bullseye','Mission','var(--cf-maroon)',
                    isset($info->mission) && $info->mission ? $info->mission :
                    'To provide a permanent digital career ecosystem that connects FUTA students, alumni, employers and industry partners for internships, jobs, mentorship and career development throughout the year.'],
                ['fa-eye','Vision','var(--cf-gold-dark)',
                    isset($info->vision) && $info->vision ? $info->vision :
                    'A FUTA where every graduate is career-ready, well-connected and equipped with the tools and network to secure meaningful employment and build impactful careers.'],
                ['fa-star','Core Values','var(--cf-dark)',
                    'Excellence, Integrity, Innovation, Collaboration, Student-Centricity and Industry Partnership – driving everything we do at the Centre for Career Services.'],
            ];
            foreach ($mvv as $item):
            ?>
            <div style="background:white; border-radius:var(--cf-radius-lg); padding:28px; box-shadow:var(--cf-shadow); border-top:4px solid <?php echo $item[2]; ?>; text-align:center;">
                <div style="width:56px; height:56px; background:rgba(107,14,32,0.07); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:24px; color:<?php echo $item[2]; ?>; margin:0 auto 16px;">
                    <i class="fa-solid <?php echo $item[0]; ?>"></i>
                </div>
                <h4 style="font-size:19px; font-weight:800; color:var(--cf-dark); margin:0 0 12px;"><?php echo $item[1]; ?></h4>
                <p style="font-size:14px; color:var(--cf-grey); line-height:1.75; margin:0;"><?php echo $item[3]; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Career Fair Lifecycle -->
<section class="cf-section cf-section-bg">
    <div class="container">
        <div class="cf-section-title centered">
            <span class="cf-label">The Full Cycle</span>
            <h2>Career Fair Lifecycle</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px;">
            <?php
            $lifecycle = [
                ['Before the Fair','var(--cf-dark)','white','fa-calendar-plus',
                    ['Student & Employer Registration','CV Preparation & Upload','CV Vetting & Approval','Employer Onboarding','Booth Requests & Allocation','Sponsorship & Advertising','Pre-Fair Career Programmes']],
                ['During the Fair','var(--cf-maroon)','white','fa-store',
                    ['QR Code Check-in at Entrance','Employer Booth Scanning','Recruiter Tagging & Shortlisting','Interview Scheduling','Career Talks & Panel Sessions','Announcements & Live Updates']],
                ['After the Fair','var(--cf-gold-dark)','white','fa-chart-line',
                    ['Placement Monitoring','Employer Follow-up & Feedback','Student Feedback Surveys','Opportunity Publications','Sponsor Reports & Analytics','Career Services Year-round Support']],
            ];
            foreach ($lifecycle as $l):
            ?>
            <div style="background:<?php echo $l[1]; ?>; color:<?php echo $l[2]; ?>; border-radius:var(--cf-radius-lg); padding:28px; box-shadow:var(--cf-shadow);">
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:18px;">
                    <i class="fa-solid <?php echo $l[3]; ?>" style="font-size:22px;"></i>
                    <h5 style="font-size:17px; font-weight:800; margin:0;"><?php echo $l[0]; ?></h5>
                </div>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:9px;">
                    <?php foreach ($l[4] as $li): ?>
                    <li style="display:flex; align-items:flex-start; gap:8px; font-size:13.5px; opacity:0.9; line-height:1.4;">
                        <i class="fa-solid fa-circle-check" style="font-size:12px; margin-top:2px; flex-shrink:0;"></i>
                        <?php echo $li; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background:var(--cf-maroon); padding:60px 0; text-align:center;">
    <div class="container">
        <h2 style="font-size:clamp(24px,3.5vw,38px); font-weight:800; color:white; margin:0 0 12px;">Be Part of FUTA Career Fair 2026</h2>
        <p style="color:rgba(255,255,255,0.75); font-size:15px; margin:0 auto 28px; max-width:500px;">Students, employers and alumni – register today and be part of this transformative event.</p>
        <div style="display:flex; gap:14px; justify-content:center; flex-wrap:wrap;">
            <a href="<?php echo base_url(); ?>home/register/student" class="cf-btn cf-btn-gold cf-btn-lg">
                <i class="fa-solid fa-graduation-cap"></i> Student Registration
            </a>
            <a href="<?php echo base_url(); ?>home/register/employer" class="cf-btn cf-btn-outline cf-btn-lg" style="color:white; border-color:rgba(255,255,255,0.5);">
                <i class="fa-solid fa-building"></i> Employer Registration
            </a>
        </div>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
</body>
</html>
