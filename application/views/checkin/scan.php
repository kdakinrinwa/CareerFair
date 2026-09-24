<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>QR Scanner – FUTA Career Fair 2026</title>
    <link href="<?php echo base_url(); ?>assetsp/css/fa-icons.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url(); ?>assetsp/images/logo.png">
    <style>
    * { box-sizing:border-box; margin:0; padding:0; }

    body {
        font-family: 'DM Sans', -apple-system, sans-serif;
        background: #0f172a;
        color: #fff;
        height: 100vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    /* ── Top bar ─────────────────────────────────── */
    .scan-topbar {
        height: 52px;
        background: rgba(0,0,0,.6);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
        flex-shrink: 0;
        z-index: 20;
        border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .scan-topbar-left { display:flex; align-items:center; gap:10px; }
    .scan-topbar-logo { height:30px; width:auto; }
    .scan-topbar-title { font-size:14px; font-weight:700; color:#C9A84C; }
    .scan-topbar-sub   { font-size:11px; color:rgba(255,255,255,.5); }
    .scan-topbar-right { display:flex; align-items:center; gap:10px; }
    .scan-nav-btn {
        display:inline-flex; align-items:center; gap:6px;
        padding:6px 12px; border-radius:8px;
        font-size:12px; font-weight:700; cursor:pointer;
        border:none; text-decoration:none;
    }
    .scan-nav-btn-light { background:rgba(255,255,255,.1); color:#fff; }
    .scan-nav-btn-gold  { background:#C9A84C; color:#1A1A2E; }
    .scan-nav-btn:hover { opacity:.85; }

    /* ── Camera viewport ────────────────────────── */
    .scan-camera-wrap {
        position: relative;
        flex: 1;
        overflow: hidden;
        background: #000;
    }
    #camera-video {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
    }
    #camera-canvas { display: none; }  /* hidden – used for frame capture */

    /* Scanning overlay */
    .scan-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }
    .scan-frame {
        width: min(260px, 65vw);
        height: min(260px, 65vw);
        position: relative;
    }
    /* Corner brackets */
    .scan-frame::before,
    .scan-frame::after,
    .scan-corner-bl,
    .scan-corner-br {
        content: '';
        position: absolute;
        width: 28px; height: 28px;
        border-color: #C9A84C;
        border-style: solid;
    }
    .scan-frame::before  { top:0;    left:0;  border-width:4px 0 0 4px; }
    .scan-frame::after   { top:0;    right:0; border-width:4px 4px 0 0; }
    .scan-corner-bl      { bottom:0; left:0;  border-width:0 0 4px 4px; }
    .scan-corner-br      { bottom:0; right:0; border-width:0 4px 4px 0; }

    /* Scan laser line animation */
    .scan-laser {
        position: absolute;
        left: 8px; right: 8px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #6B0E20, #C9A84C, #6B0E20, transparent);
        animation: laser 2.5s linear infinite;
        box-shadow: 0 0 8px rgba(201,168,76,.7);
    }
    @keyframes laser {
        0%   { top: 8px;   }
        100% { top: calc(100% - 10px); }
    }

    /* Status text beneath frame */
    .scan-status-text {
        position: absolute;
        bottom: 80px; left: 0; right: 0;
        text-align: center;
        font-size: 13px;
        color: rgba(255,255,255,.7);
        font-weight: 600;
    }
    .scan-status-text .pulse {
        animation: txt-pulse 1.5s ease-in-out infinite;
    }
    @keyframes txt-pulse { 0%,100%{opacity:1} 50%{opacity:.4} }

    /* Camera error state */
    .scan-cam-error {
        position: absolute; inset:0;
        display:flex; flex-direction:column;
        align-items:center; justify-content:center;
        background:#1a1a2e; text-align:center;
        padding:30px; gap:14px;
    }
    .scan-cam-error i   { font-size:52px; color:#6B0E20; opacity:.6; }
    .scan-cam-error h3  { font-size:17px; font-weight:700; }
    .scan-cam-error p   { font-size:13.5px; color:rgba(255,255,255,.6); max-width:300px; }
    .scan-cam-error button {
        padding:10px 24px; background:#6B0E20; color:#fff;
        border:none; border-radius:50px; font-size:14px;
        font-weight:700; cursor:pointer;
    }

    /* ── Result overlay ─────────────────────────── */
    .scan-result {
        position: absolute;
        inset: 0;
        display: none;         /* shown by JS */
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,.82);
        z-index: 10;
        animation: fade-in .2s ease;
    }
    .scan-result.show { display:flex; }
    @keyframes fade-in { from{opacity:0;transform:scale(.95)} to{opacity:1;transform:scale(1)} }

    .result-card {
        background: #fff;
        border-radius: 18px;
        width: min(340px, 92vw);
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,.6);
        position: relative;
    }
    .result-card-header {
        padding: 18px 20px 14px;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .result-card-header.success  { background: linear-gradient(135deg,#065f46,#047857); }
    .result-card-header.warning  { background: linear-gradient(135deg,#92400e,#b45309); }
    .result-card-header.error    { background: linear-gradient(135deg,#7f1d1d,#991b1b); }
    .result-card-header.neutral  { background: linear-gradient(135deg,#1e40af,#1d4ed8); }

    .result-photo {
        width: 64px; height: 64px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid rgba(255,255,255,.4);
        background: rgba(255,255,255,.15);
        flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 26px; color: rgba(255,255,255,.7);
    }
    .result-photo img { width:100%; height:100%; object-fit:cover; }

    .result-header-text { flex:1; }
    .result-status-icon { font-size:22px; }
    .result-status-msg  { font-size:15px; font-weight:800; color:#fff; margin-bottom:3px; }
    .result-time        { font-size:11.5px; color:rgba(255,255,255,.65); }

    .result-body { padding:16px 20px 18px; }
    .result-name {
        font-size:19px; font-weight:900; color:#1A1A2E; margin-bottom:4px;
    }
    .result-detail { font-size:13px; color:#6c757d; margin-bottom:10px; line-height:1.5; }
    .result-type {
        display:inline-flex; align-items:center; gap:6px;
        padding:4px 12px; border-radius:20px;
        font-size:12px; font-weight:700;
        text-transform:uppercase; letter-spacing:1px;
    }
    .result-type.student  { background:rgba(107,14,32,.1); color:#6B0E20; }
    .result-type.employer { background:rgba(201,168,76,.15); color:#a88635; }
    .result-type.alumni   { background:rgba(59,130,246,.12); color:#1d4ed8; }

    .result-pass-code {
        margin-top:10px;
        font-family:monospace; font-size:12px; color:#6c757d;
        background:#f5f5f5; padding:5px 10px; border-radius:6px;
        display:inline-block; letter-spacing:.5px;
    }

    .result-close-bar {
        background:#f5f5f5;
        padding:10px 20px;
        display:flex; align-items:center; justify-content:space-between;
    }
    .result-auto-close { font-size:12px; color:#6c757d; }
    .result-close-btn {
        background:#6B0E20; color:#fff;
        border:none; border-radius:8px;
        padding:7px 16px; font-size:13px; font-weight:700;
        cursor:pointer;
    }

    /* ── Bottom controls ────────────────────────── */
    .scan-bottom {
        height: 64px;
        background: rgba(0,0,0,.8);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 0 16px;
        flex-shrink: 0;
        border-top: 1px solid rgba(255,255,255,.08);
    }
    .scan-count {
        display:flex; flex-direction:column; align-items:center;
        font-size:11px; font-weight:700; color:rgba(255,255,255,.5);
    }
    .scan-count-num {
        font-size:22px; font-weight:900; line-height:1;
        color:#C9A84C;
    }
    .scan-toggle-cam {
        display:flex; flex-direction:column; align-items:center;
        gap:4px; cursor:pointer;
        background:rgba(255,255,255,.08);
        border:none; color:rgba(255,255,255,.7);
        border-radius:12px; padding:8px 16px;
        font-size:11px; font-weight:700;
    }
    .scan-toggle-cam i { font-size:20px; }
    .scan-toggle-cam:hover { background:rgba(255,255,255,.15); }
    .scan-officer-name {
        display:flex; flex-direction:column; align-items:center;
        font-size:10.5px; color:rgba(255,255,255,.4);
    }
    .scan-officer-name span { color:rgba(255,255,255,.75); font-weight:700; font-size:12px; }

    /* Progress bar for auto-close countdown */
    .result-progress {
        height: 3px;
        background: rgba(107,14,32,.3);
        position: relative;
        overflow: hidden;
    }
    .result-progress-fill {
        height:100%;
        background: #6B0E20;
        transition: width linear;
    }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<!-- Top bar -->
<div class="scan-topbar">
    <div class="scan-topbar-left">
        <img src="<?php echo base_url(); ?>assetsp/images/logo.png" alt="FUTA" class="scan-topbar-logo">
        <div>
            <div class="scan-topbar-title">FUTA Career Fair 2026</div>
            <div class="scan-topbar-sub">QR Check-in Scanner</div>
        </div>
    </div>
    <div class="scan-topbar-right">
        <a href="<?php echo base_url(); ?>checkin/attendance" class="scan-nav-btn scan-nav-btn-light" target="_blank">
            <i class="fa-solid fa-users"></i> Attendance
        </a>
        <a href="<?php echo base_url(); ?>checkin/logout" class="scan-nav-btn scan-nav-btn-light">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </a>
    </div>
</div>

<!-- Camera -->
<div class="scan-camera-wrap" id="camera-wrap">
    <video id="camera-video" playsinline muted autoplay></video>
    <canvas id="camera-canvas"></canvas>

    <!-- Scan frame overlay -->
    <div class="scan-overlay">
        <div class="scan-frame" id="scan-frame">
            <div class="scan-corner-bl"></div>
            <div class="scan-corner-br"></div>
            <div class="scan-laser" id="scan-laser"></div>
        </div>
    </div>

    <!-- Status text -->
    <div class="scan-status-text">
        <span class="pulse" id="scan-hint">Align QR code within the frame</span>
    </div>

    <!-- Camera error -->
    <div class="scan-cam-error" id="cam-error" style="display:none;">
        <i class="fa-solid fa-video-slash"></i>
        <h3>Camera Access Required</h3>
        <p id="cam-error-msg">Please allow camera access to use the QR scanner. Open this page in Chrome or Safari on your phone or tablet.</p>
        <button onclick="startCamera()"><i class="fa-solid fa-rotate-right"></i> Retry</button>
    </div>

    <!-- Result overlay -->
    <div class="scan-result" id="scan-result">
        <div class="result-card" id="result-card">
            <div class="result-progress"><div class="result-progress-fill" id="result-progress-fill" style="width:100%;"></div></div>
            <div class="result-card-header success" id="result-header">
                <div class="result-photo" id="result-photo">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="result-header-text">
                    <div class="result-status-icon" id="result-icon">✓</div>
                    <div class="result-status-msg"  id="result-msg">Checked In!</div>
                    <div class="result-time"        id="result-time"></div>
                </div>
            </div>
            <div class="result-body">
                <div class="result-name"   id="result-name">Name</div>
                <div class="result-detail" id="result-detail">Detail</div>
                <div>
                    <span class="result-type student" id="result-type">STUDENT</span>
                </div>
                <div class="result-pass-code" id="result-pass-code"></div>
            </div>
            <div class="result-close-bar">
                <span class="result-auto-close" id="result-auto-close">Closes in 4s</span>
                <button class="result-close-btn" onclick="resetScanner()">
                    <i class="fa-solid fa-qrcode"></i> Scan Next
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bottom controls -->
<div class="scan-bottom">
    <div class="scan-count">
        <div class="scan-count-num" id="total-scans">0</div>
        <div>Scanned Today</div>
    </div>
    <button class="scan-toggle-cam" id="toggle-cam-btn" onclick="switchCamera()">
        <i class="fa-solid fa-camera-rotate"></i>
        Switch Cam
    </button>
    <div class="scan-officer-name">
        Officer
        <span><?php echo htmlspecialchars(($officer['fullname'] ?? $officer['username'] ?? 'Staff')); ?></span>
    </div>
</div>

<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/jsQR.js"></script>
<script>
/* ============================================================
   FUTA Career Fair 2026 – QR Scanner
   Uses jsQR (local, offline-capable) + getUserMedia camera API
============================================================ */

var video       = document.getElementById('camera-video');
var canvas      = document.getElementById('camera-canvas');
var ctx         = canvas.getContext('2d');
var scanning    = true;       // false while showing result
var facingMode  = 'environment'; // rear camera default
var stream      = null;
var totalScans  = 0;
var closeTimer  = null;
var progressInt = null;
var lastCode    = '';         // debounce: ignore same code within 3s
var lastCodeTs  = 0;

var CSRF_NAME  = '<?php echo $this->security->get_csrf_token_name(); ?>';
var CSRF_TOKEN = '<?php echo $this->security->get_csrf_hash(); ?>';
var VERIFY_URL = '<?php echo site_url("checkin/verify"); ?>';

/* ── Start camera ───────────────────────────────────────── */
function startCamera() {
    document.getElementById('cam-error').style.display = 'none';
    if (stream) { stream.getTracks().forEach(function(t){ t.stop(); }); }

    var constraints = {
        video: {
            facingMode: facingMode,
            width:  { ideal: 1280 },
            height: { ideal: 720 }
        }
    };

    navigator.mediaDevices.getUserMedia(constraints)
        .then(function(s) {
            stream = s;
            video.srcObject = s;
            video.play();
            requestAnimationFrame(scanFrame);
        })
        .catch(function(err) {
            console.error(err);
            var msg = err.name === 'NotAllowedError'
                ? 'Camera permission denied. Tap the camera icon in your browser address bar to allow access.'
                : err.name === 'NotFoundError'
                    ? 'No camera found on this device.'
                    : 'Camera error: ' + err.message;
            document.getElementById('cam-error-msg').textContent = msg;
            document.getElementById('cam-error').style.display = 'flex';
        });
}

/* ── Switch between front and rear camera ───────────────── */
function switchCamera() {
    facingMode = facingMode === 'environment' ? 'user' : 'environment';
    startCamera();
}

/* ── Capture frame and decode with jsQR ─────────────────── */
function scanFrame() {
    requestAnimationFrame(scanFrame);

    if (!scanning) return;
    if (video.readyState !== video.HAVE_ENOUGH_DATA) return;

    canvas.width  = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    var code = jsQR(imageData.data, imageData.width, imageData.height, {
        inversionAttempts: 'dontInvert'
    });

    if (code && code.data) {
        var now = Date.now();
        // Debounce: ignore same code scanned within 3 seconds
        if (code.data === lastCode && (now - lastCodeTs) < 3000) return;
        lastCode   = code.data;
        lastCodeTs = now;

        handleCode(code.data);
    }
}

/* ── Send code to server ────────────────────────────────── */
function handleCode(code) {
    scanning = false;
    document.getElementById('scan-hint').textContent = 'Verifying…';
    document.getElementById('scan-laser').style.animationPlayState = 'paused';

    var data = {};
    data[CSRF_NAME] = CSRF_TOKEN;
    data.pass_code  = code;
    data.location   = 'Main Entrance';

    $.ajax({
        url:  VERIFY_URL,
        type: 'POST',
        data: data,
        dataType: 'json',
        timeout: 8000,
        success: function(r) {
            CSRF_TOKEN = r.token;   // refresh CSRF token
            if (r.result === 1) {
                showResult(r);
                totalScans++;
                document.getElementById('total-scans').textContent = totalScans;
            } else {
                showError(r.message || 'Invalid or unrecognised pass');
            }
        },
        error: function() {
            showError('Server unreachable. Check network connection.');
        }
    });
}

/* ── Show success/warning result card ───────────────────── */
function showResult(r) {
    var header   = document.getElementById('result-header');
    var icon     = document.getElementById('result-icon');
    var msg      = document.getElementById('result-msg');
    var photoEl  = document.getElementById('result-photo');
    var nameEl   = document.getElementById('result-name');
    var detailEl = document.getElementById('result-detail');
    var typeEl   = document.getElementById('result-type');
    var codeEl   = document.getElementById('result-pass-code');
    var timeEl   = document.getElementById('result-time');

    // Color
    header.className = 'result-card-header ' + (r.already_in ? 'warning' : 'success');
    icon.textContent = r.already_in ? '↩' : '✓';
    msg.textContent  = r.already_in ? 'Welcome Back' : 'Checked In!';
    timeEl.textContent = r.time || new Date().toLocaleTimeString();

    // Photo
    if (r.photo) {
        photoEl.innerHTML = '<img src="' + r.photo + '" alt="" onerror="this.parentNode.innerHTML=\'<i class=fa-regular fa-user></i>\'">';
    } else {
        photoEl.innerHTML = '<i class="fa-regular fa-user"></i>';
    }

    nameEl.textContent   = r.name;
    detailEl.textContent = r.detail;

    // Type badge
    var typeMap = { student:'student', employer:'employer', alumni:'alumni' };
    typeEl.className    = 'result-type ' + (typeMap[r.user_type] || 'student');
    typeEl.textContent  = (r.user_type || 'student').toUpperCase();

    codeEl.textContent  = r.pass_code || '';

    showResultCard(4000);   // auto-close in 4 seconds
}

/* ── Show error card ────────────────────────────────────── */
function showError(message) {
    var header = document.getElementById('result-header');
    var icon   = document.getElementById('result-icon');
    var msg    = document.getElementById('result-msg');
    var nameEl = document.getElementById('result-name');
    var detEl  = document.getElementById('result-detail');
    var typeEl = document.getElementById('result-type');
    var codeEl = document.getElementById('result-pass-code');
    var timeEl = document.getElementById('result-time');

    header.className  = 'result-card-header error';
    icon.textContent  = '✗';
    msg.textContent   = 'Check-in Failed';
    timeEl.textContent= new Date().toLocaleTimeString();
    nameEl.textContent= message;
    detEl.textContent = 'Please ask the student to contact the check-in desk.';
    typeEl.className  = 'result-type student';
    typeEl.textContent= 'UNKNOWN';
    codeEl.textContent= '';
    document.getElementById('result-photo').innerHTML = '<i class="fa-solid fa-triangle-exclamation"></i>';

    showResultCard(5000);
}

/* ── Common: show result overlay, start auto-close ─────── */
function showResultCard(ms) {
    var resultEl = document.getElementById('scan-result');
    var fill     = document.getElementById('result-progress-fill');
    var autoTxt  = document.getElementById('result-auto-close');

    resultEl.classList.add('show');
    fill.style.transition = 'none';
    fill.style.width = '100%';

    // Trigger reflow so transition applies from 100% → 0%
    fill.getBoundingClientRect();
    fill.style.transition = 'width ' + ms + 'ms linear';
    fill.style.width = '0%';

    var secs = Math.ceil(ms / 1000);
    clearInterval(progressInt);
    progressInt = setInterval(function(){
        secs--;
        autoTxt.textContent = 'Closes in ' + secs + 's';
        if (secs <= 0) clearInterval(progressInt);
    }, 1000);

    clearTimeout(closeTimer);
    closeTimer = setTimeout(resetScanner, ms);
}

/* ── Reset scanner for next person ─────────────────────── */
function resetScanner() {
    clearTimeout(closeTimer);
    clearInterval(progressInt);
    document.getElementById('scan-result').classList.remove('show');
    scanning = true;
    lastCode = '';
    document.getElementById('scan-hint').textContent = 'Align QR code within the frame';
    document.getElementById('scan-laser').style.animationPlayState = 'running';
}

/* ── Boot ───────────────────────────────────────────────── */
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    startCamera();
} else {
    document.getElementById('cam-error-msg').textContent = 'Your browser does not support camera access. Please use Chrome or Safari on Android/iPhone.';
    document.getElementById('cam-error').style.display = 'flex';
}
</script>
</body>
</html>
