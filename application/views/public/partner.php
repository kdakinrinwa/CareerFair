<!DOCTYPE html>
<html lang="en">
<head>
    <title>Partner with Us – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>Partner with FUTA</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>Partner / Sponsor</li></ul>
    </div>
</div>

<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="max-width:720px; margin:0 auto;">
            <div class="cf-section-title centered">
                <span class="cf-label">Build Lasting Connections</span>
                <h2>Become a Partner or Sponsor</h2>
                <p>Align your brand with Nigeria's leading technology university. Reach thousands of talented graduates, students and industry leaders at FUTA Career Fair 2026.</p>
            </div>

            <div style="background:white; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg); border-top:4px solid var(--cf-maroon); padding:36px;">
                <div id="partner-msg" style="display:none; padding:12px 16px; border-radius:8px; margin-bottom:18px; font-size:13.5px;"></div>

                <form id="cf-partner-form" method="post" action="<?php echo site_url('home/submit_contact'); ?>" novalidate>
                    <input type="hidden" name="subject" value="PARTNERSHIP / SPONSORSHIP ENQUIRY">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                        <?php
                        $pfields = [
                            ['Organisation / Company Name *','fullnames','text','e.g. ABC Engineering Ltd',true],
                            ['Contact Person Name *','phonenumber','text','Your full name',true],
                            ['Email Address *','emailaddress','email','contact@company.com',true],
                            ['Phone Number','phonenumber2','tel','e.g. 08012345678',false],
                        ];
                        // Use a simple layout since we reuse contactmess fields
                        ?>
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Organisation Name *</label>
                            <input type="text" name="fullnames" placeholder="e.g. ABC Engineering Ltd"
                                style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required>
                        </div>
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Contact Person *</label>
                            <input type="text" name="phonenumber" placeholder="Full name of contact"
                                style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required>
                        </div>
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Email Address *</label>
                            <input type="email" name="emailaddress" placeholder="contact@company.com"
                                style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required>
                        </div>
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Partnership Interest *</label>
                            <select name="partnership_type" style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none; background:white;">
                                <option value="">Select Package</option>
                                <option value="Platinum">Platinum Sponsor</option>
                                <option value="Gold">Gold Sponsor</option>
                                <option value="Silver">Silver Sponsor</option>
                                <option value="Partner">Event Partner</option>
                                <option value="Custom">Custom Partnership</option>
                                <option value="Advertising">Advertising Only</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-top:18px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Message / Additional Information</label>
                        <textarea name="message" rows="5" placeholder="Tell us about your organisation, what you would like to achieve and any specific requirements..."
                            style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none; resize:vertical;"
                            onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'"></textarea>
                    </div>

                    <!-- CAPTCHA -->
                    <div style="margin-top:16px; display:flex; align-items:center; gap:16px;">
                        <div style="padding:10px 20px; background:var(--cf-maroon); color:white; border-radius:var(--cf-radius); font-size:18px; font-weight:800; letter-spacing:3px; font-family:monospace;">
                            <?php echo isset($capcha2) ? $capcha2 : 'a1b2'; ?>
                        </div>
                        <div style="flex:1;">
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:5px;">Enter the code above *</label>
                            <input type="text" name="capcha" placeholder="Type the code"
                                style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:monospace; outline:none; letter-spacing:2px;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required>
                        </div>
                    </div>

                    <button type="submit" id="partner-btn" class="cf-btn cf-btn-primary" style="width:100%; justify-content:center; margin-top:24px; font-size:15px; padding:13px;">
                        <i class="fa-solid fa-paper-plane"></i> Send Partnership Enquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
<script>
$('#cf-partner-form').on('submit', function(e) {
    e.preventDefault();
    var capcha = '<?php echo isset($capcha2) ? $capcha2 : ''; ?>';
    var entered = $('[name="capcha"]').val().trim();
    if (entered !== capcha) {
        showPMsg('Security code does not match. Please try again.', 'error');
        return false;
    }
    $('#partner-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Sending...').prop('disabled', true);
    $.ajax({
        url: '<?php echo site_url("home/submit_contact"); ?>',
        type: 'POST',
        data: $(this).serialize(),
        success: function(data) {
            if (data == 1) {
                showPMsg('<i class="fa-solid fa-circle-check"></i> Thank you! Your partnership enquiry has been received. We will contact you within 2 business days.', 'success');
                $('#cf-partner-form')[0].reset();
            } else {
                showPMsg('Something went wrong. Please try again.', 'error');
            }
            $('#partner-btn').html('<i class="fa-solid fa-paper-plane"></i> Send Partnership Enquiry').prop('disabled', false);
        }
    });
});
function showPMsg(msg, type) {
    var el = document.getElementById('partner-msg');
    el.style.display = 'block';
    el.style.background = type === 'success' ? '#d1fae5' : '#fee2e2';
    el.style.color = type === 'success' ? '#065f46' : '#991b1b';
    el.style.border = '1px solid ' + (type === 'success' ? '#6ee7b7' : '#fca5a5');
    el.innerHTML = msg;
    window.scrollTo({top: el.offsetTop - 100, behavior: 'smooth'});
}
</script>
</body>
</html>
