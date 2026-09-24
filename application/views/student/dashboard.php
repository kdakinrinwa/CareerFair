<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body class="portal-body">
<div class="portal-wrap">

    <!-- Sidebar -->
    <?php echo $sidebar; ?>

    <!-- Main -->
    <main class="portal-main">

        <!-- Top Bar -->
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle" aria-label="Toggle menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="portal-topbar-title">Dashboard</div>
            <div class="portal-topbar-actions">
                <a href="<?php echo base_url(); ?>student/messages" class="topbar-icon-btn" aria-label="Notifications">
                    <i class="fa-regular fa-bell"></i>
                    <?php if (!empty($notifications)): ?>
                    <span class="topbar-notif-dot"></span>
                    <?php endif; ?>
                </a>
                <div class="topbar-user">
                    <div class="topbar-avatar">
                        <?php if (!empty($student->passport)): ?>
                        <img src="<?php echo base_url().'uploads/photos/'.htmlspecialchars($student->passport); ?>" alt="">
                        <?php else: echo strtoupper(substr($student->fullname ?? 'S', 0, 1)); ?>
                        <?php endif; ?>
                    </div>
                    <span class="topbar-name"><?php echo htmlspecialchars(substr($student->fullname ?? 'Student', 0, 18)); ?></span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="portal-content">

            <!-- Welcome banner -->
            <div style="background:linear-gradient(135deg,#6B0E20,#4a0915); border-radius:12px; padding:22px 28px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                <div>
                    <div style="font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:rgba(255,255,255,.6); margin-bottom:4px;">Welcome back</div>
                    <h2 style="font-size:22px; font-weight:800; color:#fff; margin:0 0 4px;"><?php echo htmlspecialchars($student->fullname ?? 'Student'); ?> <span style="font-size:20px;">&#128075;</span></h2>
                    <p style="font-size:13px; color:rgba(255,255,255,.65); margin:0;">
                        <?php echo htmlspecialchars($student->prog_id ?? 'FUTA Student'); ?> &bull;
                        <?php echo $student->level ?? ''; ?> Level &bull;
                        Matric: <?php echo htmlspecialchars($student->matric_no ?? ''); ?>
                    </p>
                </div>
                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <a href="<?php echo base_url(); ?>student/qr" style="display:inline-flex; align-items:center; gap:7px; padding:9px 18px; background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25); color:#fff; border-radius:50px; font-size:13px; font-weight:700; text-decoration:none;">
                        <i class="fa-solid fa-qrcode"></i> View QR Pass
                    </a>
                    <a href="<?php echo base_url(); ?>student/cv" style="display:inline-flex; align-items:center; gap:7px; padding:9px 18px; background:#C9A84C; border:1px solid #C9A84C; color:#1A1A2E; border-radius:50px; font-size:13px; font-weight:700; text-decoration:none;">
                        <i class="fa-regular fa-file-lines"></i> Upload CV
                    </a>
                </div>
            </div>

            <!-- Profile completion -->
            <?php
            $s = $student;
            $score = 0;
            if (!empty($s->fullname))       $score += 20;
            if (!empty($s->phone))          $score += 10;
            if (!empty($s->school_id))      $score += 10;
            if (!empty($s->skills))         $score += 15;
            if (!empty($s->career_interest))$score += 15;
            if (!empty($cv))                $score += 20;
            if (!empty($qr_pass))           $score += 10;
            ?>
            <div class="p-card" style="margin-bottom:24px;">
                <div class="p-card-body" style="padding:16px 20px;">
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; flex-wrap:wrap; gap:8px;">
                        <div>
                            <div style="font-size:14px; font-weight:700; color:#1A1A2E;">Profile Completion</div>
                            <div style="font-size:12px; color:#6c757d;">Complete your profile to get noticed by employers</div>
                        </div>
                        <div style="font-size:22px; font-weight:900; color:#6B0E20;"><?php echo $score; ?>%</div>
                    </div>
                    <div class="p-progress-bar">
                        <div class="p-progress-fill <?php echo $score>=80?'gold':''; ?>" style="width:<?php echo $score; ?>%"></div>
                    </div>
                    <?php if ($score < 100): ?>
                    <div style="margin-top:10px; display:flex; gap:8px; flex-wrap:wrap;">
                        <?php if (empty($s->skills)): ?>
                        <a href="<?php echo base_url(); ?>student/profile" class="p-btn p-btn-outline p-btn-sm"><i class="fa-solid fa-plus"></i> Add Skills</a>
                        <?php endif; ?>
                        <?php if (empty($cv)): ?>
                        <a href="<?php echo base_url(); ?>student/cv" class="p-btn p-btn-outline p-btn-sm"><i class="fa-solid fa-upload"></i> Upload CV</a>
                        <?php endif; ?>
                        <?php if (empty($qr_pass)): ?>
                        <a href="<?php echo base_url(); ?>student/qr" class="p-btn p-btn-outline p-btn-sm"><i class="fa-solid fa-qrcode"></i> Get QR Pass</a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Stat cards -->
            <div class="p-stat-grid" style="margin-bottom:24px;">
                <div class="p-stat-card">
                    <div class="p-stat-icon maroon"><i class="fa-solid fa-user-graduate"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo $score; ?>%</div>
                        <div class="p-stat-label">Profile Complete</div>
                    </div>
                </div>
                <div class="p-stat-card gold">
                    <div class="p-stat-icon gold"><i class="fa-regular fa-file-lines"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo $cv ? '1' : '0'; ?></div>
                        <div class="p-stat-label">CV Uploaded</div>
                    </div>
                </div>
                <div class="p-stat-card green">
                    <div class="p-stat-icon green"><i class="fa-solid fa-star"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo count($shortlists ?? []); ?></div>
                        <div class="p-stat-label">Shortlisted By</div>
                    </div>
                </div>
                <div class="p-stat-card blue">
                    <div class="p-stat-icon blue"><i class="fa-solid fa-qrcode"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo $qr_pass ? 'Yes' : 'No'; ?></div>
                        <div class="p-stat-label">QR Pass Ready</div>
                    </div>
                </div>
            </div>

            <!-- Two column: Opportunities + Events -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">

                <!-- Recent Opportunities -->
                <div class="p-card">
                    <div class="p-card-header">
                        <h3 class="p-card-title">Recommended Opportunities</h3>
                        <a href="<?php echo base_url(); ?>student/opportunities" style="font-size:12.5px; font-weight:700; color:#6B0E20; text-decoration:none;">View All</a>
                    </div>
                    <div class="p-card-body" style="padding:0;">
                        <?php if (!empty($opportunities)): ?>
                        <table class="p-table">
                            <thead><tr><th>Role</th><th>Organisation</th><th>Type</th><th></th></tr></thead>
                            <tbody>
                            <?php foreach ($opportunities as $opp): ?>
                            <tr>
                                <td style="font-weight:600; font-size:13px;"><?php echo htmlspecialchars(substr($opp->title,0,28)); ?></td>
                                <td style="font-size:12.5px; color:#6c757d;"><?php echo htmlspecialchars(substr($opp->org_name??'',0,20)); ?></td>
                                <td><span class="p-badge p-badge-maroon"><?php echo htmlspecialchars($opp->opp_type); ?></span></td>
                                <td><a href="<?php echo base_url(); ?>student/opportunities" class="p-btn p-btn-outline p-btn-sm">Apply</a></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div style="padding:28px; text-align:center; color:#6c757d;">
                            <i class="fa-solid fa-briefcase" style="font-size:32px; opacity:.3; margin-bottom:10px; display:block;"></i>
                            <p style="font-size:13.5px; margin:0;">No opportunities yet. Check back soon.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="p-card">
                    <div class="p-card-header">
                        <h3 class="p-card-title">Upcoming Events</h3>
                        <a href="<?php echo base_url(); ?>student/events" style="font-size:12.5px; font-weight:700; color:#6B0E20; text-decoration:none;">View All</a>
                    </div>
                    <div class="p-card-body" style="padding:0;">
                        <?php if (!empty($events)): ?>
                        <?php foreach ($events as $ev): ?>
                        <div style="display:flex; align-items:flex-start; gap:14px; padding:14px 18px; border-bottom:1px solid #f0f0f0;">
                            <div style="width:44px; height:44px; background:rgba(107,14,32,.08); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:18px; color:#6B0E20; flex-shrink:0;">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <div>
                                <div style="font-size:13.5px; font-weight:700; color:#1A1A2E;"><?php echo htmlspecialchars($ev->title); ?></div>
                                <div style="font-size:12px; color:#6c757d;">
                                    <?php echo $ev->event_date ? date('M d, Y', strtotime($ev->event_date)) : 'TBC'; ?>
                                    <?php echo $ev->start_time ? ' · '.date('g:i A', strtotime($ev->start_time)) : ''; ?>
                                    <?php if ($ev->venue): ?> · <?php echo htmlspecialchars($ev->venue); ?><?php endif; ?>
                                </div>
                                <span class="p-badge p-badge-blue" style="margin-top:4px;"><?php echo htmlspecialchars($ev->event_type); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <div style="padding:28px; text-align:center; color:#6c757d;">
                            <i class="fa-regular fa-calendar-days" style="font-size:32px; opacity:.3; margin-bottom:10px; display:block;"></i>
                            <p style="font-size:13.5px; margin:0;">No events scheduled yet.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Shortlisted by employers -->
            <?php if (!empty($shortlists)): ?>
            <div class="p-card" style="margin-bottom:24px;">
                <div class="p-card-header">
                    <h3 class="p-card-title"><i class="fa-solid fa-star" style="color:#C9A84C; margin-right:6px;"></i> Shortlisted By Employers</h3>
                </div>
                <div class="p-card-body" style="padding:0;">
                    <table class="p-table">
                        <thead><tr><th>Organisation</th><th>Tag</th><th>Date</th></tr></thead>
                        <tbody>
                        <?php foreach ($shortlists as $sl): ?>
                        <tr>
                            <td style="font-weight:600;"><?php echo htmlspecialchars($sl->org_name ?? 'Employer'); ?></td>
                            <td><span class="p-badge p-badge-gold"><?php echo htmlspecialchars($sl->tag ?? 'Interested'); ?></span></td>
                            <td style="font-size:12.5px; color:#6c757d;"><?php echo date('M d, Y', strtotime($sl->shortlisted_at)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

        </div><!-- /portal-content -->
    </main>
</div>

<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>
<script>
// Sidebar mobile toggle
$('#sidebar-toggle').on('click', function(){
    $('#portal-sidebar').toggleClass('open');
});
// Close on backdrop click
$(document).on('click', function(e){
    if ($(window).width() < 769) {
        if (!$(e.target).closest('#portal-sidebar, #sidebar-toggle').length) {
            $('#portal-sidebar').removeClass('open');
        }
    }
});
</script>
</body>
</html>
