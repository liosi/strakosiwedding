jQuery(document).ready(function($) {

    // Define variable
    var $body = $("body");

    // Owl Carousel Options (http://www.owlcarousel.owlgraphic.com/)
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 20,
        center: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            1000: {
                items: 2
            },
            1440: {
                items: 3
            }
        }
    });

    // FitVids
    function runFitVidsAndText() {
        $(".entry-content, .textwidget").fitVids();
    }

    runFitVidsAndText();

    // Hide Header on on scroll down
    function hideHeaderScollDown() {

        var didScroll;
        var lastScrollTop = 0;
        var delta = 5;
        var navbarHeight = $("header").outerHeight();

        $(window).scroll(function(event) {
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();

            // Make sure they scroll more than delta
            if (Math.abs(lastScrollTop - st) <= delta)
                return;

            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st > lastScrollTop && st > navbarHeight) {
                // Scroll Down
                $("header").removeClass("nav-down").addClass("nav-up");
            } else {
                // Scroll Up
                if (st + $(window).height() < $(document).height()) {
                    $("header").removeClass("nav-up").addClass("nav-down");
                }
            }

            lastScrollTop = st;
        }

    }

    hideHeaderScollDown();

    // Multi-Toggle Navigation
    function multiToggleNavigation() {

        var $siteNavigation = $("#site-navigation");
        var $siteNavigationChildren = $("#site-navigation a");

        // Show the sub menu children elements and animated the toggle
        $(".menu-control").on("click", function() {
            $(this).toggleClass("expand");
            $siteNavigation.slideToggle("fast");
        });

        // Reset the menu if children elements clicked
        $siteNavigationChildren.on("click", function() {
            $(".menu-control").removeClass("expand");
            $siteNavigation.slideUp("fast");
        });

    }

    multiToggleNavigation();

    // Sub nav hover intent
    function keepSubnavOpenOnHover() {

        // Show in sub nav
        function showSubNav() {
            $(this).children("ul").addClass("show-sub");
        }

        // Hide in sub nav
        function hideSubNav() {
            $(this).children("ul").removeClass("show-sub");
        }

        $(".menu-item-has-children").hoverIntent({
            over: showSubNav,
            out: hideSubNav,
            timeout: 250
        });
    }

    keepSubnavOpenOnHover();


    /**
     * Mobile menu functionality
     */

    var $item = $('<button class="toggle-sub" aria-expanded="false"><i class="fa fa-plus-square"></i></button>');
    var $menuHasChildren = $('#primary-menu .menu-item-has-children');

    // Append clickable icon for mobile drop menu
    if ($menuHasChildren) {
        $menuHasChildren.append($item);
    }

    // Show sub menu when toggle is clicked
    $('.toggle-sub').click(function(e) {
        $(this).each(function() {
            e.preventDefault();

            // Change aria expanded value
            $(this).attr('aria-expanded', ($(this).attr('aria-expanded') == 'false') ? 'true' : 'false');

            // Open the drop menu
            $(this).closest('.menu-item-has-children').toggleClass('drop-open');
            $(this).prev('.sub-menu').toggleClass('drop-active');

            // Change the toggle icon
            $(this).find('i').toggleClass('fa-plus-square').toggleClass('fa-minus-square');
        });
    });

});
