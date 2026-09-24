<!DOCTYPE html>
<html lang="en">
<head><title>Events – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Career Fair Events &amp; Sessions</div>
        </div>
        <div class="portal-content">
            <div class="p-card">
                <div class="p-card-header"><h3 class="p-card-title">All Events</h3></div>
                <div class="p-card-body" style="padding:0;">
                    <?php if (!empty($events)): ?>
                    <?php foreach ($events as $ev): ?>
                    <div style="display:flex;align-items:flex-start;gap:16px;padding:16px 20px;border-bottom:1px solid #f0f0f0;">
                        <div style="width:50px;height:50px;background:rgba(107,14,32,.08);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;color:#6B0E20;flex-shrink:0;">
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                        <div style="flex:1;">
                            <div style="font-size:15px;font-weight:700;color:#1A1A2E;"><?php echo htmlspecialchars($ev->title); ?></div>
                            <div style="font-size:12.5px;color:#6c757d;margin:3px 0 6px;">
                                <?php echo $ev->event_date?date('M d, Y',strtotime($ev->event_date)):'TBC'; ?>
                                <?php echo $ev->start_time?' · '.date('g:i A',strtotime($ev->start_time)):''; ?>
                                <?php if($ev->venue): ?> &bull; <?php echo htmlspecialchars($ev->venue); ?><?php endif; ?>
                            </div>
                            <span class="p-badge p-badge-blue"><?php echo htmlspecialchars($ev->event_type); ?></span>
                            <?php if($ev->description): ?>
                            <p style="font-size:13px;color:#6c757d;margin:8px 0 0;line-height:1.6;"><?php echo htmlspecialchars(substr($ev->description,0,140)); ?></p>
                            <?php endif; ?>
                        </div>
                        <span class="p-badge <?php echo $ev->status==='upcoming'?'p-badge-green':'p-badge-grey'; ?>">
                            <?php echo ucfirst($ev->status); ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <div style="padding:40px;text-align:center;color:#6c757d;">
                        <i class="fa-regular fa-calendar-days" style="font-size:44px;opacity:.3;display:block;margin-bottom:14px;"></i>
                        <h4 style="color:#1A1A2E;">No Events Scheduled</h4>
                        <p style="font-size:13.5px;">Career fair events will appear here once scheduled.</p>
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
