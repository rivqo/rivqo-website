(function($) {
  'use strict';

  var TM_Interactive_Tabs_Title = function ($scope) {
    if ($('.tm-interactive-tabs').length) {
      $('.tm-interactive-tabs .tab-buttons .tab-btn').each(function() {
        var $this = jQuery(this);
        if ($this.hasClass('active-btn')) {
          var target = $($this.attr('data-tab'));
          $(target).fadeIn(500).addClass('active-tab');
        }
      });
      $('.tm-interactive-tabs .tab-buttons .tab-btn').on('click', function (e) {
        e.preventDefault();
        var target = $($(this).attr('data-tab'));
        if ($(target).is(':visible')) {
          return false;
        } else {
          $(this).parents('.elementor-top-section').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
          $(this).addClass('active-btn');
          $(this).parents('.elementor-top-section').find('.tm-interactive-tabs-content').find('.tab').fadeOut(0);
          $(this).parents('.elementor-top-section').find('.tm-interactive-tabs-content').find('.tab').removeClass('active-tab');
          $(target).fadeIn(500).addClass('active-tab');
        }
      });
    }
  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
      elementorFrontend.hooks.addAction(
          "frontend/element_ready/tm-ele-interactive-tabs-title.default",
          TM_Interactive_Tabs_Title
      );
  });
})(jQuery);