<!DOCTYPE html>
<html lang="en">
<head><title>Notifications – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Notifications</div>
        </div>
        <div class="portal-content">
            <div class="p-card">
                <div class="p-card-header"><h3 class="p-card-title">All Notifications</h3></div>
                <div class="p-card-body" style="padding:0;">
                    <?php if (!empty($notifications)): ?>
                    <?php foreach ($notifications as $n): ?>
                    <div style="display:flex;align-items:flex-start;gap:14px;padding:14px 20px;border-bottom:1px solid #f0f0f0;<?php echo $n->is_read?'':'background:rgba(107,14,32,.025);'; ?>">
                        <div style="width:36px;height:36px;background:<?php echo $n->is_read?'#f0f0f0':'rgba(107,14,32,.1)'; ?>;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;color:<?php echo $n->is_read?'#aaa':'#6B0E20'; ?>;flex-shrink:0;">
                            <i class="fa-regular fa-bell"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-size:14px;font-weight:<?php echo $n->is_read?'500':'700'; ?>;color:#1A1A2E;"><?php echo htmlspecialchars($n->title); ?></div>
                            <div style="font-size:13px;color:#6c757d;margin:3px 0;"><?php echo htmlspecialchars($n->message); ?></div>
                            <div style="font-size:11px;color:#aaa;"><?php echo date('M d, Y g:i A',strtotime($n->created_at)); ?></div>
                        </div>
                        <?php if (!$n->is_read): ?><span style="width:8px;height:8px;border-radius:50%;background:#6B0E20;flex-shrink:0;margin-top:6px;"></span><?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div style="padding:40px;text-align:center;color:#6c757d;">
                        <i class="fa-regular fa-bell" style="font-size:44px;opacity:.3;display:block;margin-bottom:14px;"></i>
                        <h4 style="color:#1A1A2E;">No Notifications</h4>
                        <p style="font-size:13.5px;">You're all caught up! Notifications will appear here.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script>$('#sidebar-toggle').on('click',function(){$('#portal-sidebar').toggleClass('open');});</script>
</body></html>
