<!DOCTYPE html>
<html lang="en">
<head><title>Opportunities – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Job &amp; Internship Opportunities</div>
    </div>
    <div class="portal-content">
        <div class="a-card">
            <div class="a-card-head"><h3 class="a-card-title">All Postings (<?php echo count($opps); ?>)</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Title</th><th>Employer</th><th>Type</th><th>Deadline</th><th>Status</th><th>Posted</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if (!empty($opps)): foreach ($opps as $i => $o): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td style="font-weight:700;"><?php echo htmlspecialchars(substr($o->title,0,40)); ?></td>
                    <td style="font-size:13px;"><?php echo htmlspecialchars($o->org_name??''); ?></td>
                    <td><span style="background:rgba(107,14,32,.1);color:#6B0E20;padding:2px 9px;border-radius:20px;font-size:11px;font-weight:700;"><?php echo htmlspecialchars($o->opp_type); ?></span></td>
                    <td style="font-size:12.5px;color:#6c757d;"><?php echo $o->deadline?date('M d, Y',strtotime($o->deadline)):'Open'; ?></td>
                    <td><span class="a-badge a-badge-<?php echo $o->status==='active'?'approved':($o->status==='closed'?'inactive':'draft'); ?>"><?php echo ucfirst($o->status); ?></span></td>
                    <td style="font-size:12px;color:#6c757d;"><?php echo date('M d',strtotime($o->created_at)); ?></td>
                    <td>
                        <?php if ($o->status==='active'): ?>
                        <button onclick="setOppStatus(<?php echo $o->opp_id; ?>,'closed')" class="a-btn a-btn-red a-btn-sm"><i class="fa-solid fa-lock"></i> Close</button>
                        <?php else: ?>
                        <button onclick="setOppStatus(<?php echo $o->opp_id; ?>,'active')" class="a-btn a-btn-green a-btn-sm"><i class="fa-solid fa-unlock"></i> Activate</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="8" style="text-align:center;padding:40px;color:#6c757d;">No opportunities posted yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div></div>
        </div>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
function setOppStatus(id,status){ adminConfirm('Set this opportunity to "'+status+'"?',function(){ var d={id:id,status:status}; d['<?php echo $this->security->get_csrf_token_name(); ?>']='<?php echo $this->security->get_csrf_hash(); ?>'; $.post('<?php echo site_url("admin/toggle_opp_status"); ?>',d,function(r){ if(r==1){adminSuccess('Updated.');setTimeout(function(){location.reload();},1200);}else adminError('Failed.'); }); }); }
</script>
</body></html>
