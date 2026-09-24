<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<section style="background:var(--cf-light); min-height:80vh; display:flex; align-items:center; padding:60px 0;">
    <div class="container">
        <div style="max-width:480px; margin:0 auto;">

            <!-- Logo + Title -->
            <div style="text-align:center; margin-bottom:32px;">
                <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA Logo" style="height:70px; width:auto; margin:0 auto 16px;">
                <h2 style="font-size:26px; font-weight:800; color:var(--cf-dark); margin:0 0 6px;">Welcome Back</h2>
                <p style="color:var(--cf-grey); font-size:14px; margin:0;">Sign in to your FUTA Career Services account</p>
            </div>

            <!-- Login Card -->
            <div style="background:white; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg); padding:36px; border-top:4px solid var(--cf-maroon);">

                <!-- Role Tabs – Student and Employer only -->
                <div style="display:flex; gap:4px; background:var(--cf-grey-light); border-radius:50px; padding:4px; margin-bottom:28px;">
                    <?php foreach (['Student','Employer'] as $i => $role): ?>
                    <button onclick="setRole('<?php echo strtolower($role); ?>')" id="tab-<?php echo strtolower($role); ?>"
                        style="flex:1; padding:10px 4px; border:none; border-radius:50px; font-size:14px; font-weight:700;
                               cursor:pointer; transition:all 0.2s;
                               <?php echo $i===0 ? 'background:var(--cf-maroon);color:white;' : 'background:transparent;color:var(--cf-grey);'; ?>"
                        aria-pressed="<?php echo $i===0 ? 'true' : 'false'; ?>">
                        <?php echo $role === 'Student' ? '<i class="fa-solid fa-graduation-cap"></i> ' : '<i class="fa-solid fa-building"></i> '; ?>
                        <?php echo $role; ?>
                    </button>
                    <?php endforeach; ?>
                </div>

                <!-- Admin login link -->
                <div style="text-align:right; margin-top:-18px; margin-bottom:16px; font-size:12.5px; color:var(--cf-grey);">
                    Admin? <a href="<?php echo base_url(); ?>admin" style="color:var(--cf-maroon); font-weight:700;">Go to Admin Panel</a>
                </div>

                <div id="login-msg" style="display:none; padding:10px 14px; border-radius:8px; margin-bottom:18px; font-size:13.5px;"></div>

                <form id="cf-login-form" novalidate>
                    <input type="hidden" name="role" id="login-role" value="student">
                    <?php echo $this->security->get_csrf_token_name(); ?>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                           value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div style="margin-bottom:18px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:7px;">
                            Email Address <span style="color:var(--cf-maroon);">*</span>
                        </label>
                        <div style="position:relative;">
                            <i class="fa-regular fa-envelope" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--cf-grey); font-size:14px;"></i>
                            <input type="email" id="login-email" name="email" placeholder="your@email.com"
                                style="width:100%; padding:11px 14px 11px 40px; border:1.5px solid var(--cf-border);
                                       border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font);
                                       outline:none; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'"
                                required>
                        </div>
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:7px;">
                            Password <span style="color:var(--cf-maroon);">*</span>
                        </label>
                        <div style="position:relative;">
                            <i class="fa-solid fa-lock" style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--cf-grey); font-size:14px;"></i>
                            <input type="password" id="login-pass" name="password" placeholder="Enter your password"
                                style="width:100%; padding:11px 40px 11px 40px; border:1.5px solid var(--cf-border);
                                       border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font);
                                       outline:none; transition:border-color 0.2s;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'"
                                required>
                            <button type="button" onclick="togglePass()" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:var(--cf-grey);" aria-label="Show/hide password">
                                <i class="fa-regular fa-eye" id="pass-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:22px;">
                        <label style="display:flex; align-items:center; gap:8px; font-size:13px; color:var(--cf-grey); cursor:pointer;">
                            <input type="checkbox" name="remember" style="accent-color:var(--cf-maroon);"> Remember me
                        </label>
                        <a href="<?php echo base_url(); ?>home/forgot" style="font-size:13px; color:var(--cf-maroon); font-weight:600;">Forgot Password?</a>
                    </div>

                    <button type="submit" id="login-btn" class="cf-btn cf-btn-primary" style="width:100%; justify-content:center; font-size:15px; padding:13px;">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In
                    </button>
                </form>

                <div style="text-align:center; margin-top:22px; padding-top:20px; border-top:1px solid var(--cf-border); font-size:13.5px; color:var(--cf-grey);">
                    Don't have an account?
                    <a href="<?php echo base_url(); ?>home/register" style="color:var(--cf-maroon); font-weight:700; margin-left:4px;">Register Now</a>
                </div>
            </div>

            <!-- Back to Home -->
            <div style="text-align:center; margin-top:20px;">
                <a href="<?php echo base_url(); ?>" style="font-size:13.5px; color:var(--cf-grey);">
                    <i class="fa-solid fa-arrow-left fa-fw"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
<script>
function setRole(role) {
    document.getElementById('login-role').value = role;
    ['student','employer'].forEach(function(r) {
        var btn = document.getElementById('tab-'+r);
        if (r === role) {
            btn.style.background = 'var(--cf-maroon)';
            btn.style.color = 'white';
        } else {
            btn.style.background = 'transparent';
            btn.style.color = 'var(--cf-grey)';
        }
    });
}
function togglePass() {
    var p = document.getElementById('login-pass');
    var e = document.getElementById('pass-eye');
    if (p.type === 'password') {
        p.type = 'text';
        e.className = 'fa-regular fa-eye-slash';
    } else {
        p.type = 'password';
        e.className = 'fa-regular fa-eye';
    }
}
$('#cf-login-form').on('submit', function(e) {
    e.preventDefault();
    var email = $('#login-email').val().trim();
    var pass  = $('#login-pass').val().trim();
    var role  = $('#login-role').val();
    if (!email || !pass) {
        showMsg('Please enter your email and password.', 'error'); return;
    }
    $('#login-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Signing In...').prop('disabled', true);
    $.ajax({
        url: '<?php echo site_url("home/do_login"); ?>',
        type: 'POST',
        data: { email: email, password: pass, role: role,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>' },
        success: function(resp) {
            var r = JSON.parse(resp);
            if (r.result == 1) {
                showMsg('Login successful! Redirecting...', 'success');
                setTimeout(function(){ window.location.href = r.redirect; }, 800);
            } else if (r.result == -1) {
                showMsg('Your account is not active. Please contact support.', 'error');
            } else {
                showMsg('Invalid email or password. Please try again.', 'error');
            }
            $('#login-btn').html('<i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In').prop('disabled', false);
        }
    });
});
function showMsg(msg, type) {
    var el = document.getElementById('login-msg');
    el.style.display = 'block';
    el.style.background = type === 'success' ? '#d1fae5' : '#fee2e2';
    el.style.color = type === 'success' ? '#065f46' : '#991b1b';
    el.style.border = '1px solid ' + (type === 'success' ? '#6ee7b7' : '#fca5a5');
    el.innerHTML = msg;
}
</script>
</body>
</html>
