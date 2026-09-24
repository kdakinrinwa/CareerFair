<?php
$CI     =& get_instance();
$method = $CI->router->fetch_method();
$user   = $CI->session->userdata('userdata');
$name   = isset($user['fullname']) ? $user['fullname'] : 'Admin';
$group  = isset($user['usergroup']) ? $user['usergroup'] : 'admin';
$init   = strtoupper(substr($name, 0, 1));

// Pending counts for badges
$pending_emp = 0;
$pending_stu = 0;
$unread_msg  = 0;
if ($CI->db->table_exists('cf_employers'))  $pending_emp = $CI->db->where('accstatus','pending')->count_all_results('cf_employers');
if ($CI->db->table_exists('cf_students'))   $pending_stu = $CI->db->where('accstatus','pending')->count_all_results('cf_students');
if ($CI->db->table_exists('contactmess'))   $unread_msg  = $CI->db->count_all('contactmess');

function a_active($method, $targets) {
    return in_array($method, (array)$targets) ? 'active' : '';
}
?>
<div class="portal-sidebar" id="portal-sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
        <div class="sidebar-logo-text">
            <span class="sl-main">FUTA Career Services</span>
            <span class="sl-sub">Super Admin Panel</span>
        </div>
    </div>

    <!-- Admin user -->
    <div class="sidebar-user">
        <div class="sidebar-avatar"><?php echo $init; ?></div>
        <div>
            <div class="sidebar-user-name"><?php echo htmlspecialchars(substr($name, 0, 20)); ?></div>
            <div class="sidebar-user-role"><?php echo ucfirst($group); ?></div>
            <div class="sidebar-user-status">Active Session</div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">

        <div class="sidebar-nav-section">Overview</div>
        <a href="<?php echo base_url(); ?>admin/dashboard" class="<?php echo a_active($method,'dashboard'); ?>">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>
        <a href="<?php echo base_url(); ?>admin/reports" class="<?php echo a_active($method,'reports'); ?>">
            <i class="fa-solid fa-chart-line"></i> Analytics &amp; Reports
        </a>
        <a href="<?php echo base_url(); ?>admin/audit_log" class="<?php echo a_active($method,'audit_log'); ?>">
            <i class="fa-solid fa-list-check"></i> Audit Log
        </a>

        <div class="sidebar-nav-section">Registration</div>
        <a href="<?php echo base_url(); ?>admin/students" class="<?php echo a_active($method,'students'); ?>">
            <i class="fa-solid fa-user-graduate"></i> Students
            <?php if ($pending_stu): ?><span class="nav-badge"><?php echo $pending_stu; ?></span><?php endif; ?>
        </a>
        <a href="<?php echo base_url(); ?>admin/employers" class="<?php echo a_active($method,'employers'); ?>">
            <i class="fa-solid fa-building"></i> Employers
            <?php if ($pending_emp): ?><span class="nav-badge"><?php echo $pending_emp; ?></span><?php endif; ?>
        </a>

        <div class="sidebar-nav-section">Career Fair</div>
        <a href="<?php echo base_url(); ?>checkin/scan" target="_blank" style="color:#4ade80 !important; border-left-color:#4ade80 !important;">
            <i class="fa-solid fa-qrcode" style="color:#4ade80;"></i> QR Scanner (Live)
        </a>
        <a href="<?php echo base_url(); ?>checkin/attendance" target="_blank">
            <i class="fa-solid fa-users"></i> Attendance Board
        </a>
        <a href="<?php echo base_url(); ?>admin/booths" class="<?php echo a_active($method,'booths'); ?>">
            <i class="fa-solid fa-store"></i> Booth Requests
        </a>
        <a href="<?php echo base_url(); ?>admin/talks" class="<?php echo a_active($method,'talks'); ?>">
            <i class="fa-solid fa-microphone-lines"></i> Career Talks
        </a>
        <a href="<?php echo base_url(); ?>admin/opportunities" class="<?php echo a_active($method,'opportunities'); ?>">
            <i class="fa-solid fa-briefcase"></i> Opportunities
        </a>
        <a href="<?php echo base_url(); ?>admin/qr_passes" class="<?php echo a_active($method,'qr_passes'); ?>">
            <i class="fa-solid fa-qrcode"></i> QR Passes
        </a>

        <div class="sidebar-nav-section">Content</div>
        <a href="<?php echo base_url(); ?>admin/news" class="<?php echo a_active($method,['news','add_news','edit_news']); ?>">
            <i class="fa-regular fa-newspaper"></i> News &amp; Events
        </a>
        <a href="<?php echo base_url(); ?>admin/messages" class="<?php echo a_active($method,'messages'); ?>">
            <i class="fa-regular fa-envelope"></i> Messages
            <?php if ($unread_msg): ?><span class="nav-badge"><?php echo $unread_msg; ?></span><?php endif; ?>
        </a>

        <div class="sidebar-nav-section">System</div>
        <a href="<?php echo base_url(); ?>admin/settings" class="<?php echo a_active($method,'settings'); ?>">
            <i class="fa-solid fa-gear"></i> Site Settings
        </a>
        <?php if ($group === 'superadmin'): ?>
        <a href="<?php echo base_url(); ?>admin/admins" class="<?php echo a_active($method,'admins'); ?>">
            <i class="fa-solid fa-user-shield"></i> Admin Users
        </a>
        <?php endif; ?>
        <a href="<?php echo base_url(); ?>admin/changepass" class="<?php echo a_active($method,'changepass'); ?>">
            <i class="fa-solid fa-key"></i> Change Password
        </a>
        <a href="<?php echo base_url(); ?>" target="_blank">
            <i class="fa-solid fa-globe"></i> View Website
        </a>

    </nav>

    <div class="sidebar-bottom">
        <a href="<?php echo base_url(); ?>admin/signout" style="display:flex;align-items:center;gap:10px;padding:12px 16px;color:rgba(255,100,100,.8);font-size:13.5px;font-weight:600;text-decoration:none;">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
        </a>
    </div>
</div>
