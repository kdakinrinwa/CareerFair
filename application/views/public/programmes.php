<!DOCTYPE html>
<html lang="en">
<head>
    <title>Career Resources – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
    <style>
    .prog-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
    .prog-card {
        background:#fff; border-radius:14px; overflow:hidden;
        box-shadow:0 2px 16px rgba(0,0,0,.07);
        transition:transform .3s, box-shadow .3s;
        display:flex; flex-direction:column;
    }
    .prog-card:hover { transform:translateY(-6px); box-shadow:0 10px 32px rgba(107,14,32,.14); }
    .prog-card-img { height:200px; overflow:hidden; position:relative; }
    .prog-card-img img { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
    .prog-card:hover .prog-card-img img { transform:scale(1.06); }
    .prog-card-img-fallback {
        width:100%; height:100%;
        background:linear-gradient(135deg,#6B0E20,#4a0915);
        display:flex; align-items:center; justify-content:center;
        font-size:48px; color:rgba(255,255,255,.3);
    }
    .prog-card-body { padding:20px 22px 24px; flex:1; display:flex; flex-direction:column; }
    .prog-card-body h4 { font-size:18px; font-weight:800; color:#1A1A2E; margin:0 0 10px; line-height:1.3; }
    .prog-card-body p  { font-size:13.5px; color:#6c757d; line-height:1.7; flex:1; margin:0 0 16px; }
    .prog-link { display:inline-flex; align-items:center; gap:6px; padding:9px 20px; background:#6B0E20; color:#fff; border-radius:50px; font-size:13.5px; font-weight:700; text-decoration:none; transition:all .2s; }
    .prog-link:hover { background:#4a0915; transform:translateY(-1px); color:#fff; }
    @media(max-width:900px){ .prog-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:576px){ .prog-grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>

<?php echo $header; ?>

<!-- Page Title -->
<div class="cf-page-title">
    <div class="container">
        <h1>Career Resources</h1>
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li>Career Resources</li>
        </ul>
    </div>
</div>

<!-- Intro strip -->
<div style="background:#F8F6F0; padding:28px 0; border-bottom:1px solid #e8e8e8;">
    <div class="container">
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <div>
                <h2 style="font-size:22px; font-weight:800; color:#1A1A2E; margin:0 0 4px;">
                    Programmes &amp; Career Services
                </h2>
                <p style="font-size:14px; color:#6c757d; margin:0;">
                    Explore the services and programmes offered by the FUTA Centre for Career Services.
                </p>
            </div>
            <a href="<?php echo base_url(); ?>home/register/student" style="display:inline-flex; align-items:center; gap:7px; padding:10px 22px; background:#6B0E20; color:#fff; border-radius:50px; font-size:14px; font-weight:700; text-decoration:none;">
                <i class="fa-solid fa-graduation-cap"></i> Register as Student
            </a>
        </div>
    </div>
</div>

<!-- Programmes grid -->
<section style="padding:60px 0;">
    <div class="container">
        <?php if (isset($progr) && !empty($progr)): ?>
        <div class="prog-grid">
            <?php foreach ($progr as $row): ?>
            <div class="prog-card wow fadeInUp">
                <div class="prog-card-img">
                    <?php if (!empty($row->image)): ?>
                    <img src="<?php echo base_url().'uploads/'.htmlspecialchars($row->image); ?>"
                         alt="<?php echo htmlspecialchars($row->title); ?>"
                         loading="lazy">
                    <?php else: ?>
                    <div class="prog-card-img-fallback">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="prog-card-body">
                    <h4><?php echo htmlspecialchars($row->title); ?></h4>
                    <p><?php echo !empty($row->description) ? htmlspecialchars(substr($row->description, 0, 160)).'...' : 'Click to learn more about this career programme and how it can benefit your career journey.'; ?></p>
                    <a href="<?php echo base_url(); ?>home/aprogramme/<?php echo $row->service_id; ?>" class="prog-link">
                        Learn More <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center; padding:60px 20px; color:#6c757d;">
            <i class="fa-solid fa-briefcase" style="font-size:56px; opacity:.3; display:block; margin-bottom:16px;"></i>
            <h3 style="font-weight:700; color:#1A1A2E;">No Programmes Listed Yet</h3>
            <p style="font-size:15px; max-width:400px; margin:0 auto 24px;">
                Career programmes will appear here once added by the Career Services team.
            </p>
            <a href="<?php echo base_url(); ?>home/contact" style="display:inline-flex; align-items:center; gap:7px; padding:10px 24px; background:#6B0E20; color:#fff; border-radius:50px; font-size:14px; font-weight:700; text-decoration:none;">
                <i class="fa-regular fa-envelope"></i> Contact Career Services
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php echo $footer; ?>

<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>
<?php echo $js; ?>
</body>
</html>
