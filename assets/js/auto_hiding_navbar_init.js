import jQuery from 'jquery';

(function ($, undefined) {
    $('nav.navbar-fixed-top').bootstrapAutoHideNavbar({
            disableAutoHide: false,
            delta: 5,
            duration: 250,
            shadow: true
        }
    );
})(jQuery);