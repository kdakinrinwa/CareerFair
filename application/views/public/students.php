<!DOCTYPE html>
<html lang="en">
<head>
    <title>For Students – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<!-- Page Banner -->
<div class="cf-page-title">
    <div class="container">
        <h1>For Students</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>Students</li></ul>
    </div>
</div>

<!-- Hero intro -->
<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:flex; align-items:center; gap:48px; flex-wrap:wrap;">
            <div style="flex:1; min-width:280px;">
                <span class="cf-label">Your Career Starts Here</span>
                <h2 style="font-size:clamp(26px,4vw,44px); font-weight:800; color:var(--cf-dark); margin:10px 0 18px; line-height:1.2;">
                    Build Your Future at<br><span style="color:var(--cf-maroon);">FUTA Career Fair 2026</span>
                </h2>
                <p style="font-size:15.5px; color:var(--cf-grey); line-height:1.75; margin-bottom:28px; max-width:500px;">
                    Discover internships, graduate jobs and NYSC placements. Connect with 100+ companies across every industry. Get your CV reviewed and walk away with real opportunities.
                </p>
                <div style="display:flex; gap:14px; flex-wrap:wrap;">
                    <a href="<?php echo base_url(); ?>home/register/student" class="cf-btn cf-btn-primary cf-btn-lg">
                        <i class="fa-solid fa-user-plus"></i> Register Now – It's Free
                    </a>
                    <a href="<?php echo base_url(); ?>home/cv" class="cf-btn cf-btn-outline cf-btn-lg">
                        <i class="fa-regular fa-file-lines"></i> Submit Your CV
                    </a>
                </div>
            </div>
            <div style="flex-shrink:0; max-width:360px; width:100%;">
                <img src="<?php echo base_url(); ?>assetsp/images/student2.png" alt="FUTA Student"
                     style="width:100%; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg);">
            </div>
        </div>
    </div>
</section>

<!-- What Students Can Do -->
<section class="cf-section">
    <div class="container">
        <div class="cf-section-title centered">
            <span class="cf-label">Everything You Need</span>
            <h2>What You Can Do on the Portal</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:20px;">
            <?php
            $features = [
                ['fa-user-circle','Create Your Profile','Build a complete career profile with your academic details, skills, and career interests.'],
                ['fa-file-lines','Upload Your CV','Submit a PDF/DOCX CV tagged with your discipline, skills and preferred industries.'],
                ['fa-magnifying-glass','Browse Opportunities','Search and filter internships, graduate jobs and NYSC placements by industry and skill.'],
                ['fa-qrcode','Get Your Event Pass','Receive a digital QR-coded event pass for seamless entry and booth interactions at the fair.'],
                ['fa-calendar-check','Register for Events','Sign up for CV clinics, mock interviews, career talks, workshops and industry panels.'],
                ['fa-star','Get Shortlisted','Be discovered by employers reviewing CVs matched to their requirements and discipline needs.'],
            ];
            foreach ($features as $f):
            ?>
            <div class="cf-feature-item wow fadeInUp">
                <div class="cf-feature-icon"><i class="fa-solid <?php echo $f[0]; ?>"></i></div>
                <h5><?php echo $f[1]; ?></h5>
                <p><?php echo $f[2]; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Student Profile Requirements -->
<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:flex; align-items:flex-start; gap:48px; flex-wrap:wrap;">
            <div style="flex:1; min-width:260px;">
                <div class="cf-section-title">
                    <span class="cf-label">What to Prepare</span>
                    <h2>Complete Your Profile</h2>
                    <p>A complete profile increases your chances of being shortlisted. Here is what employers want to see.</p>
                </div>
                <div style="display:flex; flex-direction:column; gap:14px;">
                    <?php
                    $profile_items = [
                        ['fa-id-card','Personal Details','Name, matric number, email, phone and photograph'],
                        ['fa-graduation-cap','Academic Information','School, department, programme and level'],
                        ['fa-code','Technical Skills','Python, AutoCAD, MATLAB, Networking, GIS, etc.'],
                        ['fa-briefcase','Career Interests','Internship, NYSC, graduate job, mentoring'],
                        ['fa-file-pdf','CV Upload','PDF or DOCX, clearly structured and up to date'],
                        ['fa-link','Portfolio Links','GitHub, LinkedIn, Behance, personal website'],
                    ];
                    foreach ($profile_items as $item):
                    ?>
                    <div style="display:flex; align-items:flex-start; gap:14px; padding:14px; background:white; border-radius:var(--cf-radius); border:1px solid var(--cf-border);">
                        <div style="width:38px; height:38px; background:rgba(107,14,32,0.08); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:17px; color:var(--cf-maroon); flex-shrink:0;">
                            <i class="fa-solid <?php echo $item[0]; ?>"></i>
                        </div>
                        <div>
                            <div style="font-size:14px; font-weight:700; color:var(--cf-dark); margin-bottom:3px;"><?php echo $item[1]; ?></div>
                            <div style="font-size:12.5px; color:var(--cf-grey);"><?php echo $item[2]; ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div style="flex:1; min-width:260px;">
                <div class="cf-section-title">
                    <span class="cf-label">Fair Day Tips</span>
                    <h2>Career Fair Checklist</h2>
                </div>
                <div style="background:white; border-radius:var(--cf-radius-lg); padding:28px; box-shadow:var(--cf-shadow); border-left:4px solid var(--cf-gold);">
                    <?php
                    $checklist = [
                        'Register on the portal before the fair',
                        'Complete your profile 100%',
                        'Upload an updated CV (PDF format)',
                        'Download and print your QR Event Pass',
                        'Research companies attending the fair',
                        'Prepare a 60-second personal pitch',
                        'Dress professionally on the day',
                        'Bring printed copies of your CV',
                        'Collect business cards and follow up',
                        'Attend at least one career talk or workshop',
                    ];
                    foreach ($checklist as $i => $item):
                    ?>
                    <div style="display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid var(--cf-border);">
                        <div style="width:26px; height:26px; background:var(--cf-maroon); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:11px; flex-shrink:0;">
                            <?php echo $i+1; ?>
                        </div>
                        <span style="font-size:13.5px; color:var(--cf-dark);"><?php echo $item; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background:var(--cf-maroon); padding:60px 0; text-align:center;">
    <div class="container">
        <h2 style="font-size:clamp(24px,3.5vw,38px); font-weight:800; color:white; margin:0 0 12px;">Ready to Start Your Career Journey?</h2>
        <p style="color:rgba(255,255,255,0.75); font-size:15px; margin:0 auto 28px; max-width:500px;">Join thousands of FUTA students already registered for the Career Fair 2026.</p>
        <a href="<?php echo base_url(); ?>home/register/student" class="cf-btn cf-btn-gold cf-btn-lg">
            <i class="fa-solid fa-user-plus"></i> Register as Student
        </a>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
</body>
</html>
