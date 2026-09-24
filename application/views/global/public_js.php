<!-- jQuery – required by all interactive components -->
<script src="<?php echo base_url(); ?>assetsp/js/jquery.js"></script>
<!-- WOW.js – triggers animate.css classes on scroll -->
<script src="<?php echo base_url(); ?>assetsp/js/wow.js"></script>
<!-- SweetAlert2 – modal notifications (newsletter, contact forms) -->
<script src="<?php echo base_url(); ?>assetsp/js/sweetalert2.min.js"></script>

<script>
$(document).ready(function () {

    /* ── Dropdown – CSS handles desktop hover.
       JS only handles touch/mobile tap toggling.                   */

    // Stop parent link navigating on desktop (it has no href of its own)
    $('.cf-nav .dropdown > a').on('click', function (e) {
        if ($(window).width() > 768) { e.preventDefault(); }
    });

    // Touch devices: tap parent = toggle dropdown
    $('.cf-nav .dropdown > a').on('touchend', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $menu = $(this).siblings('.dropdown-menu-cf');
        var isOpen = $menu.is(':visible');
        $('.cf-nav .dropdown-menu-cf').hide();   // close others
        if (!isOpen) { $menu.show(); }
    });

    // Touch: tap anywhere else closes all dropdowns
    $(document).on('touchend', function (e) {
        if (!$(e.target).closest('.cf-nav .dropdown').length) {
            $('.cf-nav .dropdown-menu-cf').hide();
        }
    });

    /* ── WOW.js – animate on scroll ──────────────────────────── */
    new WOW().init();

    /* ── Sticky header shadow on scroll ──────────────────────── */
    $(window).on('scroll', function () {
        var scrolled = $(this).scrollTop() > 80;
        $('.cf-header').toggleClass('scrolled', scrolled);
        $('.cf-scroll-top').toggleClass('show', scrolled);
    });

    /* ── Scroll-to-top button ─────────────────────────────────── */
    $('.cf-scroll-top').on('click', function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
    });

    /* ── Mobile menu – open ───────────────────────────────────── */
    $('.cf-mobile-toggle').on('click', function () {
        $('.cf-mobile-menu').addClass('open');
        $('body').css('overflow', 'hidden');
    });

    /* ── Mobile menu – close (backdrop or close button) ──────── */
    $(document).on('click touchend', '.cf-mobile-menu, .mobile-close-btn', function (e) {
        if (
            $(e.target).hasClass('cf-mobile-menu') ||
            $(e.target).hasClass('mobile-close-btn') ||
            $(e.target).closest('.mobile-close-btn').length
        ) {
            $('.cf-mobile-menu').removeClass('open');
            $('body').css('overflow', '');
        }
    });

    /* ── Mobile nav – sub-menu accordion ─────────────────────── */
    $('.cf-mobile-nav .has-sub > a').on('click', function (e) {
        e.preventDefault();
        $(this).siblings('.sub-menu').slideToggle(250);
        $(this).toggleClass('open');
    });

    /* ── Newsletter subscription (footer form) ────────────────── */
    $('#cf-newsletter-btn').on('click', function (e) {
        e.preventDefault();
        var emailadd = $.trim($('#cf-emailadd').val());
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (!emailadd) {
            Swal.fire({ icon: 'error', title: 'Required', text: 'Please enter your email address.', confirmButtonColor: '#6B0E20' });
            return;
        }
        if (!reg.test(emailadd)) {
            Swal.fire({ icon: 'error', title: 'Invalid Email', text: 'The email address entered is not valid.', confirmButtonColor: '#6B0E20' });
            return;
        }

        $.ajax({
            url:  '<?php echo site_url("home/submit_newsletter"); ?>',
            type: 'POST',
            data: { emailadd: emailadd },
            success: function (data) {
                if (data == 1) {
                    Swal.fire({ icon: 'success', title: 'Subscribed!', text: 'You have been added to our newsletter.', confirmButtonColor: '#6B0E20' });
                    $('#cf-emailadd').val('');
                } else if (data == 2) {
                    Swal.fire({ icon: 'info', title: 'Already Subscribed', text: 'This email is already on our list.', confirmButtonColor: '#6B0E20' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again.', confirmButtonColor: '#6B0E20' });
                }
            }
        });
    });

});
</script>
