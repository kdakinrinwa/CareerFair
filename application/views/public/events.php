<!DOCTYPE html>
<html lang="en">
<head>
    <title>News &amp; Events – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
    <style>
    .events-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; }
    .ev-card { background:#fff; border-radius:14px; overflow:hidden; box-shadow:0 2px 14px rgba(0,0,0,.07); display:flex; flex-direction:column; transition:transform .3s, box-shadow .3s; }
    .ev-card:hover { transform:translateY(-5px); box-shadow:0 10px 28px rgba(107,14,32,.12); }
    .ev-card-img { height:185px; overflow:hidden; position:relative; }
    .ev-card-img img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .ev-card:hover .ev-card-img img { transform:scale(1.05); }
    .ev-card-date {
        position:absolute; top:14px; left:14px;
        background:#6B0E20; color:#fff;
        border-radius:8px; padding:7px 12px; text-align:center; min-width:46px;
    }
    .ev-card-date .day  { font-size:22px; font-weight:900; line-height:1; }
    .ev-card-date .mon  { font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1px; }
    .ev-card-date .year { font-size:10px; opacity:.75; }
    .ev-cat { display:inline-block; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:700; background:rgba(107,14,32,.1); color:#6B0E20; margin-bottom:8px; }
    .ev-card-body { padding:18px 20px 22px; flex:1; display:flex; flex-direction:column; }
    .ev-card-body h4 { font-size:16px; font-weight:800; color:#1A1A2E; margin:0 0 8px; line-height:1.4; }
    .ev-card-body h4 a { color:inherit; text-decoration:none; }
    .ev-card-body h4 a:hover { color:#6B0E20; }
    .ev-card-body p { font-size:13px; color:#6c757d; flex:1; margin:0 0 14px; line-height:1.65; }
    .ev-read-more { display:inline-flex; align-items:center; gap:5px; font-size:13px; font-weight:700; color:#6B0E20; text-decoration:none; transition:color .2s; }
    .ev-read-more:hover { color:#a88635; }
    .ev-read-more i { transition:transform .2s; }
    .ev-read-more:hover i { transform:translateX(4px); }
    @media(max-width:900px){ .events-grid { grid-template-columns:repeat(2,1fr); } }
    @media(max-width:576px){ .events-grid { grid-template-columns:1fr; } }
    </style>
</head>
<body>

<?php echo $header; ?>

<!-- Page Title -->
<div class="cf-page-title">
    <div class="container">
        <h1>News &amp; Events</h1>
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li>News &amp; Events</li>
        </ul>
    </div>
</div>

<section style="padding:60px 0; background:#F8F6F0;">
    <div class="container">

        <!-- Section header -->
        <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:36px; flex-wrap:wrap; gap:14px;">
            <div>
                <div style="display:inline-flex; align-items:center; gap:8px; font-size:11.5px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#a88635; margin-bottom:8px;">
                    <span style="width:16px; height:2px; background:#C9A84C; display:inline-block;"></span>
                    Stay Informed
                </div>
                <h2 style="font-size:clamp(22px,3.2vw,34px); font-weight:800; color:#1A1A2E; margin:0;">
                    FUTA Career Fair News &amp; Announcements
                </h2>
            </div>
            <a href="<?php echo base_url(); ?>home/careerfair" style="display:inline-flex; align-items:center; gap:7px; padding:9px 20px; background:#6B0E20; color:#fff; border-radius:50px; font-size:13.5px; font-weight:700; text-decoration:none;">
                <i class="fa-regular fa-calendar-days"></i> View Fair Schedule
            </a>
        </div>

        <?php if (isset($events) && !empty($events)): ?>
        <div class="events-grid">
            <?php foreach ($events as $i => $row): ?>
            <div class="ev-card wow fadeInUp" data-wow-delay="<?php echo ($i % 3) * 80; ?>ms">
                <div class="ev-card-img">
                    <?php if (!empty($row->thumbnail)): ?>
                    <img src="<?php echo base_url().'uploads/'.htmlspecialchars($row->thumbnail); ?>"
                         alt="<?php echo htmlspecialchars($row->title); ?>"
                         loading="lazy">
                    <?php else: ?>
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#6B0E20,#4a0915);display:flex;align-items:center;justify-content:center;">
                        <i class="fa-regular fa-calendar-days" style="font-size:52px;color:rgba(255,255,255,.3);"></i>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($row->eventday)): ?>
                    <div class="ev-card-date">
                        <div class="day"><?php echo date('d', strtotime($row->eventday)); ?></div>
                        <div class="mon"><?php echo date('M', strtotime($row->eventday)); ?></div>
                        <div class="year"><?php echo date('Y', strtotime($row->eventday)); ?></div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="ev-card-body">
                    <span class="ev-cat"><?php echo htmlspecialchars($row->category ?? 'News'); ?></span>
                    <h4>
                        <a href="<?php echo site_url('home/viewevent').'/'.$row->newsid; ?>">
                            <?php echo htmlspecialchars(substr($row->title, 0, 70)); ?>
                        </a>
                    </h4>
                    <?php if (!empty($row->body)): ?>
                    <p><?php echo htmlspecialchars(substr(strip_tags($row->body), 0, 110)).'...'; ?></p>
                    <?php endif; ?>
                    <a href="<?php echo site_url('home/viewevent').'/'.$row->newsid; ?>" class="ev-read-more">
                        Read More <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center; padding:60px 20px; background:#fff; border-radius:14px;">
            <i class="fa-regular fa-newspaper" style="font-size:56px; color:#6B0E20; opacity:.3; display:block; margin-bottom:16px;"></i>
            <h3 style="font-weight:700; color:#1A1A2E;">No News or Events Yet</h3>
            <p style="font-size:15px; color:#6c757d; max-width:420px; margin:0 auto;">
                Announcements and events will appear here as the Career Fair 2026 approaches. Check back soon.
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
