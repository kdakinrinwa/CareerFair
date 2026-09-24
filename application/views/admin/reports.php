<!DOCTYPE html>
<html lang="en">
<head><title>Reports – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap">
<?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Analytics &amp; Reports</div>
    </div>
    <div class="portal-content">

        <!-- Summary KPIs -->
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
            <?php
            $kpis = [
                ['maroon','fa-user-graduate','Students Registered',    $total_students],
                ['gold',  'fa-building',      'Employers Registered',  $total_employers],
                ['green', 'fa-file-lines',    'CVs Submitted',         $total_cvs],
                ['blue',  'fa-store',         'Booth Requests',        $total_booths],
                ['purple','fa-list-check',    'Shortlisted Candidates',$total_shortlists],
                ['teal',  'fa-qrcode',        'QR Passes Issued',      $total_qr],
                ['orange','fa-door-open',     'Fair Check-ins',        $total_checkins],
                ['green', 'fa-briefcase',     'Active Opportunities',  $total_opps],
            ];
            foreach ($kpis as $k):
            ?>
            <div class="a-stat <?php echo $k[0]; ?>">
                <div class="a-stat-icon <?php echo $k[0]; ?>"><i class="fa-solid <?php echo $k[1]; ?>"></i></div>
                <div><div class="a-stat-num"><?php echo number_format($k[3]); ?></div><div class="a-stat-label"><?php echo $k[2]; ?></div></div>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="display:grid;grid-template-columns:1.5fr 1fr;gap:22px;margin-bottom:22px;">

            <!-- Registration by School -->
            <div class="a-card">
                <div class="a-card-head">
                    <h3 class="a-card-title"><i class="fa-solid fa-chart-bar" style="color:#6B0E20;margin-right:8px;"></i>Student Registrations by School</h3>
                </div>
                <div class="a-card-body">
                    <?php if (!empty($reg_by_school)):
                        $max_count = max(array_column((array)$reg_by_school,'total')); ?>
                    <!-- Visual bar chart -->
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <?php foreach ($reg_by_school as $row): ?>
                        <div>
                            <div style="display:flex;justify-content:space-between;margin-bottom:4px;">
                                <span style="font-size:12.5px;font-weight:600;color:#1A1A2E;"><?php echo htmlspecialchars($row->school_name??'Unknown'); ?></span>
                                <span style="font-size:12.5px;font-weight:800;color:#6B0E20;"><?php echo number_format($row->total); ?></span>
                            </div>
                            <div style="background:#f0f0f0;border-radius:4px;height:10px;overflow:hidden;">
                                <div style="height:100%;background:linear-gradient(90deg,#6B0E20,#C9A84C);border-radius:4px;width:<?php echo $max_count>0?round($row->total/$max_count*100):0; ?>%;transition:width .6s ease;"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div style="text-align:center;padding:30px;color:#6c757d;font-size:13.5px;">No registration data yet.</div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Employer Sectors -->
            <div class="a-card">
                <div class="a-card-head">
                    <h3 class="a-card-title"><i class="fa-solid fa-industry" style="color:#6B0E20;margin-right:8px;"></i>Employer Sectors</h3>
                </div>
                <div class="a-card-body">
                    <?php if (!empty($emp_by_sector)): ?>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <?php
                        $max_e = max(array_column((array)$emp_by_sector,'total'));
                        $colors = ['#6B0E20','#C9A84C','#22c55e','#3b82f6','#8b5cf6','#f97316','#14b8a6','#ef4444'];
                        foreach ($emp_by_sector as $ci => $row):
                        ?>
                        <div>
                            <div style="display:flex;justify-content:space-between;margin-bottom:3px;">
                                <span style="font-size:12px;color:#1A1A2E;"><?php echo htmlspecialchars(substr($row->industry_name??'Other',0,24)); ?></span>
                                <span style="font-size:12px;font-weight:700;color:<?php echo $colors[$ci%count($colors)]; ?>;"><?php echo $row->total; ?></span>
                            </div>
                            <div style="background:#f0f0f0;border-radius:4px;height:8px;overflow:hidden;">
                                <div style="height:100%;background:<?php echo $colors[$ci%count($colors)]; ?>;border-radius:4px;width:<?php echo $max_e>0?round($row->total/$max_e*100):0; ?>%;"></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div style="text-align:center;padding:30px;color:#6c757d;font-size:13.5px;">No employer sector data yet.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Profile completion rate -->
        <div class="a-card">
            <div class="a-card-head">
                <h3 class="a-card-title"><i class="fa-solid fa-file-lines" style="color:#6B0E20;margin-right:8px;"></i>CV Submission Rate</h3>
            </div>
            <div class="a-card-body">
                <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap;">
                    <div style="font-size:52px;font-weight:900;color:#6B0E20;line-height:1;"><?php echo $cv_rate; ?>%</div>
                    <div style="flex:1;min-width:200px;">
                        <div style="font-size:14px;font-weight:600;color:#1A1A2E;margin-bottom:8px;">
                            <?php echo number_format($total_cvs); ?> of <?php echo number_format($total_students); ?> registered students have uploaded a CV
                        </div>
                        <div style="background:#f0f0f0;border-radius:8px;height:16px;overflow:hidden;">
                            <div style="height:100%;background:linear-gradient(90deg,#6B0E20,#C9A84C);border-radius:8px;width:<?php echo $cv_rate; ?>%;transition:width .8s ease;"></div>
                        </div>
                        <?php if ($cv_rate < 80): ?>
                        <div style="font-size:12.5px;color:#f97316;margin-top:8px;font-weight:600;">
                            <i class="fa-solid fa-triangle-exclamation fa-fw"></i> Send a reminder to students who haven't uploaded their CV.
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
</div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
</body></html>
