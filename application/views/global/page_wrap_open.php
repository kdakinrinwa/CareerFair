<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title).' – FUTA Career Fair 2026' : 'FUTA Career Services & Career Fair Portal'; ?></title>
    <?php echo $css; ?>
</head>
<body>
<?php echo $header; ?>
<!-- Page Title Banner -->
<div class="cf-page-title">
    <div class="container">
        <h1><?php echo isset($page_title) ? htmlspecialchars($page_title) : ''; ?></h1>
        <?php if (isset($breadcrumb)): ?>
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <?php foreach ($breadcrumb as $bc): ?>
            <li><?php echo htmlspecialchars($bc); ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</div>
