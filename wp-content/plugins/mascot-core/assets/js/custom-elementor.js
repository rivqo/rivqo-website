var THEMEMASCOT = {};
(function($) {
  "use strict";

  /* ---------------------------------------------------------------------- */
  /* -------------------------- Declare Variables ------------------------- */
  /* ---------------------------------------------------------------------- */
  var $document = $(document);
  var $document_body = $(document.body);
  var $window = $(window);
  var $html = $('html');
  var $body = $('body');
  var $wrapper = $('#wrapper');
  var $header = $('#header');
  var $header_navbar_scrolltofixed = $('body.tm-enable-navbar-scrolltofixed');
  var $sections = $('.elementor-section.elementor-top-section');
  var windowHeight = $window.height();
  var windowWidth = $window.width();
  var $wpAdminBar = $('#wpadminbar');

  var $gallery_isotope = $(".isotope-layout");


  THEMEMASCOT.isMobile = {
    Android: function() {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
      return (THEMEMASCOT.isMobile.Android() || THEMEMASCOT.isMobile.BlackBerry() || THEMEMASCOT.isMobile.iOS() || THEMEMASCOT.isMobile.Opera() || THEMEMASCOT.isMobile.Windows());
    }
  };

  function admin_bar_height() {
    var admin_bar_height = 0;
    if( $body.hasClass('admin-bar') ) {
      admin_bar_height = $('#wpadminbar').height();
    }
    return admin_bar_height;
  }

  function tmProgressBarCounter(pBar, pPercent){
    var percent = parseFloat(pPercent);
    if(pBar.length) {
      pBar.each(function() {
        var current_item = $(this);
        current_item.css('opacity', '1');
        current_item.countTo({
          from: 0,
          to: percent,
          speed: 2000,
          refreshInterval: 50
        });
      });
    }
  }

  function tmMasonryItemsHeightResizer(size, container){
    if(container.hasClass('masonry-tiles')) {
      var padding = parseInt(container.find('.isotope-item:not(.isotope-item-sizer)').css('padding-left')),
        masonry_default = container.find('.tm-masonry-default'),
        masonry_large_height = container.find('.tm-masonry-large-height'),
        masonry_large_wide = container.find('.tm-masonry-large-wide'),
        masonry_large_width_height = container.find('.tm-masonry-large-width-height');
      if ($window.width() > 680) {
        masonry_default.css('height', size - 2 * padding);
        masonry_large_height.css('height', Math.round(2 * size) - 2 * padding);
        masonry_large_width_height.css('height', Math.round(2 * size) - 2 * padding);
        masonry_large_wide.css('height', size - 2 * padding);
      } else {
        masonry_default.css('height', size);
        masonry_large_height.css('height', size);
        masonry_large_width_height.css('height', size);
        masonry_large_wide.css('height', Math.round(size / 2));
      }
    }
  }

  THEMEMASCOT.isRTL = {
    check: function() {
      if( $( "html" ).attr("dir") === "rtl" ) {
        return true;
      } else {
        return false;
      }
    }
  };

  THEMEMASCOT.isLTR = {
    check: function() {
      if( $( "html" ).attr("dir") !== "rtl" ) {
        return true;
      } else {
        return false;
      }
    }
  };

  THEMEMASCOT.urlParameter = {
    get: function(sParam) {
      var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

      for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : sParameterName[1];
        }
      }
    }
  };

  THEMEMASCOT.initialize = {

    init: function() {
      THEMEMASCOT.initialize.TM_bg_four_vertical_lines();
      THEMEMASCOT.initialize.TM_bootstrapNavTab();
      THEMEMASCOT.initialize.TM_tiltParallaxAnimation();
      THEMEMASCOT.initialize.TM_appearVariousItems();
      THEMEMASCOT.initialize.TM_paroller();
      THEMEMASCOT.initialize.TM_textillate();

      THEMEMASCOT.initialize.TM_platformDetect();
      THEMEMASCOT.initialize.TM_nivolightbox();
      THEMEMASCOT.initialize.TM_equalHeightDivs();
    },


    /* ---------------------------------------------------------------------- */
    /* ----------------------------- niceSelect  ---------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_bg_four_vertical_lines: function() {
      var $elementor_section = $('.elementor-section.tm-enable-four-vertical-line');
      if( $elementor_section.length > 0 ) {
        $elementor_section.children().append('<div class="tm-four-vertical-line"><div class="line line-1"></div><div class="line line-2"></div><div class="line line-3"></div><div class="line line-4"></div></div>');
      }
    },


    /* ---------------------------------------------------------------------- */
    /* ----------------------------- tilt  ----------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_bootstrapNavTab: function() {
      var $nav_tabs = $('ul.nav-tabs');
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        e.target // newly activated tab
        e.relatedTarget // previous active tab
        var $new = $(e.target);
        var $pre = $(e.relatedTarget);
        $new.parent().addClass('active');
        $pre.parent().removeClass('active');
      })
    },


    /* ---------------------------------------------------------------------- */
    /* ----------------------------- tilt  ----------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_tiltParallaxAnimation: function() {
      var $tilt_hover_effect = $('.tilt-hover-effect');
      if( $tilt_hover_effect.length > 0 ){
        $tilt_hover_effect.tilt({
          perspective: 1300,
        })
      }
    },



    /* ---------------------------------------------------------------------- */
    /* ------------------------ appear.js various items --------------------- */
    /* ---------------------------------------------------------------------- */
    TM_appearVariousItems: function() {
      var itemHolder = '.tm-item-appear-box, .tm-item-appear-clip-path';
      var $itemHolder = $(itemHolder);
      if( $itemHolder.length > 0 ) {
        $itemHolder.appear();
        $document_body.on('appear', itemHolder, function() {
          var current_item = $(this);
          current_item.addClass('tm-item-appeared');
        });
      }


      //animate items on appear
      if ( ! $body.hasClass( 'tm-enable-element-animation-effect' ) ) {
        return;
      }
      var animate_items = '.tm-animation';
      var $animate_items = $(animate_items);
      if( $animate_items.length > 0 ) {
        $animate_items.appear();
        $document_body.on('appear', animate_items, function() {
          var current_item = $(this);
          current_item.addClass('animate');
        });
      }
    },



    /* ---------------------------------------------------------------------- */
    /* -------------------------- paroller.js Parallax ---------------------- */
    /* ---------------------------------------------------------------------- */
    TM_paroller: function() {
      var $tm_paroller_object = $('.tm-paroller-object');
      if( $tm_paroller_object.length > 0 ) {
        //initialize paroller.js and set options for elements with .paroller class
        $tm_paroller_object.each(function(){
          var this_item = $(this);
          this_item.paroller();
        });
      }
    },



    /* ---------------------------------------------------------------------- */
    /* ------------------- textillate.js CSS3 text animations --------------- */
    /* ---------------------------------------------------------------------- */
    TM_textillate: function() {
      var $tm_textillate_animation = $('.tm-textillate-animation');
      if( $tm_textillate_animation.length > 0 ) {
        $tm_textillate_animation.appear();
        $document_body.on('appear', '.tm-textillate-animation', function() {
          var current_item = $(this);
          if (!current_item.hasClass('appeared')) {
            current_item.textillate();
            current_item.addClass('appeared');
          }
        });
      }
    },


    /* ---------------------------------------------------------------------- */
    /* ------------------------------- Platform detect  --------------------- */
    /* ---------------------------------------------------------------------- */
    TM_platformDetect: function() {
      if (THEMEMASCOT.isMobile.any()) {
        $html.addClass("mobile");
      } else {
        $html.addClass("no-mobile");
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ----------------------------- Magnific Popup ------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_magnificPopup_lightbox: function() {
      
      var $image_popup_lightbox = $('.image-popup-lightbox');
      if( $image_popup_lightbox.length > 0 ) {
        $image_popup_lightbox.magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          closeBtnInside: false,
          fixedContentPos: true,
          mainClass: 'mfp-no-margins mfp-fade', // class to remove default margin from left and right side
          image: {
            verticalFit: true
          }
        });
      }

      var $image_popup_vertical_fit = $('.image-popup-vertical-fit');
      if( $image_popup_vertical_fit.length > 0 ) {
        $image_popup_vertical_fit.magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          mainClass: 'mfp-img-mobile',
          image: {
            verticalFit: true
          }
        });
      }

      var $image_popup_fit_width = $('.image-popup-fit-width');
      if( $image_popup_fit_width.length > 0 ) {
        $image_popup_fit_width.magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          image: {
            verticalFit: false
          }
        });
      }

      var $image_popup_no_margins = $('.image-popup-no-margins');
      if( $image_popup_no_margins.length > 0 ) {
        $image_popup_no_margins.magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          closeBtnInside: false,
          fixedContentPos: true,
          mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
          image: {
            verticalFit: true
          },
          zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
          }
        });
      }

      var $popup_gallery = $('.popup-gallery');
      if( $popup_gallery.length > 0 ) {
        $popup_gallery.magnificPopup({
          delegate: 'a',
          type: 'image',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          },
          image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
              return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
            }
          }
        });
      }

      var $zoom_gallery = $('.zoom-gallery');
      if( $zoom_gallery.length > 0 ) {
        $zoom_gallery.magnificPopup({
          delegate: 'a',
          type: 'image',
          closeOnContentClick: false,
          closeBtnInside: false,
          mainClass: 'mfp-with-zoom mfp-img-mobile',
          image: {
            verticalFit: true,
            titleSrc: function(item) {
              return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
            }
          },
          gallery: {
            enabled: true
          },
          zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
              return element.find('img');
            }
          }
          
        });
      }
      
      var $popup_yt_vimeo_gmap = $('.popup-youtube, .popup-vimeo, .popup-gmaps');
      if( $popup_yt_vimeo_gmap.length > 0 ) {
        $popup_yt_vimeo_gmap.magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,

          fixedContentPos: false
        });
      }

      var $popup_with_zoom_anim = $('.popup-with-zoom-anim');
      if( $popup_with_zoom_anim.length > 0 ) {
        $popup_with_zoom_anim.magnificPopup({
          type: 'inline',

          fixedContentPos: false,
          fixedBgPos: true,

          overflowY: 'auto',

          closeBtnInside: true,
          preloader: false,

          midClick: true,
          removalDelay: 300,
          mainClass: 'my-mfp-zoom-in'
        });
      }

      var $popup_with_move_anim = $('.popup-with-move-anim');
      if( $popup_with_move_anim.length > 0 ) {
        $popup_with_move_anim.magnificPopup({
          type: 'inline',

          fixedContentPos: false,
          fixedBgPos: true,

          overflowY: 'auto',

          closeBtnInside: true,
          preloader: false,

          midClick: true,
          removalDelay: 300,
          mainClass: 'my-mfp-slide-bottom'
        });
      }
      
      var $ajaxload_popup = $('.ajaxload-popup');
      if( $ajaxload_popup.length > 0 ) {
        $ajaxload_popup.magnificPopup({
          type: 'ajax',
          alignTop: true,
          overflowY: 'scroll', // as we know that popup content is tall we set scroll overflow by default to avoid jump
          callbacks: {
          parseAjax: function(mfpResponse) {
          }
          }
        });
      }

      var $form_ajax_load = $('.form-ajax-load');
      if( $form_ajax_load.length > 0 ) {
        $form_ajax_load.magnificPopup({
          type: 'ajax'
        });
      }
      
      var $popup_with_form = $('.popup-with-form');
      if( $popup_with_form.length > 0 ) {
        $popup_with_form.magnificPopup({
          type: 'inline',
          preloader: false,
          focus: '#name',

          mainClass: 'mfp-no-margins mfp-fade',
          closeBtnInside: false,
          fixedContentPos: true,

          // When elemened is focused, some mobile browsers in some cases zoom in
          // It looks not nice, so we disable it:
          callbacks: {
            beforeOpen: function() {
            if($window.width() < 700) {
              this.st.focus = false;
            } else {
              this.st.focus = '#name';
            }
            }
          }
        });
      }

      var $mfpLightboxAjax = $('[data-lightbox="ajax"]');
      if( $mfpLightboxAjax.length > 0 ) {
        $mfpLightboxAjax.magnificPopup({
          type: 'ajax',
          closeBtnInside: false,
          callbacks: {
            ajaxContentAdded: function(mfpResponse) {
            },
            open: function() {
            },
            close: function() {
            }
          }
        });
      }

      //lightbox image
      var $mfpLightboxImage = $('[data-lightbox="image"]');
      if( $mfpLightboxImage.length > 0 ) {
        $mfpLightboxImage.magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          closeBtnInside: false,
          fixedContentPos: true,
          mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
          image: {
            verticalFit: true
          }
        });
      }

      //lightbox gallery
      var $mfpLightboxGallery = $('[data-lightbox="gallery"]');
      if( $mfpLightboxGallery.length > 0 ) {
        $mfpLightboxGallery.each(function() {
          var element = $(this);
          element.magnificPopup({
            delegate: 'a[data-lightbox="isotope-item"]',
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
              verticalFit: true
            },
            gallery: {
              enabled: true,
              navigateByImgClick: true,
              preload: [0,1] // Will preload 0 - before current, and 1 after the current image
            },
            zoom: {
              enabled: true,
              duration: 300, // don't foget to change the duration also in CSS
              opener: function(element) {
              return element.find('img');
              }
            }

          });
        });
      }

      //lightbox iframe
      var $mfpLightboxIframe = $('[data-lightbox="iframe"]');
      if( $mfpLightboxIframe.length > 0 ) {
        $mfpLightboxIframe.magnificPopup({
          disableOn: 600,
          type: 'iframe',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
      }

      //lightbox inline
      var $mfpLightboxInline = $('[data-lightbox="inline"]');
      if( $mfpLightboxInline.length > 0 ) {
        $mfpLightboxInline.magnificPopup({
          type: 'inline',
          mainClass: 'mfp-no-margins mfp-zoom-in',
          closeBtnInside: false,
          fixedContentPos: true
        });
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ------------------------------ Nivo Lightbox ------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_nivolightbox: function() {
      var $nivo_lightbox = $('a[data-lightbox-gallery]');
      if( $nivo_lightbox.length > 0 ) {
        $nivo_lightbox.nivoLightbox({
          effect: 'fadeScale',
          afterShowLightbox: function(){
            var $nivo_iframe = $('.nivo-lightbox-content > iframe');
            if( $nivo_iframe.length > 0 ) {
              var src = $nivo_iframe.attr('src');
              $nivo_iframe.attr('src', src + '?autoplay=1');
            }
          }
        });
      }
    },

  
    /* ---------------------------------------------------------------------- */
    /* ---------------------------- equalHeights ---------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_equalHeightDivs: function() {
      var $equal_height = $('[data-tm-equal-height-col]');
      if( $equal_height.length > 0 ) {
        $equal_height.each(function () {
          var $this = $(this);
          var target_div = ( $this.data("tm-equal-height-col") === undefined ) ? ".elementor-section .elementor-widget-wrap": $this.data("tm-equal-height-col");
          var responsive = $this.data("tm-equal-height-responsive") ;
          if ( $window.width() >= 1025 ) {
            $this.find(target_div).matchHeight();
          } else if ( $window.width() >= 768 && $window.width() <= 1024 ) {
            if ($this.hasClass('tm-eqh-disable-on-tablet')) {
              $this.children(target_div).css('height', 'auto');
              $this.find(target_div).matchHeight({ remove: true });
            }else {
              $this.find(target_div).matchHeight();
            }
          } else if ( $window.width() < 768 ) {
            if ($this.hasClass('tm-eqh-disable-on-mobile')) {
              $this.children(target_div).css('height', 'auto');
              $this.find(target_div).matchHeight({ remove: true });
            }else {
              $this.find(target_div).matchHeight();
            }
          }
        });
      }
    }

  };


  THEMEMASCOT.header = {

    init: function() {

      var t = setTimeout(function() {
        THEMEMASCOT.header.TM_Memuzord_Megamenu();
        THEMEMASCOT.header.TM_TopNav_Dropdown_Position();
        THEMEMASCOT.header.TM_sidePanelReveal();
        THEMEMASCOT.header.TM_scroolToTopOnClick();
        THEMEMASCOT.header.TM_topnavAnimate();
        THEMEMASCOT.header.TM_scrolltoTarget();
        THEMEMASCOT.header.TM_menuCollapseOnClick();
        THEMEMASCOT.header.TM_homeParallaxFadeEffect();
        THEMEMASCOT.header.TM_topsearch_toggle();
      }, 0);

    },

    /* ---------------------------------------------------------------------- */
    /* ------------------------- Side Push Panel ---------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_sidePanelReveal: function() {
      if( $('.side-panel-trigger').length > 0 ) {
        $body.addClass("has-side-panel side-panel-right");
      }
      $('.side-panel-trigger').on('click', function(e) {
        $body.toggleClass("side-panel-open");
        if ( THEMEMASCOT.isMobile.any() ) {
          $body.toggleClass("overflow-hidden");
        }
        return false;
      });

      $('.has-side-panel .side-panel-body-overlay').on('click', function(e) {
        $body.toggleClass("side-panel-open");
        return false;
      });

      var $wpAdminBar = $('#wpadminbar');
      if( $wpAdminBar.length > 0 ) {
        var wpAdminBar_height = $wpAdminBar.height();
        $('#side-panel-container').css('top', wpAdminBar_height);
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ------------------------------- scroll-to-top  ------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_scroolToTop: function() {
      if ($window.scrollTop() > 600) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    },

    TM_scroolToTopOnClick: function() {
      $document_body.on('click', '.scroll-to-top', function(e) {
        $('html, body').animate({
          scrollTop: 0
        }, 800);
        return false;
      });
    },


    /* ---------------------------------------------------------------------------- */
    /* --------------------------- One Page Nav close on click -------------------- */
    /* ---------------------------------------------------------------------------- */
    TM_menuCollapseOnClick: function() {
      $document.on('click', '.onepage-nav a', function(e) {
        if (/#/.test(this.href)) {
          if($(this).find('.indicator').length == 0) {
            $('.showhide').trigger('click');
          }
        }
      });
    },

    /* ---------------------------------------------------------------------- */
    /* ------------------- on click scrool to target with smoothness -------- */
    /* ---------------------------------------------------------------------- */
    TM_scrolltoTarget: function() {
      //jQuery for page scrolling feature - requires jQuery Easing plugin
      $('.smooth-scroll-to-target, .fullscreen-onepage-nav a').on('click', function(e) {
        e.preventDefault();

        var $anchor = $(this);
        
        var $hearder_top = $('.header .header-nav');
        var hearder_top_offset = 0;
        if ($hearder_top[0]){
          hearder_top_offset = $hearder_top.outerHeight(true);
        } else {
          hearder_top_offset = 0;
        }

        // if adminbar exist
        var $wpAdminBar = $('#wpadminbar');
        var wpAdminBar_height = 0;
        if( $wpAdminBar.length ) {
          wpAdminBar_height = $wpAdminBar.height();
        }

        //for vertical nav, offset 0
        if ($body.hasClass("tm-vertical-nav")){
          hearder_top_offset = 0;
        }

        var top = $($anchor.attr('href')).offset().top - hearder_top_offset - wpAdminBar_height;
        $('html, body').stop().animate({
          scrollTop: top
        }, 1500, 'easeInOutExpo');

      });
    },

    /* ----------------------------------------------------------------------------- */
    /* --------------------------- Menuzord - Responsive Megamenu ------------------ */
    /* ----------------------------------------------------------------------------- */
    TM_menuzord: function() {

      var $menuzord = $("#menuzord");
      if( $menuzord.length > 0 ) {
        $menuzord.menuzord({
          align: "left",
          effect: "slide",
          animation: "none",
          indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
          indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
        });
      }

      var $menuzord_right = $("#menuzord-right");
      if( $menuzord_right.length > 0 ) {
        $menuzord_right.menuzord({
          align: "right",
          effect: "slide",
          animation: "none",
          indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
          indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
        });
      }

      var $menuzord_side_panel = $("#menuzord-side-panel");
      if( $menuzord_side_panel.length > 0 ) {
        $menuzord_side_panel.menuzord({
          align: "right",
          effect: "slide",
          animation: "none",
          indicatorFirstLevel: "",
          indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
        });
      }
      
      var $menuzord_vertical_nav = $("#menuzord-verticalnav");
      if( $menuzord_vertical_nav.length > 0 ) {
        $menuzord_vertical_nav.menuzord({
          align: "right",
          effect: "slide",
          animation: "none",
          indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
          indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
        });
      }
      
      //Main Top Primary Nav
      var $menuzord_top_main_nav = $("#top-primary-nav");
      var $menuzord_top_main_nav_menuzord_menu = $menuzord_top_main_nav.find('.menuzord-menu');
      if( $menuzord_top_main_nav.length > 0 && $menuzord_top_main_nav_menuzord_menu.length ) {
        var effect = ( $menuzord_top_main_nav.data("effect") === undefined ) ? "slide": $menuzord_top_main_nav.data("effect");
        var animation = ( $menuzord_top_main_nav.data("animation") === undefined ) ? "none": $menuzord_top_main_nav.data("animation");
        var align = ( $menuzord_top_main_nav.data("align") === undefined ) ? "right": $menuzord_top_main_nav.data("align");
        $menuzord_top_main_nav.menuzord({
          align: align,
          effect: effect,
          animation: animation,
          indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
          indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
        });
      }
      
      //Clone Top Primary Nav
      var $menuzord_top_main_nav_clone = $("#top-primary-nav-clone");
      var $menuzord_top_main_nav_clone_menuzord_menu = $menuzord_top_main_nav_clone.find('.menuzord-menu');
      if( $menuzord_top_main_nav_clone.length > 0 && $menuzord_top_main_nav_clone_menuzord_menu.length ) {
        var effect = ( $menuzord_top_main_nav_clone.data("effect") === undefined ) ? "slide": $menuzord_top_main_nav_clone.data("effect");
        var animation = ( $menuzord_top_main_nav_clone.data("animation") === undefined ) ? "none": $menuzord_top_main_nav_clone.data("animation");
        var align = ( $menuzord_top_main_nav_clone.data("align") === undefined ) ? "right": $menuzord_top_main_nav_clone.data("align");
        $menuzord_top_main_nav_clone.menuzord({
          align: align,
          effect: effect,
          animation: animation,
          indicatorFirstLevel: "<i class='fa fa-angle-down'></i>",
          indicatorSecondLevel: "<i class='fa fa-angle-right'></i>"
        });
      }

      //If click on Top Primary Nav Show Hide => it will show clone mobile nav
      $menuzord_top_main_nav.on('click', '.showhide', function(e) {
        $menuzord_top_main_nav_clone.find('.showhide').trigger('click');
        if( $window.width() <= 1024 ) {
          var t = setTimeout(function() {
            $(window).resize();
          }, 400);
        }
      });

    },


    /* ----------------------------------------------------------------------------- */
    /* ------------------------- Menuzord -  Megamenu Dynamic Left ----------------- */
    /* ----------------------------------------------------------------------------- */
    TM_Memuzord_Megamenu: function() {
      if ( $window.width() > 1024 ) {
        $('.menuzord-menu').children('.menu-item').find('.megamenu').each(function () {
          var $item = $(this);
          if( $item.length > 0 ) {

            $item.css('left', 0);
            $item.css('right', 'auto');
            
            if( $item.closest('.container').length ) {
              var $container = $item.closest('.container');
            } else if( $item.closest('.container-fluid').length ) {
              var $container = $item.closest('.container-fluid');
            } else {
              var $container = $item.closest('.header-nav-container');
            }
            
            var container_width = $container.width(),
              container_padding_left = parseInt($container.css('padding-left')),
              container_padding_right = parseInt($container.css('padding-right')),
              parent_width = $item.closest('.menuzord-menu').outerWidth();
            
            var megamenu_width = $item.outerWidth();

            if (megamenu_width > parent_width) {
              var left = -(megamenu_width - parent_width) * 0.5;
            } else {
              var left = 0;
            }

            var container_offset = $container.offset();
            var megamenu_offset = $item.offset();

            left = -(megamenu_offset.left - container_offset.left - container_padding_left);

            if( $item.hasClass('megamenu-three-quarter-width') ) {
              container_width = container_width * 0.75;
              left = $item.css('left');
            } else if( $item.hasClass('megamenu-half-width') ) {
              container_width = container_width * 0.5;
            } else if( $item.hasClass('megamenu-quarter-width') ) {
              container_width = container_width * 0.25;
              left = $item.css('left');
            }

            if( $item.hasClass('megamenu-fullwidth') ) {
              //do nothing
            } else if( $item.hasClass('megamenu-position-left') ) {
              left = 0;
            } else if( $item.hasClass('megamenu-position-center') ) {
              parent_width = $item.closest('.menu-item-has-children').outerWidth();
              left = - (megamenu_width - parent_width) * 0.5;
              $item.css('right', 'auto');
            } else if( $item.hasClass('megamenu-position-right') ) {
              left = 'auto';
              $item.css('right', 0);
            }


            $item.css('width', container_width);
            $item.css('left', left);
          }
        });
      }
    },


    /* ---------------------------------------------------------------------- */
    /* -------------------------- Top Nav Dropdown Position ----------------- */
    /* ---------------------------------------------------------------------- */
    TM_TopNav_Dropdown_Position: function() {
      if ( $window.width() > 1024 ) {
        var $top_primary_nav = $('#top-primary-nav');
        var menuItems = $top_primary_nav.find(".menuzord-menu > .menu-item.menu-item-has-children");
        menuItems.each( function(i) {
          var $this = $(this);

          var browserWidth = $top_primary_nav.find(".menuzord-menu").width(); // 16 is width of scroll bar
          var menuItemPosition = $this.position().left;
          var dropdownMenuWidth = $this.find('.dropdown').width();
          var boxedLayoutWidth = $header.width();

          var menuItemFromLeft = 0;
          if ($body.hasClass("tm-boxed-layout")) {
            menuItemFromLeft = boxedLayoutWidth  - (menuItemPosition - (browserWidth - boxedLayoutWidth )/2);
          } else {
            menuItemFromLeft = browserWidth - menuItemPosition;
          }

          var dropDownMenuFromLeft; //has to stay undefined beacuse 'dropDownMenuFromLeft < dropdownMenuWidth' condition will be true
          if($this.find('li.menu-item-has-children').length > 0){
            dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
          }

          if(menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth){
            $(this).find('.dropdown').addClass('dropdown-right-zero');
            $this.find('li.menu-item-has-children').find('.dropdown').addClass('dropdown-left');
          }

        });
      }
    },

    /* ---------------------------------------------------------------------- */
    /* --------------------------- Waypoint Top Nav Sticky ------------------ */
    /* ---------------------------------------------------------------------- */
    TM_topnavAnimate: function() {
      if ($window.scrollTop() > (50)) {
        $(".navbar-sticky-animated").removeClass("animated-active");
      } else {
        $(".navbar-sticky-animated").addClass("animated-active");
      }

      if ($window.scrollTop() > (50)) {
        $(".navbar-sticky-animated .header-nav-wrapper .container, .navbar-sticky-animated .header-nav-wrapper .container-fluid").removeClass("add-padding");
      } else {
        $(".navbar-sticky-animated .header-nav-wrapper .container, .navbar-sticky-animated .header-nav-wrapper .container-fluid").addClass("add-padding");
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ---------------- home section on scroll parallax & fade -------------- */
    /* ---------------------------------------------------------------------- */
    TM_homeParallaxFadeEffect: function() {
      if ($window.width() > 1024) {
        var scrolled = $window.scrollTop();
        $('.content-fade-effect .home-content .home-text').css('padding-top', (scrolled * 0.0610) + '%').css('opacity', 1 - (scrolled * 0.00120));
      }
    },

    /* ---------------------------------------------------------------------- */
    /* --------------------------- Top search toggle  ----------------------- */
    /* ---------------------------------------------------------------------- */
    TM_topsearch_toggle: function() {
      $document_body.on('click', '#top-search-toggle', function(e) {
        e.preventDefault();
        $('.search-form-wrapper.toggle').toggleClass('active');
        return false;
      });
    }

  };

  THEMEMASCOT.widget = {

    init: function() {

      var t = setTimeout(function() {
        THEMEMASCOT.widget.TM_masonryIsotope();
        THEMEMASCOT.widget.TM_pieChart();
        THEMEMASCOT.widget.TM_progressBar();
        THEMEMASCOT.widget.TM_SVGAnimation();
        THEMEMASCOT.widget.TM_funfact();
        THEMEMASCOT.widget.TM_instagramFeed();
        THEMEMASCOT.widget.TM_jflickrfeed();
        THEMEMASCOT.widget.TM_accordion_toggles();
        THEMEMASCOT.widget.TM_tooltip();
        THEMEMASCOT.widget.TM_countDownTimer();
      }, 0);

    },

    /* ---------------------------------------------------------------------- */
    /* ----------------------------- Masonry Isotope ------------------------ */
    /* ---------------------------------------------------------------------- */
    TM_masonryIsotope: function() {
      //isotope firsttime loading
      if( $gallery_isotope.length > 0 ) {
        $gallery_isotope.each(function () {
          var $each_istope = $(this);
          $each_istope.imagesLoaded(function(){
            if ($each_istope.hasClass("masonry")){
              var isotope_inner = $each_istope.children('.isotope-layout-inner'),
              size = $each_istope.find('.isotope-item-sizer').width();
              tmMasonryItemsHeightResizer(size, $each_istope);

              isotope_inner.isotope({
                isOriginLeft: THEMEMASCOT.isLTR.check(),
                itemSelector: '.isotope-item',
                layoutMode: "masonry",
                masonry: {
                  columnWidth: '.isotope-item-sizer'
                },
                getSortData : {
                  name : function ( itemElem ) {
                    return $( itemElem ).find('.title').text();
                  },
                  date : '[data-date]',
                },
                filter: "*"
              });
            } else{
              var isotope_inner = $each_istope.children('.isotope-layout-inner');
              isotope_inner.isotope({
                isOriginLeft: THEMEMASCOT.isLTR.check(),
                itemSelector: '.isotope-item',
                layoutMode: "fitRows",
                getSortData : {
                  name : function ( itemElem ) {
                    return $( itemElem ).find('.title').text();
                  },
                  date : '[data-date]',
                },
                filter: "*"
              });
            }
          });

          //search for isotope with single item and add a class to remove left right padding.
          var count = $each_istope.find('.isotope-item:not(.isotope-item-sizer)').length;
          if( count == 1 ) {
            $each_istope.addClass('isotope-layout-single-item');
          }
        });
      }
      
      //isotope filter
      $('.isotope-layout-filter').on('click', 'a', function(e) {
        var $this = $(this);
        var $this_parent = $this.parent('div');
        $this.addClass('active').siblings().removeClass('active');

        var fselector = $this.data('filter');
        var linkwith = $this_parent.data('link-with');
        if ( $('#'+linkwith).hasClass("masonry") ){
          var $this = $('#'+linkwith);
          var isotope_inner = $this.children('.isotope-layout-inner'),
          size = $this.find('.isotope-item-sizer').width();
          tmMasonryItemsHeightResizer(size, $this);
          isotope_inner.isotope({
            isOriginLeft: THEMEMASCOT.isLTR.check(),
            itemSelector: '.isotope-item',
            layoutMode: "masonry",
            masonry: {
              columnWidth: '.isotope-item-sizer'
            },
            filter: fselector
          });
        } else {
          var $this = $('#'+linkwith);
          var isotope_inner = $this.children('.isotope-layout-inner');
          isotope_inner.isotope({
            isOriginLeft: THEMEMASCOT.isLTR.check(),
            itemSelector: '.isotope-item',
            layoutMode: "fitRows",
            filter: fselector
          });
        }
        return false;
      });

      //isotope sorter
      $('.isotope-layout-sorter').on('click', 'a', function(e) {
        var $this = $(this);
        var $this_parent = $this.parent('div');
        $this.addClass('active').siblings().removeClass('active');

        var sortby = $this.data('sortby');
        var linkwith = $this_parent.data('link-with');
        if( sortby === "shuffle" ) {
          $('#'+linkwith).isotope('shuffle');
        } else {
          $('#'+linkwith).isotope({
            isOriginLeft: THEMEMASCOT.isLTR.check(),
            sortBy: sortby
          });
        }
        return false;
      });
      
    },


    TM_isotopeGridRearrange: function() {
      if ($gallery_isotope.hasClass("masonry")){
        $gallery_isotope.isotope({
          isOriginLeft: THEMEMASCOT.isLTR.check(),
          itemSelector: '.isotope-item',
          layoutMode: "masonry"
        });
      } else{
        $gallery_isotope.isotope({
          isOriginLeft: THEMEMASCOT.isLTR.check(),
          itemSelector: '.isotope-item',
          layoutMode: "fitRows"
        });
      }
    },

    TM_isotopeGridShuffle: function() {
      $gallery_isotope.isotope('shuffle');
    },

    /* ---------------------------------------------------------------------- */
    /* ----------------------------- CountDown ------------------------------ */
    /* ---------------------------------------------------------------------- */
    TM_finalCountdown: function() {
    },
    TM_countDownTimer: function() {
      //Modern Circular
      var $timer_modern_circular = $('.final-countdown-modern-circular .countdown');
      if( $timer_modern_circular.length > 0 ) {
        $timer_modern_circular.each(function() {
          var $this = $(this);
          
          var borderwidth = $this.data('borderwidth');
          var bordercolor_second = $this.data('bordercolor-second');
          var bordercolor_minutes = $this.data('bordercolor-minutes');
          var bordercolor_hours = $this.data('bordercolor-hours');
          var bordercolor_days = $this.data('bordercolor-days');

          var defaults = {
            start: undefined,
            end: undefined,
            now: undefined,
            selectors: {
              value_seconds: '.clock-seconds .val',
              canvas_seconds: 'canvas-seconds',

              value_minutes: '.clock-minutes .val',
              canvas_minutes: 'canvas-minutes',

              value_hours: '.clock-hours .val',
              canvas_hours: 'canvas-hours',

              value_days: '.clock-days .val',
              canvas_days: 'canvas-days'
            },
            seconds: {
              borderColor: bordercolor_second,
              borderWidth: borderwidth
            },
            minutes: {
              borderColor: bordercolor_minutes,
              borderWidth: borderwidth
            },
            hours: {
              borderColor: bordercolor_hours,
              borderWidth: borderwidth
            },
            days: {
              borderColor: bordercolor_days,
              borderWidth: borderwidth
            }
          };
          $this.final_countdown(defaults);
        });
      }


      //Basic coupon site
      var $timer_smart_style = $('.final-countdown-smart-style .countdown-timer');
      if( $timer_smart_style.length > 0 ) {
        $timer_smart_style.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');


          var word_hr = $this.data('word-hr');
          var word_min = $this.data('word-min');
          var word_sec = $this.data('word-sec');
          var word_days = $this.data('word-days');

          var str =   '<div class="counter">' +  
                  '<span class="value">%D</span>' + 
                  '<span class="label">' + word_days + '</span>' +
                '</div>' + 
                '<div class="counter">' + 
                  '<span class="value">%H</span>' + 
                  '<span class="label">' + word_hr + '</span>' + 
                '</div>' + 
                '<div class="counter">' + 
                  '<span class="value">%M</span>' + 
                  '<span class="label">' + word_min + '</span>' + 
                '</div>' + 
                '<div class="counter">' + 
                  '<span class="value">%S</span>' + 
                  '<span class="label">' + word_sec + '</span>' + 
                '</div>';

          $this.countdown(future_date, function(event) {
            var $this = $(this).html(event.strftime(str));
          });
        });
      }


      //Advanced coupon site
      var $timer_advanced_coupon = $('.final-countdown-advanced-coupon .countdown-container');
      if( $timer_advanced_coupon.length > 0 ) {
        $timer_advanced_coupon.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');
          var word_weeks = $this.data('word-weeks');
          var word_days = $this.data('word-days');

          $this.countdown( future_date )
          .on('update.countdown', function(event) {
            if( showtime ) {
            var format = '%H:%M:%S';
            } else {
            var format = '';
            }
            if(event.offset.totalDays > 0) {
            format = '<span>%-d</span> '+word_days+' ' + format;
            }
            if(event.offset.weeks > 0) {
            format = '<span>%-w</span> '+word_weeks+' ' + format;
            }
            $(this).html(event.strftime(format));
          })
          .on('finish.countdown', function(event) {
            $(this).html('This offer has expired!')
            .parent().addClass('disabled');

          }); 
        });
      }


      //Basic coupon site
      var $timer_basic_coupon = $('.final-countdown-basic-coupon .countdown-container');
      if( $timer_basic_coupon.length > 0 ) {
        $timer_basic_coupon.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');
          var word_days = $this.data('word-days');

          $this.countdown(future_date, function(event) {
            if( showtime ) {
            var hour_format = ' %H:%M:%S';
            } else {
            var hour_format = '';
            }
            $(this).html(event.strftime('<span>%D</span> '+word_days+''+hour_format));
          });
        });
      }


      //Days Offsets
      var $timer_days_offset = $('.final-countdown-days-offsets .countdown-container');
      if( $timer_days_offset.length > 0 ) {
        $timer_days_offset.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');
          
          var word_hr = $this.data('word-hr');
          var word_min = $this.data('word-min');
          var word_sec = $this.data('word-sec');
          var word_days = $this.data('word-days');

          $this.countdown(future_date, function(event) {
            if( showtime ) {
            var hour_format = ' <span>%H</span> '+word_hr+' '
            + '<span>%M</span> '+word_min+' '
            + '<span>%S</span> '+word_sec+'';
            } else {
            var hour_format = '';
            }
            var $this = $(this).html(event.strftime(''
            + '<span>%D</span> '+word_days+'' + hour_format));
          });
        });
      }


      // Sum of total hours remaining
      var $timer_sum_hours_remaining = $('.final-countdown-sum-hours-remaining .countdown-container');
      if( $timer_sum_hours_remaining.length > 0 ) {
        $timer_sum_hours_remaining.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          
          var word_hr = $this.data('word-hr');
          var word_min = $this.data('word-min');
          var word_sec = $this.data('word-sec');

          $this.countdown(future_date, function(event) {
            var totalHours = event.offset.totalDays * 24 + event.offset.hours;
            var hour_format = ' <span> ' + totalHours + '</span> '+word_hr+' '
            + '<span>%M</span> '+word_min+' '
            + '<span>%S</span> '+word_sec+'';
            $(this).html(event.strftime(hour_format));
          });
        });
      }


      //  Legacy style
      var $timer_legacy_style = $('.final-countdown-legacy-style .countdown-container');
      if( $timer_legacy_style.length > 0 ) {
        $timer_legacy_style.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');

          var word_hr = $this.data('word-hr');
          var word_min = $this.data('word-min');
          var word_sec = $this.data('word-sec');
          var word_weeks = $this.data('word-weeks');
          var word_days = $this.data('word-days');

          $this.countdown(future_date, function(event) {
            if( showtime ) {
            var hour_format = ' <span>%H</span> '+word_hr+' '
            + '<span>%M</span> '+word_min+' '
            + '<span>%S</span> '+word_sec+'';
            } else {
            var hour_format = '';
            }
            var $this = $(this).html(event.strftime(''
            + '<span>%w</span> '+word_weeks+' '
            + '<span>%d</span> '+word_days+'' + hour_format));
          });
        });
      }


      //   Months offsets
      var $timer_months_offsets = $('.final-countdown-months-offsets .countdown-container');
      if( $timer_months_offsets.length > 0 ) {
        $timer_months_offsets.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');

          var word_hr = $this.data('word-hr');
          var word_min = $this.data('word-min');
          var word_sec = $this.data('word-sec');
          var word_month = $this.data('word-month');
          var word_days = $this.data('word-days');

          $this.countdown(future_date, function(event) {
            if( showtime ) {
            var hour_format = ' <span>%H</span> '+word_hr+' '
            + '<span>%M</span> '+word_min+' '
            + '<span>%S</span> '+word_sec+'';
            } else {
            var hour_format = '';
            }
            var $this = $(this).html(event.strftime(''
            + '<span>%m</span> '+word_month+' '
            + '<span>%n</span> '+word_days+'' + hour_format));
          });
        });
      }


      //   Weeks offsets
      var $timer_weeks_offsets = $('.final-countdown-weeks-offsets .countdown-container');
      if( $timer_weeks_offsets.length > 0 ) {
        $timer_weeks_offsets.each(function() {
          var $this = $(this);
          var future_date = $this.data('future-date');
          var showtime = $this.data('showtime');

          var word_hr = $this.data('word-hr');
          var word_min = $this.data('word-min');
          var word_sec = $this.data('word-sec');
          var word_weeks = $this.data('word-weeks');
          var word_days = $this.data('word-days');
          
          $this.countdown(future_date, function(event) {
            if( showtime ) {
            var hour_format = ' <span>%H</span> '+word_hr+' '
            + '<span>%M</span> '+word_min+' '
            + '<span>%S</span> '+word_sec+'';
            } else {
            var hour_format = '';
            }
            var $this = $(this).html(event.strftime(''
            + '<span>%w</span> '+word_weeks+' '
            + '<span>%d</span> '+word_days+'' + hour_format));
          });
        });
      }
    },

    
    /* ---------------------------------------------------------------------- */
    /* ----------------------- pie chart / circle skill bar ----------------- */
    /* ---------------------------------------------------------------------- */
    TM_pieChart: function() {
      var piechart = '.tm-sc-pie-chart .pie-chart';
      var $piechart = $(piechart);
      if( $piechart.length > 0 ) {
        $piechart.appear();
        $document_body.on('appear', piechart, function() {
          var current_item = $(this);
          if (!current_item.hasClass('appeared')) {
            current_item.easyPieChart({
              onStep: function(from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
              }
            });
            current_item.addClass('appeared');
          }
        });
      }
    },
    
    /* ---------------------------------------------------------------------- */
    /* ------------------- progress bar / horizontal skill bar -------------- */
    /* ---------------------------------------------------------------------- */
    TM_progressBar: function() {
      var $progress_bar = $('.tm-sc-progress-bar');
      if( $progress_bar.length > 0 ) {
        $progress_bar.appear();
        $document_body.on('appear', '.tm-sc-progress-bar', function() {
          var current_item = $(this);
          if (!current_item.hasClass('appeared')) {
            var percentage = current_item.data('percent');
            var bar_height = current_item.data('bar-height');
            var percent = current_item.find('.percent');
            var bar_holder = current_item.find('.progress-holder');
            var bar = current_item.find('.progress-content');

            if (current_item.hasClass('progress-bar-default')) {
              tmProgressBarCounter(bar.find('span.value'), percentage);
            } else {
              tmProgressBarCounter(percent.find('span.value'), percentage);
            }
            
            bar.css('width', '0%').animate({'width': percentage + '%'}, 2000);

            if (current_item.hasClass('progress-bar-floating-percent')) {
              percent.css('left', '0%').animate({'left': percentage + '%'}, 2000);
            }

            if ( bar_height != '' ) {
              bar_holder.css('height', bar_height);
              bar.css('height', bar_height);
            }


            var barcolor = current_item.data('barcolor');
            bar.css('background-color', barcolor);
            current_item.addClass('appeared');
          }
          
        });
      }
    },
    
    /* ---------------------------------------------------------------------- */
    /* ---------------------------- SVG Animation  -------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_SVGAnimation: function() {
      var $svg_animation = $('.tm-iconbox-icontype-svg-image');
      if( $svg_animation.length > 0 ) {
        $svg_animation.appear();
        $document_body.on('appear', '.tm-iconbox-icontype-svg-image', function() {
          var current_item = $(this);
          if (!current_item.hasClass('appeared')) {


            var type = current_item.data('svg-animation-type'),
              duration = current_item.data('svg-animation-duration'),
              durationDelay = '',
              reverse = '',
              strokeWidth = '',
              strokeColor = '',
              selector = '',
              customStyle = '',
              style = '';

            if (typeof current_item.data('svg-animation-duration-delay') !== 'undefined') {
              durationDelay = current_item.data('svg-animation-duration-delay');
            }

            if (typeof current_item.data('svg-reverse-animation') !== 'undefined') {
              reverse = current_item.data('svg-reverse-animation');
            }

            if (typeof current_item.data('svg-stroke-width') !== 'undefined') {
              strokeWidth = current_item.data('svg-stroke-width');
            }

            if (typeof current_item.data('svg-stroke-color') !== 'undefined') {
              strokeColor = current_item.data('svg-stroke-color');
            }

            var _vivus = new Vivus(current_item.find('.tm-vivus-svg-animation').attr('id'), {
              type: type,
              duration: duration,
              delay: durationDelay,
              reverseStack: reverse,
            });

            current_item.on({
              mouseenter: function () {
                //stuff to do on mouse enter
                _vivus.reset().play();
              },
              mouseleave: function () {
                //stuff to do on mouse leave
              }
            });

            if (strokeWidth > 0 || strokeColor.length) {
              selector = '#' + current_item.find('.tm-vivus-svg-animation').attr('id') + ' path';
              if (strokeWidth ) {
                customStyle += 'stroke-width:' + strokeWidth + ';';
              }

              if (strokeColor.length) {
                customStyle += 'stroke:' + strokeColor + ';';
              }
            }

            if (customStyle.length) {
              style = '<style type="text/css">' + selector + '{' + customStyle + '}</style>';
            }

            if (style.length) {
              $('head').append(style);
            }

            current_item.addClass('appeared');
          }
        });
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ------------------------ Funfact Number Counter ---------------------- */
    /* ---------------------------------------------------------------------- */
    TM_funfact: function() {
      var $animate_number = $('.animate-number');
      if( $animate_number.length > 0 ) {
        $animate_number.appear();
        $document_body.on('appear', '.animate-number', function() {
          $animate_number.each(function() {
            var current_item = $(this);
            if (!current_item.hasClass('appeared')) {
              current_item.animateNumbers(current_item.attr("data-value"), true, parseInt(current_item.attr("data-animation-duration"), 10)).addClass('appeared');
            }
          });
        });
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ----------------------------- Instagram Feed ---------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_instagramFeed: function() {
      var $instagram_feed_grid = $('.instagram-feed-grid');
      if( $instagram_feed_grid.length > 0 ) {
        $instagram_feed_grid.each(function() {
          var current_div = $(this);
          var instagramFeed = new Instafeed({
            target: current_div.attr('id'),
            get: 'user',
            userId: current_div.data('userid'),
            accessToken: current_div.data('accesstoken'),
            resolution: current_div.data('resolution'),
            limit: current_div.data('limit'),
            template: '<div class="item"><figure><img src="{{image}}" /><a href="{{link}}" class="link-out" target="_blank"><i class="fa fa-link"></i></a></figure></div>',
            after: function() {
            }
          });
          instagramFeed.run();
        });
      }

      var $instagram_feed_carousel = $('.instagram-feed-carousel');
      if( $instagram_feed_carousel.length > 0 ) {
        $instagram_feed_carousel.each(function() {
          var current_div = $(this);
          var instagramFeed = new Instafeed({
            target: current_div.attr('id'),
            get: 'user',
            userId: current_div.data('userid'),
            accessToken: current_div.data('accesstoken'),
            resolution: current_div.data('resolution'),
            limit: current_div.data('limit'),
            template: '<div class="item img-fullwidth"><figure><img width="250" src="{{image}}" /><a href="{{link}}" class="link-out" target="_blank"><i class="fa fa-link"></i></a></figure></div>',
            after: function() {
              current_div.addClass("owl-carousel owl-theme").owlCarousel({
                autoplay: true,
                autoplayTimeout: 4000,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                  '<i class="fa fa-chevron-left"></i>',
                  '<i class="fa fa-chevron-right"></i>'
                ],
                responsive: {
                  0: {
                    items: 1
                  },
                  768: {
                    items: 1
                  },
                  1000: {
                    items: 1
                  }
                }
              });
            }
          });
          instagramFeed.run();
        });
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ---------------------------- Flickr Feed ----------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_jflickrfeed: function() {
      var $jflickrfeed = $(".flickr-widget .flickr-feed, .jflickrfeed");
      if( $jflickrfeed.length > 0 ) {
        $jflickrfeed.each(function() {
          var current_div = $(this);
          current_div.jflickrfeed({
            limit: 9,
            qstrings: {
              id: current_div.data('userid')
            },
            itemTemplate: '<a href="{{link}}" title="{{title}}" target="_blank"><img src="{{image_m}}" alt="{{title}}">  </a>'
          });
        });
      }
    },

    /* ---------------------------------------------------------------------- */
    /* ------------------------- accordion & toggles ------------------------ */
    /* ---------------------------------------------------------------------- */
    TM_accordion_toggles: function() {
      var $panel_group_collapse = $('.panel-group .collapse');
      $panel_group_collapse.on("show.bs.collapse", function(e) {
        $(this).closest(".panel-group").find("[href='#" + $(this).attr("id") + "']").addClass("active");
      });
      $panel_group_collapse.on("hide.bs.collapse", function(e) {
        $(this).closest(".panel-group").find("[href='#" + $(this).attr("id") + "']").removeClass("active");
      });
    },

    /* ---------------------------------------------------------------------- */
    /* ------------------------------- tooltip  ----------------------------- */
    /* ---------------------------------------------------------------------- */
    TM_tooltip: function() {
      var $tooltip = $('[data-toggle="tooltip"]');
      if( $tooltip.length > 0 ) {
      }
    },
  };

  THEMEMASCOT.slider = {

    init: function() {

      var t = setTimeout(function() {
        THEMEMASCOT.slider.TM_slick();
        THEMEMASCOT.slider.TM_bxslider();
        THEMEMASCOT.slider.TM_beforeAfterSlider();
      }, 0);

    },
    

    /* ---------------------------------------------------------------------- */
    /* -------------------------------- Slick Carousel  --------------------- */
    /* ---------------------------------------------------------------------- */
    TM_slick: function() {
      var $slick_carousel_1col = $('.slick-carousel-1col');
      if ( $slick_carousel_1col.length > 0 ) {
        $slick_carousel_1col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav") === undefined ) ? false: $this.data("nav");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_duration = ( $this.data("duration") === undefined ) ? 3000: $this.data("duration");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");

          var items_desktop = 2;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 2: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 2: $this.data("tablet");
          
          $this.slick({
            infinite: data_loop,
            autoplay: data_autoplay,
            autoplaySpeed: data_duration,
            slidesToShow : items_desktop,
            arrows: data_nav,
            dots: data_dots,
            dotsClass: 'tm-slick-dots',
            adaptiveHeight: true,
            easing:'easeOutCubic',
            prevArrow: '<span class="tm-slick-prev tm-prev-icon"><i class="fa fa-chevron-left"></i></span>',
            nextArrow: '<span class="tm-slick-next tm-next-icon"><i class="fa fa-chevron-right"></i></span>',
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
            ]
          });
        });
      }


      var $slick_thumbnail_slider = $('.slick-thumbnail-slider');
      if ( $slick_thumbnail_slider.length > 0 ) {
        $slick_thumbnail_slider.each(function() {
          var $this = $(this);
          var id =  $this.attr('id');
          $this.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav-'+id
          });

          $('.slider-nav-'+id).slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            asNavFor: $this,
            dots: false,
            centerMode: false,
            focusOnSelect: true
          });

        });
      }
    },

    

    /* ---------------------------------------------------------------------- */
    /* -------------------------------- Owl Carousel  ----------------------- */
    /* ---------------------------------------------------------------------- */
    TM_owlCarousel: function() {
      var $owl_thumb_carousel = $('.tm-owl-thumb-carousel');
      if ( $owl_thumb_carousel.length > 0 ) {
        if(!$owl_thumb_carousel.hasClass("owl-carousel")){
          $owl_thumb_carousel.addClass("owl-carousel owl-theme");
        }
        $owl_thumb_carousel.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav") === undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          
          $this.owlCarousel({
            // Enable thumbnails
            thumbs: true,
            // When only using images in your slide (like the demo) use this option to dynamicly create thumbnails without using the attribute data-thumb.
            thumbImage: false,
            // Enable this if you have pre-rendered thumbnails in your html instead of letting this plugin generate them. This is recommended as it will prevent FOUC
            thumbsPrerendered: true,
            // Class that will be used on the thumbnail container
            thumbContainerClass: 'tm-owl-thumbs',
            // Class that will be used on the thumbnail item's
            thumbItemClass: 'tm-owl-thumb-item',


            
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 1,
            dots: data_dots,
            nav: data_nav,
            center: true,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ]
          });
        });
      }


      var $owl_carousel_1col = $('.tm-owl-carousel-1col');
      if ( $owl_carousel_1col.length > 0 ) {
        if(!$owl_carousel_1col.hasClass("owl-carousel")){
          $owl_carousel_1col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_1col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav") === undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 1,
            dots: data_dots,
            nav: data_nav,
            center: true,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ]
          });
        });
      }

      var $owl_carousel_2col = $('.tm-owl-carousel-2col');
      if ( $owl_carousel_2col.length > 0 ) {
        if(!$owl_carousel_2col.hasClass("owl-carousel")){
          $owl_carousel_2col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_2col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav")=== undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_smartspeed = ( $this.data("smartspeed") === undefined ) ? 300: $this.data("smartspeed");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          var data_stagePadding = ( $this.data("stagepadding") === undefined ) ? 0: $this.data("stagepadding");
          var data_center = ( $this.data("center") === undefined ) ? false: $this.data("center");

          var items_desktop = 2;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 2: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 2: $this.data("tablet");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            smartSpeed: data_smartspeed,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 2,
            margin: data_margin,
            stagePadding: data_stagePadding,
            dots: data_dots,
            nav: data_nav,
            center: data_center,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
              0: {
                items: 1,
                stagePadding: 0,
              },
              768: {
                items: items_tablet,
                stagePadding: 0,
              },
              1025: {
                items: items_laptop
              },
              1441: {
                items: items_desktop
              }
            }
          });
        });
      }

      var $owl_carousel_3col = $('.tm-owl-carousel-3col');
      if ( $owl_carousel_3col.length > 0 ) {
        if(!$owl_carousel_3col.hasClass("owl-carousel")){
          $owl_carousel_3col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_3col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav")=== undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_smartspeed = ( $this.data("smartspeed") === undefined ) ? 300: $this.data("smartspeed");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          var data_stagePadding = ( $this.data("stagepadding") === undefined ) ? 0: $this.data("stagepadding");
          var data_center = ( $this.data("center") === undefined ) ? false: $this.data("center");

          var items_desktop = 3;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 2: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 2: $this.data("tablet");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            smartSpeed: data_smartspeed,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 3,
            margin: data_margin,
            stagePadding: data_stagePadding,
            dots: data_dots,
            nav: data_nav,
            center: data_center,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
              0: {
                items: 1,
                stagePadding: 0,
              },
              768: {
                items: items_tablet,
                stagePadding: 0,
              },
              1025: {
                items: items_laptop
              },
              1441: {
                items: items_desktop
              }
            }
          });
        });
      }
      

      var $owl_carousel_4col = $('.tm-owl-carousel-4col');
      if ( $owl_carousel_4col.length > 0 ) {
        if(!$owl_carousel_4col.hasClass("owl-carousel")){
          $owl_carousel_4col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_4col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav")=== undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_smartspeed = ( $this.data("smartspeed") === undefined ) ? 300: $this.data("smartspeed");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          var data_stagePadding = ( $this.data("stagepadding") === undefined ) ? 0: $this.data("stagepadding");
          var data_center = ( $this.data("center") === undefined ) ? false: $this.data("center");

          var items_desktop = 4;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 3: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 2: $this.data("tablet");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            smartSpeed: data_smartspeed,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 4,
            margin: data_margin,
            stagePadding: data_stagePadding,
            dots: data_dots,
            nav: data_nav,
            center: data_center,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
              0: {
                items: 1,
                stagePadding: 0,
              },
              768: {
                items: items_tablet,
                stagePadding: 0,
              },
              1025: {
                items: items_laptop
              },
              1441: {
                items: items_desktop
              }
            }
          });
        });
      }

      var $owl_carousel_5col = $('.tm-owl-carousel-5col');
      if ( $owl_carousel_5col.length > 0 ) {
        if(!$owl_carousel_5col.hasClass("owl-carousel")){
          $owl_carousel_5col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_5col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav")=== undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_smartspeed = ( $this.data("smartspeed") === undefined ) ? 300: $this.data("smartspeed");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          var data_stagePadding = ( $this.data("stagepadding") === undefined ) ? 0: $this.data("stagepadding");
          var data_center = ( $this.data("center") === undefined ) ? false: $this.data("center");

          var items_desktop = 5;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 4: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 2: $this.data("tablet");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            smartSpeed: data_smartspeed,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 5,
            margin: data_margin,
            stagePadding: data_stagePadding,
            dots: data_dots,
            nav: data_nav,
            center: data_center,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
              0: {
                items: 1,
                stagePadding: 0,
              },
              768: {
                items: items_tablet,
                stagePadding: 0,
              },
              1025: {
                items: items_laptop
              },
              1441: {
                items: items_desktop
              }
            }
          });
        });
      }

      var $owl_carousel_6col = $('.tm-owl-carousel-6col');
      if ( $owl_carousel_6col.length > 0 ) {
        if(!$owl_carousel_6col.hasClass("owl-carousel")){
          $owl_carousel_6col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_6col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav")=== undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_smartspeed = ( $this.data("smartspeed") === undefined ) ? 300: $this.data("smartspeed");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          var data_stagePadding = ( $this.data("stagepadding") === undefined ) ? 0: $this.data("stagepadding");
          var data_center = ( $this.data("center") === undefined ) ? false: $this.data("center");

          var items_desktop = 6;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 4: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 2: $this.data("tablet");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            smartSpeed: data_smartspeed,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 6,
            margin: data_margin,
            stagePadding: data_stagePadding,
            dots: data_dots,
            nav: data_nav,
            center: data_center,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
              0: {
                items: 1,
                stagePadding: 0,
              },
              768: {
                items: items_tablet,
                stagePadding: 0,
              },
              1025: {
                items: items_laptop
              },
              1441: {
                items: items_desktop
              }
            }
          });
        });
      }

      var $owl_carousel_7col = $('.tm-owl-carousel-7col');
      if ( $owl_carousel_7col.length > 0 ) {
        if(!$owl_carousel_7col.hasClass("owl-carousel")){
          $owl_carousel_7col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_7col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav")=== undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_smartspeed = ( $this.data("smartspeed") === undefined ) ? 300: $this.data("smartspeed");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          var data_stagePadding = ( $this.data("stagepadding") === undefined ) ? 0: $this.data("stagepadding");
          var data_center = ( $this.data("center") === undefined ) ? false: $this.data("center");

          var items_desktop = 7;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 5: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 3: $this.data("tablet");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            smartSpeed: data_smartspeed,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 7,
            margin: data_margin,
            stagePadding: data_stagePadding,
            dots: data_dots,
            nav: data_nav,
            center: data_center,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
              0: {
                items: 1,
                stagePadding: 0,
              },
              768: {
                items: items_tablet,
                stagePadding: 0,
              },
              1025: {
                items: items_laptop
              },
              1441: {
                items: items_desktop
              }
            }
          });
        });
      }

      var $owl_carousel_8col = $('.tm-owl-carousel-8col');
      if ( $owl_carousel_8col.length > 0 ) {
        if(!$owl_carousel_8col.hasClass("owl-carousel")){
          $owl_carousel_8col.addClass("owl-carousel owl-theme");
        }
        $owl_carousel_8col.each(function() {
          var $this = $(this);
          var data_dots = ( $this.data("dots") === undefined ) ? false: $this.data("dots");
          var data_nav = ( $this.data("nav")=== undefined ) ? false: $this.data("nav");
          var data_duration = ( $this.data("duration") === undefined ) ? 4000: $this.data("duration");
          var data_smartspeed = ( $this.data("smartspeed") === undefined ) ? 300: $this.data("smartspeed");
          var data_autoplay = ( $this.data("autoplay") === undefined ) ? false: $this.data("autoplay");
          var data_loop = ( $this.data("loop") === undefined ) ? true: $this.data("loop");
          var data_margin = ( $this.data("margin") === undefined ) ? 30: $this.data("margin");
          var data_stagePadding = ( $this.data("stagepadding") === undefined ) ? 0: $this.data("stagepadding");
          var data_center = ( $this.data("center") === undefined ) ? false: $this.data("center");

          var items_desktop = 8;
          var items_laptop = ( $this.data("laptop") === undefined ) ? 6: $this.data("laptop");
          var items_tablet = ( $this.data("tablet") === undefined ) ? 4: $this.data("tablet");
          
          $this.owlCarousel({
            rtl: THEMEMASCOT.isRTL.check(),
            autoplay: data_autoplay,
            autoplayTimeout: data_duration,
            smartSpeed: data_smartspeed,
            autoHeight: true,
            responsiveClass: true,
            loop: data_loop,
            items: 8,
            margin: data_margin,
            stagePadding: data_stagePadding,
            dots: data_dots,
            nav: data_nav,
            center: data_center,
            navText: [
              '<i class="fa fa-chevron-left"></i>',
              '<i class="fa fa-chevron-right"></i>'
            ],
            responsive: {
              0: {
                items: 1,
                stagePadding: 0,
              },
              768: {
                items: items_tablet,
                stagePadding: 0,
              },
              1025: {
                items: items_laptop
              },
              1441: {
                items: items_desktop
              }
            }
          });
        });
      }


      /* animate filter */
      var owlAnimateFilter = function(even) {
        $(this)
        .addClass('__loading')
        .delay(70 * $(this).parent().index())
        .queue(function() {
          $(this).dequeue().removeClass('__loading')
        })
      }

      $('.carousel-layout-filter').on('click', 'a', function(e) {
        e.preventDefault();
        var $this = $(this);

        var $this_parent = $this.parent('div');
        
        $this.addClass('active').siblings().removeClass('active');

        var filter_data = $this.data('filter');
        var linkwith = $this_parent.data('link-with');

        /* Filter */
        $('#'+linkwith).owlFilter(filter_data, function(_owl) { 
          $(_owl).find('.tm-carousel-item').each(owlAnimateFilter); 
        });
      })


      //full height owl slider
      var $portfolio_full_height_slider = $('.tm-sc-portfolio-full-height-slider');
      if( $portfolio_full_height_slider.length > 0 ) {
        var col = $portfolio_full_height_slider.find('.full-height-slider-inner').data('col');

        var owl_carousel;
        if(col==2) {
          owl_carousel = $owl_carousel_2col;
        } else if(col==3) {
          owl_carousel = $owl_carousel_3col;
        } else if(col==4) {
          owl_carousel = $owl_carousel_4col;
        } else if(col==5) {
          owl_carousel = $owl_carousel_5col;
        } else if(col==6) {
          owl_carousel = $owl_carousel_6col;
        }

        owl_carousel.on('mousewheel', '.owl-stage', function (e) {
          if (e.deltaY>0) {
            owl_carousel.trigger('next.owl');
          } else {
            owl_carousel.trigger('prev.owl');
          }
          e.preventDefault();
        });
      }
      
    },


    /* ---------------------------------------------------------------------- */
    /* ----------------------------- BxSlider  ------------------------------ */
    /* ---------------------------------------------------------------------- */
    TM_bxslider: function() {
      var $bxslider = $('.bxslider');
      if( $bxslider.length > 0 ) {
        $bxslider.each(function() {
          var $this = $(this);
          $this.bxSlider({
            mode: 'vertical',
            minSlides: ( $this.data("minslides") === undefined ) ? 2: $this.data("minslides"),
            slideMargin: 20,
            touchEnabled: ( $this.data("touchenabled") === undefined ) ? false: $this.data("touchenabled"),
            pager: false,
            auto: ( $this.data("autoplay") === undefined ) ? true: $this.data("autoplay"),
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>'
          });
        });
      }

      if ($('.testimonials-circle-carousel').length) {
        $('.testimonials-circle-carousel').bxSlider({
          auto: true,
          controls: true,
          nextText: '<i class="opins-icon-right"></i>',
          prevText: '<i class="opins-icon-left"></i>',
          pause: 5000,
          speed: 500,
          pager: true,
          pagerCustom: '.testimonials-slider-pager-one, .testimonials-slider-pager-two'
        });
      }
    },


    /* ---------------------------------------------------------------------- */
    /* ------------------------ Before After Slider  ------------------------ */
    /* ---------------------------------------------------------------------- */
    TM_beforeAfterSlider: function() {
      var $before_after_slider = $('.twentytwenty-container');
      if ( $.isFunction($.fn.twentytwenty) ) {
        if( $before_after_slider.length > 0 ) {
          $before_after_slider.each(function() {
            var $this = $(this);
            var data_offset_pct = ( $this.data("offset-percent") === undefined ) ? 0.5: $this.data("offset-percent");
            var data_orientation = ( $this.data("orientation") === undefined ) ? 'horizontal': $this.data("orientation");
            var data_before_label = ( $this.data("before-label") === undefined ) ? 'Before': $this.data("before-label");
            var data_after_label = ( $this.data("after-label") === undefined ) ? 'After': $this.data("after-label");
            var data_no_overlay = ( $this.data("no-overlay") === undefined ) ? true: $this.data("no-overlay");
            $this.twentytwenty({
              default_offset_pct: data_offset_pct, // How much of the before image is visible when the page loads
              orientation: data_orientation, // Orientation of the before and after images ('horizontal' or 'vertical')
              before_label: data_before_label, // Set a custom before label
              after_label: data_after_label, // Set a custom after label
              no_overlay: data_no_overlay //Do not show the overlay with before and after
            });
          });
        }
      }
    }
  };


  /* ---------------------------------------------------------------------- */
  /* ---------- document ready, window load, scroll and resize ------------ */
  /* ---------------------------------------------------------------------- */
  //document ready
  THEMEMASCOT.documentOnReady = {
    init: function() {
      THEMEMASCOT.initialize.init();
      THEMEMASCOT.header.init();
      THEMEMASCOT.slider.init();
      THEMEMASCOT.widget.init();
      THEMEMASCOT.windowOnscroll.init();
    }
  };

  //window on load
  THEMEMASCOT.windowOnLoad = {
    init: function() {
      var t = setTimeout(function() {
        THEMEMASCOT.slider.TM_owlCarousel();
      }, 0);
      var tdelay = setTimeout(function() {
        THEMEMASCOT.widget.TM_masonryIsotope();
      }, 400);
      $window.trigger("scroll");
      $window.trigger("resize");
    }
  };

  //window on scroll
  THEMEMASCOT.windowOnscroll = {
    init: function() {
      $window.on( 'scroll', function(){
      });
    }
  };

  //window on resize
  THEMEMASCOT.windowOnResize = {
    init: function() {
      var t = setTimeout(function() {
        THEMEMASCOT.header.TM_Memuzord_Megamenu();
        THEMEMASCOT.header.TM_TopNav_Dropdown_Position();
        THEMEMASCOT.widget.TM_masonryIsotope();
        THEMEMASCOT.initialize.TM_equalHeightDivs();
      }, 400);
    }
  };


  THEMEMASCOT.header.TM_menuzord();
  

  /* ---------------------------------------------------------------------- */
  /* ---------------------------- Call Functions -------------------------- */
  /* ---------------------------------------------------------------------- */
  $document.ready(
    THEMEMASCOT.documentOnReady.init
  );
  $window.on('load',
    THEMEMASCOT.windowOnLoad.init
  );
  $window.on('resize', 
    THEMEMASCOT.windowOnResize.init
  );

})(jQuery);