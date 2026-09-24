<?php
// Determine active controller/method for nav highlighting
$CI =& get_instance();
$active_ctrl   = strtolower($CI->router->fetch_class());
$active_method = strtolower($CI->router->fetch_method());
?>

<!-- ========== TOP BAR ========== -->
<div class="cf-topbar">
    <div class="container">
        <div class="topbar-inner">
            <div class="topbar-left">
                <span><i class="fa-solid fa-envelope fa-fw"></i>
                    <?php echo isset($info->email1) ? htmlspecialchars($info->email1) : 'careerservices@futa.edu.ng'; ?>
                </span>
                <span><i class="fa-solid fa-phone fa-fw"></i>
                    <?php echo isset($info->phone1) ? htmlspecialchars($info->phone1) : '+234 703 000 0000'; ?>
                </span>
                <span><i class="fa-solid fa-location-dot fa-fw"></i>
                    Centre for Career Services, FUTA, Akure
                </span>
            </div>
            <div class="topbar-right">
                <div class="topbar-social">
                    <?php if (!empty($info->linkedin ?? '')): ?>
                    <a href="<?php echo $info->linkedin; ?>" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <?php else: ?>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <?php endif; ?>
                    <a href="<?php echo isset($info->twitter) && $info->twitter ? $info->twitter : '#'; ?>" target="_blank" aria-label="X/Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="<?php echo isset($info->instagram) && $info->instagram ? $info->instagram : '#'; ?>" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="<?php echo isset($info->facebook) && $info->facebook ? $info->facebook : '#'; ?>" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?php echo isset($info->youtube) && $info->youtube ? $info->youtube : '#'; ?>" target="_blank" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== MAIN HEADER ========== -->
<header class="cf-header" id="cf-header">
    <div class="container">
        <div class="header-inner">

            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="cf-logo">
                <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA Logo" width="60" height="60">
                <div class="cf-logo-text">
                    <span class="logo-main">FUTA Centre for Career Services</span>
                    <span class="logo-sub">The Federal University of Technology, Akure</span>
                    <span class="logo-tagline">People &bull; Opportunities &bull; A Brighter Tomorrow</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav aria-label="Main navigation">
                <ul class="cf-nav" id="cf-main-nav">
                    <li class="<?php echo ($active_method == 'index') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="<?php echo ($active_method == 'about') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>home/about">About</a>
                    </li>
                    <li class="dropdown <?php echo (in_array($active_method, ['careerfair', 'fair_info', 'venue'])) ? 'active' : ''; ?>">
                        <a href="#">Career Fair</a>
                        <ul class="dropdown-menu-cf">
                            <li><a href="<?php echo base_url(); ?>home/careerfair"><i class="fa-regular fa-calendar-days fa-fw me-2"></i> Career Fair 2026</a></li>
                            <li><a href="<?php echo base_url(); ?>home/events"><i class="fa-solid fa-list-check fa-fw me-2"></i> Programme &amp; Schedule</a></li>
                            <li><a href="<?php echo base_url(); ?>home/venue"><i class="fa-solid fa-location-dot fa-fw me-2"></i> Venue &amp; Directions</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($active_method == 'students') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>home/students">Students</a>
                    </li>
                    <li class="<?php echo ($active_method == 'employers') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>home/employers">Employers</a>
                    </li>
                    <li class="<?php echo ($active_method == 'alumni') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>home/alumni">Alumni</a>
                    </li>
                    <li class="dropdown <?php echo (in_array($active_method, ['resources', 'events', 'album', 'videos'])) ? 'active' : ''; ?>">
                        <a href="#">Resources</a>
                        <ul class="dropdown-menu-cf">
                            <li><a href="<?php echo base_url(); ?>home/programmes"><i class="fa-solid fa-briefcase fa-fw me-2"></i> Career Resources</a></li>
                            <li><a href="<?php echo base_url(); ?>home/album"><i class="fa-regular fa-images fa-fw me-2"></i> Gallery</a></li>
                            <li><a href="<?php echo base_url(); ?>home/videos"><i class="fa-brands fa-youtube fa-fw me-2"></i> Videos</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($active_method == 'events') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>home/events">Events</a>
                    </li>
                    <li class="<?php echo ($active_method == 'contact') ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>home/contact">Contact</a>
                    </li>
                </ul>
            </nav>

            <!-- Header Buttons -->
            <div class="cf-header-btns">
                <a href="<?php echo base_url(); ?>home/login" class="cf-btn cf-btn-outline cf-btn-sm">
                    <i class="fa-regular fa-user"></i> Login
                </a>
                <a href="<?php echo base_url(); ?>home/register" class="cf-btn cf-btn-primary cf-btn-sm">
                    <i class="fa-solid fa-user-plus"></i> Sign Up
                </a>
            </div>

            <!-- Mobile Toggle -->
            <button class="cf-mobile-toggle" id="cf-mobile-toggle" aria-label="Open mobile menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</header>

<!-- ========== MOBILE MENU ========== -->
<div class="cf-mobile-menu" id="cf-mobile-menu" role="dialog" aria-label="Mobile navigation">
    <div class="cf-mobile-menu-inner">
        <div class="mobile-close">
            <button class="mobile-close-btn" aria-label="Close menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <!-- Mobile Logo -->
        <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px; padding-bottom:16px; border-bottom:2px solid #6B0E20;">
            <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA Logo" style="height:44px; width:auto;">
            <div>
                <div style="font-size:12px; font-weight:700; color:#6B0E20; text-transform:uppercase;">FUTA Career Services</div>
                <div style="font-size:10px; color:#666;">Career Fair 2026</div>
            </div>
        </div>

        <ul class="cf-mobile-nav">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>home/about">About</a></li>
            <li class="has-sub">
                <a href="#">Career Fair <i class="fa-solid fa-chevron-down" style="font-size:10px; margin-left:5px;"></i></a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>home/careerfair">Career Fair 2026</a></li>
                    <li><a href="<?php echo base_url(); ?>home/events">Programme &amp; Schedule</a></li>
                    <li><a href="<?php echo base_url(); ?>home/venue">Venue &amp; Directions</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>home/students">Students</a></li>
            <li><a href="<?php echo base_url(); ?>home/employers">Employers</a></li>
            <li><a href="<?php echo base_url(); ?>home/alumni">Alumni</a></li>
            <li class="has-sub">
                <a href="#">Resources <i class="fa-solid fa-chevron-down" style="font-size:10px; margin-left:5px;"></i></a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url(); ?>home/programmes">Career Resources</a></li>
                    <li><a href="<?php echo base_url(); ?>home/album">Gallery</a></li>
                    <li><a href="<?php echo base_url(); ?>home/videos">Videos</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url(); ?>home/events">Events</a></li>
            <li><a href="<?php echo base_url(); ?>home/contact">Contact</a></li>
        </ul>

        <div style="margin-top:24px; display:flex; flex-direction:column; gap:10px;">
            <a href="<?php echo base_url(); ?>home/login" class="cf-btn cf-btn-outline w-100" style="justify-content:center;">
                <i class="fa-regular fa-user"></i> Login / Sign In
            </a>
            <a href="<?php echo base_url(); ?>home/register" class="cf-btn cf-btn-primary w-100" style="justify-content:center;">
                <i class="fa-solid fa-user-plus"></i> Register Now
            </a>
        </div>
    </div>
</div>
