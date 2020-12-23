/*
 * center menu 
 */
/*
 * BG Loaded
 * Copyright (c) 2014 Jonathan Catmull
 * Licensed under the MIT license.
 */

(function ($) {
    $.fn.bgLoaded = function (custom) {

        var self = this;

        // Default plugin settings
        var defaults = {
            afterLoaded: function () {
                this.addClass('bg-loaded');
            }
        };

        // Merge default and user settings
        var settings = $.extend({}, defaults, custom);

        // Loop through element
        self.each(function () {
            var $this = $(this),
                    bgImgs = $this.css('background-image').split(', ');
            $this.data('loaded-count', 0);

            $.each(bgImgs, function (key, value) {
                var img = value.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');
                $('<img/>').attr('src', img).load(function () {
                    $(this).remove(); // prevent memory leaks
                    $this.data('loaded-count', $this.data('loaded-count') + 1);
                    if ($this.data('loaded-count') >= bgImgs.length) {
                        settings.afterLoaded.call($this);
                    }
                });
            });

        });
    };
//    "use strict";
//
//    function menu_align() {
//        var headerWrap = $('.site-header');
//        var navWrap = $('.navbar');
//        var logoWrap = $('.site-logo');
//        var containerWrap = $('.container');
//        var classToAdd = 'header-align-center';
//        if (headerWrap.hasClass(classToAdd))
//        {
//            headerWrap.removeClass(classToAdd);
//        }
//        var logoWidth = logoWrap.outerWidth();
//        var menuWidth = navWrap.outerWidth();
//        var containerWidth = containerWrap.width();
//        if (menuWidth + logoWidth > containerWidth) {
//            headerWrap.addClass(classToAdd);
//        } else {
//            if (headerWrap.hasClass(classToAdd))
//            {
//                headerWrap.removeClass(classToAdd);
//            }
//        }
//
//    }
    function ifraimeResize() {
        $('.entry-media iframe:visible , .entry-content iframe:visible').each(function () {
            if ($(this).parents('.work-blog').length) {
                if ($(this).parents('.container').width() < $(this).parents('.work-blog').width()) {
                    var parentWidth = $(this).parents('.container').width();
                } else {
                    var parentWidth = $(this).parents('.work-blog').width() - 40;
                }
            } else {
                var parentWidth = $(this).parent().width();
            }
            var thisWidth = $(this).attr('width');
            var thisHeight = $(this).attr('height');
            $(this).css('width', parentWidth);
            var newHeight = thisHeight * parentWidth / thisWidth;
            $(this).css('height', newHeight);
        });
    }

    $(window).load(function () {
        ifraimeResize();
        $("input[type='radio']").labelauty({
            checked_label: "",
            unchecked_label: "",
            class: "radio-labelauty"
        });
        $("input[type='checkbox']").labelauty({
            checked_label: "",
            unchecked_label: ""
        });
        
    });
    $(window).resize(function () {
        ifraimeResize();
    });
    $(document).ready(function () {
        $('body').on('click', '.menu-icon', function (e) {
            e.preventDefault();
            if ($(window).width() < 992) {
                $('.main-header .navbar').toggleClass('active');
                $('.main-header .navbar').slideToggle(500);
                $(this).toggleClass('active');
            }
        });

        ifraimeResize();
        $('.work-wrapper-bg').each(function () {
            $(this).css('opacity', '0');
            $(this).bgLoaded({
                afterLoaded: function () {
                    $(this).css('opacity', '1');
                }
            });
        });
        var container = $('.work-blog');
        container.infinitescroll({
            navSelector: ".older-works",
            nextSelector: ".older-works a",
            itemSelector: ".work-blog .page-wrapper",
            debag: true,
            loading: {
                finishedMsg: '',
                img: (template_directory_uri.url + '/images/loader.svg'),
                msgText: ''
            }
        }, function (newElements) {
            var elements = newElements;
            $(newElements).each(function () {
                $(this).find('.work-wrapper-bg').css('opacity', '0');
                $(this).find('.work-wrapper-bg').bgLoaded({
                    afterLoaded: function () {
                        $(this).css('opacity', '1');                         
                    }
                });
                ifraimeResize();
            });
        });
        var container2 = $('.two-col-works');
        container2.infinitescroll({
            navSelector: ".older-works",
            nextSelector: ".older-works a",
            itemSelector: ".two-col-works .work-element",
            debag: true,
            loading: {
                finishedMsg: '',
                img: (template_directory_uri.url + '/images/loader.svg'),
                msgText: ''
            }
        }, function (newElements) {
            var elements = newElements;
            $(newElements).each(function () {
                $(this).find('.work-wrapper-bg').css('opacity', '0');
                $(this).find('.work-wrapper-bg').bgLoaded({
                    afterLoaded: function () {
                        $(this).css('opacity', '1');
                    }
                });
            });
        });
        /*
         * Superfish menu
         */
        var example = $('#main-menu').superfish({
            delay: 200,
            onBeforeShow: function () {
                $(this).removeClass('toleft');
                if ($(this).parent().offset()) {
                    if (($(this).parent().offset().left + $(this).parent().width() - $(window).width() + 170) > 0) {
                        $(this).addClass('toleft');
                    }
                }
            }
        });
    });
})(jQuery);