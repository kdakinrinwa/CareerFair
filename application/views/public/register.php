<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
    <style>
    /* ── Registration page layout ─────────────────────── */
    .reg-wrap {
        min-height: 100vh;
        background: #F8F6F0;
        display: flex;
        align-items: stretch;
    }

    /* ── Left: form panel ─────────────────────────────── */
    .reg-left {
        flex: 1;
        padding: 48px 52px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }

    /* ── Right: image panel ───────────────────────────── */
    .reg-right {
        width: 340px;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
        background: #1A1A2E;
    }
    .reg-right-img {
        position: absolute;
        inset: 0;
        background: url('<?php echo base_url(); ?>assetsp/images/<?php echo $reg_type === "employer" ? "emp.png" : "students-group.png"; ?>') center top / cover no-repeat;
        opacity: 1;
    }
    /* Dark gradient so text at bottom reads clearly */
    .reg-right-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(107,14,32,0.25) 0%,
            rgba(26,26,46,0.30) 40%,
            rgba(26,26,46,0.88) 100%
        );
    }
    .reg-right-content {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 32px 28px;
        z-index: 2;
    }
    .reg-right-quote {
        font-size: 26px;
        font-weight: 900;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 14px;
    }
    .reg-right-quote span { color: #C9A84C; }
    .reg-right-tagline {
        display: flex;
        gap: 18px;
        font-size: 13px;
        font-weight: 700;
        color: rgba(255,255,255,.75);
    }
    .reg-right-tagline span {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .reg-right-tagline span::before {
        content: '·';
        color: #C9A84C;
        font-size: 18px;
    }
    .reg-right-tagline span:first-child::before { display: none; }

    /* Header branding in top-left of right panel */
    .reg-right-header {
        position: absolute;
        top: 0; left: 0; right: 0;
        padding: 20px 22px;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(180deg, rgba(107,14,32,.85) 0%, transparent 100%);
    }
    .reg-right-header img { height: 38px; width: auto; filter: brightness(1.1); }
    .reg-right-header-text .rh-uni  { font-size: 9.5px; font-weight: 700; color: rgba(255,255,255,.85); text-transform: uppercase; letter-spacing: .5px; line-height: 1.3; }
    .reg-right-header-text .rh-dept { font-size: 11px; font-weight: 700; color: #C9A84C; }

    /* ── Form header ──────────────────────────────────── */
    .reg-form-header { margin-bottom: 28px; }
    .reg-form-header .reg-logo {
        display: flex; align-items: center; gap: 10px; margin-bottom: 18px;
    }
    .reg-form-header .reg-logo img { height: 48px; width: auto; }
    .reg-form-header .reg-logo-text .rl-main { font-size: 12px; font-weight: 700; color: #6B0E20; text-transform: uppercase; letter-spacing: .3px; }
    .reg-form-header .reg-logo-text .rl-sub  { font-size: 10px; color: #6c757d; }
    .reg-form-header h2 { font-size: 26px; font-weight: 900; color: #1A1A2E; margin: 0 0 4px; }
    .reg-form-header p  { font-size: 14px; color: #6B0E20; font-weight: 700; margin: 0; }

    /* ── Type tabs (Student | Employer only) ──────────── */
    .reg-tabs { display: flex; gap: 8px; margin-bottom: 24px; }
    .reg-tab {
        flex: 1; display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; border-radius: 10px;
        border: 2px solid #e8e8e8; background: #fff;
        text-decoration: none; transition: all .2s; cursor: pointer;
    }
    .reg-tab:hover { border-color: rgba(107,14,32,.3); }
    .reg-tab.active { border-color: #6B0E20; background: rgba(107,14,32,.04); }
    .reg-tab-icon {
        width: 38px; height: 38px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; flex-shrink: 0;
        background: #f0f0f0; color: #6c757d;
        transition: all .2s;
    }
    .reg-tab.active .reg-tab-icon { background: #6B0E20; color: #fff; }
    .reg-tab-label { font-size: 14.5px; font-weight: 700; color: #1A1A2E; line-height: 1.2; }
    .reg-tab.active .reg-tab-label { color: #6B0E20; }
    .reg-tab-desc  { font-size: 11.5px; color: #6c757d; }

    /* ── Step indicator ───────────────────────────────── */
    .reg-steps {
        display: flex; align-items: center;
        gap: 0; margin-bottom: 24px;
    }
    .reg-step-item { display: flex; align-items: center; flex: 1; }
    .reg-step-circle {
        width: 30px; height: 30px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 12.5px; font-weight: 800;
        background: #e8e8e8; color: #aaa;
        flex-shrink: 0; transition: all .3s;
    }
    .reg-step-circle.active { background: #6B0E20; color: #fff; }
    .reg-step-label {
        font-size: 10.5px; font-weight: 600; color: #aaa;
        white-space: nowrap; margin-top: 4px;
        transition: color .3s;
    }
    .reg-step-label.active { color: #6B0E20; }
    .reg-step-connector {
        flex: 1; height: 2px; background: #e8e8e8; margin: 0 4px;
    }
    .reg-step-col { display: flex; flex-direction: column; align-items: center; }

    /* ── Form fields ──────────────────────────────────── */
    .reg-field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .reg-field { margin-bottom: 0; }
    .reg-label {
        display: block; font-size: 13px; font-weight: 600;
        color: #1A1A2E; margin-bottom: 6px;
    }
    .reg-input {
        width: 100%; padding: 10px 14px;
        border: 1.5px solid #e8e8e8; border-radius: 8px;
        font-size: 14px; font-family: 'DM Sans', sans-serif;
        outline: none; transition: border-color .2s;
        background: #fff; box-sizing: border-box;
    }
    .reg-input:focus { border-color: #6B0E20; }
    .reg-input::placeholder { color: #bbb; }
    select.reg-input { background: #fff; cursor: pointer; }

    /* ── Terms checkbox ───────────────────────────────── */
    .reg-terms {
        display: flex; align-items: flex-start; gap: 10px;
        padding: 13px 16px; background: rgba(107,14,32,.04);
        border-radius: 8px; border: 1px solid rgba(107,14,32,.1);
        font-size: 13.5px; color: #1A1A2E; cursor: pointer;
        margin-top: 16px;
    }
    .reg-terms input { margin-top: 2px; accent-color: #6B0E20; flex-shrink: 0; }
    .reg-terms a { color: #6B0E20; font-weight: 700; }

    /* ── Submit button ────────────────────────────────── */
    .reg-submit {
        width: 100%; margin-top: 20px; padding: 13px;
        background: linear-gradient(135deg, #6B0E20, #4a0915);
        color: #fff; border: none; border-radius: 50px;
        font-size: 15px; font-weight: 800;
        font-family: 'DM Sans', sans-serif; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: opacity .2s, transform .2s;
    }
    .reg-submit:hover { opacity: .92; transform: translateY(-1px); }
    .reg-submit:disabled { opacity: .65; transform: none; }

    /* ── Bottom login link ────────────────────────────── */
    .reg-login-link {
        text-align: center; margin-top: 18px;
        font-size: 14px; color: #6c757d;
    }
    .reg-login-link a { color: #6B0E20; font-weight: 700; }

    /* ── Alert ─────────────────────────────────────────── */
    #reg-alert { display:none; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:13.5px; }

    /* ── Career interest chips ────────────────────────── */
    .reg-chips { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 14px; }
    .reg-chip {
        display: flex; align-items: center; gap: 7px;
        padding: 6px 14px; border: 1.5px solid #e8e8e8;
        border-radius: 50px; font-size: 13px; color: #1A1A2E;
        cursor: pointer; transition: all .2s; background: #fff;
    }
    .reg-chip input { accent-color: #6B0E20; }
    .reg-chip:hover { border-color: rgba(107,14,32,.3); }

    /* ── Responsive ────────────────────────────────────── */
    @media (max-width: 960px) { .reg-right { display: none; } }
    @media (max-width: 640px) {
        .reg-left { padding: 28px 20px; }
        .reg-field-grid { grid-template-columns: 1fr; }
        .reg-tabs { flex-direction: column; }
    }
    </style>
</head>
<body>

<?php echo $header; ?>

<?php $reg_type = isset($reg_type) ? $reg_type : 'student'; ?>

<div class="reg-wrap">

    <!-- ════════════════════════════════════════════
         LEFT – Registration Form
    ════════════════════════════════════════════ -->
    <div class="reg-left">

        <!-- Logo + heading -->
        <div class="reg-form-header">
            <div class="reg-logo">
                <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
                <div class="reg-logo-text">
                    <span class="rl-main">The Federal University of Technology, Akure</span>
                    <span class="rl-sub">Centre for Career Services</span>
                </div>
            </div>
            <h2>
                <?php echo $reg_type === 'employer' ? 'Create Employer Account' : 'Create Student Account'; ?>
            </h2>
            <p>Join FUTA Career Fair 2026</p>
        </div>

        <!-- Type tabs: Student | Employer only -->
        <div class="reg-tabs">
            <a href="<?php echo base_url(); ?>home/register/student"
               class="reg-tab <?php echo $reg_type === 'student' ? 'active' : ''; ?>">
                <div class="reg-tab-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <div>
                    <div class="reg-tab-label">Student</div>
                    <div class="reg-tab-desc">Register &amp; submit CV</div>
                </div>
            </a>
            <a href="<?php echo base_url(); ?>home/register/employer"
               class="reg-tab <?php echo $reg_type === 'employer' ? 'active' : ''; ?>">
                <div class="reg-tab-icon"><i class="fa-solid fa-building"></i></div>
                <div>
                    <div class="reg-tab-label">Employer</div>
                    <div class="reg-tab-desc">Recruit top talent</div>
                </div>
            </a>
        </div>

        <!-- Step indicator -->
        <?php
        $steps = $reg_type === 'employer'
            ? ['Organisation', 'Contact Person', 'Participation', 'Review']
            : ['Personal Info', 'Academic Info', 'Career Interest', 'Review'];
        ?>
        <div class="reg-steps">
            <?php foreach ($steps as $si => $sname): ?>
            <div class="reg-step-item">
                <div class="reg-step-col">
                    <div class="reg-step-circle <?php echo $si === 0 ? 'active' : ''; ?>"><?php echo $si+1; ?></div>
                    <div class="reg-step-label <?php echo $si === 0 ? 'active' : ''; ?>"><?php echo $sname; ?></div>
                </div>
                <?php if ($si < count($steps)-1): ?>
                <div class="reg-step-connector"></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Alert -->
        <div id="reg-alert"></div>

        <!-- ══ STUDENT FORM ══ -->
        <?php if ($reg_type === 'student'): ?>
        <form id="cf-reg-form" method="post" action="<?php echo site_url('home/do_register'); ?>" novalidate>
            <input type="hidden" name="role" value="student">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="reg-field-grid">
                <div class="reg-field">
                    <label class="reg-label">Full Name <span style="color:#6B0E20;">*</span></label>
                    <input type="text" name="fullname" class="reg-input" placeholder="Enter your full name" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Matric Number <span style="color:#6B0E20;">*</span></label>
                    <input type="text" name="matric_no" class="reg-input" placeholder="e.g. ENG/2023/1234" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Email Address <span style="color:#6B0E20;">*</span></label>
                    <input type="email" name="email" class="reg-input" placeholder="Enter your email" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Phone Number <span style="color:#6B0E20;">*</span></label>
                    <input type="tel" name="phone" class="reg-input" placeholder="e.g. 08012345678" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Password <span style="color:#6B0E20;">*</span></label>
                    <input type="password" name="password" class="reg-input" placeholder="Create password" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Confirm Password <span style="color:#6B0E20;">*</span></label>
                    <input type="password" name="password2" class="reg-input" placeholder="Confirm password" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">School <span style="color:#6B0E20;">*</span></label>
                    <select name="school_id" class="reg-input" required>
                        <option value="">Select School</option>
                        <option value="1">SEET – Engineering</option>
                        <option value="2">SOC – Computing</option>
                        <option value="3">SAAT – Agriculture</option>
                        <option value="4">SEMS – Earth Sciences</option>
                        <option value="5">SET – Environmental Technology</option>
                        <option value="6">SMAT – Management Technology</option>
                        <option value="7">SOS – Sciences</option>
                        <option value="8">SHHT – Health Technology</option>
                    </select>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Level <span style="color:#6B0E20;">*</span></label>
                    <select name="level" class="reg-input" required>
                        <option value="">Select Level</option>
                        <option value="100">100 Level</option>
                        <option value="200">200 Level</option>
                        <option value="300">300 Level</option>
                        <option value="400" selected>400 Level</option>
                        <option value="500">500 Level</option>
                        <option value="600">600 Level</option>
                        <option value="PGD">PGD</option>
                        <option value="MSc">MSc</option>
                        <option value="PhD">PhD</option>
                    </select>
                </div>
            </div>

            <!-- Terms -->
            <label class="reg-terms">
                <input type="checkbox" name="agree_terms" id="agree_terms" required>
                <span>I agree to the <a href="<?php echo base_url(); ?>home/page/terms">Terms &amp; Conditions</a>
                and consent to FUTA Career Services processing my profile and CV data for career matching.</span>
            </label>

            <button type="submit" class="reg-submit" id="reg-btn">
                Next <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <!-- ══ EMPLOYER FORM ══ -->
        <?php else: ?>
        <form id="cf-reg-form" method="post" action="<?php echo site_url('home/do_register'); ?>" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="role" value="employer">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="reg-field-grid">
                <div class="reg-field">
                    <label class="reg-label">Organisation Name <span style="color:#6B0E20;">*</span></label>
                    <input type="text" name="org_name" class="reg-input" placeholder="e.g. ABC Engineering Ltd" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Industry Sector <span style="color:#6B0E20;">*</span></label>
                    <select name="industry_id" class="reg-input" required>
                        <option value="">Select Industry</option>
                        <option value="1">Banking &amp; Finance</option>
                        <option value="2">ICT &amp; Telecommunications</option>
                        <option value="3">Oil &amp; Gas</option>
                        <option value="4">Engineering &amp; Manufacturing</option>
                        <option value="5">Agriculture &amp; Agribusiness</option>
                        <option value="6">Consulting &amp; Professional Services</option>
                        <option value="7">Construction &amp; Real Estate</option>
                        <option value="8">Healthcare &amp; Pharmaceuticals</option>
                        <option value="15">Other</option>
                    </select>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Organisation Type <span style="color:#6B0E20;">*</span></label>
                    <select name="org_type" class="reg-input" required>
                        <option value="">Select Type</option>
                        <option value="Private Company">Private Company</option>
                        <option value="Government">Government Agency</option>
                        <option value="NGO">NGO</option>
                        <option value="International Organisation">International Organisation</option>
                        <option value="Startup">Startup</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Company Website</label>
                    <input type="url" name="website" class="reg-input" placeholder="https://www.company.com">
                </div>
                <div class="reg-field">
                    <label class="reg-label">Contact Person Name <span style="color:#6B0E20;">*</span></label>
                    <input type="text" name="contact_name" class="reg-input" placeholder="Full name" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Designation / Role <span style="color:#6B0E20;">*</span></label>
                    <input type="text" name="contact_designation" class="reg-input" placeholder="e.g. HR Manager" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Contact Email <span style="color:#6B0E20;">*</span></label>
                    <input type="email" name="contact_email" class="reg-input" placeholder="recruiter@company.com" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Contact Phone <span style="color:#6B0E20;">*</span></label>
                    <input type="tel" name="contact_phone" class="reg-input" placeholder="e.g. 08012345678" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Password <span style="color:#6B0E20;">*</span></label>
                    <input type="password" name="password" class="reg-input" placeholder="Create password" required>
                </div>
                <div class="reg-field">
                    <label class="reg-label">Confirm Password <span style="color:#6B0E20;">*</span></label>
                    <input type="password" name="password2" class="reg-input" placeholder="Confirm password" required>
                </div>
            </div>

            <!-- Recruitment Interest -->
            <div style="margin-top:16px;">
                <label class="reg-label">Recruitment Interest</label>
                <div class="reg-chips">
                    <?php foreach (['Internship','NYSC','Graduate Trainee','Full-time'] as $ri): ?>
                    <label class="reg-chip">
                        <input type="checkbox" name="recruit_interest[]" value="<?php echo $ri; ?>">
                        <?php echo $ri; ?>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Terms -->
            <label class="reg-terms">
                <input type="checkbox" name="agree_terms" required>
                <span>I agree to the <a href="<?php echo base_url(); ?>home/page/terms">Terms &amp; Conditions</a>
                and confirm I am authorised to register on behalf of my organisation.</span>
            </label>

            <button type="submit" class="reg-submit" id="reg-btn">
                <i class="fa-solid fa-building"></i> Create Employer Account
            </button>
        </form>
        <?php endif; ?>

        <!-- Login link -->
        <div class="reg-login-link">
            Already have an account? <a href="<?php echo base_url(); ?>home/login">Login here</a>
        </div>

    </div><!-- /reg-left -->


    <!-- ════════════════════════════════════════════
         RIGHT – st.png image with quote overlay
    ════════════════════════════════════════════ -->
    <div class="reg-right">
        <div class="reg-right-img"></div>
        <div class="reg-right-overlay"></div>

        <!-- Top branding -->
        <div class="reg-right-header">
            <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA">
            <div class="reg-right-header-text">
                <div class="rh-uni">THE FEDERAL UNIVERSITY OF<br>TECHNOLOGY, AKURE</div>
                <div class="rh-dept">Centre for Career Services</div>
            </div>
        </div>

        <!-- Bottom quote -->
        <div class="reg-right-content">
            <div class="reg-right-quote">
                <?php if ($reg_type === 'employer'): ?>
                "Connect With<br>FUTA's <span>Top Talent"</span>
                <?php else: ?>
                "Your Career<br>Journey<br><span>Starts Here"</span>
                <?php endif; ?>
            </div>
            <div class="reg-right-tagline">
                <?php if ($reg_type === 'employer'): ?>
                <span>Recruit</span>
                <span>Engage</span>
                <span>Grow</span>
                <?php else: ?>
                <span>Learn</span>
                <span>Connect</span>
                <span>Grow</span>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- /reg-right -->

</div><!-- /reg-wrap -->

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>
<?php echo $js; ?>
<script>
$(document).ready(function(){

    /* ── Form submission with validation ──────────── */
    $('#cf-reg-form').on('submit', function(e){
        e.preventDefault();

        // Password match check
        var p1 = $('[name=password]').val();
        var p2 = $('[name=password2]').val();
        if (p1 && p2 && p1 !== p2) {
            showAlert('Passwords do not match. Please check and try again.', 'error');
            return;
        }

        var btn = $('#reg-btn');
        btn.html('<i class="fa-solid fa-spinner fa-spin"></i> Processing...').prop('disabled', true);

        $.ajax({
            url:         '<?php echo site_url("home/do_register"); ?>',
            type:        'POST',
            data:        new FormData(this),
            contentType: false,
            processData: false,
            success: function(resp) {
                // do_register redirects on success, so response arriving means an error
                showAlert('Registration could not be completed. Please check your details.', 'error');
                btn.html('<?php echo $reg_type === "employer" ? "<i class=\"fa-solid fa-building\"></i> Create Employer Account" : "Next <i class=\"fa-solid fa-arrow-right\"></i>"; ?>').prop('disabled', false);
            },
            error: function() {
                // Likely a redirect happened – treat as success
                Swal.fire({
                    icon: 'success',
                    title: 'Account Created!',
                    text:  'Your account has been created. You can now log in.',
                    confirmButtonColor: '#6B0E20',
                    confirmButtonText:  'Go to Login'
                }).then(function(){ window.location.href = '<?php echo site_url("home/login"); ?>'; });
            }
        });
    });

    function showAlert(msg, type) {
        var el = document.getElementById('reg-alert');
        el.style.display   = 'block';
        el.style.background = type === 'success' ? '#d1fae5' : '#fee2e2';
        el.style.color      = type === 'success' ? '#065f46' : '#991b1b';
        el.style.border     = '1px solid ' + (type === 'success' ? '#6ee7b7' : '#fca5a5');
        el.innerHTML = '<i class="fa-solid fa-' + (type === 'success' ? 'circle-check' : 'circle-xmark') + ' fa-fw"></i> ' + msg;
        el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
});
</script>
</body>
</html>
