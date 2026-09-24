<!DOCTYPE html>
<html lang="en">
<head>
    <title>Photo Gallery – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
    <style>
    .album-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; }
    .album-card { border-radius:12px; overflow:hidden; position:relative; aspect-ratio:1; box-shadow:0 2px 12px rgba(0,0,0,.1); transition:transform .3s, box-shadow .3s; }
    .album-card:hover { transform:translateY(-4px); box-shadow:0 8px 28px rgba(107,14,32,.16); }
    .album-card img { width:100%; height:100%; object-fit:cover; display:block; transition:transform .5s; }
    .album-card:hover img { transform:scale(1.06); }
    .album-card-overlay { position:absolute; inset:0; background:linear-gradient(180deg,transparent 40%,rgba(0,0,0,.82)); display:flex; align-items:flex-end; padding:16px; opacity:0; transition:opacity .3s; }
    .album-card:hover .album-card-overlay { opacity:1; }
    .album-card-title { font-size:14px; font-weight:700; color:#fff; line-height:1.3; }
    .album-card-sub   { font-size:11.5px; color:rgba(255,255,255,.7); margin-top:4px; }
    @media(max-width:900px){ .album-grid { grid-template-columns:repeat(3,1fr); } }
    @media(max-width:600px){ .album-grid { grid-template-columns:repeat(2,1fr); } }
    </style>
</head>
<body>

<?php echo $header; ?>

<div class="cf-page-title">
    <div class="container">
        <h1>Photo Gallery</h1>
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li>Gallery</li>
        </ul>
    </div>
</div>

<section style="padding:60px 0; background:#F8F6F0;">
    <div class="container">

        <div style="margin-bottom:36px;">
            <div style="display:inline-flex; align-items:center; gap:8px; font-size:11.5px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#a88635; margin-bottom:8px;">
                <span style="width:16px; height:2px; background:#C9A84C; display:inline-block;"></span>
                Memories &amp; Highlights
            </div>
            <h2 style="font-size:clamp(22px,3.2vw,34px); font-weight:800; color:#1A1A2E; margin:0;">
                FUTA Career Services Gallery
            </h2>
        </div>

        <?php if (isset($albums) && !empty($albums)): ?>
        <div class="album-grid">
            <?php foreach ($albums as $i => $row): ?>
            <a href="<?php echo base_url(); ?>home/aalbum/<?php echo $row->slid; ?>"
               class="album-card wow fadeInUp" data-wow-delay="<?php echo ($i % 4) * 60; ?>ms"
               aria-label="<?php echo htmlspecialchars($row->projecttitle); ?>">
                <?php if (!empty($row->file)): ?>
                <img src="<?php echo base_url(); ?>uploads/<?php echo htmlspecialchars($row->file); ?>"
                     alt="<?php echo htmlspecialchars($row->projecttitle); ?>"
                     loading="lazy">
                <?php else: ?>
                <div style="width:100%;height:100%;background:linear-gradient(135deg,#1A1A2E,#6B0E20);display:flex;align-items:center;justify-content:center;">
                    <i class="fa-regular fa-images" style="font-size:40px;color:rgba(255,255,255,.3);"></i>
                </div>
                <?php endif; ?>
                <div class="album-card-overlay">
                    <div>
                        <div class="album-card-title"><?php echo htmlspecialchars($row->projecttitle); ?></div>
                        <?php if (!empty($row->longtitle)): ?>
                        <div class="album-card-sub"><?php echo htmlspecialchars(substr($row->longtitle, 0, 55)); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center; padding:60px 20px; background:#fff; border-radius:14px;">
            <i class="fa-regular fa-images" style="font-size:56px; color:#6B0E20; opacity:.3; display:block; margin-bottom:16px;"></i>
            <h3 style="font-weight:700; color:#1A1A2E;">No Albums Yet</h3>
            <p style="font-size:15px; color:#6c757d; max-width:380px; margin:0 auto;">
                Photo albums from career events will appear here as they are added.
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
