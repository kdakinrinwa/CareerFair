<?php
$CI     =& get_instance();
$method = $CI->router->fetch_method();
$e      = isset($employer) ? $employer : null;
$name   = $e ? $e->org_name : 'Employer';
$init   = strtoupper(substr($name,0,1));
?>
<div class="portal-sidebar" id="portal-sidebar">
    <div class="sidebar-logo">
        <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
        <div class="sidebar-logo-text">
            <span class="sl-main">Employer Portal</span>
            <span class="sl-sub">FUTA Career Fair 2026</span>
        </div>
    </div>
    <div class="sidebar-user">
        <div class="sidebar-avatar"><?php echo $init; ?></div>
        <div>
            <div class="sidebar-user-name"><?php echo htmlspecialchars(substr($name,0,20)); ?></div>
            <div class="sidebar-user-role">Employer Account</div>
            <?php if ($e && $e->accstatus === 'approved'): ?>
            <div class="sidebar-user-status">Approved</div>
            <?php else: ?>
            <div style="font-size:10px;color:#f59e0b;margin-top:2px;"><i class="fa-solid fa-clock"></i> Pending Approval</div>
            <?php endif; ?>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="sidebar-nav-section">Main Menu</div>
        <a href="<?php echo base_url(); ?>employer/dashboard" class="<?php echo $method==='dashboard'?'active':''; ?>">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="<?php echo base_url(); ?>employer/profile" class="<?php echo $method==='profile'?'active':''; ?>">
            <i class="fa-solid fa-building"></i> Company Profile
        </a>
        <div class="sidebar-nav-section">Recruitment</div>
        <a href="<?php echo base_url(); ?>employer/candidates" class="<?php echo $method==='candidates'?'active':''; ?>">
            <i class="fa-solid fa-users"></i> Talent Vault / CV Search
        </a>
        <a href="<?php echo base_url(); ?>employer/shortlist" class="<?php echo $method==='shortlist'?'active':''; ?>">
            <i class="fa-solid fa-star"></i> My Shortlist
        </a>
        <a href="<?php echo base_url(); ?>employer/opportunities" class="<?php echo $method==='opportunities'?'active':''; ?>">
            <i class="fa-solid fa-briefcase"></i> Job / Internship Posts
        </a>
        <div class="sidebar-nav-section">Career Fair</div>
        <a href="<?php echo base_url(); ?>employer/booth" class="<?php echo $method==='booth'?'active':''; ?>">
            <i class="fa-solid fa-store"></i> Booth Request
        </a>
        <a href="<?php echo base_url(); ?>" target="_blank">
            <i class="fa-solid fa-globe"></i> Public Site
        </a>
    </nav>
    <div class="sidebar-bottom">
        <a href="<?php echo base_url(); ?>employer/logout" style="display:flex;align-items:center;gap:10px;padding:10px 16px;color:rgba(255,100,100,.75);font-size:13.5px;font-weight:600;text-decoration:none;">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </a>
    </div>
</div>
