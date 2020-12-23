/**
 * Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Customizer preview reload changes asynchronously.
 * Things like site title and description changes.
 */

(function ($) {
    function menu_align() {
        var headerWrap = $('.site-header');
        var navWrap = $('.navbar');
        var logoWrap = $('.site-logo');
        var containerWrap = $('.container');
        var classToAdd = 'header-align-center';
        if (headerWrap.hasClass(classToAdd)) {
            headerWrap.removeClass(classToAdd);
        }
        var logoWidth = logoWrap.outerWidth();
        var menuWidth = navWrap.outerWidth();
        var containerWidth = containerWrap.width();
        if (menuWidth + logoWidth > containerWidth) {
            headerWrap.addClass(classToAdd);
        } else {
            if (headerWrap.hasClass(classToAdd)) {
                headerWrap.removeClass(classToAdd);
            }
        }

    }

    /*wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $logo= $('.site-header .header-logo ').html();
            $('.site-header .site-logo').text('');
            $('.site-footer .site-logo').text('');
            var text = '';
            var text2 = '';
            if (($logo !== '') || (to !== '') || (wp.customize.instance('blogname').get() !== '')) {
                if ( ($logo !== '') && ($logo !== undefined) ) {
                    text += '<div class="header-logo ">' + $logo + '</div>';
                }

                text += '<a class="home-link" href="#" title="" rel="home"><div class="site-description">';
                text += '<h1 class="site-title';
                if (to !== '') {
                    text += ' empty-tagline';
                }
                text += '">' + wp.customize.instance('blogname').get() + '</h1>';
                text += '<p class="site-tagline">' + to + '</p>';
                text += '</div></a>';
            }
            if ((wp.customize.instance('mp_artwork_logo_footer').get() !== '') || (to !== '') || (wp.customize.instance('blogname').get() !== '')) {
                text2 += '<a class="home-link" href="#" title="" rel="home">';
                if (wp.customize.instance('mp_artwork_logo_footer').get() !== '') {
                    text2 += '<div class="header-logo "><img src="' + wp.customize.instance('mp_artwork_logo_footer').get() + '" alt=""></div>';
                }

                text2 += '<div class="site-description" ';
                if (to === '') {
                    text2 += 'style="margin:0;"';
                }
                text2 += '>';
                text2 += '<h1 class="site-title';
                if (to !== '') {
                    text2 += ' empty-tagline';
                }
                text2 += '">' + wp.customize.instance('blogname').get() + '</h1>';

                text2 += '<p class="site-tagline">' + to + '</p>';

                text2 += '</div>';
                text2 += '</a>';
            }
            $('.site-header .site-logo').append(text);
            $('.site-footer .site-logo').append(text2);
            menu_align();
        });
    });
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $logo= $('.site-header .header-logo ').html();
            $('.site-header .site-logo').text('');
            $('.site-footer .site-logo').text('');
            var text = '';
            var text2 = '';
            if (($logo !== '') || (wp.customize.instance('blogdescription').get() !== '') || (to !== '')) {

                if ($logo !== '') {
                    text += '<div class="header-logo ">'+$logo+'</div>';
                }

                text += '<div class="site-description">';
                text += '<a class="home-link" href="#" title="" rel="home">';
                text += '<h1 class="site-title';
                if (wp.customize.instance('blogdescription').get() !== '') {
                    text += ' empty-tagline';
                }
                text += '">' + to + '</h1>';
                text += '<p class="site-tagline">' + wp.customize.instance('blogdescription').get() + '</p>';

                text += '</a>';
                text += '</div>';
            }
            if ((wp.customize.instance('mp_artwork_logo_footer').get() !== '') || (wp.customize.instance('blogdescription').get() !== '') || (to !== '')) {
                text2 += '<a class="home-link" href="#" title="" rel="home">';
                if (wp.customize.instance('mp_artwork_logo_footer').get() !== '') {
                    text2 += '<div class="header-logo "><img src="' + wp.customize.instance('mp_artwork_logo_footer').get() + '" alt=""></div>';
                }
                text2 += '<div class="site-description" ';
                if (wp.customize.instance('blogdescription').get() === '') {
                    text2 += 'style="margin:0;"';
                }
                text2 += '>';
                text2 += '<h1 class="site-title';
                text2 += ' empty-tagline';

                text2 += '">' + to + '</h1>';
                if (wp.customize.instance('blogdescription').get() !== '') {
                    text2 += '<p class="site-tagline">' + wp.customize.instance('blogdescription').get() + '</p>';
                }
                text2 += '</div>';
                text2 += '</a>';
            }
            $('.site-header .site-logo').append(text);
            $('.site-footer .site-logo').append(text2);
            menu_align();
        });
    });
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            $('.main-header .site-title').css('color', to);
        });
    });*/
    wp.customize('mp_artwork_rss_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-rss" title="rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    wp.customize('mp_artwork_facebook_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (to !== '') {
                text += '<a href="' + to + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    wp.customize('mp_artwork_twitter_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    wp.customize('mp_artwork_linkedin_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    wp.customize('mp_artwork_google_plus_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });


    wp.customize('mp_artwork_instagram_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    wp.customize('mp_artwork_pinterest_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    wp.customize('mp_artwork_tumblr_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_youtube_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_youtube_link').get() + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    wp.customize('mp_artwork_youtube_link', function (value) {
        value.bind(function (to) {
            $('.site-footer .social-profile').text('');
            var text = '';
            if (wp.customize.instance('mp_artwork_facebook_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_facebook_link').get() + '" class="button-facebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_twitter_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_twitter_link').get() + '" class="button-twitter" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_linkedin_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_linkedin_link').get() + '" class="button-linkedin" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_google_plus_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_google_plus_link').get() + '" class="button-google" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_instagram_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_instagram_link').get() + '" class="button-instagram" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_pinterest_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_pinterest_link').get() + '" class="button-pinterest" title="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_tumblr_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_tumblr_link').get() + '" class="button-tumblr" title="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>';
            }
            if (to !== '') {
                text += '<a href="' + to + '" class="button-youtube" title="youtube" target="_blank"><i class="fa fa-youtube"></i></a>';
            }
            if (wp.customize.instance('mp_artwork_rss_link').get() !== '') {
                text += '<a href="' + wp.customize.instance('mp_artwork_rss_link').get() + '" class="button-rss" title="Rss" target="_blank"><i class="fa fa-rss"></i></a>';
            }
            $('.site-footer .social-profile').append(text);
        });
    });
    /*wp.customize('header_image', function (value) {
        value.bind(function (to) {
            if (to === '') {
                $('.header-image-wrapper').hide();
            } else {
                $('.header-image-wrapper').show();
                $('.header-image-wrapper .header-image').css('background-image', to);
            }
        });
    });*/
    /*wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' == to) {
                $('.site-description').hide();
            } else {
                $('.site-description').show();
            }
        });
    });*/
    wp.customize('mp_artwork_location_info', function (value) {
        value.bind(function (to) {
            var text = '';
            $('.info-list-address .info-list').remove();
            if (to !== '') {
                text += '<ul class=" info-list"><li>' + to + '</li></ul>';
            }
            $('.info-list-address').append(text);
        });
    });
    wp.customize('mp_artwork_location_info_label', function (value) {
        value.bind(function (to) {
            var text = '';
            $('.info-list-address .footer-title').remove();
            if (to !== '') {
                text += '<div class="footer-title">' + to + '</div>';
            }
            $('.info-list-address').prepend(text);
        });
    });
    wp.customize('mp_artwork_hours_info', function (value) {

        value.bind(function (to) {
            var text = '';
            $('.info-list-hours .info-list').remove();
            if (to !== '') {
                text += '<ul class=" info-list"><li>' + to + '</li></ul>';
            }
            $('.info-list-hours').append(text);

        });
    });
    wp.customize('mp_artwork_hours_info_label', function (value) {
        value.bind(function (to) {
            var text = '';
            $('.info-list-hours .footer-title').remove();
            if (to !== '') {
                text += '<div class="footer-title">' + to + '</div>';
            }
            $('.info-list-hours').prepend(text);
        });
    });

    wp.customize('mp_artwork_copyright', function (value) {
        value.bind(function (to) {
            var text = '<span class="copyright-date">' + $('.site-footer .copyright-date').text() + '</span>';
            $('.site-footer .copyright').text('');
            if (to !== '') {
                text += to;
            }
            $('.site-footer .copyright').html(text);
        });

    });
    wp.customize('mp_artwork_about_content', function (value) {
        value.bind(function (to) {
            var text = '';
            $('.content-about-page').text('');
            if (to !== '') {
                text += to;
            }
            $('.content-about-page').html(text);
        });

    });


})(jQuery);
