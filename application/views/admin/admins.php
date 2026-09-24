<!DOCTYPE html>
<html lang="en">
<head><title>Admin Users – FUTA Admin</title><?php echo $css; ?></head>
<body class="portal-body admin-body">
<div class="portal-wrap"><?php echo $sidebar; ?>
<main class="portal-main">
    <div class="portal-topbar">
        <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
        <div class="portal-topbar-title">Admin Users Management</div>
        <div class="portal-topbar-actions">
            <button onclick="openAdminModal(0)" class="a-btn a-btn-maroon a-btn-sm"><i class="fa-solid fa-plus"></i> Add Admin</button>
        </div>
    </div>
    <div class="portal-content">
        <div class="a-card">
            <div class="a-card-head"><h3 class="a-card-title"><i class="fa-solid fa-user-shield" style="color:#6B0E20;margin-right:8px;"></i>System Admin Accounts</h3></div>
            <div class="a-card-body-flush"><div class="a-table-wrap">
            <table class="a-table">
                <thead><tr><th>#</th><th>Full Name</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($admins as $i => $a): ?>
                <tr>
                    <td style="color:#6c757d;font-size:12px;"><?php echo $i+1; ?></td>
                    <td><div style="display:flex;align-items:center;gap:10px;"><div class="a-avatar" style="width:30px;height:30px;font-size:11px;"><?php echo strtoupper(substr($a->fullname??'A',0,1)); ?></div><span style="font-weight:700;"><?php echo htmlspecialchars($a->fullname??''); ?></span></div></td>
                    <td style="font-family:monospace;font-size:13px;"><?php echo htmlspecialchars($a->username); ?></td>
                    <td style="font-size:12.5px;color:#6c757d;"><?php echo htmlspecialchars($a->email??''); ?></td>
                    <td><span class="a-badge <?php echo $a->usergroup==='superadmin'?'a-badge-approved':'a-badge-pending'; ?>"><?php echo ucfirst($a->usergroup); ?></span></td>
                    <td><span class="a-badge a-badge-<?php echo $a->accstatus; ?>"><?php echo ucfirst($a->accstatus); ?></span></td>
                    <td><button onclick="openAdminModal(<?php echo $a->auto_id; ?>,'<?php echo addslashes($a->fullname); ?>','<?php echo addslashes($a->username); ?>','<?php echo addslashes($a->email??''); ?>','<?php echo $a->usergroup; ?>','<?php echo $a->accstatus; ?>')" class="a-btn a-btn-ghost a-btn-sm"><i class="fa-solid fa-pen"></i> Edit</button></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div></div>
        </div>
    </div>
</main></div>

<!-- Modal -->
<div id="admin-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:14px;padding:32px;width:100%;max-width:480px;position:relative;">
        <h3 id="modal-title" style="font-size:18px;font-weight:800;color:#1A1A2E;margin:0 0 20px;">Admin User</h3>
        <form id="admin-form">
            <input type="hidden" name="auto_id" id="f-id" value="0">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                <div><label class="p-form-label">Full Name *</label><input type="text" name="fullname" id="f-fn" class="p-form-control" required></div>
                <div><label class="p-form-label">Username *</label><input type="text" name="username" id="f-un" class="p-form-control" required></div>
                <div><label class="p-form-label">Email</label><input type="email" name="email" id="f-em" class="p-form-control"></div>
                <div><label class="p-form-label">Password <span style="color:#6c757d;font-weight:400;">(leave blank to keep)</span></label><input type="password" name="password" id="f-pw" class="p-form-control"></div>
                <div><label class="p-form-label">Role</label>
                    <select name="usergroup" id="f-gr" class="p-form-control">
                        <option value="admin">Admin</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="checkin_officer">Check-in Officer</option>
                    </select>
                </div>
                <div><label class="p-form-label">Status</label>
                    <select name="accstatus" id="f-st" class="p-form-control">
                        <option value="enabled">Enabled</option>
                        <option value="disabled">Disabled</option>
                    </select>
                </div>
            </div>
            <div style="display:flex;gap:10px;justify-content:flex-end;">
                <button type="button" onclick="closeAdminModal()" class="a-btn a-btn-ghost">Cancel</button>
                <button type="submit" class="a-btn a-btn-maroon"><i class="fa-solid fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</div>

<?php echo $this->load->view('admin/admin_js','',TRUE); ?>
<script>
function openAdminModal(id,fn,un,em,gr,st){
    document.getElementById('f-id').value=id||0;
    document.getElementById('f-fn').value=fn||'';
    document.getElementById('f-un').value=un||'';
    document.getElementById('f-em').value=em||'';
    document.getElementById('f-gr').value=gr||'admin';
    document.getElementById('f-st').value=st||'enabled';
    document.getElementById('modal-title').textContent=id?'Edit Admin':'New Admin User';
    document.getElementById('admin-modal').style.display='flex';
}
function closeAdminModal(){ document.getElementById('admin-modal').style.display='none'; }
$('#admin-form').on('submit',function(e){
    e.preventDefault();
    $.ajax({url:'<?php echo site_url("admin/save_admin"); ?>',type:'POST',data:$(this).serialize(),
        success:function(r){ var d=JSON.parse(r);
            if(d.result>=1){adminSuccess('Admin user saved.');setTimeout(function(){location.reload();},1200);}
            else if(d.result==2) adminError('Username already exists.')
            else adminError('Save failed.');
            closeAdminModal();
        }
    });
});
</script>
</body></html>
