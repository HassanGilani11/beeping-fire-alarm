(function ($) {
    'use strict';

    function login_dropdown() {
        $('.site-header-account').mouseenter(function () {
            if (!$('.account-dropdown', this).has('.account-wrap').length) {
                $('.account-dropdown', this).append($('.account-wrap'));
            }
        });
    }

    function handleWindow() {
        var body = document.querySelector('body');

        if (window.innerWidth > body.clientWidth + 5) {
            body.classList.add('has-scrollbar');
            body.setAttribute('style', '--scroll-bar: ' + (window.innerWidth - body.clientWidth) + 'px');
        } else {
            body.classList.remove('has-scrollbar');
        }
    }

    function minHeight() {
        var $body = $('body'),
            bodyHeight = $(window).outerHeight(),
            headerHeight = $('header.header-1').outerHeight(),
            footerHeight = $('footer.site-footer').outerHeight(),
            $adminBar = $('#wpadminbar');

        if ($adminBar.length > 0) {
            headerHeight += $adminBar.height();
        }

        if ($body.find('header.header-1').length) {

            $('.site-content').css({
                'min-height': bodyHeight - headerHeight - footerHeight - 90
            });
        }
    }

    function setPositionLvN($item) {
        var sub = $item.children('.sub-menu'),
            offset = $item.offset(),
            width = $item.outerWidth(),
            screen_width = $(window).width(),
            sub_width = sub.outerWidth();
        var align_delta = offset.left + width + sub_width - screen_width;
        if (align_delta > 0) {
            if ($item.parents('.menu-item-has-children').length) {
                sub.css({left: 'auto', right: '100%'});
            } else {
                sub.css({left: 'auto', right: '0'});
            }
        } else {
            sub.css({left: '', right: ''});
        }
    }

    function initSubmenuHover() {
        $('.site-header .primary-navigation .menu-item-has-children').hover(function (event) {
            var $item = $(event.currentTarget);
            setPositionLvN($item);
        });
    }

    initSubmenuHover();
    minHeight();
    handleWindow();
    login_dropdown();

})(jQuery);

