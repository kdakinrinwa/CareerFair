<!DOCTYPE html>
<html lang="en">
<head><title>Employers – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap">
<?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Employers Management</div>
    </div>
    <div class="portal-content">

        <form method="get" class="a-filter-bar">
            <div class="a-search">
                <input type="text" name="q" placeholder="Search organisation or email..." value="<?php echo htmlspecialchars($_GET['q']??''); ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <select name="status" class="a-filter-select" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="pending"   <?php echo(($_GET['status']??'')==='pending')?'selected':''; ?>>Pending</option>
                <option value="approved"  <?php echo(($_GET['status']??'')==='approved')?'selected':''; ?>>Approved</option>
                <option value="suspended" <?php echo(($_GET['status']??'')==='suspended')?'selected':''; ?>>Suspended</option>
            </select>
            <?php if (!empty($_GET['q']) || !empty($_GET['status'])): ?>
            <a href="<?php echo base_url(); ?>admin/employers" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-xmark"></i> Clear</a>
            <?php endif; ?>
        </form>

        <div class="a-card">
            <div class="a-card-head">
                <h3 class="a-card-title">Employers (<?php echo count($employers); ?>)</h3>
            </div>
            <div class="a-card-body-flush">
                <div class="a-table-wrap">
                <table class="a-table">
                    <thead><tr><th>#</th><th>Organisation</th><th>Contact Person</th><th>Email</th><th>Type</th><th>Status</th><th>Joined</th><th>Actions</th></tr></thead>
                    <tbody>
                    <?php if (!empty($employers)): foreach ($employers as $i => $e): ?>
                    <tr>
                        <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                        <td style="font-weight:700;"><?php echo htmlspecialchars(substr($e->org_name,0,28)); ?></td>
                        <td>
                            <div style="font-size:13.5px;"><?php echo htmlspecialchars($e->contact_name); ?></div>
                            <div style="font-size:11.5px;color:#6c757d;"><?php echo htmlspecialchars($e->contact_designation??''); ?></div>
                        </td>
                        <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($e->contact_email); ?></td>
                        <td style="font-size:12.5px;"><?php echo htmlspecialchars($e->org_type??''); ?></td>
                        <td><span class="a-badge a-badge-<?php echo $e->accstatus; ?>"><?php echo ucfirst($e->accstatus); ?></span></td>
                        <td style="font-size:12px;color:#6c757d;"><?php echo date('M d, Y',strtotime($e->created_at)); ?></td>
                        <td style="white-space:nowrap;">
                            <?php if ($e->accstatus === 'pending'): ?>
                            <button onclick="changeEmpStatus(<?php echo $e->employer_id; ?>,'approved')" class="a-btn a-btn-green a-btn-sm"><i class="fa-solid fa-check"></i> Approve</button>
                            <?php elseif ($e->accstatus === 'approved'): ?>
                            <button onclick="changeEmpStatus(<?php echo $e->employer_id; ?>,'suspended')" class="a-btn a-btn-red a-btn-sm"><i class="fa-solid fa-ban"></i> Suspend</button>
                            <?php else: ?>
                            <button onclick="changeEmpStatus(<?php echo $e->employer_id; ?>,'approved')" class="a-btn a-btn-green a-btn-sm"><i class="fa-solid fa-rotate-right"></i> Restore</button>
                            <?php endif; ?>
                            <a href="<?php echo base_url(); ?>admin/view_employer/<?php echo $e->employer_id; ?>" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-regular fa-eye"></i> View</a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="8" style="text-align:center;padding:40px;color:#6c757d;">No employers found.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
var _csrf = '<?php echo $this->security->get_csrf_token_name(); ?>';
var _token= '<?php echo $this->security->get_csrf_hash(); ?>';
function changeEmpStatus(id, status) {
    var msg = status==='approved' ? 'Approve this employer?' : status==='suspended' ? 'Suspend this employer account?' : 'Restore this employer?';
    adminConfirm(msg, function(){
        var d = {id:id, status:status}; d[_csrf]=_token;
        $.post('<?php echo site_url("admin/toggle_employer_status"); ?>', d, function(r){
            if(r==1){ adminSuccess('Status updated to '+status); setTimeout(function(){location.reload();},1200); }
            else adminError('Update failed.');
        });
    });
}
</script>
</body></html>
