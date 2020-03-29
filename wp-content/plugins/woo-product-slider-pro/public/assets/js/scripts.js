jQuery(function ($) {

    'use strict';

    /**
     * Preloader.
     */
    $('body').find('.wpsp-product-section').each(function () {
        var _this = $(this),
            custom_id = $(this).attr('id'),
            preloader = _this.data('preloader');
        if ('1' == preloader) {
            var parents_class = $('#' + custom_id).parent('.wpsp-slider-section'),
                parents_siblings_id = parents_class.find('.wpspro-preloader').attr('id');
            $(window).load(function () {
                $('#' + parents_siblings_id).animate({ opacity: 1 }, 600).hide();
                $('#' + custom_id).animate({ opacity: 1 }, 600)
            })
        }
    })

    $('.wpsp-product-section').each(function () {
        var custom_id = $(this).attr('id');
        var _this = $(this);

        /**
         * Slider.
         */
        var layout_preset = _this.data('layout');
        if (custom_id != '' && layout_preset == 'slider') {
            jQuery('#' + custom_id).slick({

                prevArrow: '<div class="slick-prev"><i class="fa fa-' + _this.data('arrowicon') + '-left"></i></div>',
                nextArrow: '<div class="slick-next"><i class="fa fa-' + _this.data('arrowicon') + '-right"></i></div>',

            }); // Slick end
        }
        /**
         * Masonry.
         */
        if (custom_id != '' && layout_preset == 'grid') {
            $('.grid_style_masonry .wpsp-product-section#' + custom_id).masonry({
                // options
                itemSelector: 'div.wpsp-masonry-item'
            });
        }

        /**
         * Magnific Popup
         */
        var lightbox = _this.data('lightbox');
        function wpsproLightbox() {
            $('#' + custom_id + ' .wpsp-product').magnificPopup({
                delegate: 'a.sp-wpsp-lightbox',
                type: 'image',
                // other options
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'mfp-with-zoom mfp-img-mobile',
                zoom: {
                    enabled: true,
                    duration: 300, // don't forget to change the duration also in CSS
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        }
        if ('1' == lightbox) {
            wpsproLightbox();
        }

        /**
         * Ajax pagination.
         */
        var pagination_type = _this.data('pagination');
        var appendClass = '#' + custom_id + ' .wpsp-product';
        if (custom_id != '' && layout_preset == 'grid') {
            if (pagination_type == 'ajax_number') {
                $('.wpsp-slider-section .wpspro-preloader').hide();
                $('#wpsp-slider-section').on('click', '.wpspro-pagination.wpspro-ajax-num-pagination a', function (e) {
                    e.preventDefault();
                    var link = $(this).attr('href');
                    $('#wpsp-slider-section').animate({ opacity: 1 }, 400, function () {
                        $('.wpsp-slider-section .wpspro-preloader').show();
                        $(this).load(link + ' #wpsp-slider-section', function () {
                            $(this).animate({ opacity: 1 }, 400);
                            $('.wpsp-slider-section .wpspro-preloader').hide();
                            if ('1' == lightbox) {
                                wpsproLightbox();
                            }
                        });
                    });
                });
            } else if (pagination_type == 'load_more_scroll') {
                $('#' + custom_id + '.wpsp-product-section.load_more_scroll').infiniteScroll({
                    // options
                    path: '.' + custom_id + ' .next.page-numbers',
                    append: appendClass,
                    scrollThreshold: 100,
                    history: false,
                    status: '.' + custom_id + ' .page-load-status',
                    button: '.' + custom_id + ' .wpspro-item-load-more',
                    onInit: function() {
                        this.on( 'append', function() {
                            if ('1' == lightbox) {
                                wpsproLightbox();
                            }
                        });
                    }
                });
            } else if (pagination_type == 'load_more_btn') {
                $('#' + custom_id + '.wpsp-product-section.load_more_btn').infiniteScroll({
                    // options
                    path: '.' + custom_id + ' .next.page-numbers',
                    append: appendClass,
                    scrollThreshold: 100,
                    history: false,
                    status: '.' + custom_id + ' .page-load-status',
                    button: '.' + custom_id + ' .wpspro-item-load-more',
                    loadOnScroll: false,
                    elementScroll: true,
                    hideNav: '.' + custom_id + ' .wpspro-pagination',
                    onInit: function() {
                        this.on( 'append', function() {
                            if ('1' == lightbox) {
                                wpsproLightbox();
                            }
                        });
                    }
                });
            }
        }

    });

});