<!DOCTYPE html>
<html lang="en">
<head><title>Student Profile – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Student Profile</div>
        <div class="portal-topbar-actions">
            <a href="<?php echo base_url(); ?>admin/students" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-arrow-left"></i> Back to Students</a>
        </div>
    </div>
    <div class="portal-content">
        <?php if ($student): ?>
        <div style="display:grid;grid-template-columns:1fr 1.4fr;gap:22px;align-items:start;">

            <!-- Profile card -->
            <div>
                <div class="a-card">
                    <div class="a-card-body" style="text-align:center;padding:28px;">
                        <div class="a-avatar" style="width:64px;height:64px;font-size:24px;margin:0 auto 14px;"><?php echo strtoupper(substr($student->fullname,0,1)); ?></div>
                        <h3 style="font-size:18px;font-weight:800;color:#1A1A2E;margin:0 0 4px;"><?php echo htmlspecialchars($student->fullname); ?></h3>
                        <div style="font-size:13px;color:#6c757d;margin-bottom:12px;"><?php echo htmlspecialchars($student->matric_no); ?></div>
                        <span class="a-badge a-badge-<?php echo $student->accstatus; ?>"><?php echo ucfirst($student->accstatus); ?></span>
                    </div>
                    <div style="padding:0 22px 22px;">
                        <?php
                        $rows=[
                            ['Email',          $student->email??'–'],
                            ['Phone',          $student->phone??'–'],
                            ['Level',          ($student->level??'–').' Level'],
                            ['Gender',         $student->gender??'–'],
                            ['Career Interest',$student->career_interest??'–'],
                            ['Skills',         $student->skills??'–'],
                            ['Available For',  $student->available_for??'–'],
                            ['Registered',     isset($student->created_at)?date('M d, Y',strtotime($student->created_at)):'–'],
                        ];
                        foreach ($rows as $r):
                        ?>
                        <div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid #f0f0f0;font-size:13px;">
                            <span style="color:#6c757d;font-weight:600;flex-shrink:0;margin-right:12px;"><?php echo $r[0]; ?></span>
                            <span style="color:#1A1A2E;font-weight:600;text-align:right;word-break:break-all;"><?php echo htmlspecialchars($r[1]); ?></span>
                        </div>
                        <?php endforeach; ?>
                        <?php if ($student->linkedin_url): ?>
                        <div style="padding:9px 0;"><a href="<?php echo htmlspecialchars($student->linkedin_url); ?>" target="_blank" class="a-btn a-btn-ghost a-btn-sm" style="width:100%;justify-content:center;"><i class="fa-brands fa-linkedin"></i> LinkedIn Profile</a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right col -->
            <div>
                <!-- CV -->
                <div class="a-card" style="margin-bottom:18px;">
                    <div class="a-card-head"><h3 class="a-card-title">CV</h3></div>
                    <div class="a-card-body">
                        <?php if ($cv): ?>
                        <div style="display:flex;align-items:center;gap:14px;">
                            <i class="fa-regular fa-file-pdf" style="font-size:36px;color:#dc2626;"></i>
                            <div style="flex:1;">
                                <div style="font-weight:700;"><?php echo htmlspecialchars($cv->original_name??$cv->filename); ?></div>
                                <div style="font-size:12px;color:#6c757d;">Uploaded <?php echo date('M d, Y',strtotime($cv->uploaded_at)); ?> &bull; <?php echo round($cv->file_size/1024,1); ?> KB</div>
                            </div>
                            <a href="<?php echo base_url(); ?>uploads/cvs/<?php echo htmlspecialchars($cv->filename); ?>" target="_blank" class="a-btn a-btn-maroon a-btn-sm"><i class="fa-solid fa-eye"></i> View</a>
                        </div>
                        <?php else: ?><div style="color:#6c757d;font-size:13.5px;">No CV uploaded yet.</div><?php endif; ?>
                    </div>
                </div>

                <!-- QR Pass -->
                <div class="a-card" style="margin-bottom:18px;">
                    <div class="a-card-head"><h3 class="a-card-title">QR Event Pass</h3></div>
                    <div class="a-card-body">
                        <?php if ($qr): ?>
                        <div style="display:flex;align-items:center;gap:14px;">
                            <img src="<?php echo base_url(); ?>assetsp/images/QR.png" style="width:54px;height:54px;border-radius:6px;">
                            <div>
                                <div style="font-weight:700;font-family:monospace;color:#6B0E20;"><?php echo htmlspecialchars($qr->pass_code); ?></div>
                                <div style="font-size:12px;color:#6c757d;">Issued <?php echo date('M d, Y',strtotime($qr->issued_at)); ?></div>
                                <span class="a-badge <?php echo $qr->is_revoked?'a-badge-revoked':'a-badge-approved'; ?>"><?php echo $qr->is_revoked?'Revoked':'Valid'; ?></span>
                            </div>
                        </div>
                        <?php else: ?><div style="color:#6c757d;font-size:13.5px;">No QR pass issued yet.</div><?php endif; ?>
                    </div>
                </div>

                <!-- Shortlists -->
                <div class="a-card">
                    <div class="a-card-head"><h3 class="a-card-title">Shortlisted By (<?php echo count($shortlists); ?>)</h3></div>
                    <div class="a-card-body" style="padding:0;">
                        <?php if (!empty($shortlists)): foreach ($shortlists as $sl): ?>
                        <div style="display:flex;align-items:center;justify-content:space-between;padding:11px 18px;border-bottom:1px solid #f5f5f5;">
                            <span style="font-size:13.5px;font-weight:600;"><?php echo htmlspecialchars($sl->org_name??'Employer'); ?></span>
                            <span class="a-badge a-badge-approved"><?php echo htmlspecialchars($sl->tag??'Interested'); ?></span>
                        </div>
                        <?php endforeach; else: ?>
                        <div style="padding:20px;text-align:center;color:#6c757d;font-size:13.5px;">Not shortlisted by any employer yet.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
        <?php else: ?>
        <div class="a-card"><div class="a-card-body" style="text-align:center;padding:40px;color:#6c757d;">Student not found.</div></div>
        <?php endif; ?>
    </div>
</main></div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
</body></html>
