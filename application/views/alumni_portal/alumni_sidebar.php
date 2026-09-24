<?php
$CI     =& get_instance();
$method = $CI->router->fetch_method();
$a      = isset($alumni) ? $alumni : null;
$name   = $a ? $a->fullname : 'Alumni';
?>
<div class="portal-sidebar" id="portal-sidebar">
    <div class="sidebar-logo">
        <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
        <div class="sidebar-logo-text">
            <span class="sl-main">Alumni Portal</span>
            <span class="sl-sub">FUTA Career Fair 2026</span>
        </div>
    </div>
    <div class="sidebar-user">
        <div class="sidebar-avatar"><?php echo strtoupper(substr($name,0,1)); ?></div>
        <div>
            <div class="sidebar-user-name"><?php echo htmlspecialchars(substr($name,0,20)); ?></div>
            <div class="sidebar-user-role">Alumni Account</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="sidebar-nav-section">Main Menu</div>
        <a href="<?php echo base_url(); ?>alumni/dashboard" class="<?php echo $method==='dashboard'?'active':''; ?>">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="<?php echo base_url(); ?>" target="_blank">
            <i class="fa-solid fa-globe"></i> Public Site
        </a>
    </nav>
    <div class="sidebar-bottom">
        <a href="<?php echo base_url(); ?>alumni/logout" style="display:flex;align-items:center;gap:10px;padding:10px 16px;color:rgba(255,100,100,.75);font-size:13.5px;font-weight:600;text-decoration:none;">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </a>
    </div>
</div>
