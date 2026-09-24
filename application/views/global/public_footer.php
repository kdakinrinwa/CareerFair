<!-- ========== NEWSLETTER / CTA STRIP ========== -->
<section class="cf-cta-banner cf-footer-cta-strip">
    <div class="container">
        <div class="cf-cta-inner">
            <div class="cf-cta-text">
                <h2>Your Next Opportunity Starts Here</h2>
                <p>Join thousands of FUTA students and connect with top employers at the FUTA Career Fair 2026.</p>
            </div>
            <a href="<?php echo base_url(); ?>home/register" class="cf-btn cf-btn-gold cf-btn-lg">
                Get Started Today <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- ========== MAIN FOOTER ========== -->
<footer class="cf-footer-top">
    <div class="container">
        <div class="row" style="gap: 0;">

            <!-- Column 1: About -->
            <div class="col-lg-4" style="padding-bottom: 30px;">
                <div class="cf-footer-logo">
                    <img src="<?php echo base_url(); ?>assetsp/images/footer-logo.png" alt="FUTA Logo">
                    <div class="cf-footer-logo-text">
                        <span class="f-main">FUTA Centre for Career Services</span>
                        <span class="f-sub">The Federal University of Technology, Akure</span>
                        <span class="f-tag">Technology for Self Reliance</span>
                    </div>
                </div>
                <p class="cf-footer-about">
                    The FUTA Career Services &amp; Career Fair Portal connects students, alumni, employers and industry partners for internships, jobs, mentorship and career development opportunities throughout the year.
                </p>
                <div class="cf-footer-social">
                    <a href="<?php echo isset($info->facebook) && $info->facebook ? $info->facebook : '#'; ?>" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?php echo isset($info->twitter) && $info->twitter ? $info->twitter : '#'; ?>" target="_blank" aria-label="X/Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="<?php echo isset($info->instagram) && $info->instagram ? $info->instagram : '#'; ?>" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="<?php echo isset($info->youtube) && $info->youtube ? $info->youtube : '#'; ?>" target="_blank" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-lg-2" style="padding-bottom: 30px;">
                <h5 class="cf-footer-title">Quick Links</h5>
                <ul class="cf-footer-links">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>home/about">About Us</a></li>
                    <li><a href="<?php echo base_url(); ?>home/careerfair">Career Fair 2026</a></li>
                    <li><a href="<?php echo base_url(); ?>home/students">For Students</a></li>
                    <li><a href="<?php echo base_url(); ?>home/employers">For Employers</a></li>
                    <li><a href="<?php echo base_url(); ?>home/alumni">Alumni &amp; Mentors</a></li>
                    <li><a href="<?php echo base_url(); ?>home/events">Events</a></li>
                    <li><a href="<?php echo base_url(); ?>home/contact">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3: Recent Events -->
            <div class="col-lg-3" style="padding-bottom: 30px;">
                <h5 class="cf-footer-title">Recent Events</h5>
                <?php if (isset($eventf) && !empty($eventf)):
                    foreach ($eventf as $row): ?>
                    <div style="display:flex; gap:12px; align-items:flex-start; margin-bottom:16px;">
                        <div style="width:56px; height:56px; border-radius:8px; overflow:hidden; flex-shrink:0;">
                            <img src="<?php echo base_url(); ?>uploads/<?php echo htmlspecialchars($row->thumbnail); ?>"
                                 alt="<?php echo htmlspecialchars($row->title); ?>"
                                 style="width:100%; height:100%; object-fit:cover;">
                        </div>
                        <div>
                            <a href="<?php echo site_url('home/viewevent') . '/' . $row->newsid; ?>"
                               style="font-size:13px; font-weight:600; color:rgba(255,255,255,0.8); line-height:1.4; display:block; margin-bottom:4px;">
                                <?php echo htmlspecialchars(substr($row->title, 0, 52)); ?>
                            </a>
                            <span style="font-size:11px; color:rgba(255,255,255,0.45);">
                                <i class="fa-regular fa-calendar fa-fw"></i>
                                <?php
                                    $d = strtotime($row->eventday);
                                    echo date('M d, Y', $d);
                                ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
            </div>

            <!-- Column 4: Contact + Newsletter -->
            <div class="col-lg-3" style="padding-bottom: 30px;">
                <h5 class="cf-footer-title">Contact Us</h5>
                <ul class="cf-footer-contact">
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span><?php echo isset($info->address1) ? htmlspecialchars($info->address1) : 'Centre for Career Services, FUTA, Akure, Ondo State, Nigeria'; ?></span>
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope"></i>
                        <span><?php echo isset($info->email1) ? htmlspecialchars($info->email1) : 'careerservices@futa.edu.ng'; ?></span>
                    </li>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        <span><?php echo isset($info->phone1) ? htmlspecialchars($info->phone1) : '+234 703 000 0000'; ?></span>
                    </li>
                </ul>

                <div style="margin-top:20px;">
                    <p class="cf-footer-tagline">
                        <strong>Preparing FUTA Students</strong><br>
                        for the Workplace... Today and Tomorrow.
                    </p>
                </div>

                <div class="cf-footer-newsletter" style="margin-top:16px;">
                    <p style="font-size:13px; color:rgba(255,255,255,0.6); margin-bottom:6px; font-weight:600;">Stay Updated</p>
                    <div class="input-group">
                        <input type="email" id="cf-emailadd" name="emailadd" placeholder="Your email address" autocomplete="email">
                        <button type="button" id="cf-newsletter-btn">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>


