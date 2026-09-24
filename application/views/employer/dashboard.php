<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employer Dashboard – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Welcome, <?php echo htmlspecialchars($employer->contact_name ?? 'Recruiter'); ?></div>
            <div class="portal-topbar-actions">
                <div class="topbar-user">
                    <div class="topbar-avatar"><?php echo strtoupper(substr($employer->org_name??'E',0,1)); ?></div>
                    <span class="topbar-name"><?php echo htmlspecialchars(substr($employer->org_name??'',0,18)); ?></span>
                </div>
            </div>
        </div>
        <div class="portal-content">

            <!-- Status banner -->
            <?php if (($employer->accstatus ?? '') !== 'approved'): ?>
            <div class="p-alert p-alert-warning" style="margin-bottom:20px;">
                <i class="fa-solid fa-clock fa-fw"></i>
                <strong>Pending Approval</strong> – Your account is awaiting approval from Career Services.
                You will receive an email once approved and can then access CV search and shortlisting.
            </div>
            <?php endif; ?>

            <!-- Welcome bar -->
            <div style="background:linear-gradient(135deg,#1A1A2E,#16213e); border-radius:12px; padding:22px 28px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
                <div>
                    <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-bottom:4px;">Employer Portal</div>
                    <h2 style="font-size:22px;font-weight:800;color:#fff;margin:0 0 4px;"><?php echo htmlspecialchars($employer->org_name ?? ''); ?></h2>
                    <p style="font-size:13px;color:rgba(255,255,255,.6);margin:0;"><?php echo htmlspecialchars($employer->contact_designation ?? ''); ?> &bull; <?php echo htmlspecialchars($employer->contact_email ?? ''); ?></p>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <a href="<?php echo base_url(); ?>employer/candidates" style="display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:#C9A84C;border-radius:50px;font-size:13px;font-weight:700;text-decoration:none;color:#1A1A2E;">
                        <i class="fa-solid fa-magnifying-glass"></i> Search CVs
                    </a>
                    <a href="<?php echo base_url(); ?>employer/booth" style="display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:50px;font-size:13px;font-weight:700;text-decoration:none;color:#fff;">
                        <i class="fa-solid fa-store"></i> Request Booth
                    </a>
                </div>
            </div>

            <!-- Stat cards -->
            <div class="p-stat-grid" style="margin-bottom:24px;">
                <div class="p-stat-card">
                    <div class="p-stat-icon maroon"><i class="fa-solid fa-file-lines"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo count($cv_matches ?? []); ?></div>
                        <div class="p-stat-label">CVs Matched</div>
                    </div>
                </div>
                <div class="p-stat-card gold">
                    <div class="p-stat-icon gold"><i class="fa-solid fa-star"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo count($shortlists ?? []); ?></div>
                        <div class="p-stat-label">Shortlisted</div>
                    </div>
                </div>
                <div class="p-stat-card green">
                    <div class="p-stat-icon green"><i class="fa-solid fa-store"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo $booth ? ucfirst($booth->status) : 'None'; ?></div>
                        <div class="p-stat-label">Booth Status</div>
                    </div>
                </div>
                <div class="p-stat-card blue">
                    <div class="p-stat-icon blue"><i class="fa-solid fa-briefcase"></i></div>
                    <div>
                        <div class="p-stat-num"><?php echo count($opportunities ?? []); ?></div>
                        <div class="p-stat-label">Opportunities Posted</div>
                    </div>
                </div>
            </div>

            <!-- Two col -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <!-- Top CV Matches -->
                <div class="p-card">
                    <div class="p-card-header">
                        <h3 class="p-card-title">Top Candidate Matches</h3>
                        <a href="<?php echo base_url(); ?>employer/candidates" style="font-size:12.5px;font-weight:700;color:#6B0E20;text-decoration:none;">View All</a>
                    </div>
                    <div class="p-card-body" style="padding:0;">
                        <?php if (!empty($cv_matches)): ?>
                        <?php foreach ($cv_matches as $c): ?>
                        <div style="display:flex;align-items:center;gap:12px;padding:12px 18px;border-bottom:1px solid #f0f0f0;">
                            <div style="width:36px;height:36px;border-radius:50%;background:rgba(107,14,32,.1);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#6B0E20;flex-shrink:0;">
                                <?php echo strtoupper(substr($c->fullname,0,1)); ?>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div style="font-size:13.5px;font-weight:700;color:#1A1A2E;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo htmlspecialchars($c->fullname); ?></div>
                                <div style="font-size:11.5px;color:#6c757d;"><?php echo htmlspecialchars(substr($c->skills??'',0,40)); ?></div>
                            </div>
                            <button onclick="shortlistStudent(<?php echo $c->student_id; ?>, '<?php echo addslashes($c->fullname); ?>')"
                                    class="p-btn p-btn-outline p-btn-sm" style="flex-shrink:0;">
                                <i class="fa-solid fa-star"></i>
                            </button>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <div style="padding:32px;text-align:center;color:#6c757d;">
                            <i class="fa-solid fa-users" style="font-size:36px;opacity:.3;display:block;margin-bottom:12px;"></i>
                            <p style="font-size:13.5px;margin:0;">No CV matches yet. Check back once students upload CVs.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- My Shortlist -->
                <div class="p-card">
                    <div class="p-card-header">
                        <h3 class="p-card-title">My Shortlist</h3>
                        <a href="<?php echo base_url(); ?>employer/shortlist" style="font-size:12.5px;font-weight:700;color:#6B0E20;text-decoration:none;">View All</a>
                    </div>
                    <div class="p-card-body" style="padding:0;">
                        <?php if (!empty($shortlists)): ?>
                        <?php foreach (array_slice($shortlists,0,5) as $sl): ?>
                        <div style="display:flex;align-items:center;gap:12px;padding:12px 18px;border-bottom:1px solid #f0f0f0;">
                            <div style="width:36px;height:36px;border-radius:50%;background:rgba(201,168,76,.12);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#a88635;flex-shrink:0;">
                                <?php echo strtoupper(substr($sl->fullname??'?',0,1)); ?>
                            </div>
                            <div style="flex:1;">
                                <div style="font-size:13.5px;font-weight:700;color:#1A1A2E;"><?php echo htmlspecialchars($sl->fullname??'Student'); ?></div>
                                <div style="font-size:11.5px;color:#6c757d;"><?php echo htmlspecialchars($sl->level??''); ?></div>
                            </div>
                            <span class="p-badge p-badge-gold"><?php echo htmlspecialchars($sl->tag??'Interested'); ?></span>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <div style="padding:32px;text-align:center;color:#6c757d;">
                            <i class="fa-solid fa-star" style="font-size:36px;opacity:.3;display:block;margin-bottom:12px;"></i>
                            <p style="font-size:13.5px;margin:0;">No candidates shortlisted yet.</p>
                        </div>
                        <?php endif; ?>
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

function shortlistStudent(id, name) {
    Swal.fire({
        title: 'Shortlist ' + name + '?',
        input: 'select',
        inputOptions: { 'Interested':'Interested','Strong Candidate':'Strong Candidate','Interview':'Interview','Internship':'Internship','Graduate Programme':'Graduate Programme','Follow Up':'Follow Up' },
        inputPlaceholder: 'Select tag',
        showCancelButton: true,
        confirmButtonText: 'Shortlist',
        confirmButtonColor: '#6B0E20'
    }).then(function(r){
        if (r.isConfirmed) {
            $.post('<?php echo site_url("employer/add_shortlist"); ?>', {
                student_id: id, tag: r.value,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            }, function(d){
                var res = JSON.parse(d);
                if (res.result >= 1) {
                    Swal.fire({ icon:'success', title:'Shortlisted!', text: name + ' added to your shortlist.', confirmButtonColor:'#6B0E20' })
                        .then(function(){ location.reload(); });
                }
            });
        }
    });
}
</script>
</body></html>
