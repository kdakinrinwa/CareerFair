<!DOCTYPE html>
<html lang="en">
<head><title>Company Profile – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Company Profile</div>
        </div>
        <div class="portal-content">
            <div class="p-card" style="max-width:680px;">
                <div class="p-card-header">
                    <h3 class="p-card-title">Edit Company Profile</h3>
                    <button class="p-btn p-btn-maroon p-btn-sm" id="save-emp-btn"><i class="fa-solid fa-save"></i> Save</button>
                </div>
                <div class="p-card-body">
                    <form id="emp-form">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">Organisation Name</label>
                                <input type="text" name="org_name" class="p-form-control" value="<?php echo htmlspecialchars($employer->org_name??''); ?>" required>
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Organisation Type</label>
                                <select name="org_type" class="p-form-control">
                                    <?php foreach (['Private Company','Government','NGO','International Organisation','Startup','Other'] as $t): ?>
                                    <option value="<?php echo $t; ?>" <?php echo ($employer->org_type??'')===$t?'selected':''; ?>><?php echo $t; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">Contact Person</label>
                                <input type="text" name="contact_name" class="p-form-control" value="<?php echo htmlspecialchars($employer->contact_name??''); ?>">
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Designation</label>
                                <input type="text" name="contact_designation" class="p-form-control" value="<?php echo htmlspecialchars($employer->contact_designation??''); ?>">
                            </div>
                        </div>
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">Phone</label>
                                <input type="tel" name="contact_phone" class="p-form-control" value="<?php echo htmlspecialchars($employer->contact_phone??''); ?>">
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Website</label>
                                <input type="url" name="website" class="p-form-control" value="<?php echo htmlspecialchars($employer->website??''); ?>">
                            </div>
                        </div>
                        <div class="p-form-group">
                            <label class="p-form-label">Recruitment Interest</label>
                            <div style="display:flex;flex-wrap:wrap;gap:10px;">
                                <?php foreach (['Internship','NYSC','Graduate Trainee','Full-time'] as $ri): ?>
                                <label style="display:flex;align-items:center;gap:7px;font-size:13.5px;cursor:pointer;padding:6px 14px;border:1.5px solid #e8e8e8;border-radius:50px;">
                                    <input type="checkbox" name="recruit_interest[]" value="<?php echo $ri; ?>" style="accent-color:#6B0E20;"
                                        <?php echo (strpos($employer->recruit_interest??'',$ri)!==false)?'checked':''; ?>>
                                    <?php echo $ri; ?>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>
<script>
$('#sidebar-toggle').on('click',function(){$('#portal-sidebar').toggleClass('open');});
$('#save-emp-btn').on('click',function(){
    $(this).html('<i class="fa-solid fa-spinner fa-spin"></i>').prop('disabled',true);
    $.ajax({url:'<?php echo site_url("employer/save_profile"); ?>',type:'POST',data:$('#emp-form').serialize(),success:function(r){
        var d=JSON.parse(r);
        Swal.fire({icon:d.result==1?'success':'error',title:d.result==1?'Saved':'Error',confirmButtonColor:'#6B0E20'});
        $('#save-emp-btn').html('<i class="fa-solid fa-save"></i> Save').prop('disabled',false);
    }});
});
</script>
</body></html>
