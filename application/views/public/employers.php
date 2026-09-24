<!DOCTYPE html>
<html lang="en">
<head>
    <title>For Employers – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>For Employers</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>Employers</li></ul>
    </div>
</div>

<!-- Intro -->
<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:flex; align-items:center; gap:48px; flex-wrap:wrap;">
            <div style="flex-shrink:0; max-width:360px; width:100%;">
                <img src="<?php echo base_url(); ?>assetsp/images/employer1.png" alt="Employer at FUTA Career Fair"
                     style="width:100%; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg);">
            </div>
            <div style="flex:1; min-width:280px;">
                <span class="cf-label">Partner with FUTA. Access Top Talent.</span>
                <h2 style="font-size:clamp(26px,4vw,44px); font-weight:800; color:var(--cf-dark); margin:10px 0 18px; line-height:1.2;">
                    Build the Future<br>with <span style="color:var(--cf-maroon);">FUTA Graduates</span>
                </h2>
                <p style="font-size:15.5px; color:var(--cf-grey); line-height:1.75; margin-bottom:28px; max-width:500px;">
                    Access a pool of over 2,000 talented engineering, technology, science and agriculture graduates. Search CVs by discipline, filter by skills, shortlist candidates and schedule interviews – all through one platform.
                </p>
                <div style="display:flex; gap:14px; flex-wrap:wrap;">
                    <a href="<?php echo base_url(); ?>home/register/employer" class="cf-btn cf-btn-primary cf-btn-lg">
                        <i class="fa-solid fa-building"></i> Register Your Organisation
                    </a>
                    <a href="<?php echo base_url(); ?>home/contact" class="cf-btn cf-btn-outline cf-btn-lg">
                        <i class="fa-regular fa-envelope"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Participation Options -->
<section class="cf-section">
    <div class="container">
        <div class="cf-section-title centered">
            <span class="cf-label">How to Participate</span>
            <h2>Employer Participation Options</h2>
            <p>Multiple ways to engage with FUTA's talent pool and build your brand on campus.</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:20px;">
            <?php
            $options = [
                ['fa-store','Exhibition Booth','Set up a branded booth at the Career Fair. Meet students face-to-face, distribute materials and conduct on-the-spot screenings.','Request Booth','home/register/employer'],
                ['fa-microphone-lines','Career Talk','Give a career talk or panel session. Showcase your organisation and attract the best talent.','Request Talk','home/contact'],
                ['fa-magnifying-glass-chart','CV Search & Filtering','Access approved student CVs. Filter by school, department, skills, career interest and availability.','Browse Talent','home/register/employer'],
                ['fa-list-check','Shortlisting System','Save candidates to your shortlist, tag them and send interview invitations directly through the portal.','Learn More','home/register/employer'],
                ['fa-qrcode','QR Booth Scanning','Scan student QR passes at your booth and instantly tag them as Interested, Strong Candidate, Interview, etc.','Learn More','home/register/employer'],
                ['fa-bullhorn','Advertising & Sponsorship','Advertise on the portal homepage, event banners and printed materials. Become a Platinum, Gold or Silver sponsor.','Enquire','home/contact'],
            ];
            foreach ($options as $o):
            ?>
            <div class="cf-prog-card wow fadeInUp">
                <div class="cf-prog-card-icon" style="font-size:28px;"><i class="fa-solid <?php echo $o[0]; ?>"></i></div>
                <h5><?php echo $o[1]; ?></h5>
                <p><?php echo $o[2]; ?></p>
                <a href="<?php echo base_url().$o[4]; ?>" class="cf-link-join">
                    <?php echo $o[3]; ?> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Sponsorship Packages -->
<section class="cf-section cf-section-bg">
    <div class="container">
        <div class="cf-section-title centered">
            <span class="cf-label">Support the Future</span>
            <h2>Sponsorship Packages</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:20px; max-width:900px; margin:0 auto;">
            <?php
            $packages = [
                ['Platinum','#6B0E20','white','Premium booth, keynote speaking, logo on all materials, featured CV access, social media promotion'],
                ['Gold','#C9A84C','#1A1A2E','Standard booth, speaking opportunity, logo on materials, CV access'],
                ['Silver','#aaa','white','Booth space, logo on digital materials, CV access'],
                ['Partner','#1A1A2E','white','Logo on materials, digital advertising, career talk slot'],
                ['Custom','#2d2d44','white','Tailored package to meet your specific goals and budget'],
            ];
            foreach ($packages as $i => $p):
            ?>
            <div style="background:<?php echo $p[1]; ?>; color:<?php echo $p[2]; ?>; border-radius:var(--cf-radius-lg); padding:28px 20px; text-align:center; box-shadow:var(--cf-shadow);">
                <div style="font-size:20px; font-weight:800; margin-bottom:12px;"><?php echo $p[0]; ?></div>
                <div style="font-size:12.5px; line-height:1.65; opacity:0.85; margin-bottom:16px;"><?php echo $p[3]; ?></div>
                <a href="<?php echo base_url(); ?>home/contact" style="display:inline-block; padding:8px 18px; border:2px solid <?php echo $p[2]; ?>; border-radius:50px; font-size:12px; font-weight:700; color:<?php echo $p[2]; ?>; text-decoration:none; transition:all 0.2s;">
                    Enquire
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background:var(--cf-dark); padding:60px 0; text-align:center;">
    <div class="container">
        <h2 style="font-size:clamp(24px,3.5vw,38px); font-weight:800; color:white; margin:0 0 12px;">Ready to Recruit Top FUTA Talent?</h2>
        <p style="color:rgba(255,255,255,0.65); font-size:15px; margin:0 auto 28px; max-width:500px;">Register your organisation today and get access to FUTA's growing talent pool.</p>
        <a href="<?php echo base_url(); ?>home/register/employer" class="cf-btn cf-btn-gold cf-btn-lg">
            <i class="fa-solid fa-building"></i> Register as Employer
        </a>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
</body>
</html>
