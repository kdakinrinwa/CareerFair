<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login – FUTA Career Services</title>
    <?php echo $this->load->view('admin/admin_css','',TRUE); ?>
</head>
<body class="admin-body">
<div class="admin-login-wrap">
    <div class="admin-login-box">

        <!-- Logo -->
        <div style="text-align:center; margin-bottom:28px;">
            <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA" style="height:64px; width:auto; margin:0 auto 14px; display:block;">
            <h2 style="font-size:20px; font-weight:800; color:#1A1A2E; margin:0 0 4px;">FUTA Career Services</h2>
            <p style="font-size:12.5px; color:#6c757d; margin:0; text-transform:uppercase; letter-spacing:1.5px;">Super Admin Panel</p>
            <div style="width:40px; height:3px; background:linear-gradient(90deg,#6B0E20,#C9A84C); border-radius:2px; margin:10px auto 0;"></div>
        </div>

        <div id="login-alert" style="display:none; padding:11px 16px; border-radius:8px; margin-bottom:16px; font-size:13.5px;"></div>

        <form id="admin-login-form" novalidate>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" class="csrf-field" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div style="margin-bottom:16px;">
                <label style="display:block; font-size:13px; font-weight:600; color:#1A1A2E; margin-bottom:6px;">Username / Email</label>
                <div style="position:relative;">
                    <i class="fa-regular fa-user" style="position:absolute; left:13px; top:50%; transform:translateY(-50%); color:#6c757d; font-size:14px;"></i>
                    <input type="text" name="username" id="adm-user" placeholder="admin"
                        style="width:100%; padding:10px 14px 10px 40px; border:1.5px solid #e8e8e8; border-radius:8px; font-size:14px; font-family:'DM Sans',sans-serif; outline:none; transition:border-color .2s; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#6B0E20'" onblur="this.style.borderColor='#e8e8e8'" required>
                </div>
            </div>

            <div style="margin-bottom:24px;">
                <label style="display:block; font-size:13px; font-weight:600; color:#1A1A2E; margin-bottom:6px;">Password</label>
                <div style="position:relative;">
                    <i class="fa-solid fa-lock" style="position:absolute; left:13px; top:50%; transform:translateY(-50%); color:#6c757d; font-size:14px;"></i>
                    <input type="password" name="password" id="adm-pass" placeholder="Enter password"
                        style="width:100%; padding:10px 40px 10px 40px; border:1.5px solid #e8e8e8; border-radius:8px; font-size:14px; font-family:'DM Sans',sans-serif; outline:none; transition:border-color .2s; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#6B0E20'" onblur="this.style.borderColor='#e8e8e8'" required>
                    <button type="button" onclick="toggleAdmPass()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#6c757d; padding:0;">
                        <i class="fa-regular fa-eye" id="adm-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" id="adm-login-btn"
                style="width:100%; padding:12px; background:linear-gradient(135deg,#6B0E20,#4a0915); color:#fff; border:none; border-radius:8px; font-size:15px; font-weight:700; font-family:'DM Sans',sans-serif; cursor:pointer; transition:opacity .2s;">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In
            </button>
        </form>

        <div style="text-align:center; margin-top:20px; font-size:12px; color:#aaa;">
            FUTA Career Services &amp; Career Fair Portal &copy; <?php echo date('Y'); ?>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script>
function toggleAdmPass() {
    var p = document.getElementById('adm-pass');
    var e = document.getElementById('adm-eye');
    p.type = p.type === 'password' ? 'text' : 'password';
    e.className = p.type === 'password' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash';
}
$('#admin-login-form').on('submit', function(e) {
    e.preventDefault();
    var u = $('#adm-user').val().trim();
    var p = $('#adm-pass').val().trim();
    if (!u || !p) { showAlert('Please enter your username and password.', 'error'); return; }
    $('#adm-login-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Signing in...').prop('disabled', true);
    var csrf = $('.csrf-field').attr('name');
    var data = { username: u, password: p };
    data[csrf] = $('.csrf-field').val();
    $.ajax({
        url:  '<?php echo site_url("admin/validate"); ?>',
        type: 'POST', data: data,
        success: function(resp) {
            var r = JSON.parse(resp);
            $('.csrf-field').val(r.token);
            if (r.result == 1) {
                showAlert('Login successful! Redirecting...', 'success');
                setTimeout(function(){ window.location.href = '<?php echo site_url("admin/dashboard"); ?>'; }, 600);
            } else if (r.result == -1) {
                showAlert('Your account is disabled. Contact the system administrator.', 'error');
                $('#adm-login-btn').html('<i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In').prop('disabled', false);
            } else {
                showAlert('Invalid username or password. Please try again.', 'error');
                $('#adm-login-btn').html('<i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In').prop('disabled', false);
            }
        },
        error: function() {
            showAlert('Server error. Please try again.', 'error');
            $('#adm-login-btn').html('<i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In').prop('disabled', false);
        }
    });
});
function showAlert(msg, type) {
    var el = document.getElementById('login-alert');
    el.style.display = 'block';
    el.style.background = type === 'success' ? '#d1fae5' : '#fee2e2';
    el.style.color      = type === 'success' ? '#065f46' : '#991b1b';
    el.style.border     = '1px solid ' + (type === 'success' ? '#6ee7b7' : '#fca5a5');
    el.innerHTML = '<i class="fa-solid fa-' + (type === 'success' ? 'circle-check' : 'circle-xmark') + ' fa-fw"></i> ' + msg;
}
</script>
</body>
</html>
