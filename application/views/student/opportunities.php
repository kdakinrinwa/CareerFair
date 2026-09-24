<!DOCTYPE html>
<html lang="en">
<head><title>Opportunities – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Internship &amp; Job Opportunities</div>
        </div>
        <div class="portal-content">
            <div class="p-card">
                <div class="p-card-header"><h3 class="p-card-title">Available Opportunities</h3></div>
                <div class="p-card-body" style="padding:0;">
                    <?php if (!empty($opportunities)): ?>
                    <table class="p-table">
                        <thead><tr><th>Title</th><th>Organisation</th><th>Type</th><th>Deadline</th><th></th></tr></thead>
                        <tbody>
                        <?php foreach ($opportunities as $o): ?>
                        <tr>
                            <td style="font-weight:600;"><?php echo htmlspecialchars($o->title); ?></td>
                            <td><?php echo htmlspecialchars($o->org_name ?? ''); ?></td>
                            <td><span class="p-badge p-badge-maroon"><?php echo htmlspecialchars($o->opp_type); ?></span></td>
                            <td style="font-size:12.5px; color:#6c757d;"><?php echo $o->deadline ? date('M d, Y',strtotime($o->deadline)) : 'Open'; ?></td>
                            <td><a href="#" class="p-btn p-btn-outline p-btn-sm">Apply</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div style="padding:40px; text-align:center; color:#6c757d;">
                        <i class="fa-solid fa-briefcase" style="font-size:44px;opacity:.3;display:block;margin-bottom:14px;"></i>
                        <h4 style="color:#1A1A2E;">No Opportunities Yet</h4>
                        <p style="font-size:13.5px;">Employers will post opportunities here. Check back soon.</p>
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
