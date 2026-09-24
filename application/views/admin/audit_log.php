<!DOCTYPE html>
<html lang="en">
<head><title>Audit Log – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap">
<?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Audit Log &amp; Event Trail</div>
        <div class="portal-topbar-actions">
            <span style="font-size:13px;color:#6c757d;"><?php echo count($logs); ?> recent entries (max 200)</span>
        </div>
    </div>
    <div class="portal-content">
        <div class="a-card">
            <div class="a-card-head">
                <h3 class="a-card-title"><i class="fa-solid fa-clock-rotate-left" style="color:#6B0E20;margin-right:8px;"></i>System Event Log</h3>
                <div style="font-size:12.5px;color:#6c757d;">All admin actions are recorded here for accountability and security.</div>
            </div>
            <div class="a-card-body-flush">
                <div class="a-table-wrap">
                <table class="a-table">
                    <thead><tr><th>#</th><th>Action</th><th>User</th><th>Type</th><th>Table</th><th>Record ID</th><th>IP Address</th><th>Detail</th><th>Date / Time</th></tr></thead>
                    <tbody>
                    <?php if (!empty($logs)): foreach ($logs as $i => $log): ?>
                    <tr>
                        <td style="color:#6c757d;font-size:11.5px;"><?php echo $i+1; ?></td>
                        <td>
                            <span style="font-size:13px;font-weight:700;color:#<?php echo strpos($log->action,'DELETE')!==false?'dc2626':(strpos($log->action,'CREATE')!==false?'15803d':'1A1A2E'); ?>;">
                                <?php echo htmlspecialchars($log->action); ?>
                            </span>
                        </td>
                        <td style="font-size:12.5px;">#<?php echo $log->user_id; ?></td>
                        <td><span class="a-badge a-badge-active" style="font-size:10px;"><?php echo htmlspecialchars($log->user_type??''); ?></span></td>
                        <td style="font-size:12px;color:#6c757d;"><?php echo htmlspecialchars($log->table_name??'–'); ?></td>
                        <td style="font-size:12.5px;color:#6c757d;"><?php echo $log->record_id ? '#'.$log->record_id : '–'; ?></td>
                        <td style="font-size:12px;color:#6c757d;font-family:monospace;"><?php echo htmlspecialchars($log->ip_address??''); ?></td>
                        <td style="font-size:12px;color:#6c757d;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo htmlspecialchars(substr($log->new_values??'',0,60)); ?></td>
                        <td style="font-size:12px;color:#6c757d;white-space:nowrap;"><?php echo date('M d, Y H:i:s',strtotime($log->created_at)); ?></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="9" style="text-align:center;padding:40px;color:#6c757d;">No audit entries found.</td></tr>
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
</body></html>
