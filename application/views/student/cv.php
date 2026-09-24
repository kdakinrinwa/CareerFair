<!DOCTYPE html>
<html lang="en">
<head><title>My CV – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">My CV</div>
        </div>
        <div class="portal-content">

            <div id="cv-alert"></div>

            <div style="display:grid; grid-template-columns:1.4fr 1fr; gap:24px; align-items:start;">

                <!-- Upload panel -->
                <div class="p-card">
                    <div class="p-card-header">
                        <h3 class="p-card-title"><i class="fa-solid fa-upload" style="color:#6B0E20;margin-right:8px;"></i>Upload / Replace CV</h3>
                    </div>
                    <div class="p-card-body">
                        <form id="cv-form" enctype="multipart/form-data">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                            <!-- Drop zone -->
                            <div id="cv-dropzone" style="border:2px dashed #e8e8e8; border-radius:12px; padding:36px 20px; text-align:center; cursor:pointer; transition:border-color .2s; margin-bottom:16px;"
                                 onclick="document.getElementById('cv_file').click()">
                                <i class="fa-regular fa-file-pdf" style="font-size:44px; color:#6B0E20; opacity:.6; display:block; margin-bottom:12px;"></i>
                                <div style="font-size:15px; font-weight:700; color:#1A1A2E; margin-bottom:4px;">Click to select your CV</div>
                                <div style="font-size:13px; color:#6c757d;">PDF or DOCX &bull; Maximum 5 MB</div>
                                <div id="cv-filename" style="font-size:13px; color:#6B0E20; font-weight:700; margin-top:10px;"></div>
                            </div>
                            <input type="file" name="cv_file" id="cv_file" accept=".pdf,.docx,.doc" style="display:none;">

                            <!-- Classification metadata -->
                            <div style="background:#F8F6F0; border-radius:10px; padding:16px; margin-bottom:18px;">
                                <div style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#a88635; margin-bottom:12px;">
                                    <i class="fa-solid fa-tag fa-fw"></i> CV Classification (helps employers find you)
                                </div>
                                <div class="p-form-row">
                                    <div class="p-form-group">
                                        <label class="p-form-label">School</label>
                                        <select name="school_id" class="p-form-control">
                                            <option value="">Select School</option>
                                            <?php foreach ([1=>'SEET – Engineering',2=>'SOC – Computing',3=>'SAAT – Agriculture',4=>'SEMS – Earth Sciences',5=>'SET – Environmental Tech',6=>'SMAT – Management Tech',7=>'SOS – Sciences',8=>'SHHT – Health Tech'] as $id=>$name): ?>
                                            <option value="<?php echo $id; ?>" <?php echo ($student->school_id??0)==$id?'selected':''; ?>><?php echo $name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="p-form-group">
                                        <label class="p-form-label">Level</label>
                                        <select name="level" class="p-form-control">
                                            <?php foreach (['100','200','300','400','500','600','PGD','MSc','PhD'] as $l): ?>
                                            <option value="<?php echo $l; ?>" <?php echo ($student->level??'')===$l?'selected':''; ?>><?php echo $l; ?> Level</option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-form-group" style="margin-bottom:0;">
                                    <label class="p-form-label">Key Skills <small style="color:#6c757d;">(comma-separated)</small></label>
                                    <input type="text" name="skills" class="p-form-control" value="<?php echo htmlspecialchars($student->skills??''); ?>" placeholder="Python, AutoCAD, MATLAB, Networking...">
                                </div>
                            </div>

                            <!-- Consent -->
                            <div style="padding:12px 16px; background:rgba(107,14,32,.04); border-radius:8px; border:1px solid rgba(107,14,32,.1); margin-bottom:18px;">
                                <label style="display:flex; align-items:flex-start; gap:10px; cursor:pointer; font-size:13.5px; color:#1A1A2E;">
                                    <input type="checkbox" name="cv_consent" id="cv_consent" style="margin-top:2px; accent-color:#6B0E20;" required>
                                    <span>I consent to FUTA Career Services sharing my CV with approved employers for recruitment and internship purposes.</span>
                                </label>
                            </div>

                            <button type="submit" id="cv-upload-btn" class="p-btn p-btn-maroon" style="width:100%; justify-content:center;">
                                <i class="fa-solid fa-cloud-upload-alt"></i> Upload CV
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Current CV -->
                <div class="p-card">
                    <div class="p-card-header">
                        <h3 class="p-card-title">Current CV</h3>
                    </div>
                    <div class="p-card-body">
                        <?php if ($cv): ?>
                        <div style="text-align:center; padding:20px 0;">
                            <i class="fa-regular fa-file-pdf" style="font-size:56px; color:#6B0E20; display:block; margin-bottom:14px;"></i>
                            <div style="font-size:14.5px; font-weight:700; color:#1A1A2E; margin-bottom:4px; word-break:break-all;">
                                <?php echo htmlspecialchars($cv->original_name ?? $cv->filename); ?>
                            </div>
                            <div style="font-size:12px; color:#6c757d; margin-bottom:16px;">
                                Uploaded <?php echo date('M d, Y', strtotime($cv->uploaded_at)); ?>
                                &bull; <?php echo number_format($cv->file_size/1024, 1); ?> KB
                            </div>
                            <span class="p-badge p-badge-green" style="margin-bottom:16px; display:inline-block;">
                                <i class="fa-solid fa-circle-check"></i> Active
                            </span>
                            <div>
                                <a href="<?php echo base_url(); ?>uploads/cvs/<?php echo htmlspecialchars($cv->filename); ?>"
                                   target="_blank" class="p-btn p-btn-outline p-btn-sm">
                                    <i class="fa-solid fa-eye"></i> View CV
                                </a>
                            </div>
                        </div>
                        <?php else: ?>
                        <div style="text-align:center; padding:28px; color:#6c757d;">
                            <i class="fa-regular fa-file-lines" style="font-size:48px; opacity:.3; display:block; margin-bottom:14px;"></i>
                            <div style="font-size:15px; font-weight:700; color:#1A1A2E; margin-bottom:8px;">No CV Uploaded</div>
                            <p style="font-size:13px;">Upload your CV so employers can find and shortlist you.</p>
                        </div>
                        <?php endif; ?>

                        <!-- CV Tips -->
                        <div style="margin-top:20px; padding:14px; background:#F8F6F0; border-radius:8px;">
                            <div style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#a88635; margin-bottom:10px;">CV Tips</div>
                            <?php foreach ([
                                'Use a clean, readable format (no tables or text boxes)',
                                'Keep to 1–2 pages; PG students may use up to 3',
                                'List technical skills clearly: Python, MATLAB, AutoCAD',
                                'Include your matric number and graduation year',
                                'Save and upload as PDF to preserve formatting',
                            ] as $tip): ?>
                            <div style="display:flex; gap:8px; font-size:12.5px; color:#1A1A2E; margin-bottom:6px;">
                                <i class="fa-solid fa-check" style="color:#6B0E20; flex-shrink:0; margin-top:2px;"></i>
                                <?php echo $tip; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
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

// File name preview
$('#cv_file').on('change', function(){
    var name = this.files[0] ? this.files[0].name : '';
    $('#cv-filename').text(name ? '✓ ' + name : '');
    $('#cv-dropzone').css('border-color', name ? '#6B0E20' : '#e8e8e8');
});

// Drag & drop
var dz = document.getElementById('cv-dropzone');
dz.addEventListener('dragover', function(e){ e.preventDefault(); this.style.borderColor='#6B0E20'; });
dz.addEventListener('dragleave', function(){ this.style.borderColor='#e8e8e8'; });
dz.addEventListener('drop', function(e){
    e.preventDefault();
    var f = e.dataTransfer.files[0];
    if (f) {
        document.getElementById('cv_file').files = e.dataTransfer.files;
        $('#cv-filename').text('✓ ' + f.name);
        this.style.borderColor = '#6B0E20';
    }
});

// Upload
$('#cv-form').on('submit', function(e){
    e.preventDefault();
    if (!$('#cv_file')[0].files.length) {
        Swal.fire({ icon:'warning', title:'No File', text:'Please select a CV file to upload.', confirmButtonColor:'#6B0E20' });
        return;
    }
    if (!$('#cv_consent').is(':checked')) {
        Swal.fire({ icon:'warning', title:'Consent Required', text:'Please tick the consent checkbox before uploading.', confirmButtonColor:'#6B0E20' });
        return;
    }
    var btn = $('#cv-upload-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Uploading...').prop('disabled', true);
    var fd  = new FormData(this);
    $.ajax({
        url: '<?php echo site_url("student/upload_cv"); ?>',
        type: 'POST', data: fd,
        contentType: false, processData: false,
        success: function(r){
            var d = JSON.parse(r);
            if (d.result == 1) {
                Swal.fire({ icon:'success', title:'CV Uploaded', text:'Your CV has been uploaded successfully.', confirmButtonColor:'#6B0E20' })
                    .then(function(){ location.reload(); });
            } else if (d.result == -2) {
                Swal.fire({ icon:'error', title:'Invalid Format', text:'Only PDF, DOC, or DOCX files are allowed.', confirmButtonColor:'#6B0E20' });
            } else if (d.result == -3) {
                Swal.fire({ icon:'error', title:'File Too Large', text:'Maximum file size is 5 MB.', confirmButtonColor:'#6B0E20' });
            } else {
                Swal.fire({ icon:'error', title:'Upload Failed', text:'Could not save your CV. Please try again.', confirmButtonColor:'#6B0E20' });
            }
            $('#cv-upload-btn').html('<i class="fa-solid fa-cloud-upload-alt"></i> Upload CV').prop('disabled', false);
        }
    });
});
</script>
</body></html>
