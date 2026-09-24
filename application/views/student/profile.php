<!DOCTYPE html>
<html lang="en">
<head><title>My Profile – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">My Profile</div>
        </div>
        <div class="portal-content">
            <div id="profile-alert"></div>
            <div class="p-card">
                <div class="p-card-header">
                    <h3 class="p-card-title">Edit Profile</h3>
                    <button class="p-btn p-btn-maroon p-btn-sm" id="save-profile-btn">
                        <i class="fa-solid fa-save"></i> Save Changes
                    </button>
                </div>
                <div class="p-card-body">
                    <form id="profile-form">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">Full Name *</label>
                                <input type="text" name="fullname" class="p-form-control" value="<?php echo htmlspecialchars($student->fullname ?? ''); ?>" required>
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Phone Number</label>
                                <input type="tel" name="phone" class="p-form-control" value="<?php echo htmlspecialchars($student->phone ?? ''); ?>">
                            </div>
                        </div>
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">Level</label>
                                <select name="level" class="p-form-control">
                                    <?php foreach (['100','200','300','400','500','600','PGD','MSc','PhD'] as $l): ?>
                                    <option value="<?php echo $l; ?>" <?php echo ($student->level??'')===$l?'selected':''; ?>><?php echo $l; ?> Level</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Gender</label>
                                <select name="gender" class="p-form-control">
                                    <option value="">Select</option>
                                    <?php foreach (['Male','Female','Other'] as $g): ?>
                                    <option value="<?php echo $g; ?>" <?php echo ($student->gender??'')===$g?'selected':''; ?>><?php echo $g; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="p-form-group">
                            <label class="p-form-label">Skills <small style="color:#6c757d;">(comma-separated, e.g. Python, AutoCAD, MATLAB)</small></label>
                            <input type="text" name="skills" class="p-form-control" value="<?php echo htmlspecialchars($student->skills ?? ''); ?>" placeholder="Python, AutoCAD, Networking, GIS...">
                        </div>
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">LinkedIn URL</label>
                                <input type="url" name="linkedin_url" class="p-form-control" value="<?php echo htmlspecialchars($student->linkedin_url ?? ''); ?>" placeholder="https://linkedin.com/in/...">
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">GitHub / Portfolio URL</label>
                                <input type="url" name="github_url" class="p-form-control" value="<?php echo htmlspecialchars($student->github_url ?? ''); ?>" placeholder="https://github.com/...">
                            </div>
                        </div>
                        <div class="p-form-group">
                            <label class="p-form-label">Career Interests</label>
                            <div style="display:flex; flex-wrap:wrap; gap:10px;">
                                <?php foreach (['Internship','NYSC Placement','Graduate Job','Mentoring','Entrepreneurship'] as $ci): ?>
                                <label style="display:flex; align-items:center; gap:7px; font-size:13.5px; cursor:pointer; padding:6px 14px; border:1.5px solid #e8e8e8; border-radius:50px;">
                                    <input type="checkbox" name="career_interest[]" value="<?php echo $ci; ?>"
                                        style="accent-color:#6B0E20;"
                                        <?php echo (strpos($student->career_interest??'',$ci)!==false)?'checked':''; ?>>
                                    <?php echo $ci; ?>
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
$('#save-profile-btn').on('click',function(){
    var btn = $(this).html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...').prop('disabled',true);
    $.ajax({
        url:'<?php echo site_url("student/save_profile"); ?>',
        type:'POST', data:$('#profile-form').serialize(),
        success:function(r){
            var d=JSON.parse(r);
            if(d.result==1){ Swal.fire({icon:'success',title:'Saved',text:'Profile updated successfully.',confirmButtonColor:'#6B0E20'}); }
            else { Swal.fire({icon:'error',title:'Error',text:'Failed to save. Please try again.',confirmButtonColor:'#6B0E20'}); }
            $('#save-profile-btn').html('<i class="fa-solid fa-save"></i> Save Changes').prop('disabled',false);
        }
    });
});
</script>
</body></html>
