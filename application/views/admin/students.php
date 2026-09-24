<!DOCTYPE html>
<html lang="en">
<head><title>Students – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap">
<?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Students Management</div>
        <div class="portal-topbar-actions">
            <span style="font-size:13px;color:#6c757d;"><?php echo count($students); ?> total records</span>
        </div>
    </div>
    <div class="portal-content">

        <!-- Filters -->
        <form method="get" class="a-filter-bar">
            <div class="a-search">
                <input type="text" name="q" placeholder="Search name, matric, email..." value="<?php echo htmlspecialchars($_GET['q']??''); ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <select name="school" class="a-filter-select" onchange="this.form.submit()">
                <option value="">All Schools</option>
                <?php foreach([1=>'SEET',2=>'SOC',3=>'SAAT',4=>'SEMS',5=>'SET',6=>'SMAT',7=>'SOS',8=>'SHHT'] as $id=>$sc): ?>
                <option value="<?php echo $id; ?>" <?php echo(($_GET['school']??'')==$id)?'selected':''; ?>><?php echo $sc; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="status" class="a-filter-select" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="active"   <?php echo(($_GET['status']??'')==='active')?'selected':''; ?>>Active</option>
                <option value="pending"  <?php echo(($_GET['status']??'')==='pending')?'selected':''; ?>>Pending</option>
                <option value="inactive" <?php echo(($_GET['status']??'')==='inactive')?'selected':''; ?>>Inactive</option>
            </select>
            <?php if (!empty($_GET['q']) || !empty($_GET['school']) || !empty($_GET['status'])): ?>
            <a href="<?php echo base_url(); ?>admin/students" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-xmark"></i> Clear</a>
            <?php endif; ?>
        </form>

        <div class="a-card">
            <div class="a-card-head">
                <h3 class="a-card-title">Registered Students (<?php echo count($students); ?>)</h3>
            </div>
            <div class="a-card-body-flush">
                <div class="a-table-wrap">
                <table class="a-table">
                    <thead>
                        <tr><th>#</th><th>Name</th><th>Matric No</th><th>Email</th><th>Level</th><th>CV</th><th>Status</th><th>Joined</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($students)): foreach ($students as $i => $s): ?>
                    <tr>
                        <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="a-avatar" style="width:32px;height:32px;font-size:12px;"><?php echo strtoupper(substr($s->fullname,0,1)); ?></div>
                                <div>
                                    <div style="font-weight:700;font-size:13.5px;"><?php echo htmlspecialchars($s->fullname); ?></div>
                                    <div style="font-size:11px;color:#6c757d;"><?php echo htmlspecialchars($s->email); ?></div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;font-weight:600;"><?php echo htmlspecialchars($s->matric_no); ?></td>
                        <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($s->email); ?></td>
                        <td><span style="background:rgba(59,130,246,.1);color:#1d4ed8;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:700;"><?php echo $s->level; ?></span></td>
                        <td>
                            <?php if ($this->db->table_exists('cf_student_cvs') && $this->db->where(['student_id'=>$s->student_id,'is_active'=>1])->count_all_results('cf_student_cvs')): ?>
                            <span class="a-badge a-badge-active">Yes</span>
                            <?php else: ?>
                            <span style="font-size:11.5px;color:#aaa;">–</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <select onchange="updateStudentStatus(<?php echo $s->student_id; ?>, this.value)" class="a-filter-select" style="padding:4px 8px;font-size:11.5px;border-radius:6px;">
                                <?php foreach(['active','pending','inactive'] as $st): ?>
                                <option value="<?php echo $st; ?>" <?php echo $s->accstatus===$st?'selected':''; ?>><?php echo ucfirst($st); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td style="font-size:12px;color:#6c757d;"><?php echo date('M d, Y',strtotime($s->created_at)); ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>admin/view_student/<?php echo $s->student_id; ?>" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-regular fa-eye"></i> View</a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="9" style="text-align:center;padding:40px;color:#6c757d;">No students found matching your filters.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</main>
</div>
<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
function updateStudentStatus(id, status) {
    $.post('<?php echo site_url("admin/toggle_student_status"); ?>', {
        id: id, status: status,
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    }, function(r){ if(r==1) adminSuccess('Status updated.'); else adminError('Update failed.'); });
}
</script>
</body></html>
