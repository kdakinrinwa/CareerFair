<!DOCTYPE html>
<html lang="en">
<head><title>Add News – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>

    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Add News / Announcement</div>
            <div class="portal-topbar-actions">
                <a href="<?php echo base_url(); ?>admin/news" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
        </div>
        <div class="portal-content">
            <div id="news-alert"></div>
            <div class="a-card" style="max-width:720px;">
                <div class="a-card-head"><h3 class="a-card-title">New Announcement</h3></div>
                <div class="a-card-body">
                    <form id="add-news-form" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" name="creator" value="<?php echo $this->session->userdata('userid'); ?>">
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:14px;">
                            <div>
                                <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Title *</label>
                                <input type="text" name="title" class="p-form-control" placeholder="News or announcement title" required>
                            </div>
                            <div>
                                <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Category</label>
                                <select name="category" class="p-form-control">
                                    <option value="News">News</option>
                                    <option value="Announcement">Announcement</option>
                                    <option value="Event">Event</option>
                                    <option value="Career Talk">Career Talk</option>
                                    <option value="Workshop">Workshop</option>
                                </select>
                            </div>
                            <div>
                                <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Event Date</label>
                                <input type="date" name="eventday" class="p-form-control">
                            </div>
                            <div>
                                <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Status</label>
                                <select name="viewstate" class="p-form-control">
                                    <option value="show">Published</option>
                                    <option value="hide">Draft (Hidden)</option>
                                </select>
                            </div>
                        </div>
                        <div style="margin-bottom:14px;">
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Body / Content *</label>
                            <textarea name="body" rows="6" class="p-form-control" placeholder="Write your announcement content here..." required></textarea>
                        </div>
                        <div style="margin-bottom:18px;">
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Thumbnail Image <span style="color:#6c757d;font-weight:400;">(JPG/PNG, max 3MB)</span></label>
                            <input type="file" name="thumbnail" accept="image/jpeg,image/png" class="p-form-control">
                        </div>
                        <button type="submit" class="a-btn a-btn-maroon" style="padding:11px 28px;">
                            <i class="fa-solid fa-paper-plane"></i> Publish News
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
    $('#add-news-form').on('submit',function(e){
        e.preventDefault();
        var btn=$(this).find('button[type=submit]').html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...').prop('disabled',true);
        var fd=new FormData(this);
        $.ajax({url:'<?php echo site_url("admin/save_news"); ?>',type:'POST',data:fd,contentType:false,processData:false,
            success:function(r){ if(r==1){adminSuccess('News published!');setTimeout(function(){window.location='<?php echo site_url("admin/news"); ?>';},1200);}else adminError('Save failed.'); btn.html('<i class="fa-solid fa-paper-plane"></i> Publish News').prop('disabled',false); }
        });
    });
</script>
</body></html>
