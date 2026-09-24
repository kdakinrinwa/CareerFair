<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in Report – FUTA Career Fair 2026</title>
    <link href="<?php echo base_url(); ?>assetsp/css/fa-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetsp/css/careerfair.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetsp/css/admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
    body{font-family:'DM Sans',sans-serif;background:#f0f2f5;margin:0;}
    .rep-topbar{background:linear-gradient(135deg,#0f172a,#6B0E20);color:#fff;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
    .rep-topbar-title{font-size:17px;font-weight:800;}
    .rep-topbar-sub{font-size:12px;color:rgba(255,255,255,.55);}
    .rep-content{padding:24px;max-width:1400px;margin:0 auto;}
    @media print{.rep-topbar,.no-print{display:none!important;} body{background:#fff;} .rep-content{padding:0;}}
    </style>
</head>
<body>
<div class="rep-topbar no-print">
    <div>
        <div class="rep-topbar-title">Check-in Report – FUTA Career Fair 2026</div>
        <div class="rep-topbar-sub"><?php echo $total_scans; ?> total scan entries (latest 500)</div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button onclick="window.print()" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:#C9A84C;color:#1A1A2E;border:none;border-radius:8px;font-size:13px;font-weight:700;cursor:pointer;">
            <i class="fa-solid fa-print"></i> Print Report
        </button>
        <a href="<?php echo base_url(); ?>checkin/attendance" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:rgba(255,255,255,.15);color:#fff;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-users"></i> Attendance Board
        </a>
        <a href="<?php echo base_url(); ?>checkin/scan" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:rgba(255,255,255,.15);color:#fff;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-qrcode"></i> Back to Scanner
        </a>
        <a href="<?php echo base_url(); ?>admin/qr_passes" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:rgba(255,255,255,.1);color:#fff;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-id-card"></i> Admin Panel
        </a>
    </div>
</div>

<div class="rep-content">

    <!-- Summary KPIs -->
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
        <?php
        $students_scanned  = count(array_filter($logs, fn($l) => $l->user_type === 'student'));
        $employers_scanned = count(array_filter($logs, fn($l) => $l->user_type === 'employer'));
        $alumni_scanned    = count(array_filter($logs, fn($l) => $l->user_type === 'alumni'));
        $kpis = [
            ['maroon','fa-list-check','Total Scans',   $total_scans],
            ['gold',  'fa-user-graduate','Students',   $students_scanned],
            ['green', 'fa-building','Employer Reps',   $employers_scanned],
            ['blue',  'fa-user-tie','Alumni',           $alumni_scanned],
        ];
        foreach ($kpis as $k):
        ?>
        <div class="a-stat <?php echo $k[0]; ?>">
            <div class="a-stat-icon <?php echo $k[0]; ?>"><i class="fa-solid <?php echo $k[1]; ?>"></i></div>
            <div><div class="a-stat-num"><?php echo $k[3]; ?></div><div class="a-stat-label"><?php echo $k[2]; ?></div></div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="a-card">
        <div class="a-card-head">
            <h3 class="a-card-title"><i class="fa-solid fa-clock-rotate-left" style="color:#6B0E20;margin-right:8px;"></i>Full Check-in Log</h3>
            <div style="font-size:12.5px;color:#6c757d;">Every scan event — most recent first. Print this for fair records.</div>
        </div>
        <div class="a-card-body-flush"><div class="a-table-wrap">
        <table class="a-table">
            <thead>
                <tr>
                    <th>#</th><th>Name</th><th>Details</th><th>Type</th>
                    <th>Pass Code</th><th>Location</th><th>Scanned By</th><th>Date &amp; Time</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($logs)): foreach ($logs as $i => $log): ?>
            <tr>
                <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                <td style="font-weight:700;"><?php echo htmlspecialchars($log->name??'–'); ?></td>
                <td style="font-size:12.5px;color:#6c757d;max-width:180px;"><?php echo htmlspecialchars(substr($log->detail??'',0,55)); ?></td>
                <td>
                    <span class="a-badge a-badge-<?php echo $log->user_type==='student'?'active':($log->user_type==='employer'?'pending':'draft'); ?>">
                        <?php echo ucfirst($log->user_type??'–'); ?>
                    </span>
                </td>
                <td style="font-family:monospace;font-size:12px;color:#6B0E20;font-weight:700;"><?php echo htmlspecialchars($log->pass_code??''); ?></td>
                <td style="font-size:12.5px;"><?php echo htmlspecialchars($log->location??'Main Entrance'); ?></td>
                <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($log->scanned_by_name??'Officer'); ?></td>
                <td style="font-size:12.5px;white-space:nowrap;color:#6c757d;">
                    <?php echo date('M d, Y H:i:s', strtotime($log->checkin_time)); ?>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="8" style="text-align:center;padding:40px;color:#6c757d;">No check-in records found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div></div>
    </div>

</div>

<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
</body>
</html>
