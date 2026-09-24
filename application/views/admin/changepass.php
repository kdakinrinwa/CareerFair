<!DOCTYPE html>
<html lang="en">
<head><title>Change Password – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Change Password</div>
    </div>
    <div class="portal-content">
        <div class="a-card" style="max-width:480px;">
            <div class="a-card-head"><h3 class="a-card-title"><i class="fa-solid fa-key" style="color:#6B0E20;margin-right:8px;"></i>Change Admin Password</h3></div>
            <div class="a-card-body">
                <form id="cp-form">
                    <input type="hidden" name="auto_id" value="<?php echo $this->session->userdata('userid'); ?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="p-form-group">
                        <label class="p-form-label">New Password *</label>
                        <input type="password" name="newpassword" class="p-form-control" placeholder="Enter new password" required>
                    </div>
                    <div class="p-form-group">
                        <label class="p-form-label">Confirm Password *</label>
                        <input type="password" name="confirm_password" class="p-form-control" placeholder="Repeat new password" required>
                    </div>
                    <button type="submit" class="a-btn a-btn-maroon" style="width:100%;justify-content:center;padding:11px;margin-top:6px;">
                        <i class="fa-solid fa-save"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
$('#cp-form').on('submit',function(e){
    e.preventDefault();
    var pw=$('[name=newpassword]').val(); var cf=$('[name=confirm_password]').val();
    if(pw!==cf){ adminError('Passwords do not match.'); return; }
    if(pw.length<6){ adminError('Password must be at least 6 characters.'); return; }
    $.ajax({url:'<?php echo site_url("admin/resetpassword"); ?>',type:'POST',data:$(this).serialize(),
        success:function(r){ var d=JSON.parse(r); if(d.result==1) adminSuccess('Password updated successfully.'); else adminError('Update failed.'); }
    });
});
</script>
</body></html>
