<!DOCTYPE html>
<html lang="en">
<head><title>Settings – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Account Settings</div>
        </div>
        <div class="portal-content">

            <div id="settings-alert"></div>

            <!-- Change Password -->
            <div class="p-card" style="max-width:560px; margin-bottom:24px;">
                <div class="p-card-header">
                    <h3 class="p-card-title"><i class="fa-solid fa-lock" style="color:#6B0E20;margin-right:8px;"></i>Change Password</h3>
                </div>
                <div class="p-card-body">
                    <form id="pass-form">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="p-form-group">
                            <label class="p-form-label">Current Password *</label>
                            <input type="password" name="current_password" class="p-form-control" placeholder="Enter current password" required>
                        </div>
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">New Password *</label>
                                <input type="password" name="new_password" class="p-form-control" placeholder="New password" required>
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Confirm New Password *</label>
                                <input type="password" name="confirm_password" class="p-form-control" placeholder="Repeat new password" required>
                            </div>
                        </div>
                        <button type="submit" class="p-btn p-btn-maroon">
                            <i class="fa-solid fa-key"></i> Update Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Account Info (read-only) -->
            <div class="p-card" style="max-width:560px;">
                <div class="p-card-header">
                    <h3 class="p-card-title"><i class="fa-solid fa-id-card" style="color:#6B0E20;margin-right:8px;"></i>Account Information</h3>
                </div>
                <div class="p-card-body">
                    <?php
                    $rows = [
                        ['Matric Number', $student->matric_no ?? '—'],
                        ['Email Address', $student->email ?? '—'],
                        ['Registration Status', ucfirst($student->accstatus ?? 'active')],
                        ['Fair Registered', ($student->fair_registered ?? 0) ? 'Yes' : 'No'],
                    ];
                    foreach ($rows as $r):
                    ?>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:11px 0;border-bottom:1px solid #f0f0f0;">
                        <span style="font-size:13.5px;font-weight:600;color:#6c757d;"><?php echo $r[0]; ?></span>
                        <span style="font-size:13.5px;font-weight:700;color:#1A1A2E;"><?php echo htmlspecialchars($r[1]); ?></span>
                    </div>
                    <?php endforeach; ?>
                    <div style="margin-top:16px; padding:12px 16px; background:rgba(201,168,76,.1); border-radius:8px; font-size:13px; color:#92400e; border:1px solid rgba(201,168,76,.3);">
                        <i class="fa-solid fa-triangle-exclamation fa-fw"></i>
                        To change your email or matric number, please contact the Career Services office.
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>
<script>
$('#sidebar-toggle').on('click', function(){ $('#portal-sidebar').toggleClass('open'); });
$('#pass-form').on('submit', function(e){
    e.preventDefault();
    var btn = $(this).find('button[type=submit]');
    btn.html('<i class="fa-solid fa-spinner fa-spin"></i> Updating...').prop('disabled', true);
    $.ajax({
        url: '<?php echo site_url("student/change_password"); ?>',
        type: 'POST', data: $(this).serialize(),
        success: function(r){
            var d = JSON.parse(r);
            if (d.result == 1) {
                Swal.fire({ icon:'success', title:'Password Updated', text:'Your password has been changed successfully.', confirmButtonColor:'#6B0E20' });
                $('#pass-form')[0].reset();
            } else if (d.result == -1) {
                Swal.fire({ icon:'error', title:'Incorrect Password', text:'Your current password is wrong.', confirmButtonColor:'#6B0E20' });
            } else if (d.result == -2) {
                Swal.fire({ icon:'error', title:'Mismatch', text:'New passwords do not match.', confirmButtonColor:'#6B0E20' });
            } else {
                Swal.fire({ icon:'error', title:'Error', text:'Something went wrong. Please try again.', confirmButtonColor:'#6B0E20' });
            }
            btn.html('<i class="fa-solid fa-key"></i> Update Password').prop('disabled', false);
        }
    });
});
</script>
</body></html>
