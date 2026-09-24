<!DOCTYPE html>
<html lang="en">
<head><title>News & Events – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">News &amp; Events</div>
        <div class="portal-topbar-actions">
            <a href="<?php echo base_url(); ?>admin/add_news" class="a-btn a-btn-maroon a-btn-sm"><i class="fa-solid fa-plus"></i> Add News</a>
        </div>
    </div>
    <div class="portal-content">
        <div class="a-card">
            <div class="a-card-head"><h3 class="a-card-title">All News &amp; Announcements</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Title</th><th>Category</th><th>Event Date</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if (!empty($news)): foreach ($news as $i => $n): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td style="font-weight:700;max-width:280px;"><?php echo htmlspecialchars(substr($n->title,0,65)); ?></td>
                    <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($n->category??'News'); ?></td>
                    <td style="font-size:12.5px;color:#6c757d;"><?php echo !empty($n->eventday)?date('M d, Y',strtotime($n->eventday)):'–'; ?></td>
                    <td><span class="a-badge a-badge-<?php echo ($n->viewstate??'show')==='show'?'approved':'inactive'; ?>"><?php echo ($n->viewstate??'show')==='show'?'Published':'Hidden'; ?></span></td>
                    <td style="white-space:nowrap;">
                        <a href="<?php echo base_url(); ?>admin/edit_news/<?php echo $n->newsid; ?>" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
                        <button onclick="delNews(<?php echo $n->newsid; ?>)" class="a-btn a-btn-red a-btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="6" style="text-align:center;padding:40px;color:#6c757d;">No news items yet. <a href="<?php echo base_url(); ?>admin/add_news" style="color:#6B0E20;font-weight:700;">Add the first one.</a></td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div></div>
        </div>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
function delNews(id){ adminConfirm('Delete this news item?',function(){ var d={newsid:id}; d['<?php echo $this->security->get_csrf_token_name(); ?>']='<?php echo $this->security->get_csrf_hash(); ?>'; $.post('<?php echo site_url("admin/delete_news"); ?>',d,function(r){ if(r==1){adminSuccess('Deleted.');setTimeout(function(){location.reload();},1200);}else adminError('Failed.'); }); }); }
</script>
</body></html>
