<!DOCTYPE html>
<html lang="en">
<head>
    <title>Alumni &amp; Mentors – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>Alumni &amp; Mentors</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>Alumni &amp; Mentors</li></ul>
    </div>
</div>

<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:flex; align-items:center; gap:48px; flex-wrap:wrap;">
            <div style="flex:1; min-width:280px;">
                <span class="cf-label">Give Back. Connect. Inspire.</span>
                <h2 style="font-size:clamp(26px,4vw,44px); font-weight:800; color:var(--cf-dark); margin:10px 0 18px; line-height:1.2;">
                    FUTA Alumni &amp;<br><span style="color:var(--cf-maroon);">Mentor Network</span>
                </h2>
                <p style="font-size:15.5px; color:var(--cf-grey); line-height:1.75; margin-bottom:28px; max-width:500px;">
                    As a FUTA alumnus, you have the power to shape the next generation. Volunteer as a mentor, join industry panels, deliver career talks and help current students build the careers you blazed the trail for.
                </p>
                <div style="display:flex; gap:14px; flex-wrap:wrap;">
                    <a href="<?php echo base_url(); ?>home/register/alumni" class="cf-btn cf-btn-primary cf-btn-lg">
                        <i class="fa-solid fa-user-tie"></i> Join as Alumni / Mentor
                    </a>
                    <a href="<?php echo base_url(); ?>home/contact" class="cf-btn cf-btn-outline cf-btn-lg">
                        <i class="fa-regular fa-envelope"></i> Get in Touch
                    </a>
                </div>
            </div>
            <div style="flex-shrink:0; max-width:340px; width:100%;">
                <img src="<?php echo base_url(); ?>assetsp/images/alumni1.png" alt="FUTA Alumni"
                     style="width:100%; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg);">
            </div>
        </div>
    </div>
</section>

<section class="cf-section">
    <div class="container">
        <div class="cf-section-title centered">
            <span class="cf-label">Ways to Contribute</span>
            <h2>How Alumni Can Participate</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:20px;">
            <?php
            $roles = [
                ['fa-chalkboard-user','Career Talks','Share your career journey and industry insights in a talk session at the fair.'],
                ['fa-users','Industry Panels','Participate in panel discussions on the future of engineering, technology, agriculture and more.'],
                ['fa-handshake','Mentoring Sessions','Offer one-on-one or group mentoring to final-year and postgraduate students.'],
                ['fa-briefcase','Internship Offers','Offer internship placements through your current organisation.'],
                ['fa-star','FUTA Alumni Network','Connect with fellow FUTA graduates and be part of the growing alumni ecosystem.'],
                ['fa-globe','FUTAVerse Community','Contribute to the long-term FUTA career community for year-round engagement.'],
            ];
            foreach ($roles as $r):
            ?>
            <div class="cf-prog-card wow fadeInUp">
                <div class="cf-prog-card-icon" style="font-size:26px;"><i class="fa-solid <?php echo $r[0]; ?>"></i></div>
                <h5><?php echo $r[1]; ?></h5>
                <p><?php echo $r[2]; ?></p>
                <a href="<?php echo base_url(); ?>home/register/alumni" class="cf-link-join">
                    Get Involved <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section style="background:var(--cf-maroon); padding:60px 0; text-align:center;">
    <div class="container">
        <h2 style="font-size:clamp(24px,3.5vw,38px); font-weight:800; color:white; margin:0 0 12px;">Be the Inspiration You Once Needed</h2>
        <p style="color:rgba(255,255,255,0.75); font-size:15px; margin:0 auto 28px; max-width:500px;">Register today and help shape the careers of the next generation of FUTA graduates.</p>
        <a href="<?php echo base_url(); ?>home/register/alumni" class="cf-btn cf-btn-gold cf-btn-lg">
            <i class="fa-solid fa-user-plus"></i> Register as Alumni / Mentor
        </a>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
</body>
</html>
