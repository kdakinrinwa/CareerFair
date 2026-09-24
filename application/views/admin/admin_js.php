<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>
<script>
$(document).ready(function(){
    // Mobile sidebar toggle
    $('#sidebar-toggle').on('click', function(){ $('#portal-sidebar').toggleClass('open'); });
    $(document).on('click', function(e){
        if($(window).width() < 769 && !$(e.target).closest('#portal-sidebar,#sidebar-toggle').length){
            $('#portal-sidebar').removeClass('open');
        }
    });
});
function adminConfirm(msg, callback) {
    Swal.fire({ title:'Confirm', text:msg, icon:'question', showCancelButton:true, confirmButtonColor:'#6B0E20', cancelButtonColor:'#aaa', confirmButtonText:'Yes, proceed' }).then(function(r){ if(r.isConfirmed) callback(); });
}
function adminSuccess(msg) { Swal.fire({ icon:'success', title:'Done', text:msg, confirmButtonColor:'#6B0E20' }); }
function adminError(msg)   { Swal.fire({ icon:'error',   title:'Error', text:msg, confirmButtonColor:'#6B0E20' }); }
</script>
