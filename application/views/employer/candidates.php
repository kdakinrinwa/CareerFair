<!DOCTYPE html>
<html lang="en">
<head><title>Talent Vault – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Talent Vault / CV Search</div>
        </div>
        <div class="portal-content">

            <!-- Filter bar -->
            <div class="p-card" style="margin-bottom:20px;">
                <div class="p-card-body">
                    <form method="get" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:12px; align-items:end;">
                        <div>
                            <label class="p-form-label">Search</label>
                            <input type="text" name="q" class="p-form-control" placeholder="Name, skills..." value="<?php echo htmlspecialchars($_GET['q']??''); ?>">
                        </div>
                        <div>
                            <label class="p-form-label">School</label>
                            <select name="school" class="p-form-control">
                                <option value="">All Schools</option>
                                <?php foreach ([1=>'SEET',2=>'SOC',3=>'SAAT',4=>'SEMS',5=>'SET',6=>'SMAT',7=>'SOS',8=>'SHHT'] as $id=>$s): ?>
                                <option value="<?php echo $id; ?>" <?php echo (($_GET['school']??'')==$id)?'selected':''; ?>><?php echo $s; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="p-form-label">Level</label>
                            <select name="level" class="p-form-control">
                                <option value="">All Levels</option>
                                <?php foreach (['100','200','300','400','500','600','PGD','MSc','PhD'] as $l): ?>
                                <option value="<?php echo $l; ?>" <?php echo (($_GET['level']??'')===$l)?'selected':''; ?>><?php echo $l; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="p-form-label">Career Interest</label>
                            <select name="interest" class="p-form-control">
                                <option value="">Any Interest</option>
                                <?php foreach (['Internship','NYSC Placement','Graduate Job','Mentoring','Entrepreneurship'] as $i): ?>
                                <option value="<?php echo $i; ?>" <?php echo (($_GET['interest']??'')===$i)?'selected':''; ?>><?php echo $i; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="p-form-label">&nbsp;</label>
                            <button type="submit" class="p-btn p-btn-maroon" style="width:100%;justify-content:center;">
                                <i class="fa-solid fa-magnifying-glass"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results -->
            <div class="p-card">
                <div class="p-card-header">
                    <h3 class="p-card-title"><?php echo count($candidates); ?> Candidate<?php echo count($candidates)!=1?'s':''; ?> Found</h3>
                </div>
                <div class="p-card-body" style="padding:0;">
                    <?php if (!empty($candidates)): ?>
                    <table class="p-table">
                        <thead><tr><th>Name</th><th>Level</th><th>Skills</th><th>Career Interest</th><th>Links</th><th></th></tr></thead>
                        <tbody>
                        <?php foreach ($candidates as $c): ?>
                        <tr>
                            <td>
                                <div style="font-weight:700;"><?php echo htmlspecialchars($c->fullname); ?></div>
                                <div style="font-size:11.5px;color:#6c757d;"><?php echo htmlspecialchars($c->matric_no); ?></div>
                            </td>
                            <td><span class="p-badge p-badge-blue"><?php echo $c->level; ?></span></td>
                            <td style="font-size:12.5px;max-width:180px;"><?php echo htmlspecialchars(substr($c->skills??'',0,60)); ?></td>
                            <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars(substr($c->career_interest??'',0,40)); ?></td>
                            <td>
                                <?php if ($c->linkedin_url): ?><a href="<?php echo htmlspecialchars($c->linkedin_url); ?>" target="_blank" style="color:#6B0E20;margin-right:6px;"><i class="fa-brands fa-linkedin"></i></a><?php endif; ?>
                                <?php if ($c->github_url): ?><a href="<?php echo htmlspecialchars($c->github_url); ?>" target="_blank" style="color:#6B0E20;"><i class="fa-brands fa-github"></i></a><?php endif; ?>
                            </td>
                            <td>
                                <button onclick="shortlistStudent(<?php echo $c->student_id; ?>,'<?php echo addslashes($c->fullname); ?>')" class="p-btn p-btn-gold p-btn-sm">
                                    <i class="fa-solid fa-star"></i> Shortlist
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div style="padding:40px;text-align:center;color:#6c757d;">
                        <i class="fa-solid fa-users" style="font-size:44px;opacity:.3;display:block;margin-bottom:14px;"></i>
                        <h4 style="color:#1A1A2E;">No Candidates Found</h4>
                        <p style="font-size:13.5px;">Try adjusting your search filters.</p>
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
function shortlistStudent(id, name) {
    Swal.fire({ title:'Shortlist '+name+'?', input:'select', inputOptions:{'Interested':'Interested','Strong Candidate':'Strong Candidate','Interview':'Interview','Internship':'Internship','Graduate Programme':'Graduate Programme','Follow Up':'Follow Up'}, inputPlaceholder:'Select tag', showCancelButton:true, confirmButtonText:'Shortlist', confirmButtonColor:'#6B0E20' })
    .then(function(r){ if(r.isConfirmed){ $.post('<?php echo site_url("employer/add_shortlist"); ?>',{student_id:id,tag:r.value,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},function(d){ var res=JSON.parse(d); if(res.result>=1){ Swal.fire({icon:'success',title:'Shortlisted!',confirmButtonColor:'#6B0E20'}); } }); } });
}
</script>
</body></html>
