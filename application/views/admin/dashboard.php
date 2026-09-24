<!DOCTYPE html>
<html lang="en">
<head><title>Dashboard – FUTA Career Services Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap">
<?php echo $sidebar; ?>
<main class="portal-main">

    <!-- Topbar -->
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="admin-topbar-brand">Career Fair 2026 &nbsp;·&nbsp; Super Admin</div>
        <div class="portal-topbar-actions">
            <a href="<?php echo base_url(); ?>admin/settings" class="topbar-icon-btn" title="Settings"><i class="fa-solid fa-gear"></i></a>
            <a href="<?php echo base_url(); ?>admin/signout" class="topbar-icon-btn" title="Sign Out" style="color:#dc2626;"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </div>
    </div>

    <div class="portal-content">

        <!-- Check-in quick access panel -->
        <div style="background:linear-gradient(135deg,#065f46,#047857); border-radius:12px; padding:20px 28px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.6);margin-bottom:4px;">
                    <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:#4ade80;margin-right:6px;animation:blink 1.5s infinite;"></span>
                    Career Fair Check-in System
                </div>
                <h3 style="font-size:18px;font-weight:800;color:#fff;margin:0 0 4px;">
                    QR Scanner &amp; Attendance Board
                </h3>
                <p style="font-size:13px;color:rgba(255,255,255,.65);margin:0;">
                    <?php echo $total_checkins; ?> check-ins recorded &nbsp;·&nbsp;
                    <?php echo $total_qr; ?> QR passes issued
                </p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="<?php echo base_url(); ?>checkin/scan" target="_blank" style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:#4ade80;color:#065f46;border-radius:50px;font-size:13.5px;font-weight:800;text-decoration:none;">
                    <i class="fa-solid fa-qrcode"></i> Open Scanner
                </a>
                <a href="<?php echo base_url(); ?>checkin/attendance" target="_blank" style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#fff;border-radius:50px;font-size:13.5px;font-weight:700;text-decoration:none;">
                    <i class="fa-solid fa-users"></i> Attendance Board
                </a>
                <a href="<?php echo base_url(); ?>checkin/report" target="_blank" style="display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:rgba(255,255,255,.1);color:#fff;border-radius:50px;font-size:13.5px;font-weight:700;text-decoration:none;">
                    <i class="fa-solid fa-chart-bar"></i> Report
                </a>
            </div>
        </div>
        <style>@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}</style>

        <!-- Welcome banner -->
        <div style="background:linear-gradient(135deg,#0f172a,#1a1a2e,#4a0915); border-radius:12px; padding:24px 28px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-bottom:4px;">Super Admin</div>
                <h2 style="font-size:22px;font-weight:800;color:#fff;margin:0 0 4px;">Career Fair 2026 – Overview</h2>
                <p style="font-size:13px;color:rgba(255,255,255,.55);margin:0;">
                    <?php echo date('l, F j, Y'); ?> &nbsp;·&nbsp;
                    Welcome, <?php echo htmlspecialchars($admin_user['fullname'] ?? 'Admin'); ?>
                </p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <?php if (($pending_employers + $pending_students) > 0): ?>
                <a href="<?php echo base_url(); ?>admin/employers" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:rgba(249,115,22,.9);color:#fff;border-radius:50px;font-size:13px;font-weight:700;text-decoration:none;">
                    <i class="fa-solid fa-bell"></i> <?php echo $pending_employers + $pending_students; ?> Pending Approvals
                </a>
                <?php endif; ?>
                <a href="<?php echo base_url(); ?>admin/reports" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:#C9A84C;color:#1A1A2E;border-radius:50px;font-size:13px;font-weight:700;text-decoration:none;">
                    <i class="fa-solid fa-chart-line"></i> View Reports
                </a>
            </div>
        </div>

        <!-- 8-cell stat grid -->
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
            <?php
            $stats = [
                ['a-stat maroon','fa-user-graduate','Students',       number_format($total_students),  'admin/students'],
                ['a-stat gold',  'fa-building',      'Employers',      number_format($total_employers), 'admin/employers'],
                ['a-stat green', 'fa-file-lines',    'CVs Uploaded',   number_format($total_cvs),       'admin/students'],
                ['a-stat blue',  'fa-store',         'Booth Requests', number_format($total_booths),    'admin/booths'],
                ['a-stat purple','fa-microphone-lines','Career Talks', number_format($total_talks),     'admin/talks'],
                ['a-stat teal',  'fa-qrcode',        'QR Passes',      number_format($total_qr),        'admin/qr_passes'],
                ['a-stat orange','fa-door-open',     'Check-ins',      number_format($total_checkins),  'admin/qr_passes'],
                ['a-stat red',   'fa-clock',         'Pending Approvals', ($pending_employers+$pending_students), 'admin/employers'],
            ];
            foreach ($stats as $s):
            ?>
            <a href="<?php echo base_url().$s[4]; ?>" style="text-decoration:none;">
                <div class="<?php echo $s[0]; ?>">
                    <div class="a-stat-icon <?php echo explode(' ',$s[0])[1]; ?>"><i class="fa-solid <?php echo $s[1]; ?>"></i></div>
                    <div><div class="a-stat-num"><?php echo $s[3]; ?></div><div class="a-stat-label"><?php echo $s[2]; ?></div></div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Two col: Recent students + Audit log -->
        <div style="display:grid;grid-template-columns:1.3fr 1fr;gap:20px;margin-bottom:22px;">

            <!-- Recent Student Registrations -->
            <div class="a-card">
                <div class="a-card-head">
                    <h3 class="a-card-title"><i class="fa-solid fa-user-graduate" style="color:#6B0E20;margin-right:8px;"></i>Recent Student Registrations</h3>
                    <a href="<?php echo base_url(); ?>admin/students" class="a-btn a-btn-ghost a-btn-sm">View All</a>
                </div>
                <div class="a-card-body-flush">
                    <div class="a-table-wrap">
                    <table class="a-table">
                        <thead><tr><th>Name</th><th>Matric</th><th>Level</th><th>Status</th><th>Joined</th></tr></thead>
                        <tbody>
                        <?php if (!empty($recent_students)): foreach ($recent_students as $s): ?>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="a-avatar" style="width:30px;height:30px;font-size:12px;"><?php echo strtoupper(substr($s->fullname,0,1)); ?></div>
                                    <span style="font-weight:600;"><?php echo htmlspecialchars(substr($s->fullname,0,22)); ?></span>
                                </div>
                            </td>
                            <td style="font-size:12px;color:#6c757d;"><?php echo htmlspecialchars($s->matric_no); ?></td>
                            <td><span class="a-badge a-badge-active" style="font-size:10px;"><?php echo $s->level; ?></span></td>
                            <td><span class="a-badge a-badge-<?php echo $s->accstatus; ?>"><?php echo ucfirst($s->accstatus); ?></span></td>
                            <td style="font-size:12px;color:#6c757d;"><?php echo date('M d',strtotime($s->created_at)); ?></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="5" style="text-align:center;color:#6c757d;padding:28px;">No students registered yet.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>

            <!-- Recent Audit Log -->
            <div class="a-card">
                <div class="a-card-head">
                    <h3 class="a-card-title"><i class="fa-solid fa-list-check" style="color:#6B0E20;margin-right:8px;"></i>Recent Activity</h3>
                    <a href="<?php echo base_url(); ?>admin/audit_log" class="a-btn a-btn-ghost a-btn-sm">Full Log</a>
                </div>
                <div class="a-card-body-flush">
                    <?php if (!empty($recent_logs)): foreach ($recent_logs as $log): ?>
                    <div style="display:flex;gap:12px;padding:11px 18px;border-bottom:1px solid #f5f5f5;">
                        <div style="width:32px;height:32px;border-radius:50%;background:rgba(107,14,32,.08);display:flex;align-items:center;justify-content:center;font-size:13px;color:#6B0E20;flex-shrink:0;">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-size:13px;font-weight:600;color:#1A1A2E;"><?php echo htmlspecialchars($log->action); ?></div>
                            <div style="font-size:11.5px;color:#6c757d;">
                                <?php echo $log->user_type; ?> #<?php echo $log->user_id; ?> &nbsp;·&nbsp;
                                <?php echo $log->ip_address; ?> &nbsp;·&nbsp;
                                <?php echo date('M d H:i',strtotime($log->created_at)); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                    <div style="padding:28px;text-align:center;color:#6c757d;font-size:13.5px;">No activity logged yet.</div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Recent Employers -->
        <?php if (!empty($recent_employers)): ?>
        <div class="a-card">
            <div class="a-card-head">
                <h3 class="a-card-title"><i class="fa-solid fa-building" style="color:#6B0E20;margin-right:8px;"></i>Recent Employer Registrations</h3>
                <a href="<?php echo base_url(); ?>admin/employers" class="a-btn a-btn-ghost a-btn-sm">View All</a>
            </div>
            <div class="a-card-body-flush">
                <div class="a-table-wrap">
                <table class="a-table">
                    <thead><tr><th>Organisation</th><th>Contact</th><th>Email</th><th>Type</th><th>Status</th><th>Action</th></tr></thead>
                    <tbody>
                    <?php foreach ($recent_employers as $e): ?>
                    <tr>
                        <td style="font-weight:700;"><?php echo htmlspecialchars(substr($e->org_name,0,28)); ?></td>
                        <td><?php echo htmlspecialchars($e->contact_name); ?></td>
                        <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($e->contact_email); ?></td>
                        <td style="font-size:12px;"><?php echo htmlspecialchars($e->org_type??''); ?></td>
                        <td><span class="a-badge a-badge-<?php echo $e->accstatus; ?>"><?php echo ucfirst($e->accstatus); ?></span></td>
                        <td>
                            <?php if ($e->accstatus === 'pending'): ?>
                            <button onclick="approveEmployer(<?php echo $e->employer_id; ?>,'approved')" class="a-btn a-btn-green a-btn-sm"><i class="fa-solid fa-check"></i> Approve</button>
                            <?php endif; ?>
                            <a href="<?php echo base_url(); ?>admin/view_employer/<?php echo $e->employer_id; ?>" class="a-btn a-btn-ghost a-btn-sm">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div><!-- /portal-content -->
</main>
</div>

<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
function approveEmployer(id, status) {
    adminConfirm('Approve this employer account?', function(){
        $.post('<?php echo site_url("admin/toggle_employer_status"); ?>', {
            id: id, status: status,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        }, function(r){ if(r==1){ adminSuccess('Employer approved.'); setTimeout(function(){location.reload();},1200); } });
    });
}
</script>
</body></html>
