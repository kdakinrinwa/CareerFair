<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>Contact Us</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>Contact</li></ul>
    </div>
</div>

<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:grid; grid-template-columns:1fr 1.6fr; gap:40px; flex-wrap:wrap;" class="row">

            <!-- Contact Info Column -->
            <div style="padding:0 12px;">
                <div class="cf-section-title">
                    <span class="cf-label">Get in Touch</span>
                    <h2>Contact Career Services</h2>
                    <p>Have questions about the FUTA Career Fair 2026? Reach out to the Centre for Career Services.</p>
                </div>

                <div style="display:flex; flex-direction:column; gap:16px; margin-bottom:28px;">
                    <?php
                    $contacts = [
                        ['fa-location-dot', 'Address',
                            isset($info->address1) ? $info->address1 : 'Centre for Career Services, Federal University of Technology, Akure (FUTA), PMB 704, Akure, Ondo State, Nigeria'],
                        ['fa-envelope','Email',
                            isset($info->email1) ? $info->email1 : 'careerservices@futa.edu.ng'],
                        ['fa-phone','Phone',
                            isset($info->phone1) ? $info->phone1 : '+234 703 000 0000'],
                        ['fa-clock','Office Hours','Monday – Friday: 8:00 AM – 5:00 PM'],
                    ];
                    foreach ($contacts as $c):
                    ?>
                    <div style="display:flex; gap:16px; padding:18px; background:white; border-radius:var(--cf-radius); border:1px solid var(--cf-border);">
                        <div style="width:44px; height:44px; background:rgba(107,14,32,0.08); border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:19px; color:var(--cf-maroon); flex-shrink:0;">
                            <i class="fa-solid <?php echo $c[0]; ?>"></i>
                        </div>
                        <div>
                            <div style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; color:var(--cf-grey); margin-bottom:4px;"><?php echo $c[1]; ?></div>
                            <div style="font-size:14px; color:var(--cf-dark); font-weight:500;"><?php echo $c[2]; ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Social Links -->
                <h5 style="font-size:15px; font-weight:700; color:var(--cf-dark); margin-bottom:14px;">Follow Us</h5>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <?php
                    $socials = [
                        ['fa-brands fa-linkedin-in','LinkedIn',isset($info->linkedin) ? $info->linkedin : '#'],
                        ['fa-brands fa-x-twitter','X / Twitter',isset($info->twitter) ? $info->twitter : '#'],
                        ['fa-brands fa-instagram','Instagram',isset($info->instagram) ? $info->instagram : '#'],
                        ['fa-brands fa-facebook-f','Facebook',isset($info->facebook) ? $info->facebook : '#'],
                        ['fa-brands fa-youtube','YouTube',isset($info->youtube) ? $info->youtube : '#'],
                    ];
                    foreach ($socials as $s):
                    ?>
                    <a href="<?php echo $s[2]; ?>" target="_blank" aria-label="<?php echo $s[1]; ?>"
                       style="width:42px; height:42px; background:var(--cf-maroon); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-size:16px; transition:all 0.2s;"
                       onmouseover="this.style.background='var(--cf-gold)'; this.style.color='var(--cf-dark)';"
                       onmouseout="this.style.background='var(--cf-maroon)'; this.style.color='white';">
                        <i class="<?php echo $s[0]; ?>"></i>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Contact Form Column -->
            <div style="padding:0 12px;">
                <div style="background:white; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg); border-top:4px solid var(--cf-maroon); padding:36px;">
                    <h4 style="font-size:20px; font-weight:800; color:var(--cf-dark); margin:0 0 6px;">Send Us a Message</h4>
                    <p style="font-size:13.5px; color:var(--cf-grey); margin:0 0 24px;">We typically respond within 1–2 business days.</p>

                    <div id="contact-msg" style="display:none; padding:12px 16px; border-radius:8px; margin-bottom:18px; font-size:13.5px;"></div>

                    <form id="cf-contact-form" novalidate>
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px; margin-bottom:18px;">
                            <div>
                                <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Full Name *</label>
                                <input type="text" name="fullnames" id="c-fullnames" placeholder="Your full name"
                                    style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none;"
                                    onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required>
                            </div>
                            <div>
                                <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Phone Number</label>
                                <input type="tel" name="phonenumber" id="c-phone" placeholder="+234 8xx xxx xxxx"
                                    style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none;"
                                    onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'">
                            </div>
                        </div>
                        <div style="margin-bottom:18px;">
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Email Address *</label>
                            <input type="email" name="emailaddress" id="c-email" placeholder="your@email.com"
                                style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required>
                        </div>
                        <div style="margin-bottom:18px;">
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Subject *</label>
                            <select name="subject" id="c-subject"
                                style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none; background:white;" required>
                                <option value="">Select a subject</option>
                                <option value="GENERAL ENQUIRY">General Enquiry</option>
                                <option value="STUDENT REGISTRATION">Student Registration</option>
                                <option value="EMPLOYER REGISTRATION">Employer Registration</option>
                                <option value="BOOTH REQUEST">Booth Request</option>
                                <option value="CAREER TALK">Career Talk Request</option>
                                <option value="SPONSORSHIP">Sponsorship / Advertising</option>
                                <option value="TECHNICAL SUPPORT">Technical Support</option>
                                <option value="OTHER">Other</option>
                            </select>
                        </div>
                        <div style="margin-bottom:20px;">
                            <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:6px;">Message *</label>
                            <textarea name="message" id="c-message" rows="5" placeholder="Type your message here..."
                                style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:14px; font-family:var(--cf-font); outline:none; resize:vertical;"
                                onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required></textarea>
                        </div>

                        <!-- Security code -->
                        <div style="display:flex; align-items:center; gap:16px; margin-bottom:22px;">
                            <div style="padding:10px 20px; background:var(--cf-dark); color:white; border-radius:var(--cf-radius); font-size:18px; font-weight:800; letter-spacing:3px; font-family:monospace; flex-shrink:0;">
                                <?php echo isset($capcha2) ? htmlspecialchars($capcha2) : ''; ?>
                            </div>
                            <div style="flex:1;">
                                <label style="display:block; font-size:13px; font-weight:600; color:var(--cf-dark); margin-bottom:5px;">Enter the security code *</label>
                                <input type="text" id="c-capcha" placeholder="Type code above"
                                    style="width:100%; padding:10px 14px; border:1.5px solid var(--cf-border); border-radius:var(--cf-radius); font-size:16px; font-family:monospace; letter-spacing:3px; outline:none;"
                                    onfocus="this.style.borderColor='var(--cf-maroon)'" onblur="this.style.borderColor='var(--cf-border)'" required>
                            </div>
                        </div>

                        <button type="submit" id="contact-btn" class="cf-btn cf-btn-primary" style="width:100%; justify-content:center; font-size:15px; padding:13px;">
                            <i class="fa-solid fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
<script>
$('#cf-contact-form').on('submit', function(e) {
    e.preventDefault();
    var capcha = '<?php echo isset($capcha2) ? htmlspecialchars($capcha2, ENT_QUOTES) : ''; ?>';
    var entered = $('#c-capcha').val().trim();
    if (entered.toLowerCase() !== capcha.toLowerCase()) {
        showCMsg('Security code does not match. Please try again.', 'error'); return;
    }
    var fullnames = $('#c-fullnames').val().trim();
    var email = $('#c-email').val().trim();
    var message = $('#c-message').val().trim();
    if (!fullnames || !email || !message) {
        showCMsg('Please fill in all required fields.', 'error'); return;
    }
    $('#contact-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Sending...').prop('disabled', true);
    $.ajax({
        url: '<?php echo site_url("home/submit_contact"); ?>',
        type: 'POST',
        data: {
            fullnames: fullnames,
            phonenumber: $('#c-phone').val().trim(),
            emailaddress: email,
            subject: $('#c-subject').val(),
            message: message,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success: function(data) {
            if (data == 1) {
                showCMsg('<i class="fa-solid fa-circle-check"></i> Message sent successfully! We will get back to you within 1–2 business days.', 'success');
                $('#cf-contact-form')[0].reset();
            } else {
                showCMsg('Failed to send your message. Please try again.', 'error');
            }
            $('#contact-btn').html('<i class="fa-solid fa-paper-plane"></i> Send Message').prop('disabled', false);
        }
    });
});
function showCMsg(msg, type) {
    var el = document.getElementById('contact-msg');
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
