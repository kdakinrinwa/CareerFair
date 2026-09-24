<!DOCTYPE html>
<html lang="en">
<head><title>Employer Profile – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Employer Profile</div>
        <div class="portal-topbar-actions">
            <a href="<?php echo base_url(); ?>admin/employers" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="portal-content">
        <?php if ($employer): ?>
        <div style="display:grid;grid-template-columns:1fr 1.4fr;gap:22px;align-items:start;">
            <div class="a-card">
                <div class="a-card-body" style="text-align:center;padding:28px;">
                    <div class="a-avatar gold" style="width:64px;height:64px;font-size:24px;margin:0 auto 14px;"><?php echo strtoupper(substr($employer->org_name,0,1)); ?></div>
                    <h3 style="font-size:18px;font-weight:800;color:#1A1A2E;margin:0 0 4px;"><?php echo htmlspecialchars($employer->org_name); ?></h3>
                    <div style="font-size:13px;color:#6c757d;margin-bottom:12px;"><?php echo htmlspecialchars($employer->org_type??''); ?></div>
                    <span class="a-badge a-badge-<?php echo $employer->accstatus; ?>"><?php echo ucfirst($employer->accstatus); ?></span>
                    <?php if ($employer->accstatus === 'pending'): ?>
                    <div style="margin-top:14px;">
                        <button onclick="quickApprove(<?php echo $employer->employer_id; ?>)" class="a-btn a-btn-green" style="width:100%;justify-content:center;"><i class="fa-solid fa-check"></i> Approve Employer</button>
                    </div>
                    <?php endif; ?>
                </div>
                <div style="padding:0 22px 22px;">
                    <?php
                    $rows=[
                        ['Contact',      $employer->contact_name??'–'],
                        ['Designation',  $employer->contact_designation??'–'],
                        ['Email',        $employer->contact_email??'–'],
                        ['Phone',        $employer->contact_phone??'–'],
                        ['Website',      $employer->website??'–'],
                        ['Recruit For',  $employer->recruit_interest??'–'],
                        ['Registered',   isset($employer->created_at)?date('M d, Y',strtotime($employer->created_at)):'–'],
                    ];
                    foreach ($rows as $r):
                    ?>
                    <div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid #f0f0f0;font-size:13px;">
                        <span style="color:#6c757d;font-weight:600;flex-shrink:0;margin-right:12px;"><?php echo $r[0]; ?></span>
                        <span style="color:#1A1A2E;font-weight:600;text-align:right;word-break:break-all;"><?php echo htmlspecialchars($r[1]); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:14px;margin-bottom:18px;">
                    <?php
                    $ks=[['Shortlisted',$shortlists,'fa-star','maroon'],['Booth',($booth?ucfirst($booth->status):'None'),'fa-store','gold'],['Talks',($talk?ucfirst($talk->status):'None'),'fa-microphone','purple']];
                    foreach ($ks as $k):
                    ?>
                    <div class="a-stat <?php echo $k[3]; ?>" style="flex-direction:column;align-items:flex-start;">
                        <div class="a-stat-icon <?php echo $k[3]; ?>" style="margin-bottom:8px;"><i class="fa-solid <?php echo $k[2]; ?>"></i></div>
                        <div class="a-stat-num"><?php echo $k[1]; ?></div>
                        <div class="a-stat-label"><?php echo $k[0]; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="a-card">
                    <div class="a-card-head"><h3 class="a-card-title">Job / Internship Postings (<?php echo count($opps); ?>)</h3></div>
                    <div class="a-card-body-flush">
                    <?php if (!empty($opps)): foreach ($opps as $o): ?>
                    <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 18px;border-bottom:1px solid #f5f5f5;">
                        <div>
                            <div style="font-size:13.5px;font-weight:700;"><?php echo htmlspecialchars($o->title); ?></div>
                            <div style="font-size:12px;color:#6c757d;"><?php echo htmlspecialchars($o->opp_type); ?> &bull; <?php echo $o->deadline?date('M d, Y',strtotime($o->deadline)):'Open'; ?></div>
                        </div>
                        <span class="a-badge a-badge-<?php echo $o->status==='active'?'approved':($o->status==='closed'?'inactive':'draft'); ?>"><?php echo ucfirst($o->status); ?></span>
                    </div>
                    <?php endforeach; else: ?>
                    <div style="padding:24px;text-align:center;color:#6c757d;font-size:13.5px;">No opportunities posted yet.</div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="a-card"><div class="a-card-body" style="text-align:center;padding:40px;color:#6c757d;">Employer not found.</div></div>
        <?php endif; ?>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
function quickApprove(id){ adminConfirm('Approve this employer?',function(){ var d={id:id,status:'approved'}; d['<?php echo $this->security->get_csrf_token_name(); ?>']='<?php echo $this->security->get_csrf_hash(); ?>'; $.post('<?php echo site_url("admin/toggle_employer_status"); ?>',d,function(r){ if(r==1){adminSuccess('Approved!');setTimeout(function(){location.reload();},1200);}else adminError('Failed.'); }); }); }
</script>
</body></html>
