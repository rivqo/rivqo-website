(function ($) {
  "use strict";

  var WidgetTestimonialThumbCarouselHandler = function ($scope) {
    console.log("test");
    // Testinomials Carousel
    if ($(".testimonial-content").length) {
      var testimonial_thumbs = new Swiper(".testimonial-thumbs", {
        spaceBetween: 10,
        loop: false,
        slidesPerView: 3,
        breakpoints: {
          320: {
            slidesPerView: 3,
          },
          600: {
            slidesPerView: 3,
          },
          600: {
            slidesPerView: 3,
          },
        },
      });

      var testimonial_content = new Swiper(".testimonial-content", {
        spaceBetween: 0,
        loop: true,
        thumbs: {
          swiper: testimonial_thumbs,
        },
        navigation: {
          nextEl: ".testi-button-next",
          prevEl: ".testi-button-prev",
        },
      });
    }
  };

  //elementor front start
  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/tm-ele-cpt-testimonials.skin-style-current-theme3", WidgetTestimonialThumbCarouselHandler);
  });
  $(window).on("elementor/editor/before_enqueue_scripts", function () {
    elementorFrontend.hooks.addAction("frontend/element_ready/widget", function ($scope) {
      WidgetTestimonialThumbCarouselHandler;
    });
  });
})(jQuery);
