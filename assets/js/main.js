
function isExternal(url) {
    "use strict";
    var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
    /*global location */
    if (typeof match[1] === "string" &&
            match[1].length > 0 &&
            match[1].toLowerCase() !== location.protocol) {
        return true;
    }
    if (typeof match[2] === "string" &&
            match[2].length > 0 &&
            match[2].replace(new RegExp(":(" + {"http:": 80, "https:": 443}[location.protocol] + ")?$"), "") !== location.host) {
        return true;
    }
    return false;
}

function makeAllLinksA(str) {
    "use strict";
    return str.replace(/(http|ftp|https):\/\/[\w\-]+(\.[\w\-]+)+([\w.,@?\^=%&amp;\:\/~+#\-]*[\w@?\^=%&amp\\;\/~+#\-])?/g, '<a href="$&" target="_blank">$&</a>');
}

/*global jQuery */
(
    function initialize($) {
        "use strict";

        /*global document */
        $(document).ready(function () {
            var current = 0,
                previous = 0,
                top = $('#nav_bar').position().top,
                nav = $('#nav_bar'),
                fixedNav = nav.clone(false),
                animating = false,
                height;

            fixedNav.addClass('navbar-fixed');
            fixedNav.css('display', 'none');
            fixedNav.appendTo(nav);
            height = fixedNav.height();

            /*global window */
            $(window).scroll(function () {
                previous = current;
                current = $(window).scrollTop();

                if (current - height > top) {
                    //nav.css('display','none');
                    fixedNav.css('display', 'block');
                    if (previous < current && !animating) {
                        fixedNav.animate({top: -height}, 300, function () {
                            animating = false;
                        });
                        animating = true;
                    } else if (previous > current && !animating) {
                        fixedNav.animate({top: 0}, 300, function () {
                            animating = false;
                        });
                        animating = true;
                    }
                }
                if (current < top) {
                    fixedNav.css("display", "none");
                }
            });
        });


        $(document).ready(function () {
            $(".acc-trigger").siblings().hide();
            $(".acc-trigger").click(function () {
                if ($(this).siblings().is(":hidden")) {
                    $(this).siblings().slideToggle(250);
                    $(this).children().css("background", "url(assets/images/accordion-minus.png) no-repeat right 55%");
                } else {
                    $(this).siblings().slideToggle(250);
                    $(this).children().css("background", "url(assets/images/accordion-plus.png) no-repeat right 55%");
                }
            });
        });
    }(jQuery)
);
