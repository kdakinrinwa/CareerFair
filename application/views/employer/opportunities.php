<!DOCTYPE html>
<html lang="en">
<head><title>Job Postings – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Job / Internship Postings</div>
        </div>
        <div class="portal-content">
            <!-- Post form -->
            <div class="p-card" style="margin-bottom:24px;">
                <div class="p-card-header"><h3 class="p-card-title"><i class="fa-solid fa-plus" style="color:#6B0E20;margin-right:8px;"></i>Post New Opportunity</h3></div>
                <div class="p-card-body">
                    <form id="opp-form">
                        <input type="hidden" name="opp_id" value="0">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">Job / Internship Title *</label>
                                <input type="text" name="title" class="p-form-control" placeholder="e.g. Software Engineering Intern" required>
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Type *</label>
                                <select name="opp_type" class="p-form-control" required>
                                    <option value="Internship">Internship</option>
                                    <option value="NYSC">NYSC Placement</option>
                                    <option value="Graduate Trainee">Graduate Trainee</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                </select>
                            </div>
                        </div>
                        <div class="p-form-row">
                            <div class="p-form-group">
                                <label class="p-form-label">Location</label>
                                <input type="text" name="location" class="p-form-control" placeholder="Lagos, Nigeria / Remote">
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Application Deadline</label>
                                <input type="date" name="deadline" class="p-form-control">
                            </div>
                        </div>
                        <div class="p-form-group">
                            <label class="p-form-label">Required Skills</label>
                            <input type="text" name="req_skills" class="p-form-control" placeholder="Python, AutoCAD, Communication...">
                        </div>
                        <div class="p-form-group">
                            <label class="p-form-label">Description *</label>
                            <textarea name="description" class="p-form-control" rows="4" placeholder="Describe the role, responsibilities and requirements..." required></textarea>
                        </div>
                        <button type="submit" class="p-btn p-btn-maroon" id="opp-btn">
                            <i class="fa-solid fa-paper-plane"></i> Post Opportunity
                        </button>
                    </form>
                </div>
            </div>

            <!-- Existing postings -->
            <div class="p-card">
                <div class="p-card-header"><h3 class="p-card-title">Your Postings (<?php echo count($opportunities); ?>)</h3></div>
                <div class="p-card-body" style="padding:0;">
                    <?php if (!empty($opportunities)): ?>
                    <table class="p-table">
                        <thead><tr><th>Title</th><th>Type</th><th>Deadline</th><th>Status</th></tr></thead>
                        <tbody>
                        <?php foreach ($opportunities as $o): ?>
                        <tr>
                            <td style="font-weight:700;"><?php echo htmlspecialchars($o->title); ?></td>
                            <td><span class="p-badge p-badge-maroon"><?php echo htmlspecialchars($o->opp_type); ?></span></td>
                            <td style="font-size:12.5px;color:#6c757d;"><?php echo $o->deadline?date('M d, Y',strtotime($o->deadline)):'Open'; ?></td>
                            <td><span class="p-badge p-badge-<?php echo $o->status==='active'?'green':'grey'; ?>"><?php echo ucfirst($o->status); ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div style="padding:32px;text-align:center;color:#6c757d;">
                        <i class="fa-solid fa-briefcase" style="font-size:44px;opacity:.3;display:block;margin-bottom:14px;"></i>
                        <p style="font-size:13.5px;">No postings yet. Use the form above to add one.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>
<script>
$('#sidebar-toggle').on('click',function(){$('#portal-sidebar').toggleClass('open');});
$('#opp-form').on('submit',function(e){
    e.preventDefault();
    var btn=$('#opp-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Posting...').prop('disabled',true);
    $.ajax({url:'<?php echo site_url("employer/post_opportunity"); ?>',type:'POST',data:$(this).serialize(),success:function(r){
        var d=JSON.parse(r);
        if(d.result==1){Swal.fire({icon:'success',title:'Posted!',text:'Opportunity published successfully.',confirmButtonColor:'#6B0E20'}).then(function(){location.reload();});}
        else{Swal.fire({icon:'error',title:'Error',confirmButtonColor:'#6B0E20'});}
        $('#opp-btn').html('<i class="fa-solid fa-paper-plane"></i> Post Opportunity').prop('disabled',false);
    }});
});
</script>
</body></html>
