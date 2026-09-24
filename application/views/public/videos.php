<!DOCTYPE html>
<html lang="en">
<head>
    <title>Videos – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
    <style>
    .video-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:28px; }
    .video-wrap { border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,.12); background:#000; position:relative; aspect-ratio:16/9; }
    .video-wrap iframe { position:absolute; inset:0; width:100%; height:100%; border:0; }
    .video-desc { padding:14px 16px; background:#fff; border-radius:0 0 12px 12px; font-size:13.5px; font-weight:600; color:#1A1A2E; }
    @media(max-width:768px){ .video-grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>

<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>Videos</h1>
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li>Videos</li>
        </ul>
    </div>
</div>

<section style="padding:60px 0; background:#F8F6F0;">
    <div class="container">

        <div style="margin-bottom:36px;">
            <div style="display:inline-flex; align-items:center; gap:8px; font-size:11.5px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#a88635; margin-bottom:8px;">
                <span style="width:16px; height:2px; background:#C9A84C; display:inline-block;"></span>
                Watch &amp; Learn
            </div>
            <h2 style="font-size:clamp(22px,3.2vw,34px); font-weight:800; color:#1A1A2E; margin:0;">
                FUTA Career Services Videos
            </h2>
        </div>

        <?php if (isset($video) && !empty($video)): ?>
        <div class="video-grid">
            <?php foreach ($video as $row): ?>
            <div class="wow fadeInUp">
                <div class="video-wrap">
                    <iframe
                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($row->videocode); ?>?rel=0"
                        title="<?php echo htmlspecialchars($row->description ?? 'FUTA Career Services Video'); ?>"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                        loading="lazy">
                    </iframe>
                </div>
                <?php if (!empty($row->description)): ?>
                <div class="video-desc">
                    <i class="fa-brands fa-youtube" style="color:#ff0000; margin-right:7px;"></i>
                    <?php echo htmlspecialchars($row->description); ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center; padding:60px 20px; background:#fff; border-radius:14px;">
            <i class="fa-brands fa-youtube" style="font-size:56px; color:#ff0000; opacity:.4; display:block; margin-bottom:16px;"></i>
            <h3 style="font-weight:700; color:#1A1A2E;">No Videos Yet</h3>
            <p style="font-size:15px; color:#6c757d; max-width:400px; margin:0 auto;">
                Career fair videos and talks will appear here once published.
            </p>
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
