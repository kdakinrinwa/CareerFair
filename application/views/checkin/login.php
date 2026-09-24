<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Check-in Login – FUTA Career Fair 2026</title>
    <link href="<?php echo base_url(); ?>assetsp/css/fa-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url(); ?>assetsp/images/logo.png">
    <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'DM Sans',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#0f172a 0%,#1a1a2e 50%,#4a0915 100%);padding:20px;}
    .login-box{background:#fff;border-radius:18px;padding:36px 32px;width:100%;max-width:380px;box-shadow:0 24px 64px rgba(0,0,0,.45);}
    .login-logo{text-align:center;margin-bottom:24px;}
    .login-logo img{height:60px;width:auto;margin:0 auto 12px;display:block;}
    .login-logo h2{font-size:18px;font-weight:800;color:#1A1A2E;margin:0 0 2px;}
    .login-logo p{font-size:12px;color:#6c757d;letter-spacing:1px;text-transform:uppercase;}
    .login-logo .divider{width:36px;height:3px;background:linear-gradient(90deg,#6B0E20,#C9A84C);border-radius:2px;margin:10px auto 0;}
    #login-alert{display:none;padding:11px 14px;border-radius:8px;margin-bottom:14px;font-size:13.5px;}
    .field{margin-bottom:14px;}
    .field label{display:block;font-size:13px;font-weight:600;color:#1A1A2E;margin-bottom:5px;}
    .field input{width:100%;padding:10px 14px 10px 40px;border:1.5px solid #e8e8e8;border-radius:8px;font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s;box-sizing:border-box;}
    .field input:focus{border-color:#6B0E20;}
    .field .input-wrap{position:relative;}
    .field .input-wrap i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#6c757d;font-size:14px;}
    .login-btn{width:100%;padding:12px;background:linear-gradient(135deg,#6B0E20,#4a0915);color:#fff;border:none;border-radius:8px;font-size:15px;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;margin-top:6px;}
    .login-btn:disabled{opacity:.65;}
    .back-link{text-align:center;margin-top:16px;font-size:13px;color:#6c757d;}
    .back-link a{color:#6B0E20;font-weight:700;text-decoration:none;}
    .checkin-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(107,14,32,.08);color:#6B0E20;padding:5px 14px;border-radius:20px;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:18px;}
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
        <h2>FUTA Career Fair 2026</h2>
        <p>Check-in System</p>
        <div class="divider"></div>
    </div>

    <div style="text-align:center;margin-bottom:18px;">
        <span class="checkin-badge"><i class="fa-solid fa-qrcode"></i> Event Check-in Officer</span>
    </div>

    <div id="login-alert"></div>

    <form id="checkin-login-form" novalidate>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" class="csrf-token" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="field">
            <label>Username</label>
            <div class="input-wrap">
                <i class="fa-regular fa-user"></i>
                <input type="text" name="username" placeholder="Enter your username" required autocomplete="username">
            </div>
        </div>
        <div class="field">
            <label>Password</label>
            <div class="input-wrap">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Enter password" required autocomplete="current-password">
            </div>
        </div>
        <button type="submit" class="login-btn" id="login-btn">
            <i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In to Scanner
        </button>
    </form>

    <div class="back-link">
        <a href="<?php echo base_url(); ?>admin"><i class="fa-solid fa-arrow-left"></i> Back to Admin</a>
    </div>
</div>

<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script>
$('#checkin-login-form').on('submit', function(e){
    e.preventDefault();
    var u = $('[name=username]').val().trim();
    var p = $('[name=password]').val().trim();
    if (!u || !p){ showAlert('Please enter your username and password.','error'); return; }
    var btn = $('#login-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Signing in...').prop('disabled',true);
    var data = {username:u, password:p};
    data[$('.csrf-token').attr('name')] = $('.csrf-token').val();
    $.ajax({
        url: '<?php echo site_url("checkin/do_login"); ?>',
        type: 'POST', data: data, dataType:'json',
        success: function(r){
            $('.csrf-token').val(r.token);
            if(r.result==1){ showAlert('Login successful! Opening scanner…','success'); setTimeout(function(){ window.location.href='<?php echo site_url("checkin/scan"); ?>'; },600); }
            else if(r.result==-1){ showAlert('Account is disabled.','error'); btn.html('<i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In to Scanner').prop('disabled',false); }
            else { showAlert('Invalid username or password.','error'); btn.html('<i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In to Scanner').prop('disabled',false); }
        },
        error:function(){ showAlert('Server error. Please try again.','error'); btn.html('<i class="fa-solid fa-arrow-right-to-bracket"></i> &nbsp;Sign In to Scanner').prop('disabled',false); }
    });
});
function showAlert(msg,type){
    var el=document.getElementById('login-alert');
    el.style.display='block';
    el.style.background=type==='success'?'#d1fae5':'#fee2e2';
    el.style.color=type==='success'?'#065f46':'#991b1b';
    el.style.border='1px solid '+(type==='success'?'#6ee7b7':'#fca5a5');
    el.innerHTML='<i class="fa-solid fa-'+(type==='success'?'circle-check':'circle-xmark')+' fa-fw"></i> '+msg;
}
</script>
</body>
</html>
