<?php
$CI =& get_instance();
$method = $CI->router->fetch_method();
$uid    = $CI->session->userdata('userid');

// Unread notification count
$unread = 0;
if ($CI->db->table_exists('cf_notifications')) {
    $CI->db->where(['user_id'=>$uid,'user_type'=>'student','is_read'=>0]);
    $unread = $CI->db->count_all_results('cf_notifications');
}

// Student name for display
$s_name = isset($student) && $student ? $student->fullname : $CI->session->userdata('userdata')['fullname'] ?? 'Student';
$initials = strtoupper(substr($s_name,0,1));
?>
<div class="portal-sidebar" id="portal-sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
        <div class="sidebar-logo-text">
            <span class="sl-main">Career Services</span>
            <span class="sl-sub">FUTA Career Fair 2026</span>
        </div>
    </div>

    <!-- User Info -->
    <div class="sidebar-user">
        <div class="sidebar-avatar">
            <?php if (!empty($student->passport)): ?>
            <img src="<?php echo base_url().'uploads/photos/'.htmlspecialchars($student->passport); ?>" alt="">
            <?php else: ?>
            <?php echo $initials; ?>
            <?php endif; ?>
        </div>
        <div>
            <div class="sidebar-user-name"><?php echo htmlspecialchars(substr($s_name,0,20)); ?></div>
            <div class="sidebar-user-role">Student Portal</div>
            <div class="sidebar-user-status">Online</div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <div class="sidebar-nav-section">Main Menu</div>
        <a href="<?php echo base_url(); ?>student/dashboard" class="<?php echo $method==='dashboard'?'active':''; ?>">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
        <a href="<?php echo base_url(); ?>student/profile" class="<?php echo $method==='profile'?'active':''; ?>">
            <i class="fa-solid fa-user-circle"></i> My Profile
        </a>
        <a href="<?php echo base_url(); ?>student/cv" class="<?php echo $method==='cv'?'active':''; ?>">
            <i class="fa-regular fa-file-lines"></i> My CV
        </a>
        <a href="<?php echo base_url(); ?>student/qr" class="<?php echo $method==='qr'?'active':''; ?>">
            <i class="fa-solid fa-qrcode"></i> QR Event Pass
        </a>

        <div class="sidebar-nav-section">Career Fair</div>
        <a href="<?php echo base_url(); ?>student/opportunities" class="<?php echo $method==='opportunities'?'active':''; ?>">
            <i class="fa-solid fa-briefcase"></i> Opportunities
        </a>
        <a href="<?php echo base_url(); ?>student/events" class="<?php echo $method==='events'?'active':''; ?>">
            <i class="fa-regular fa-calendar-days"></i> Events &amp; Sessions
        </a>
        <a href="<?php echo base_url(); ?>student/messages" class="<?php echo $method==='messages'?'active':''; ?>">
            <i class="fa-regular fa-bell"></i> Notifications
            <?php if ($unread > 0): ?>
            <span class="nav-badge"><?php echo $unread; ?></span>
            <?php endif; ?>
        </a>

        <div class="sidebar-nav-section">Account</div>
        <a href="<?php echo base_url(); ?>student/settings" class="<?php echo $method==='settings'?'active':''; ?>">
            <i class="fa-solid fa-gear"></i> Settings
        </a>
        <a href="<?php echo base_url(); ?>" target="_blank">
            <i class="fa-solid fa-globe"></i> Public Site
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="<?php echo base_url(); ?>student/logout" style="display:flex;align-items:center;gap:10px;padding:10px 16px;color:rgba(255,100,100,.75);font-size:13.5px;font-weight:600;text-decoration:none;">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </a>
    </div>
</div>
