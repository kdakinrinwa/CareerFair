<!DOCTYPE html>
<html lang="en">
<head><title>Booth Request – FUTA Career Fair 2026</title><?php echo $css; ?></head>
<body class="portal-body">
<div class="portal-wrap">
    <?php echo $sidebar; ?>
    <main class="portal-main">
        <div class="portal-topbar">
            <button class="sidebar-toggle" id="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
            <div class="portal-topbar-title">Booth Request</div>
        </div>
        <div class="portal-content">
            <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:24px;align-items:start;">
                <div class="p-card">
                    <div class="p-card-header"><h3 class="p-card-title"><i class="fa-solid fa-store" style="color:#6B0E20;margin-right:8px;"></i>Request Exhibition Booth</h3></div>
                    <div class="p-card-body">
                        <?php if ($booth): ?>
                        <div class="p-alert p-alert-<?php echo $booth->status==='approved'?'success':($booth->status==='rejected'?'error':'info'); ?>">
                            <i class="fa-solid fa-circle-check fa-fw"></i>
                            <strong>Booth Request <?php echo ucfirst($booth->status); ?></strong>
                            <?php if ($booth->booth_number): ?> – Booth <strong><?php echo htmlspecialchars($booth->booth_number); ?></strong><?php endif; ?>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-top:10px;">
                            <?php foreach ([['Size',$booth->booth_size],['Status',ucfirst($booth->status)],['Requested',date('M d, Y',strtotime($booth->requested_at))],['Booth No.',$booth->booth_number??'TBA'],['Location',$booth->booth_location??'TBA']] as $r): ?>
                            <div style="padding:12px;background:#F8F6F0;border-radius:8px;">
                                <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:#6c757d;"><?php echo $r[0]; ?></div>
                                <div style="font-size:14px;font-weight:700;color:#1A1A2E;margin-top:3px;"><?php echo htmlspecialchars($r[1]); ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <div id="booth-alert"></div>
                        <form id="booth-form">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="p-form-group">
                                <label class="p-form-label">Booth Size *</label>
                                <select name="booth_size" class="p-form-control" required>
                                    <option value="Standard">Standard</option>
                                    <option value="Double">Double</option>
                                    <option value="Corner">Corner</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>
                            <div class="p-form-group">
                                <label class="p-form-label">Special Requirements</label>
                                <textarea name="requirements" class="p-form-control" rows="3" placeholder="Power outlets, internet, specific location, etc."></textarea>
                            </div>
                            <button type="submit" class="p-btn p-btn-maroon" id="booth-btn">
                                <i class="fa-solid fa-paper-plane"></i> Submit Booth Request
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="p-card">
                    <div class="p-card-header"><h3 class="p-card-title">Booth Information</h3></div>
                    <div class="p-card-body">
                        <?php foreach ([['Standard','Single 3×3m booth with table, 2 chairs, power'],['Double','Two adjoining booths – ideal for large teams'],['Corner','Corner position – more visibility, more foot traffic'],['Premium','Prime location + branding on event banner']] as $b): ?>
                        <div style="padding:12px;background:#F8F6F0;border-radius:8px;margin-bottom:10px;">
                            <div style="font-size:13.5px;font-weight:700;color:#1A1A2E;"><?php echo $b[0]; ?></div>
                            <div style="font-size:12.5px;color:#6c757d;margin-top:3px;"><?php echo $b[1]; ?></div>
                        </div>
                        <?php endforeach; ?>
                        <div style="margin-top:14px;padding:12px;background:rgba(201,168,76,.1);border-radius:8px;font-size:13px;color:#92400e;border:1px solid rgba(201,168,76,.3);">
                            <i class="fa-solid fa-info-circle fa-fw"></i>
                            Booth allocation is subject to admin approval. You will be notified by email once approved.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>
<script>
$('#sidebar-toggle').on('click',function(){$('#portal-sidebar').toggleClass('open');});
$('#booth-form').on('submit',function(e){
    e.preventDefault();
    var btn=$('#booth-btn').html('<i class="fa-solid fa-spinner fa-spin"></i> Submitting...').prop('disabled',true);
    $.ajax({url:'<?php echo site_url("employer/request_booth"); ?>',type:'POST',data:$(this).serialize(),success:function(r){
        var d=JSON.parse(r);
        if(d.result==1){Swal.fire({icon:'success',title:'Request Submitted',text:'Your booth request has been sent to Career Services.',confirmButtonColor:'#6B0E20'}).then(function(){location.reload();});}
        else if(d.result==2){Swal.fire({icon:'info',title:'Already Requested',text:'You already have a booth request on file.',confirmButtonColor:'#6B0E20'});}
        else{Swal.fire({icon:'error',title:'Error',text:'Something went wrong.',confirmButtonColor:'#6B0E20'});}
        $('#booth-btn').html('<i class="fa-solid fa-paper-plane"></i> Submit Booth Request').prop('disabled',false);
    }});
});
</script>
</body></html>
