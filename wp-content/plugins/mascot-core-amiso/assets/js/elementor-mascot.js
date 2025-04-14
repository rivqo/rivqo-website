(function($) {
    'use strict';

    var elementorBlogSlider = {};

    elementorBlogSlider.MascotCoreElementorInitScript = MascotCoreElementorInitScript;


    elementorBlogSlider.MascotCoreElementorOnWindowLoad = MascotCoreElementorOnWindowLoad;

    $(window).load(MascotCoreElementorOnWindowLoad);

    /*
     ** All functions to be called on $(window).load() should be in this function
     */
    function MascotCoreElementorOnWindowLoad() {
        
        var isEditMode = Boolean(elementorFrontend.isEditMode());
        if (isEditMode) {
            MascotCoreElementorInitScript();
        }
    }

    function MascotCoreElementorInitScript(){
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/init', function() {
            // Do something that is based on the elementorFrontend object.
            } );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/tm-ele-animated-layers.default', function() {
            } );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
            } );
            elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function( $scope ) {
                THEMEMASCOT.documentOnReady.init();
                THEMEMASCOT.windowOnLoad.init();
                THEMEMASCOT.slider.TM_owlCarousel();
            } );
        });
    }


    var WidgetContactHandler = function ($scope) {
        if ($(".get-quote__progress-range").length) {
            $(".get-quote__progress-range").each(function () {
                let balanceTag = $(this).find(".get-quote__balance span");
                let balanceInput = $(this).find(".get-quote__balance__input");
                $(this).find(".balance-range-slider").ionRangeSlider({
                    onStart: function (data) {
                        balanceTag.html(data.from);
                        balanceInput.prop("value", data.from);
                    },
                    onChange: function (data) {
                        balanceTag.html(data.from);
                        balanceInput.prop("value", data.from);
                    }
                });
            });
        }

        if ($(".range-slider-price").length) {
            var priceRange = document.getElementById("range-slider-price");

            noUiSlider.create(priceRange, {
                start: [30, 150],
                limit: 200,
                behaviour: "drag",
                connect: true,
                range: {
                    min: 10,
                    max: 200
                }
            });

            var limitFieldMin = document.getElementById("min-value-rangeslider");
            var limitFieldMax = document.getElementById("max-value-rangeslider");

            priceRange.noUiSlider.on("update", function (values, handle) {
                (handle ? $(limitFieldMax) : $(limitFieldMin)).text(values[handle]);
            });
        }
    };

    //elementor front start
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/tm-ele-contact-form-7.default",
            WidgetContactHandler
        );
    });


})(jQuery);