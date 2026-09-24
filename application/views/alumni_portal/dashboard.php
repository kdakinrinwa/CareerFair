<!DOCTYPE html>
<html lang="en">
<head><title>Alumni Dashboard – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Alumni Dashboard</div>
        </div>
        <div class="portal-content">
            <div style="background:linear-gradient(135deg,#1A1A2E,#16213e); border-radius:12px; padding:28px; margin-bottom:24px;">
                <h2 style="font-size:24px;font-weight:800;color:#fff;margin:0 0 6px;">Welcome, <?php echo htmlspecialchars($alumni->fullname ?? 'Alumni'); ?>!</h2>
                <p style="color:rgba(255,255,255,.65);font-size:14px;margin:0;">
                    <?php echo htmlspecialchars($alumni->programme ?? ''); ?>
                    <?php echo $alumni->grad_year ? ' · Class of '.$alumni->grad_year : ''; ?>
                    <?php echo !empty($alumni->current_org) ? ' · '.$alumni->current_org : ''; ?>
                </p>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:20px;">
                <?php foreach ([
                    ['fa-chalkboard-user','Mentor Students','Share your expertise with current FUTA students.','home/alumni'],
                    ['fa-microphone','Career Talk','Register to give a career talk at the fair.','home/careerfair'],
                    ['fa-briefcase','Opportunities','Post internship or job opportunities.','home/employers'],
                    ['fa-users','Connect','Network with fellow FUTA alumni.','home/alumni'],
                ] as $item): ?>
                <a href="<?php echo base_url().$item[3]; ?>" style="background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 14px rgba(0,0,0,.07);text-decoration:none;display:block;transition:transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform=''">
                    <div style="width:46px;height:46px;background:rgba(107,14,32,.08);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#6B0E20;margin-bottom:14px;">
                        <i class="fa-solid <?php echo $item[0]; ?>"></i>
                    </div>
                    <div style="font-size:15px;font-weight:700;color:#1A1A2E;margin-bottom:5px;"><?php echo $item[1]; ?></div>
                    <div style="font-size:13px;color:#6c757d;"><?php echo $item[2]; ?></div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</div>
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script>$('#sidebar-toggle').on('click',function(){$('#portal-sidebar').toggleClass('open');});</script>
</body></html>
