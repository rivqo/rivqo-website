(function ($) {
    'use strict';

    function search_popup() {

        var $button_search = $('.icon-search-popup');
        var $drop_down = $('.site-search-popup-wrap');
        $button_search.on('click', function (e) {
            e.preventDefault();
            $('html').toggleClass('search-popup-active');
        });

        $('.site-search-popup-close').on('click', function (e) {
            e.preventDefault();
            $('html').removeClass('search-popup-active');
        });

        $(document).mouseup(function (e) {
            if (!$drop_down.is(e.target) && $drop_down.has(e.target).length == 0) {
                $('html').removeClass('search-popup-active');
            }
        });
    }


    $(document).ready(function () {
        search_popup();
    });
})(jQuery);
