<!DOCTYPE html>
<html lang="en">
<head><title>Edit News – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Edit News Item</div>
        <div class="portal-topbar-actions">
            <a href="<?php echo base_url(); ?>admin/news" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="portal-content">
        <div class="a-card" style="max-width:720px;">
            <div class="a-card-head"><h3 class="a-card-title">Edit: <?php echo htmlspecialchars(substr($item->title??'',0,50)); ?></h3></div>
            <div class="a-card-body">
                <form id="edit-news-form" enctype="multipart/form-data">
                    <input type="hidden" name="newsid"     value="<?php echo $item->newsid; ?>">
                    <input type="hidden" name="thumbnail"  value="<?php echo htmlspecialchars($item->thumbnail??''); ?>">
                    <input type="hidden" name="creator"    value="<?php echo $this->session->userdata('userid'); ?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:14px;">
                        <div>
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Title *</label>
                            <input type="text" name="title" class="p-form-control" value="<?php echo htmlspecialchars($item->title??''); ?>" required>
                        </div>
                        <div>
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Category</label>
                            <select name="category" class="p-form-control">
                                <?php foreach (['News','Announcement','Event','Career Talk','Workshop'] as $c): ?>
                                <option value="<?php echo $c; ?>" <?php echo ($item->category??'')===$c?'selected':''; ?>><?php echo $c; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Event Date</label>
                            <input type="date" name="eventday" class="p-form-control" value="<?php echo $item->eventday??''; ?>">
                        </div>
                        <div>
                            <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Status</label>
                            <select name="viewstate" class="p-form-control">
                                <option value="show" <?php echo ($item->viewstate??'show')==='show'?'selected':''; ?>>Published</option>
                                <option value="hide" <?php echo ($item->viewstate??'show')==='hide'?'selected':''; ?>>Hidden</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-bottom:14px;">
                        <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Body *</label>
                        <textarea name="body" rows="6" class="p-form-control" required><?php echo htmlspecialchars($item->body??''); ?></textarea>
                    </div>
                    <?php if (!empty($item->thumbnail)): ?>
                    <div style="margin-bottom:10px;font-size:12.5px;color:#6c757d;">Current image: <strong><?php echo htmlspecialchars($item->thumbnail); ?></strong></div>
                    <?php endif; ?>
                    <div style="margin-bottom:18px;">
                        <label style="display:block;font-size:12.5px;font-weight:600;color:#1A1A2E;margin-bottom:5px;">Replace Thumbnail (optional)</label>
                        <input type="file" name="thumbnail" accept="image/jpeg,image/png" class="p-form-control">
                    </div>
                    <button type="submit" class="a-btn a-btn-maroon" style="padding:11px 28px;"><i class="fa-solid fa-save"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
$('#edit-news-form').on('submit',function(e){
    e.preventDefault();
    var btn=$(this).find('button[type=submit]').html('<i class="fa-solid fa-spinner fa-spin"></i> Saving...').prop('disabled',true);
    var fd=new FormData(this);
    $.ajax({url:'<?php echo site_url("admin/update_news"); ?>',type:'POST',data:fd,contentType:false,processData:false,
        success:function(r){ if(r==1){adminSuccess('Saved!');setTimeout(function(){window.location='<?php echo site_url("admin/news"); ?>';},1200);}else adminError('Save failed.'); btn.html('<i class="fa-solid fa-save"></i> Save Changes').prop('disabled',false); }
    });
});
</script>
</body></html>
