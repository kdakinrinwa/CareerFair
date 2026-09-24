<!DOCTYPE html>
<html lang="en">
<head>
    <title>QR Event Pass – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
    <style>
    /* ── Printable pass card ───────────────────────────────── */
    .pass-card {
        background: #ffffff;
        border-radius: 14px;
        width: 300px;
        box-shadow: 0 8px 32px rgba(0,0,0,.18);
        overflow: hidden;
        border: 1px solid #e0e0e0;
        font-family: 'DM Sans', sans-serif;
        position: relative;
    }

    /* Maroon header strip */
    .pass-header {
        background: #6B0E20;
        padding: 14px 16px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .pass-header-logo {
        width: 42px; height: 42px;
        border-radius: 50%;
        background: #fff;
        overflow: hidden;
        flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
    }
    .pass-header-logo img { width: 100%; height: 100%; object-fit: contain; padding: 2px; }
    .pass-header-text { line-height: 1.25; }
    .pass-header-text .h-uni {
        font-size: 9.5px; font-weight: 700; color: rgba(255,255,255,.9);
        text-transform: uppercase; letter-spacing: .5px;
    }
    .pass-header-text .h-title {
        font-size: 16px; font-weight: 900; color: #C9A84C;
        letter-spacing: -.3px;
    }
    .pass-header-text .h-year {
        font-size: 16px; font-weight: 900; color: #ffffff;
    }

    /* Passport photo */
    .pass-photo-wrap {
        padding: 18px 0 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .pass-photo {
        width: 110px; height: 130px;
        border-radius: 8px;
        overflow: hidden;
        border: 3px solid #6B0E20;
        background: #f0f0f0;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 0;
    }
    .pass-photo img {
        width: 100%; height: 100%;
        object-fit: cover; object-position: top center;
    }
    .pass-photo-placeholder {
        font-size: 48px; color: #ccc;
    }

    /* Student info */
    .pass-info {
        padding: 12px 18px 4px;
        text-align: center;
    }
    .pass-name {
        font-size: 17px; font-weight: 900; color: #1A1A2E;
        margin-bottom: 2px; line-height: 1.2;
    }
    .pass-dept {
        font-size: 12.5px; color: #555; font-weight: 500;
        margin-bottom: 2px;
    }
    .pass-id {
        font-size: 12px; color: #6B0E20; font-weight: 700;
        letter-spacing: .5px;
    }

    /* QR code */
    .pass-qr-wrap {
        padding: 10px 18px 8px;
        display: flex;
        justify-content: center;
    }
    .pass-qr-img {
        width: 130px; height: 130px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        padding: 4px;
    }
    .pass-qr-img img { width: 100%; height: 100%; object-fit: contain; }

    /* Badge label */
    .pass-badge {
        margin: 4px 18px 10px;
        background: #6B0E20;
        color: #fff;
        border-radius: 6px;
        text-align: center;
        padding: 7px 0;
        font-size: 15px;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    /* Gold footer */
    .pass-footer {
        background: linear-gradient(135deg, #C9A84C, #a88635);
        padding: 9px 14px;
        text-align: center;
    }
    .pass-footer .pf-valid {
        font-size: 13px; font-weight: 900; color: #fff;
        text-transform: uppercase; letter-spacing: 1px;
        margin-bottom: 2px;
    }
    .pass-footer .pf-theme {
        font-size: 10px; color: rgba(255,255,255,.85);
        font-style: italic;
    }

    /* ── Print styles ───────────────────────────────────────── */
    @media print {
        body * { visibility: hidden; }
        .pass-card, .pass-card * { visibility: visible; }
        .pass-card {
            position: fixed;
            top: 0; left: 50%;
            transform: translateX(-50%);
            box-shadow: none;
            border: 2px solid #6B0E20;
            width: 280px;
        }
        .portal-sidebar, .portal-topbar,
        .pass-right-panel, .pass-upload-panel,
        #sidebar-toggle { display: none !important; }
    }
    </style>
</head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">

        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">QR Event Pass</div>
            <div class="portal-topbar-actions">
                <?php if ($qr_pass): ?>
                <button onclick="window.print()" class="p-btn p-btn-maroon p-btn-sm">
                    <i class="fa-solid fa-print"></i> Print Pass
                </button>
                <?php endif; ?>
            </div>
        </div>

        <div class="portal-content">
            <div style="display:grid; grid-template-columns:auto 1fr; gap:28px; align-items:start;">

                <!-- ── LEFT: The printable pass card ─────────── -->
                <div>
                    <?php if ($qr_pass): ?>
                    <div class="pass-card" id="event-pass">

                        <!-- Header -->
                        <div class="pass-header">
                            <div class="pass-header-logo">
                                <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
                            </div>
                            <div class="pass-header-text">
                                <div class="h-uni">The Federal University of<br>Technology, Akure</div>
                                <div>
                                    <span class="h-title">Career Fair&nbsp;</span>
                                    <span class="h-year">2026</span>
                                </div>
                            </div>
                        </div>

                        <!-- Passport photo -->
                        <div class="pass-photo-wrap">
                            <div class="pass-photo">
                                <?php if (!empty($student->passport)): ?>
                                <img src="<?php echo base_url(); ?>uploads/photos/<?php echo htmlspecialchars($student->passport); ?>"
                                     alt="<?php echo htmlspecialchars($student->fullname ?? ''); ?>">
                                <?php else: ?>
                                <div class="pass-photo-placeholder">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Student info -->
                        <div class="pass-info">
                            <div class="pass-name"><?php echo htmlspecialchars($student->fullname ?? 'Student Name'); ?></div>
                            <?php
                            // Get school name
                            $school_names = [1=>'Engineering (SEET)',2=>'Computing (SOC)',3=>'Agriculture (SAAT)',4=>'Earth Sciences (SEMS)',5=>'Environmental Tech (SET)',6=>'Management Tech (SMAT)',7=>'Sciences (SOS)',8=>'Health Technology (SHHT)'];
                            $school_label = isset($student->school_id) ? ($school_names[$student->school_id] ?? '') : '';
                            ?>
                            <?php if ($school_label): ?>
                            <div class="pass-dept"><?php echo $school_label; ?></div>
                            <?php endif; ?>
                            <div class="pass-id">Student ID: <?php echo htmlspecialchars($qr_pass->pass_code); ?></div>
                        </div>

                        <!-- QR Code -->
                        <div class="pass-qr-wrap">
                            <div class="pass-qr-img">
                                <img src="<?php echo base_url(); ?>assetsp/images/QR.png" alt="QR Code">
                            </div>
                        </div>

                        <!-- STUDENT badge -->
                        <div class="pass-badge">STUDENT</div>

                        <!-- Gold footer -->
                        <div class="pass-footer">
                            <div class="pf-valid"><i class="fa-solid fa-circle-check"></i> &nbsp;VALID EVENT PASS</div>
                            <div class="pf-theme">FUTA NextGen: Careers, Skills, Innovation and Industry</div>
                        </div>

                    </div>

                    <!-- Print hint -->
                    <div style="margin-top:12px; text-align:center; font-size:12.5px; color:#6c757d;">
                        <i class="fa-solid fa-print fa-fw"></i> Print, laminate and carry on fair day
                    </div>

                    <?php else: ?>
                    <!-- No pass yet -->
                    <div style="background:#fff; border-radius:14px; padding:40px 28px; text-align:center; box-shadow:0 2px 16px rgba(0,0,0,.07); width:300px;">
                        <i class="fa-solid fa-qrcode" style="font-size:56px; color:#6B0E20; opacity:.3; display:block; margin-bottom:16px;"></i>
                        <h4 style="font-weight:800; color:#1A1A2E; margin:0 0 8px;">No Pass Yet</h4>
                        <p style="font-size:13.5px; color:#6c757d; margin:0 0 20px;">Your QR event pass will be generated once your registration is confirmed by Career Services.</p>
                        <a href="<?php echo base_url(); ?>home/contact" style="display:inline-flex;align-items:center;gap:7px;padding:9px 20px;background:#6B0E20;color:#fff;border-radius:50px;font-size:13.5px;font-weight:700;text-decoration:none;">
                            <i class="fa-regular fa-envelope"></i> Contact Career Services
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- ── RIGHT: Upload passport + instructions ── -->
                <div style="display:flex; flex-direction:column; gap:20px;" class="pass-right-panel">

                    <!-- Passport Upload Card -->
                    <div class="p-card pass-upload-panel">
                        <div class="p-card-header">
                            <h3 class="p-card-title">
                                <i class="fa-solid fa-camera" style="color:#6B0E20; margin-right:8px;"></i>
                                Upload / Update Passport Photo
                            </h3>
                        </div>
                        <div class="p-card-body">
                            <div id="passport-alert" style="display:none; padding:11px 16px; border-radius:8px; margin-bottom:16px; font-size:13.5px;"></div>

                            <!-- Current photo preview -->
                            <div style="display:flex; align-items:center; gap:18px; margin-bottom:20px; padding:16px; background:#F8F6F0; border-radius:10px;">
                                <div style="width:80px; height:96px; border-radius:8px; overflow:hidden; border:3px solid #6B0E20; background:#e8e8e8; flex-shrink:0; display:flex; align-items:center; justify-content:center;">
                                    <?php if (!empty($student->passport)): ?>
                                    <img id="current-passport" src="<?php echo base_url(); ?>uploads/photos/<?php echo htmlspecialchars($student->passport); ?>"
                                         alt="Your passport photo"
                                         style="width:100%; height:100%; object-fit:cover; object-position:top center;">
                                    <?php else: ?>
                                    <i class="fa-regular fa-user" style="font-size:36px; color:#ccc;" id="passport-placeholder"></i>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div style="font-size:14.5px; font-weight:700; color:#1A1A2E; margin-bottom:4px;">
                                        <?php echo !empty($student->passport) ? 'Current passport photo' : 'No photo uploaded yet'; ?>
                                    </div>
                                    <div style="font-size:13px; color:#6c757d; line-height:1.6;">
                                        This photo appears on your event pass.<br>
                                        Use a clear, recent passport-style photo.
                                    </div>
                                </div>
                            </div>

                            <form id="passport-form" enctype="multipart/form-data">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                                <!-- Drop zone -->
                                <div id="passport-dropzone"
                                     style="border:2px dashed #e8e8e8; border-radius:10px; padding:28px 16px; text-align:center; cursor:pointer; transition:border-color .2s; margin-bottom:14px;"
                                     onclick="document.getElementById('passport_file').click()">
                                    <i class="fa-regular fa-image" style="font-size:32px; color:#6B0E20; opacity:.5; display:block; margin-bottom:10px;"></i>
                                    <div style="font-size:14.5px; font-weight:700; color:#1A1A2E; margin-bottom:4px;">Click to select passport photo</div>
                                    <div style="font-size:13px; color:#6c757d;">JPG or PNG &bull; Minimum 300×300px &bull; Max 3 MB</div>
                                    <div id="passport-filename" style="font-size:13px; font-weight:700; color:#6B0E20; margin-top:8px;"></div>
                                </div>
                                <input type="file" name="passport_file" id="passport_file"
                                       accept="image/jpeg,image/png,image/jpg"
                                       style="display:none;">

                                <!-- Photo guidelines -->
                                <div style="background:rgba(201,168,76,.08); border:1px solid rgba(201,168,76,.3); border-radius:8px; padding:12px 14px; margin-bottom:16px;">
                                    <div style="font-size:12.5px; font-weight:700; color:#a88635; margin-bottom:7px;">
                                        <i class="fa-solid fa-lightbulb fa-fw"></i> Photo Guidelines
                                    </div>
                                    <?php foreach ([
                                        'Plain/light background preferred',
                                        'Face clearly visible, no sunglasses',
                                        'Recent photo – taken within the last year',
                                        'Portrait orientation works best',
                                    ] as $g): ?>
                                    <div style="display:flex; align-items:center; gap:7px; font-size:12.5px; color:#1A1A2E; margin-bottom:4px;">
                                        <i class="fa-solid fa-check" style="color:#6B0E20; font-size:11px; flex-shrink:0;"></i>
                                        <?php echo $g; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <button type="submit" id="passport-upload-btn" class="p-btn p-btn-maroon" style="width:100%; justify-content:center; font-size:14.5px; padding:12px;">
                                    <i class="fa-solid fa-cloud-upload-alt"></i> Upload Passport Photo
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- How to Use card -->
                    <div class="p-card">
                        <div class="p-card-header"><h3 class="p-card-title">How to Use Your Pass</h3></div>
                        <div class="p-card-body">
                            <?php foreach ([
                                ['fa-door-open',       'Show at Entrance',   'Present your pass at the main gate for check-in on both days.'],
                                ['fa-store',           'Booth Scanning',     'Let employers scan your QR code at their booths during the fair.'],
                                ['fa-calendar-check',  'Session Entry',      'Use your pass to mark attendance at talks and workshops.'],
                                ['fa-print',           'Print & Laminate',   'Print this page and laminate your pass for a professional look.'],
                            ] as $tip): ?>
                            <div style="display:flex; gap:14px; margin-bottom:16px;">
                                <div style="width:38px; height:38px; border-radius:10px; background:rgba(107,14,32,.08); display:flex; align-items:center; justify-content:center; font-size:17px; color:#6B0E20; flex-shrink:0;">
                                    <i class="fa-solid <?php echo $tip[0]; ?>"></i>
                                </div>
                                <div>
                                    <div style="font-size:14px; font-weight:700; color:#1A1A2E;"><?php echo $tip[1]; ?></div>
                                    <div style="font-size:13px; color:#6c757d;"><?php echo $tip[2]; ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div><!-- /right panel -->
            </div>
        </div>
    </main>
</div>

<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>
<script>
// ── Sidebar toggle ──────────────────────────────────────
$('#sidebar-toggle').on('click', function(){ $('#portal-sidebar').toggleClass('open'); });

// ── File name preview & drag-drop ──────────────────────
$('#passport_file').on('change', function(){
    if (!this.files[0]) return;
    var name = this.files[0].name;
    $('#passport-filename').text('✓ ' + name);
    $('#passport-dropzone').css('border-color', '#6B0E20');

    // Live preview on the card before upload
    var reader = new FileReader();
    reader.onload = function(e) {
        var src = e.target.result;
        // Update preview box in upload panel
        $('#passport-dropzone').closest('.p-card-body').find('img#current-passport').attr('src', src);
        // Update the pass card photo live
        $('.pass-photo img').attr('src', src);
        // Remove placeholder if shown
        $('#passport-placeholder').hide();
    };
    reader.readAsDataURL(this.files[0]);
});

// Drag & drop
var dz = document.getElementById('passport-dropzone');
if (dz) {
    dz.addEventListener('dragover',  function(e){ e.preventDefault(); this.style.borderColor='#6B0E20'; });
    dz.addEventListener('dragleave', function()  { this.style.borderColor='#e8e8e8'; });
    dz.addEventListener('drop', function(e){
        e.preventDefault();
        var f = e.dataTransfer.files[0];
        if (f) {
            document.getElementById('passport_file').files = e.dataTransfer.files;
            // Trigger change event manually
            $('#passport_file').trigger('change');
        }
    });
}

// ── Upload ──────────────────────────────────────────────
$('#passport-form').on('submit', function(e){
    e.preventDefault();

    if (!$('#passport_file')[0].files.length) {
        showPassAlert('Please select a photo to upload.', 'error');
        return;
    }

    var file  = $('#passport_file')[0].files[0];
    var maxMB = 3 * 1024 * 1024;
    if (file.size > maxMB) {
        showPassAlert('File is too large. Maximum size is 3 MB.', 'error');
        return;
    }

    var allowed = ['image/jpeg','image/jpg','image/png'];
    if (!allowed.includes(file.type)) {
        showPassAlert('Only JPG and PNG images are accepted.', 'error');
        return;
    }

    var btn = $('#passport-upload-btn')
        .html('<i class="fa-solid fa-spinner fa-spin"></i> Uploading...')
        .prop('disabled', true);

    var fd = new FormData(this);

    $.ajax({
        url:         '<?php echo site_url("student/upload_passport"); ?>',
        type:        'POST',
        data:        fd,
        contentType: false,
        processData: false,
        success: function(resp) {
            var d = JSON.parse(resp);
            if (d.result == 1) {
                showPassAlert('<i class="fa-solid fa-circle-check"></i> Passport photo updated! Your event pass has been refreshed.', 'success');
                // Reload after 1.5s so the new photo is fetched from server
                setTimeout(function(){ location.reload(); }, 1600);
            } else if (d.result == -2) {
                showPassAlert('Only JPG or PNG files are accepted.', 'error');
            } else if (d.result == -3) {
                showPassAlert('File too large. Maximum is 3 MB.', 'error');
            } else {
                showPassAlert('Upload failed. Please try again.', 'error');
            }
            btn.html('<i class="fa-solid fa-cloud-upload-alt"></i> Upload Passport Photo').prop('disabled', false);
        },
        error: function(){
            showPassAlert('Server error. Please try again.', 'error');
            btn.html('<i class="fa-solid fa-cloud-upload-alt"></i> Upload Passport Photo').prop('disabled', false);
        }
    });
});

function showPassAlert(msg, type){
    var el = document.getElementById('passport-alert');
    el.style.display   = 'block';
    el.style.background = type === 'success' ? '#d1fae5' : '#fee2e2';
    el.style.color      = type === 'success' ? '#065f46' : '#991b1b';
    el.style.border     = '1px solid ' + (type === 'success' ? '#6ee7b7' : '#fca5a5');
    el.innerHTML = msg;
    el.scrollIntoView({ behavior:'smooth', block:'nearest' });
}
</script>
</body>
</html>
