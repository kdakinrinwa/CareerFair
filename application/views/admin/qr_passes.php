<!DOCTYPE html>
<html lang="en">
<head><title>QR Passes – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">QR Event Passes</div>
    </div>
    <div class="portal-content">
        <div class="a-card">
            <div class="a-card-head"><h3 class="a-card-title">Issued QR Passes (<?php echo count($passes); ?>)</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Pass Code</th><th>Name</th><th>Matric No</th><th>Type</th><th>Level</th><th>Status</th><th>Issued</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if (!empty($passes)): foreach ($passes as $i => $p): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td style="font-family:monospace;font-size:12.5px;color:#6B0E20;font-weight:700;"><?php echo htmlspecialchars($p->pass_code); ?></td>
                    <td style="font-weight:600;"><?php echo htmlspecialchars($p->fullname??'–'); ?></td>
                    <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($p->matric_no??'–'); ?></td>
                    <td><span style="background:rgba(107,14,32,.1);color:#6B0E20;padding:2px 8px;border-radius:20px;font-size:10.5px;font-weight:700;"><?php echo ucfirst($p->user_type); ?></span></td>
                    <td style="font-size:12.5px;"><?php echo htmlspecialchars($p->level??'–'); ?></td>
                    <td><?php if ($p->is_revoked): ?><span class="a-badge a-badge-revoked">Revoked</span><?php else: ?><span class="a-badge a-badge-active">Valid</span><?php endif; ?></td>
                    <td style="font-size:12px;color:#6c757d;"><?php echo date('M d, Y',strtotime($p->issued_at)); ?></td>
                    <td>
                        <?php if (!$p->is_revoked): ?>
                        <button onclick="revokeQR(<?php echo $p->pass_id; ?>)" class="a-btn a-btn-red a-btn-sm"><i class="fa-solid fa-ban"></i> Revoke</button>
                        <?php else: ?>
                        <span style="font-size:12px;color:#aaa;">Revoked <?php echo $p->revoked_at?date('M d',strtotime($p->revoked_at)):''; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="9" style="text-align:center;padding:40px;color:#6c757d;">No QR passes issued yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div></div>
        </div>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
function revokeQR(id){ adminConfirm('Revoke this QR pass? The student will lose event access.',function(){ var d={pass_id:id}; d['<?php echo $this->security->get_csrf_token_name(); ?>']='<?php echo $this->security->get_csrf_hash(); ?>'; $.post('<?php echo site_url("admin/revoke_qr"); ?>',d,function(r){ if(r==1){adminSuccess('Pass revoked.');setTimeout(function(){location.reload();},1200);}else adminError('Failed.'); }); }); }
</script>
</body></html>
