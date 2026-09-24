<!DOCTYPE html>
<html lang="en">
<head><title>Booth Requests – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Booth Requests</div>
    </div>
    <div class="portal-content">
        <div class="a-card">
            <div class="a-card-head"><h3 class="a-card-title">Exhibition Booth Requests (<?php echo count($booths); ?>)</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Organisation</th><th>Contact</th><th>Size</th><th>Requirements</th><th>Status</th><th>Booth No.</th><th>Requested</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if (!empty($booths)): foreach ($booths as $i => $b): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td style="font-weight:700;"><?php echo htmlspecialchars(substr($b->org_name??'',0,24)); ?></td>
                    <td style="font-size:12.5px;"><?php echo htmlspecialchars($b->contact_name??''); ?></td>
                    <td><span style="background:rgba(107,14,32,.1);color:#6B0E20;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:700;"><?php echo $b->booth_size; ?></span></td>
                    <td style="font-size:12px;color:#6c757d;max-width:140px;"><?php echo htmlspecialchars(substr($b->requirements??'',0,50)); ?></td>
                    <td><span class="a-badge a-badge-<?php echo $b->status==='approved'?'approved':($b->status==='rejected'?'inactive':'pending'); ?>"><?php echo ucfirst($b->status); ?></span></td>
                    <td style="font-weight:700;color:#6B0E20;"><?php echo $b->booth_number??'–'; ?></td>
                    <td style="font-size:12px;color:#6c757d;"><?php echo date('M d',strtotime($b->requested_at)); ?></td>
                    <td>
                        <?php if ($b->status === 'pending'): ?>
                        <button onclick="approveBooth(<?php echo $b->booth_req_id; ?>)" class="a-btn a-btn-green a-btn-sm"><i class="fa-solid fa-check"></i> Allocate</button>
                        <button onclick="rejectBooth(<?php echo $b->booth_req_id; ?>)" class="a-btn a-btn-red a-btn-sm"><i class="fa-solid fa-xmark"></i> Reject</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="9" style="text-align:center;padding:40px;color:#6c757d;">No booth requests yet.</td></tr>
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
function approveBooth(id) {
    Swal.fire({ title:'Allocate Booth', html:'<input id="bn" placeholder="Booth number e.g. A12" class="swal2-input"><input id="bl" placeholder="Location e.g. Hall A Row 3" class="swal2-input">', showCancelButton:true, confirmButtonColor:'#6B0E20', confirmButtonText:'Allocate' }).then(function(r){
        if(r.isConfirmed){ var d={id:id,status:'approved',booth_number:$('#bn').val(),booth_location:$('#bl').val()}; d[_csrf]=_tok; $.post('<?php echo site_url("admin/approve_booth"); ?>',d,function(res){ if(res==1){adminSuccess('Booth allocated.');setTimeout(function(){location.reload();},1200);}else adminError('Failed.'); }); }
    });
}
function rejectBooth(id){ adminConfirm('Reject this booth request?',function(){ var d={id:id,status:'rejected'}; d[_csrf]=_tok; $.post('<?php echo site_url("admin/approve_booth"); ?>',d,function(res){ if(res==1){adminSuccess('Rejected.');setTimeout(function(){location.reload();},1200);}else adminError('Failed.'); }); }); }
</script>
</body></html>
