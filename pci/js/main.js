(function ($) {
    "use strict";
    /*-------------------------------------
        Contact Form initiating
    -------------------------------------*/
    
    /*-------------------------------------
    Slick Slider
    -------------------------------------*/
    if ($('.slick-carousel').length) {
        $('.slick-carousel').slick();
    }
    /*-------------------------------------
    Wow Js
    -------------------------------------*/
    new WOW().init();
    /*-------------------------------------
Section background image
-------------------------------------*/
    imageFunction();

    function imageFunction() {

    $('[data-bg-image]').each(function () {
    var img = $(this).data('bg-image');
    $(this).css({
    backgroundImage: 'url(' + img + ')',
    });
    });
    }
    
  /*-------------------------------------
    Progress Bar Init
    --------------------------------------*/
    if ($.fn.circleProgress !== undefined) {

       $('.circle-progress').circleProgress({
            size: 160,
            thickness: 9,
            emptyFill: "#fb542f",
            fill: {
              color: "#fff"
            },
            startAngle: 0,
            
        }).on('circle-animation-progress', function(event, progress) {
             var data_value = $(this).data('value'); 
             var data_value_full = data_value * 100;

            $(this).find('span').html(Math.round(data_value_full * progress) + '<i></i>');
        });
    }
    /*-------------------------------------
        Sal Init
    -------------------------------------*/
   if(typeof sal === 'function'){
    sal({
            threshold: 0.05,
            once: true
        });

    if ($(window).outerWidth() < 1025) {
        var scrollAnimations = sal();
        scrollAnimations.disable();
    }
   }
    
    /*-------------------------------------
    Jquery Serch Box
    -------------------------------------*/
    $('a[href="#header-search"]').on("click", function (event) {
        event.preventDefault();
        var target = $("#header-search");
        target.addClass("open");
        setTimeout(function () {
            target.find('input').focus();
        }, 600);
        return false;
    });

    $("#header-search, #header-search button.close").on("click keyup", function (event) {
        if (
            event.target === this ||
            event.target.className === "close" ||
            event.keyCode === 27
        ) {
            $(this).removeClass("open");
        }
    });
    

    /*---------------------------------------
    On Click Section Switch
    --------------------------------------- */
    $('[data-type="section-switch"]').on('click', function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            if (target.length > 0) {

                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
    /*-------------------------------------
    On Scroll 
    -------------------------------------*/
    $(window).on('scroll', function() {

        // Back Top Button
        if ($(window).scrollTop() > 500) {
            $('.scrollup').addClass('back-top');
        } else {
            $('.scrollup').removeClass('back-top');
        }
        // Sticky Header
        if ($('body').hasClass('sticky-header')) {
            var stickyPlaceHolder = $("#rt-sticky-placeholder"),
                menu = $("#header-menu"),
                menuH = menu.outerHeight(),
                topHeaderH = $('#header-topbar').outerHeight() || 0,
                middleHeaderH = $('#header-middlebar').outerHeight() || 0,
                targrtScroll = topHeaderH + middleHeaderH;
            if ($(window).scrollTop() > targrtScroll) {
                menu.addClass('rt-sticky');
                stickyPlaceHolder.height(menuH);
            } else {
                menu.removeClass('rt-sticky');
                stickyPlaceHolder.height(0);
            }
        }
    });

    /*-------------------------------------
        Google Map
    -------------------------------------*/
    
    
     /*-------------------------------------
    MeanMenu activation code
    --------------------------------------*/
    if ($.fn.meanmenu) {
        var base_url='https://innovertechnologies.com/pcishopping/cart';
        $('nav#dropdown').meanmenu({
            siteLogo: "<div class='mobile-menu-nav-back'><a class='logo-mobile' ><img src='https://pcianalytics.in/img/logo/logo.png' alt='logo' class='img-fluid'/ width='100px'></a> <div align='right' style='margin-left: 72px;'><a class='justify-content-end' href="+base_url+"><div class='item-icon'>(<span class='totalitem'></span>)<i class='fa fa-shopping-cart'></i></div></a></div></div>"
        });
    }
    /*-------------------------------------
    Offcanvas Menu activation code
    -------------------------------------*/
    $('#wrapper').on('click', '.offcanvas-menu-btn', function (e) {
        e.preventDefault();
        var $this = $(this),
            wrapper = $(this).parents('body').find('>#wrapper'),
            wrapMask = $('<div />').addClass('offcanvas-mask'),
            offCancas = $('#offcanvas-wrap'),
            position = offCancas.data('position') || 'left';

        if ($this.hasClass('menu-status-open')) {
            wrapper.addClass('open').append(wrapMask);
            $this.removeClass('menu-status-open').addClass('menu-status-close');
            offCancas.css({
                'transform': 'translateX(0)'
            });
        } else {
            removeOffcanvas();
        }

        function removeOffcanvas() {
            wrapper.removeClass('open').find('> .offcanvas-mask').remove();
            $this.removeClass('menu-status-close').addClass('menu-status-open');
            if (position === 'left') {
                offCancas.css({
                    'transform': 'translateX(-105%)'
                });
            } else {
                offCancas.css({
                    'transform': 'translateX(105%)'
                });
            }
        }
        $(".offcanvas-mask, .offcanvas-close").on('click', function () {
            removeOffcanvas();
        });

        return false;
    });

/*-------------------------------------
Carousel slider initiation
-------------------------------------*/
    $(".rc-carousel").each(function () {
        var carousel = $(this),
            loop = carousel.data("loop"),
            Canimate = carousel.data("animate"),
            items = carousel.data("items"),
            margin = carousel.data("margin"),
            stagePadding = carousel.data("stage-padding"),
            autoplay = carousel.data("autoplay"),
            autoplayTimeout = carousel.data("autoplay-timeout"),
            smartSpeed = carousel.data("smart-speed"),
            dots = carousel.data("dots"),
            nav = carousel.data("nav"),
            navSpeed = carousel.data("nav-speed"),
            rXsmall = carousel.data("r-x-small"),
            rXsmallNav = carousel.data("r-x-small-nav"),
            rXsmallDots = carousel.data("r-x-small-dots"),
            rXmedium = carousel.data("r-x-medium"),
            rXmediumNav = carousel.data("r-x-medium-nav"),
            rXmediumDots = carousel.data("r-x-medium-dots"),
            rSmall = carousel.data("r-small"),
            rSmallNav = carousel.data("r-small-nav"),
            rSmallDots = carousel.data("r-small-dots"),
            rMedium = carousel.data("r-medium"),
            rMediumNav = carousel.data("r-medium-nav"),
            rMediumDots = carousel.data("r-medium-dots"),
            rLarge = carousel.data("r-large"),
            rLargeNav = carousel.data("r-large-nav"),
            rLargeDots = carousel.data("r-large-dots"),
            rExtraLarge = carousel.data("r-extra-large"),
            rExtraLargeNav = carousel.data("r-extra-large-nav"),
            rExtraLargeDots = carousel.data("r-extra-large-dots"),
            center = carousel.data("center"),
            custom_nav = carousel.data("custom-nav") || "";
        carousel.addClass('owl-carousel');
        var owl = carousel.owlCarousel({
            loop: loop ? true : false,
            animateOut: Canimate,
            items: items ? items : 1,
            lazyLoad: true,
            margin: margin ? margin : 0,
            autoplay: autoplay ? true : false,
            autoplayTimeout: autoplayTimeout ? autoplayTimeout : 1000,
            smartSpeed: smartSpeed ? smartSpeed : 250,
            dots: dots ? true : false,
            nav: nav ? true : false,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            navSpeed: navSpeed ? true : false,
            center: center ? true : false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: rXsmall ? rXsmall : 1,
                    nav: rXsmallNav ? true : false,
                    dots: rXsmallDots ? true : false
                },
                576: {
                    items: rXmedium ? rXmedium : 2,
                    nav: rXmediumNav ? true : false,
                    dots: rXmediumDots ? true : false
                },
                768: {
                    items: rSmall ? rSmall : 3,
                    nav: rSmallNav ? true : false,
                    dots: rSmallDots ? true : false
                },
                992: {
                    items: rMedium ? rMedium : 4,
                    nav: rMediumNav ? true : false,
                    dots: rMediumDots ? true : false
                },
                1200: {
                    items: rLarge ? rLarge : 5,
                    nav: rLargeNav ? true : false,
                    dots: rLargeDots ? true : false
                },
                1240: {
                    items: rExtraLarge ? rExtraLarge : 5,
                    nav: rExtraLargeNav ? true : false,
                    dots: rExtraLargeDots ? true : false
                }
            },
        });

        if (custom_nav) {
            var nav = $(custom_nav),
                nav_next = $(".rt-next", nav),
                nav_prev = $(".rt-prev", nav);

            nav_next.on("click", function (e) {
                e.preventDefault();
                owl.trigger('next.owl.carousel');
                return false;
            });

            nav_prev.on("click", function (e) {
                e.preventDefault();
                owl.trigger('prev.owl.carousel');
                return false;
            });
        }
    });

 })(jQuery);
 $(document).ready(function() {
  $("#accordian h3").click(function() {
    //Slide up all the link lists
    $("#accordian ul ul").slideUp();
    //Slide down the link list below the h3 clicked - only if it's closed
    if(!$(this).next().is(":visible")) {
      $(this).next().slideDown();
    }
  })
   $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
  
})


    //edit this message to say what you want
    var message = "Function Disabled";

    function clickIE() {
        if (document.all) {
            // alert(message);
            return false;
        }
    }
    function clickNS(e) {
        if (document.layers || (document.getElementById && !document.all)) {
            if (e.which == 2 || e.which == 3) {
                // alert(message);
                return false;
            }
        }
    }
    if (document.layers) {
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown = clickNS;
    }
    else {
        document.onmouseup = clickNS;
        document.oncontextmenu = clickIE;
    }

    document.oncontextmenu = new Function("return false")
    // -->
var ltbrowseofferOptions = {};!function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0;var t=document.referrer?encodeURIComponent(document.referrer.substr(document.referrer.indexOf("://")+1)):"",r=document.location?encodeURIComponent(window.location.href.substring(window.location.protocol.length)):"";e.src="//chat.pcianalytics.in/browseoffer/getstatus/(size)/450/(height)/450/(units)/pixels/(showoverlay)/true/(canreopen)/true?r="+t+"&l="+r;var o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(e,o)}();!function(){var e=document.createElement("script");e.type="text/javascript",e.async=!0;var t=document.referrer?encodeURIComponent(document.referrer.substr(document.referrer.indexOf("://")+1)):"",n=document.location?encodeURIComponent(window.location.href.substring(window.location.protocol.length)):"";e.src="//chat.pcianalytics.in/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(invitation_lookup)/true/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/1/(theme)/1?r="+t+"&l="+n;var o=document.getElementsByTagName("script")[0];o.parentNode.insertBefore(e,o)}();