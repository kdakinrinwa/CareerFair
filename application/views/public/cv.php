<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit CV – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>Submit Your CV</h1>
        <ul class="breadcrumb"><li><a href="<?php echo base_url(); ?>">Home</a></li><li>Submit CV</li></ul>
    </div>
</div>

<section class="cf-section cf-section-bg">
    <div class="container">
        <div style="display:grid; grid-template-columns:1.5fr 1fr; gap:40px; flex-wrap:wrap;" class="row">

            <!-- CV Submission Info -->
            <div style="padding:0 12px;">
                <div class="cf-section-title">
                    <span class="cf-label">Get Discovered by Top Employers</span>
                    <h2>CV Upload &amp; Classification</h2>
                    <p>Your CV is more than a document – it's your first impression. Upload it with the right metadata so employers can find you.</p>
                </div>

                <!-- How it works -->
                <h5 style="font-size:16px; font-weight:700; color:var(--cf-dark); margin:0 0 16px;">How CV Matching Works</h5>
                <div style="display:flex; align-items:flex-start; gap:0; margin-bottom:30px; overflow-x:auto; padding-bottom:8px;">
                    <?php
                    $chain = ['School','Department','Programme','Specialization','Skills','Career Interest','Industry Preference'];
                    foreach ($chain as $i => $step):
                    ?>
                    <div style="display:flex; align-items:center; flex-shrink:0;">
                        <div style="background:<?php echo $i%2===0 ? 'var(--cf-maroon)':'var(--cf-gold)'; ?>; color:<?php echo $i%2===0 ? 'white':'var(--cf-dark)'; ?>; padding:8px 14px; border-radius:50px; font-size:12px; font-weight:700; white-space:nowrap;">
                            <?php echo $step; ?>
                        </div>
                        <?php if ($i < count($chain)-1): ?>
                        <div style="width:20px; height:2px; background:var(--cf-border);"></div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- CV tips -->
                <h5 style="font-size:16px; font-weight:700; color:var(--cf-dark); margin:0 0 14px;">CV Preparation Tips</h5>
                <div style="display:flex; flex-direction:column; gap:10px; margin-bottom:28px;">
                    <?php
                    $tips = [
                        ['Use a clean, professional format – no decorative fonts or tables','fa-check'],
                        ['Keep your CV to 1–2 pages unless you are a postgraduate student','fa-check'],
                        ['List your technical skills clearly: Python, AutoCAD, MATLAB, GIS, etc.','fa-check'],
                        ['Include your matric number, programme and graduation year','fa-check'],
                        ['Upload as PDF – it preserves your formatting across all devices','fa-check'],
                        ['Add your GitHub, LinkedIn or portfolio link for extra visibility','fa-check'],
                    ];
                    foreach ($tips as $t):
                    ?>
                    <div style="display:flex; align-items:center; gap:12px; font-size:13.5px; color:var(--cf-dark);">
                        <i class="fa-solid <?php echo $t[1]; ?>" style="color:var(--cf-maroon); flex-shrink:0;"></i>
                        <?php echo $t[0]; ?>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div style="padding:16px 20px; background:rgba(201,168,76,0.1); border:1px solid rgba(201,168,76,0.3); border-radius:var(--cf-radius); font-size:13.5px; color:var(--cf-dark);">
                    <strong style="color:var(--cf-gold-dark);"><i class="fa-solid fa-lightbulb fa-fw"></i> Note:</strong>
                    CV submissions are reviewed and approved by the Career Services team before being made available to employers. Only students who have consented to CV access will be visible to recruiters.
                </div>
            </div>

            <!-- Upload Form -->
            <div style="padding:0 12px;">
                <div style="background:white; border-radius:var(--cf-radius-lg); box-shadow:var(--cf-shadow-lg); border-top:4px solid var(--cf-maroon); padding:30px; position:sticky; top:90px;">
                    <h4 style="font-size:19px; font-weight:800; color:var(--cf-dark); margin:0 0 6px;">
                        <i class="fa-regular fa-file-lines" style="color:var(--cf-maroon);"></i> Upload Your CV
                    </h4>
                    <p style="font-size:13px; color:var(--cf-grey); margin:0 0 22px;">You must be logged in as a student to submit your CV.</p>

                    <div style="padding:20px; background:var(--cf-grey-light); border-radius:var(--cf-radius); text-align:center; margin-bottom:20px; border:2px dashed var(--cf-border);">
                        <i class="fa-regular fa-file-pdf" style="font-size:40px; color:var(--cf-maroon); margin-bottom:12px;"></i>
                        <p style="font-size:14px; font-weight:600; color:var(--cf-dark); margin:0 0 6px;">PDF or DOCX format</p>
                        <p style="font-size:12px; color:var(--cf-grey); margin:0;">Maximum file size: 5MB</p>
                    </div>

                    <a href="<?php echo base_url(); ?>home/login" class="cf-btn cf-btn-primary" style="width:100%; justify-content:center; margin-bottom:12px; font-size:15px; padding:13px;">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Login to Upload CV
                    </a>
                    <a href="<?php echo base_url(); ?>home/register/student" class="cf-btn cf-btn-outline" style="width:100%; justify-content:center;">
                        <i class="fa-solid fa-user-plus"></i> Create Student Account
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<?php echo $footer; ?>
<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top"><i class="fa-solid fa-arrow-up"></i></button>
<?php echo $js; ?>
</body>
</html>
