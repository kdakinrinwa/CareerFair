<!DOCTYPE html>
<html lang="en">
<head><title>Error – FUTA Admin</title>
<?php echo (class_exists('CI_Controller') && method_exists(get_instance(), 'load')) ? get_instance()->load->view('admin/admin_css','',TRUE) : ''; ?>
</head>
<body class="portal-body admin-body" style="display:flex;align-items:center;justify-content:center;min-height:100vh;">
    <div style="text-align:center;padding:40px;">
        <div style="font-size:80px;font-weight:900;color:#6B0E20;line-height:1;margin-bottom:16px;">404</div>
        <h2 style="font-size:22px;font-weight:800;color:#1A1A2E;margin:0 0 10px;">Page Not Found</h2>
        <p style="font-size:14.5px;color:#6c757d;margin:0 0 24px;">The admin page you requested does not exist.</p>
        <a href="<?php echo base_url(); ?>admin/dashboard" style="display:inline-flex;align-items:center;gap:8px;padding:11px 24px;background:#6B0E20;color:#fff;border-radius:8px;font-size:14px;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-house"></i> Admin Dashboard
        </a>
    </div>
</body>
</html>
