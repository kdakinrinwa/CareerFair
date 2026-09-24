<!DOCTYPE html>
<html lang="en">
<head>
    <title>Venue &amp; Directions – FUTA Career Fair 2026</title>
    <?php echo $css; ?>
    <style>
    .venue-map-wrap {
        border-radius: 14px; overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,.12);
        position: relative; width: 100%; height: 480px;
    }
    .venue-map-wrap iframe { width: 100%; height: 100%; border: 0; display: block; }
    .venue-info-card {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,.07);
        padding: 28px; height: 100%;
    }
    .venue-detail-row {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 14px 0; border-bottom: 1px solid #f0f0f0;
    }
    .venue-detail-row:last-child { border-bottom: none; }
    .venue-icon {
        width: 40px; height: 40px; border-radius: 10px;
        background: rgba(107,14,32,.08); color: #6B0E20;
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; flex-shrink: 0;
    }
    .getting-here-item {
        display: flex; gap: 16px; padding: 18px;
        background: #fff; border-radius: 10px;
        border: 1px solid #e8e8e8; margin-bottom: 14px;
        transition: border-color .2s, box-shadow .2s;
    }
    .getting-here-item:hover { border-color: rgba(107,14,32,.2); box-shadow: 0 3px 14px rgba(107,14,32,.08); }
    .ghi-icon { width: 44px; height: 44px; border-radius: 12px; background: rgba(107,14,32,.07); color: #6B0E20; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    </style>
</head>
<body>

<?php echo $header; ?>

<!-- Page Title -->
<div class="cf-page-title">
    <div class="container">
        <h1>Venue &amp; Directions</h1>
        <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><a href="<?php echo base_url(); ?>home/careerfair">Career Fair 2026</a></li>
            <li>Venue &amp; Directions</li>
        </ul>
    </div>
</div>

<!-- Main content -->
<section style="padding: 60px 0; background: #F8F6F0;">
    <div class="container">

        <!-- Top row: Map + Info card -->
        <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 28px; margin-bottom: 40px; align-items: start;">

            <!-- Google Map -->
            <div>
                <div class="venue-map-wrap">
                    <!--
                        FUTA – Federal University of Technology, Akure
                        Coordinates: 7.2973° N, 5.1401° E
                        Using Google Maps embed iframe (no API key needed for basic embed)
                    -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.6583407024053!2d5.137826874876978!3d7.297316892712065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1043a7df82c93d11%3A0x10e61fe6fa5d7bb0!2sFederal%20University%20of%20Technology%2C%20Akure!5e0!3m2!1sen!2sng!4v1700000000000!5m2!1sen!2sng"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="FUTA – Federal University of Technology, Akure – Google Map">
                    </iframe>
                </div>
                <div style="margin-top: 14px; display: flex; gap: 12px; flex-wrap: wrap;">
                    <a href="https://maps.google.com/?q=Federal+University+of+Technology+Akure+Nigeria"
                       target="_blank"
                       style="display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:#6B0E20;color:#fff;border-radius:50px;font-size:13.5px;font-weight:700;text-decoration:none;">
                        <i class="fa-solid fa-map-location-dot"></i> Open in Google Maps
                    </a>
                    <a href="https://maps.google.com/?q=Federal+University+of+Technology+Akure+Nigeria&dirflg=d"
                       target="_blank"
                       style="display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border:2px solid #6B0E20;color:#6B0E20;border-radius:50px;font-size:13.5px;font-weight:700;text-decoration:none;background:transparent;">
                        <i class="fa-solid fa-route"></i> Get Directions
                    </a>
                </div>
            </div>

            <!-- Venue details card -->
            <div class="venue-info-card">
                <div style="margin-bottom: 20px;">
                    <div style="font-size:11.5px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#a88635;margin-bottom:6px;">
                        <span style="display:inline-block;width:14px;height:2px;background:#C9A84C;vertical-align:middle;margin-right:8px;"></span>
                        Event Venue
                    </div>
                    <h2 style="font-size:22px;font-weight:800;color:#1A1A2E;margin:0 0 4px;">
                        FUTA 2500-Seater Hall
                    </h2>
                    <p style="font-size:14px;color:#6c757d;margin:0;">
                        Federal University of Technology, Akure (FUTA)
                    </p>
                </div>

                <div class="venue-detail-row">
                    <div class="venue-icon"><i class="fa-regular fa-calendar-days"></i></div>
                    <div>
                        <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#6c757d;">Date</div>
                        <div style="font-size:15px;font-weight:700;color:#1A1A2E;">Wednesday – Thursday</div>
                        <div style="font-size:14px;color:#6B0E20;font-weight:600;">November 12–13, 2026</div>
                    </div>
                </div>

                <div class="venue-detail-row">
                    <div class="venue-icon"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#6c757d;">Time</div>
                        <div style="font-size:15px;font-weight:700;color:#1A1A2E;">8:00 AM – 6:00 PM</div>
                        <div style="font-size:13px;color:#6c757d;">Both days (WAT – UTC+1)</div>
                    </div>
                </div>

                <div class="venue-detail-row">
                    <div class="venue-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#6c757d;">Full Address</div>
                        <div style="font-size:14px;font-weight:600;color:#1A1A2E;line-height:1.5;">
                            FUTA 2500-Seater Hall<br>
                            Federal University of Technology<br>
                            PMB 704, Akure, Ondo State<br>
                            Nigeria
                        </div>
                    </div>
                </div>

                <div class="venue-detail-row">
                    <div class="venue-icon"><i class="fa-solid fa-car-side"></i></div>
                    <div>
                        <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#6c757d;">Parking</div>
                        <div style="font-size:14px;color:#1A1A2E;">Free parking available on campus. Follow event signage at the main gate.</div>
                    </div>
                </div>

                <div class="venue-detail-row">
                    <div class="venue-icon"><i class="fa-solid fa-universal-access"></i></div>
                    <div>
                        <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#6c757d;">Accessibility</div>
                        <div style="font-size:14px;color:#1A1A2E;">The venue is accessible to persons with disabilities. Dedicated assistance available at the entrance.</div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Getting Here section -->
        <div style="background:#fff; border-radius:14px; padding:32px; box-shadow:0 2px 14px rgba(0,0,0,.07);">
            <h3 style="font-size:20px; font-weight:800; color:#1A1A2E; margin:0 0 24px; padding-bottom:14px; border-bottom:2px solid #f0f0f0;">
                <i class="fa-solid fa-route" style="color:#6B0E20; margin-right:10px;"></i>Getting to FUTA
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">

                <div class="getting-here-item">
                    <div class="ghi-icon"><i class="fa-solid fa-car"></i></div>
                    <div>
                        <div style="font-size:15px;font-weight:700;color:#1A1A2E;margin-bottom:5px;">By Car / Taxi</div>
                        <div style="font-size:13.5px;color:#6c757d;line-height:1.65;">
                            From Akure city centre, take the Oba-Ile road. The main FUTA gate is clearly signed.
                            The event hall is a 2-minute walk from the main gate.
                        </div>
                    </div>
                </div>

                <div class="getting-here-item">
                    <div class="ghi-icon"><i class="fa-solid fa-bus"></i></div>
                    <div>
                        <div style="font-size:15px;font-weight:700;color:#1A1A2E;margin-bottom:5px;">By Public Transport</div>
                        <div style="font-size:13.5px;color:#6c757d;line-height:1.65;">
                            Take a bus or minibus from Oja-Oba Market heading toward Oba-Ile. 
                            Ask for "FUTA gate" – buses pass directly in front.
                        </div>
                    </div>
                </div>

                <div class="getting-here-item">
                    <div class="ghi-icon"><i class="fa-solid fa-motorcycle"></i></div>
                    <div>
                        <div style="font-size:15px;font-weight:700;color:#1A1A2E;margin-bottom:5px;">By Okada / Tricycle</div>
                        <div style="font-size:13.5px;color:#6c757d;line-height:1.65;">
                            Okada and keke napep are available throughout Akure.
                            Tell the driver "FUTA 2500-seater hall" – it is well known.
                        </div>
                    </div>
                </div>

                <div class="getting-here-item">
                    <div class="ghi-icon"><i class="fa-solid fa-plane-arrival"></i></div>
                    <div>
                        <div style="font-size:15px;font-weight:700;color:#1A1A2E;margin-bottom:5px;">From Out of Town</div>
                        <div style="font-size:13.5px;color:#6c757d;line-height:1.65;">
                            The nearest airport is Akure Airport (AKR), approx. 15 minutes from FUTA.
                            From Lagos or Abuja, Akure is on the Ondo State expressway.
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Quick register CTA -->
<section style="background: linear-gradient(135deg, #6B0E20, #4a0915); padding: 50px 0; text-align: center;">
    <div class="container">
        <h2 style="font-size: clamp(22px,3.5vw,36px); font-weight: 800; color: #fff; margin: 0 0 12px;">
            Attending the Fair?
        </h2>
        <p style="color: rgba(255,255,255,.75); font-size: 15px; margin: 0 auto 26px; max-width: 480px;">
            Register now to get your QR event pass and be ready at the door on November 12.
        </p>
        <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo base_url(); ?>home/register/student" style="display:inline-flex;align-items:center;gap:8px;padding:12px 26px;background:#C9A84C;color:#1A1A2E;border-radius:50px;font-size:14px;font-weight:800;text-decoration:none;">
                <i class="fa-solid fa-graduation-cap"></i> Student Registration
            </a>
            <a href="<?php echo base_url(); ?>home/register/employer" style="display:inline-flex;align-items:center;gap:8px;padding:12px 26px;background:rgba(255,255,255,.15);border:2px solid rgba(255,255,255,.4);color:#fff;border-radius:50px;font-size:14px;font-weight:800;text-decoration:none;">
                <i class="fa-solid fa-building"></i> Employer Registration
            </a>
        </div>
    </div>
</section>

<?php echo $footer; ?>

<button class="cf-scroll-top" id="cf-scroll-top" aria-label="Scroll to top">
    <i class="fa-solid fa-arrow-up"></i>
</button>
<?php echo $js; ?>

<style>
@media(max-width:900px){
    .venue-map-wrap { height: 320px; }
    section .container > div[style*="grid-template-columns: 1.6fr"] { grid-template-columns: 1fr !important; }
    .getting-here-item + div { grid-template-columns: 1fr !important; }
}
@media(max-width:600px){
    .getting-here-item + div { grid-template-columns: 1fr; }
}
</style>
</body>
</html>
