<!DOCTYPE html>
<html lang="en">
<head><title>Messages – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Contact Messages &amp; Newsletter</div>
    </div>
    <div class="portal-content">

        <div class="a-card" style="margin-bottom:22px;">
            <div class="a-card-head"><h3 class="a-card-title"><i class="fa-regular fa-envelope" style="color:#6B0E20;margin-right:8px;"></i>Contact Messages (<?php echo count($messages); ?>)</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Name</th><th>Subject</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th></tr></thead>
                <tbody>
                <?php if (!empty($messages)): foreach ($messages as $i => $m): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td style="font-weight:700;"><?php echo htmlspecialchars($m->fullnames??''); ?></td>
                    <td style="font-size:12.5px;"><span style="background:rgba(107,14,32,.1);color:#6B0E20;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:700;"><?php echo htmlspecialchars($m->category??'General'); ?></span></td>
                    <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($m->emailaddress??''); ?></td>
                    <td style="font-size:12.5px;"><?php echo htmlspecialchars($m->phonenumber??''); ?></td>
                    <td style="font-size:12.5px;color:#6c757d;max-width:220px;"><?php echo htmlspecialchars(substr($m->message??'',0,80)); ?></td>
                    <td style="font-size:12px;color:#6c757d;"><?php echo isset($m->datesent)?date('M d, Y',strtotime($m->datesent)):''; ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="7" style="text-align:center;padding:30px;color:#6c757d;">No contact messages yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div></div>
        </div>

        <div class="a-card">
            <div class="a-card-head"><h3 class="a-card-title"><i class="fa-solid fa-paper-plane" style="color:#6B0E20;margin-right:8px;"></i>Newsletter Subscribers (<?php echo count($newsletters); ?>)</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Email Address</th><th>Subscribed</th></tr></thead>
                <tbody>
                <?php if (!empty($newsletters)): foreach ($newsletters as $i => $n): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td style="font-weight:600;"><?php echo htmlspecialchars($n->emailaddress); ?></td>
                    <td style="font-size:12px;color:#6c757d;"><?php echo isset($n->datesent)?date('M d, Y',strtotime($n->datesent)):''; ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="3" style="text-align:center;padding:30px;color:#6c757d;">No newsletter subscribers yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div></div>
        </div>

    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
</body></html>
