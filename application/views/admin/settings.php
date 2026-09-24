<!DOCTYPE html>
<html lang="en">
<head><title>Site Settings – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap">
<?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Site Settings</div>
    </div>
    <div class="portal-content">
        <div id="settings-alert"></div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:22px;">

            <!-- Contact Info -->
            <div class="a-card">
                <div class="a-card-head">
                    <h3 class="a-card-title"><i class="fa-solid fa-address-card" style="color:#6B0E20;margin-right:8px;"></i>Contact Information</h3>
                </div>
                <div class="a-card-body">
                    <form id="settings-form">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <?php
                        $s = $setting;
                        $fields = [
                            ['phone1','Phone 1','tel',$s->phone1??''],
                            ['phone2','Phone 2','tel',$s->phone2??''],
                            ['email1','Email 1','email',$s->email1??''],
                            ['email2','Email 2 (optional)','email',$s->email2??''],
                            ['address1','Address Line 1','text',$s->address1??''],
                            ['address2','Address Line 2 (optional)','text',$s->address2??''],
                        ];
                        foreach ($fields as $f):
                        ?>
                        <div style="margin-bottom:14px;">
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;"><?php echo $f[1]; ?></label>
                            <input type="<?php echo $f[2]; ?>" name="<?php echo $f[0]; ?>" value="<?php echo htmlspecialchars($f[3]); ?>"
                                style="width:100%;padding:9px 13px;border:1.5px solid #e8e8e8;border-radius:8px;font-size:13.5px;font-family:'DM Sans',sans-serif;outline:none;box-sizing:border-box;"
                                onfocus="this.style.borderColor='#6B0E20'" onblur="this.style.borderColor='#e8e8e8'">
                        </div>
                        <?php endforeach; ?>
                        <!-- Welcome / About -->
                        <div style="margin-bottom:14px;">
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Welcome Message</label>
                            <textarea name="welcome" rows="3" style="width:100%;padding:9px 13px;border:1.5px solid #e8e8e8;border-radius:8px;font-size:13.5px;font-family:'DM Sans',sans-serif;outline:none;resize:vertical;box-sizing:border-box;" onfocus="this.style.borderColor='#6B0E20'" onblur="this.style.borderColor='#e8e8e8'"><?php echo htmlspecialchars($s->welcome??''); ?></textarea>
                        </div>
                        <button type="submit" class="a-btn a-btn-maroon" style="width:100%;justify-content:center;padding:11px;">
                            <i class="fa-solid fa-save"></i> Save Contact Settings
                        </button>
                    </form>
                </div>
            </div>

            <!-- Social Media & Other -->
            <div>
                <div class="a-card" style="margin-bottom:22px;">
                    <div class="a-card-head">
                        <h3 class="a-card-title"><i class="fa-solid fa-share-nodes" style="color:#6B0E20;margin-right:8px;"></i>Social Media Handles</h3>
                    </div>
                    <div class="a-card-body">
                        <form id="social-form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <?php
                            $socials = [
                                ['facebook','Facebook URL','fa-brands fa-facebook-f','#1877f2',$s->facebook??''],
                                ['twitter', 'X / Twitter URL','fa-brands fa-x-twitter','#000',$s->twitter??''],
                                ['instagram','Instagram URL','fa-brands fa-instagram','#e1306c',$s->instagram??''],
                                ['linkedin','LinkedIn URL','fa-brands fa-linkedin-in','#0077b5',$s->linkedin??''],
                                ['youtube','YouTube URL','fa-brands fa-youtube','#ff0000',$s->youtube??''],
                                ['whatsapp','WhatsApp Number','fa-brands fa-whatsapp','#25d366',$s->whatsapp??''],
                            ];
                            foreach ($socials as $sv):
                            ?>
                            <div style="margin-bottom:12px;">
                                <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">
                                    <i class="<?php echo $sv[2]; ?>" style="color:<?php echo $sv[3]; ?>;margin-right:6px;"></i><?php echo $sv[1]; ?>
                                </label>
                                <input type="text" name="<?php echo $sv[0]; ?>" value="<?php echo htmlspecialchars($sv[4]); ?>"
                                    placeholder="https://..."
                                    style="width:100%;padding:9px 13px;border:1.5px solid #e8e8e8;border-radius:8px;font-size:13.5px;font-family:'DM Sans',sans-serif;outline:none;box-sizing:border-box;"
                                    onfocus="this.style.borderColor='#6B0E20'" onblur="this.style.borderColor='#e8e8e8'">
                            </div>
                            <?php endforeach; ?>
                            <button type="submit" class="a-btn a-btn-maroon" style="width:100%;justify-content:center;padding:11px;margin-top:6px;">
                                <i class="fa-solid fa-save"></i> Save Social Settings
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick info -->
                <div class="a-card">
                    <div class="a-card-head"><h3 class="a-card-title">System Information</h3></div>
                    <div class="a-card-body">
                        <?php
                        $sysinfo = [
                            ['Application','FUTA Career Services Portal'],
                            ['Version','1.0.0 – Career Fair 2026'],
                            ['Framework','CodeIgniter 3'],
                            ['Database','MySQL (careerfair)'],
                            ['Server Time', date('Y-m-d H:i:s')],
                            ['PHP Version', phpversion()],
                        ];
                        foreach ($sysinfo as $si):
                        ?>
                        <div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid #f0f0f0;font-size:13px;">
                            <span style="color:#6c757d;font-weight:600;"><?php echo $si[0]; ?></span>
                            <span style="color:#1A1A2E;font-weight:700;"><?php echo $si[1]; ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
</div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
var _csrf = '<?php echo $this->security->get_csrf_token_name(); ?>';
$('#settings-form, #social-form').on('submit', function(e){
    e.preventDefault();
    var btn = $(this).find('button[type=submit]');
    btn.html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...').prop('disabled',true);
    $.ajax({ url:'<?php echo site_url("admin/save_settings"); ?>', type:'POST', data:$(this).serialize(),
        success:function(r){ if(r==1) adminSuccess('Settings saved successfully.'); else adminError('Save failed.'); btn.html('<i class="fa-solid fa-save"></i> Save Settings').prop('disabled',false); }
    });
});
</script>
</body></html>
