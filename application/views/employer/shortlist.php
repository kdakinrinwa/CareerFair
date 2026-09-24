<!DOCTYPE html>
<html lang="en">
<head><title>My Shortlist – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">My Shortlist</div>
        </div>
        <div class="portal-content">
            <div class="p-card">
                <div class="p-card-header"><h3 class="p-card-title"><?php echo count($shortlists); ?> Shortlisted Candidate<?php echo count($shortlists)!=1?'s':''; ?></h3></div>
                <div class="p-card-body" style="padding:0;">
                    <?php if (!empty($shortlists)): ?>
                    <table class="p-table">
                        <thead><tr><th>Name</th><th>Matric No.</th><th>Level</th><th>Skills</th><th>Tag</th><th>Date</th></tr></thead>
                        <tbody>
                        <?php foreach ($shortlists as $sl): ?>
                        <tr>
                            <td style="font-weight:700;"><?php echo htmlspecialchars($sl->fullname??'—'); ?></td>
                            <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($sl->matric_no??'—'); ?></td>
                            <td><span class="p-badge p-badge-blue"><?php echo htmlspecialchars($sl->level??'—'); ?></span></td>
                            <td style="font-size:12px;color:#6c757d;max-width:160px;"><?php echo htmlspecialchars(substr($sl->skills??'',0,50)); ?></td>
                            <td><span class="p-badge p-badge-gold"><?php echo htmlspecialchars($sl->tag??'Interested'); ?></span></td>
                            <td style="font-size:12px;color:#6c757d;"><?php echo date('M d, Y',strtotime($sl->shortlisted_at)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div style="padding:40px;text-align:center;color:#6c757d;">
                        <i class="fa-solid fa-star" style="font-size:44px;opacity:.3;display:block;margin-bottom:14px;"></i>
                        <h4 style="color:#1A1A2E;">No Shortlisted Candidates</h4>
                        <p style="font-size:13.5px;"><a href="<?php echo base_url(); ?>employer/candidates" style="color:#6B0E20;font-weight:700;">Search the Talent Vault</a> to find and shortlist candidates.</p>
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
