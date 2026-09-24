<!DOCTYPE html>
<html lang="en">
<head><title>Career Talks – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Career Talk Requests</div>
    </div>
    <div class="portal-content">
        <div class="a-card">
            <div class="a-card-head"><h3 class="a-card-title">Career Talk Requests (<?php echo count($talks); ?>)</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Speaker</th><th>Organisation</th><th>Topic</th><th>Pref. Date</th><th>Status</th><th>Requested</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if (!empty($talks)): foreach ($talks as $i => $t): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td><div style="font-weight:700;"><?php echo htmlspecialchars($t->speaker_name); ?></div><div style="font-size:11.5px;color:#6c757d;"><?php echo htmlspecialchars($t->designation??''); ?></div></td>
                    <td style="font-size:13px;"><?php echo htmlspecialchars($t->organisation??''); ?></td>
                    <td style="font-size:13px;max-width:180px;"><?php echo htmlspecialchars(substr($t->topic,0,60)); ?></td>
                    <td style="font-size:12.5px;color:#6c757d;"><?php echo $t->preferred_date?date('M d, Y',strtotime($t->preferred_date)):'TBC'; ?></td>
                    <td><span class="a-badge a-badge-<?php echo $t->status==='approved'?'approved':($t->status==='declined'?'inactive':'pending'); ?>"><?php echo ucfirst($t->status); ?></span></td>
                    <td style="font-size:12px;color:#6c757d;"><?php echo date('M d',strtotime($t->requested_at)); ?></td>
                    <td>
                        <?php if ($t->status === 'pending'): ?>
                        <button onclick="talkAction(<?php echo $t->talk_id; ?>,'approved')" class="a-btn a-btn-green a-btn-sm"><i class="fa-solid fa-check"></i> Approve</button>
                        <button onclick="talkAction(<?php echo $t->talk_id; ?>,'declined')" class="a-btn a-btn-red a-btn-sm"><i class="fa-solid fa-xmark"></i> Decline</button>
                        <?php elseif ($t->status === 'approved'): ?>
                        <button onclick="talkAction(<?php echo $t->talk_id; ?>,'scheduled')" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-calendar-check"></i> Schedule</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="8" style="text-align:center;padding:40px;color:#6c757d;">No career talk requests yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div></div>
        </div>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
var _csrf='<?php echo $this->security->get_csrf_token_name(); ?>';
var _tok='<?php echo $this->security->get_csrf_hash(); ?>';
function talkAction(id, status) {
    adminConfirm('Set status to "'+status+'"?', function(){
        var d={id:id,status:status}; d[_csrf]=_tok;
        $.post('<?php echo site_url("admin/approve_talk"); ?>',d,function(r){ if(r==1){adminSuccess('Updated.');setTimeout(function(){location.reload();},1200);}else adminError('Failed.'); });
    });
}
</script>
</body></html>
