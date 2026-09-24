<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance – FUTA Career Fair 2026</title>
    <link href="<?php echo base_url(); ?>assetsp/css/fa-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetsp/css/careerfair.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assetsp/css/admin.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <style>
    body{font-family:'DM Sans',sans-serif;background:#f0f2f5;margin:0;}
    .att-topbar{background:linear-gradient(135deg,#0f172a,#6B0E20);color:#fff;padding:14px 24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
    .att-topbar-left{display:flex;align-items:center;gap:12px;}
    .att-topbar-left img{height:40px;}
    .att-title{font-size:18px;font-weight:800;color:#fff;}
    .att-sub{font-size:12px;color:rgba(255,255,255,.6);}
    .att-live{display:inline-flex;align-items:center;gap:6px;background:rgba(34,197,94,.2);border:1px solid rgba(34,197,94,.4);color:#4ade80;padding:4px 12px;border-radius:20px;font-size:11.5px;font-weight:700;}
    .att-live::before{content:'';width:7px;height:7px;border-radius:50%;background:#4ade80;animation:live-pulse 1.5s infinite;}
    @keyframes live-pulse{0%,100%{opacity:1}50%{opacity:.3}}
    .att-content{padding:24px;max-width:1400px;margin:0 auto;}
    .kpi-row{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
    .kpi{background:#fff;border-radius:12px;padding:18px 20px;box-shadow:0 2px 12px rgba(0,0,0,.06);display:flex;align-items:center;gap:14px;border-left:4px solid #6B0E20;}
    .kpi.gold{border-left-color:#C9A84C;}
    .kpi.green{border-left-color:#22c55e;}
    .kpi.blue{border-left-color:#3b82f6;}
    .kpi-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;}
    .kpi-icon.maroon{background:rgba(107,14,32,.1);color:#6B0E20;}
    .kpi-icon.gold{background:rgba(201,168,76,.12);color:#a88635;}
    .kpi-icon.green{background:rgba(34,197,94,.1);color:#15803d;}
    .kpi-icon.blue{background:rgba(59,130,246,.1);color:#1d4ed8;}
    .kpi-num{font-size:28px;font-weight:900;color:#1A1A2E;line-height:1;}
    .kpi-lbl{font-size:12.5px;color:#6c757d;font-weight:500;}
    .filter-bar{display:flex;align-items:center;gap:12px;margin-bottom:18px;flex-wrap:wrap;}
    .filter-btn{padding:8px 18px;border-radius:8px;font-size:13px;font-weight:700;cursor:pointer;border:2px solid #e8e8e8;background:#fff;color:#1A1A2E;text-decoration:none;transition:all .2s;}
    .filter-btn.active{background:#6B0E20;border-color:#6B0E20;color:#fff;}
    .filter-btn:hover:not(.active){border-color:#6B0E20;color:#6B0E20;}
    .search-box{display:flex;gap:0;flex:1;max-width:320px;}
    .search-box input{flex:1;padding:9px 14px;border:1.5px solid #e8e8e8;border-right:none;border-radius:8px 0 0 8px;font-size:13.5px;font-family:'DM Sans',sans-serif;outline:none;}
    .search-box input:focus{border-color:#6B0E20;}
    .search-box button{padding:9px 14px;background:#6B0E20;color:#fff;border:none;border-radius:0 8px 8px 0;cursor:pointer;}
    .att-table-wrap{background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,.06);overflow:hidden;}
    .att-table{width:100%;border-collapse:collapse;}
    .att-table th{font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#6c757d;padding:10px 16px;border-bottom:2px solid #f0f0f0;background:#fafafa;text-align:left;white-space:nowrap;}
    .att-table td{padding:12px 16px;border-bottom:1px solid #f5f5f5;font-size:14px;color:#1A1A2E;vertical-align:middle;}
    .att-table tr:last-child td{border-bottom:none;}
    .att-table tr:hover td{background:rgba(107,14,32,.02);}
    .att-photo{width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid #e8e8e8;}
    .att-avatar{width:40px;height:40px;border-radius:50%;background:#6B0E20;color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:15px;font-weight:700;}
    .att-type-badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;}
    .type-student{background:rgba(107,14,32,.1);color:#6B0E20;}
    .type-employer{background:rgba(201,168,76,.12);color:#a88635;}
    .type-alumni{background:rgba(59,130,246,.1);color:#1d4ed8;}
    .empty-state{text-align:center;padding:60px 20px;color:#6c757d;}
    .empty-state i{font-size:52px;opacity:.3;display:block;margin-bottom:14px;}
    .att-actions{display:flex;gap:10px;align-items:center;flex-wrap:wrap;}
    @media(max-width:900px){.kpi-row{grid-template-columns:1fr 1fr;}}
    @media(max-width:576px){.kpi-row{grid-template-columns:1fr 1fr;} .att-content{padding:16px;}}
    </style>
</head>
<body>

<!-- Top bar -->
<div class="att-topbar">
    <div class="att-topbar-left">
        <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
        <div>
            <div class="att-title">Career Fair 2026 — Attendance</div>
            <div class="att-sub">
                <?php echo date('l, F j, Y', strtotime($date)); ?>
                &nbsp;·&nbsp; Check-in Officer: <?php echo htmlspecialchars($officer['fullname'] ?? $officer['username'] ?? 'Staff'); ?>
            </div>
        </div>
    </div>
    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
        <span class="att-live">LIVE</span>
        <a href="<?php echo base_url(); ?>checkin/scan" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:#fff;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-qrcode"></i> Back to Scanner
        </a>
        <a href="<?php echo base_url(); ?>checkin/report" style="display:inline-flex;align-items:center;gap:7px;padding:8px 16px;background:#C9A84C;color:#1A1A2E;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-chart-bar"></i> Full Report
        </a>
        <a href="<?php echo base_url(); ?>checkin/logout" style="display:inline-flex;align-items:center;gap:7px;padding:8px 14px;background:rgba(239,68,68,.2);color:#fca5a5;border-radius:8px;font-size:13px;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
</div>

<div class="att-content">

    <!-- KPIs -->
    <div class="kpi-row">
        <div class="kpi">
            <div class="kpi-icon maroon"><i class="fa-solid fa-users"></i></div>
            <div><div class="kpi-num"><?php echo $total_all; ?></div><div class="kpi-lbl">Total Present Today</div></div>
        </div>
        <div class="kpi gold">
            <div class="kpi-icon gold"><i class="fa-solid fa-user-graduate"></i></div>
            <div><div class="kpi-num"><?php echo $total_students; ?></div><div class="kpi-lbl">Students</div></div>
        </div>
        <div class="kpi green">
            <div class="kpi-icon green"><i class="fa-solid fa-building"></i></div>
            <div><div class="kpi-num"><?php echo $total_employers; ?></div><div class="kpi-lbl">Employer Reps</div></div>
        </div>
        <div class="kpi blue">
            <div class="kpi-icon blue"><i class="fa-regular fa-clock"></i></div>
            <div>
                <div class="kpi-num" style="font-size:18px;" id="live-time"><?php echo date('H:i'); ?></div>
                <div class="kpi-lbl">Current Time</div>
            </div>
        </div>
    </div>

    <!-- Filter + Search + Date -->
    <form method="get" id="filter-form">
        <div class="filter-bar">
            <?php
            $types = ['all'=>'All','student'=>'Students','employer'=>'Employers','alumni'=>'Alumni'];
            foreach ($types as $k=>$v):
            ?>
            <a href="?type=<?php echo $k; ?>&date=<?php echo htmlspecialchars($date); ?>"
               class="filter-btn <?php echo $filter===$k?'active':''; ?>">
                <?php echo $v; ?> <?php echo $k==='all'?"($total_all)":($k==='student'?"($total_students)":($k==='employer'?"($total_employers)":'')); ?>
            </a>
            <?php endforeach; ?>
            <input type="hidden" name="type" value="<?php echo htmlspecialchars($filter); ?>">
            <div class="search-box">
                <input type="text" name="q" id="live-search" placeholder="Search by name..." value="<?php echo htmlspecialchars($_GET['q']??''); ?>" autocomplete="off">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>"
                style="padding:9px 12px;border:1.5px solid #e8e8e8;border-radius:8px;font-size:13.5px;font-family:'DM Sans',sans-serif;outline:none;"
                onchange="this.form.submit()">
            <a href="javascript:void(0)" onclick="location.reload()" style="display:inline-flex;align-items:center;gap:6px;padding:9px 14px;background:#f5f5f5;border-radius:8px;font-size:13px;font-weight:700;color:#1A1A2E;text-decoration:none;" title="Refresh">
                <i class="fa-solid fa-rotate-right"></i> Refresh
            </a>
        </div>
    </form>

    <!-- Attendance table -->
    <div class="att-table-wrap">
        <?php if (!empty($checkins)): ?>
        <table class="att-table" id="att-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Check-in Time</th>
                    <th>Pass Code</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($checkins as $i => $c): ?>
            <tr class="att-row" data-name="<?php echo strtolower(htmlspecialchars($c->name)); ?>">
                <td style="color:#6c757d;font-size:12.5px;"><?php echo $i+1; ?></td>
                <td>
                    <?php if ($c->photo): ?>
                    <img src="<?php echo htmlspecialchars($c->photo); ?>" alt="" class="att-photo"
                         onerror="this.outerHTML='<div class=att-avatar><?php echo strtoupper(substr($c->name,0,1)); ?></div>'">
                    <?php else: ?>
                    <div class="att-avatar"><?php echo strtoupper(substr($c->name, 0, 1)); ?></div>
                    <?php endif; ?>
                </td>
                <td style="font-weight:700;font-size:14.5px;"><?php echo htmlspecialchars($c->name); ?></td>
                <td style="font-size:13px;color:#6c757d;max-width:220px;"><?php echo htmlspecialchars($c->detail); ?></td>
                <td>
                    <span class="att-type-badge type-<?php echo $c->user_type; ?>">
                        <i class="fa-solid <?php echo $c->user_type==='student'?'fa-graduation-cap':($c->user_type==='employer'?'fa-building':'fa-user-tie'); ?>"></i>
                        <?php echo ucfirst($c->user_type); ?>
                    </span>
                </td>
                <td style="font-size:13px;"><?php echo htmlspecialchars($c->location??'Main Entrance'); ?></td>
                <td style="font-size:13.5px; color:#6B0E20; font-weight:600;">
                    <?php echo date('H:i:s', strtotime($c->checkin_time)); ?>
                </td>
                <td style="font-family:monospace;font-size:12px;color:#6c757d;"><?php echo htmlspecialchars($c->pass_code); ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty-state">
            <i class="fa-solid fa-users-slash"></i>
            <h3 style="font-weight:700;color:#1A1A2E;margin-bottom:8px;">No check-ins yet</h3>
            <p style="font-size:14px;">
                <?php echo $date === date('Y-m-d') ? 'Attendees will appear here as they check in at the fair entrance.' : 'No check-ins recorded for ' . date('F j, Y', strtotime($date)) . '.'; ?>
            </p>
        </div>
        <?php endif; ?>
    </div>

    <div style="margin-top:10px;font-size:12.5px;color:#6c757d;text-align:right;">
        Page auto-refreshes every 30 seconds &nbsp;·&nbsp;
        <?php echo $total_all; ?> unique attendees present &nbsp;·&nbsp;
        Last updated: <span id="last-refresh"><?php echo date('H:i:s'); ?></span>
    </div>

</div>

<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script>
// Live clock
setInterval(function(){
    var now = new Date();
    var h=now.getHours().toString().padStart(2,'0');
    var m=now.getMinutes().toString().padStart(2,'0');
    var s=now.getSeconds().toString().padStart(2,'0');
    document.getElementById('live-time').textContent = h+':'+m;
},1000);

// Client-side live search (filters without a page reload)
$('#live-search').on('input', function(){
    var q = $(this).val().toLowerCase().trim();
    $('.att-row').each(function(){
        var name = $(this).data('name') || '';
        $(this).toggle(!q || name.indexOf(q) !== -1);
    });
});

// Auto-refresh every 30 seconds (re-loads the page so new check-ins appear)
var refreshTimer = setInterval(function(){
    var url = window.location.href;
    // Only auto-refresh if no search is active (don't interrupt the user)
    if (!$('#live-search').val()) {
        document.getElementById('last-refresh').textContent = new Date().toLocaleTimeString();
        window.location.reload();
    }
}, 30000);
</script>
</body>
</html>
