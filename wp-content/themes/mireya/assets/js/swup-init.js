( function( $ ) {
  'use strict';

  var elementor = 0;
  if ( window.location.href.indexOf('/?elementor-preview=') > -1 ) {
    elementor = 1;
  }
    
  // swup init js
  const options = {
    containers: ['#mry-dynamic-content', '#mry-dynamic-menu'],
    animateHistoryBrowsing: true,
    animationSelector: '[class="transition-fade"]',
    plugins: [new SwupBodyClassPlugin()]
  };

  if ( $('#mry-dynamic-content').length && $('#mry-dynamic-menu').length ) {
    const swup = new Swup(options);
  }

  // reinit
  document.addEventListener("swup:contentReplaced", function() {

    /* custom menu link */
    $('.menu-item-type-custom').each(function () {
      $(this).find('> a').attr('data-no-swup', '');
    });

    /*add custom elementor css*/
    var body_classes = $('body').attr('class').split(' ');
    var page_class = '';
    var page_id = 0;

    for (var i=0; i<body_classes.length; i++) {
      if (body_classes[i].substring(0, 8) == "page-id-") {
        var page_class = body_classes[i];
        var page_id = parseInt(page_class.replace('page-id-', ''));
      } else if (body_classes[i].substring(0, 15) == "elementor-page-") {
        var page_class = body_classes[i];
        var page_id = parseInt(page_class.replace('elementor-page-', ''));
      }
    }
    var elementor_post_css_url = swup_url_data.url.replace('themes/mireya', '') + 'uploads/elementor/css/post-'+page_id+'.css'

    if ( !$("#elementor-post-"+page_id+"-css").length ) {
      $('<link id="elementor-post-'+page_id+'-css" href="'+elementor_post_css_url+'" rel="stylesheet">').appendTo("head");
    }

    /* side popup */
    $('.mry-popup-btn').on('click', function () {
      $('.mry-success-popup-frame').removeClass('mry-active');
    });

    /* run animations */
    $(document).ready(function () {
      var timeout = 1000
      $('html').addClass('is-animating');

      $(".mry-loader").animate({
        width: "100%"
      }, timeout);

      setTimeout(function () {
        $('.mry-preloader').removeClass('mry-active');
      }, timeout);

      setTimeout(function () {
        $('html').removeClass('is-animating');
      }, timeout);
    });

    /* nice scrolling */
    if ( ! $('body').hasClass('default--scrolling') ) {
      Scrollbar.use(OverscrollPlugin);
      var scrollbar = Scrollbar.init(document.querySelector('#scroll'), {
        damping: 0.07,
        renderByPixel: true,
        continuousScrolling: true,
        plugins: {
          overscroll: {
            effect: 'bounce',
            damping: 0.15,
            maxOverscroll: 80
          },
          mobile: {
            speed: 0.2,
            alwaysShowTracks: false
          }
        },
      });

      $('.mry-scroll-hint').on('click', function () {
        scrollbar.scrollTo(0, 550, 1800);
      });
    }

    window.oncontextmenu = function () {
      return false;
    }
    document.onkeydown = function (e) {
      if (window.event.keyCode == 123 || e.button == 2)
        return false;
    }

    /* portfolio filter */
    $('.mry-filter a').on('click', function () {
      $('.mry-filter .mry-current').removeClass('mry-current');
      $(this).addClass('mry-current');

      var selector = $(this).data('filter');
      $('.mry-masonry-grid').isotope({
        filter: selector
      });
      return false;
    });

    /* masonry grid */
	var $masonry_grid = $('.mry-masonry-grid'); $masonry_grid.imagesLoaded(function() {
		$masonry_grid.isotope({
			filter: '*',
			itemSelector: '.mry-masonry-grid-item',
			percentPosition: true,
			masonry: {
				columnWidth: '.mry-grid-sizer'
			} 
		});
	});

    /* magnific popups */
    if(/\.(?:jpg|jpeg|gif|png)$/i.test($('.wp-block-gallery .blocks-gallery-item:first a').attr('href'))){
      $('.wp-block-gallery a').magnificPopup({
        gallery: {
            enabled: true
        },
        type: 'image',
        closeOnContentClick: false,
        fixedContentPos: false,
        closeBtnInside: false,
        removalDelay: 500,
        callbacks: {
          beforeOpen: function() {
            // just a hack that adds mfp-anim class to markup 
             this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
             this.st.mainClass = 'mfp-zoom-in';
          }
        },
      });
    }
    $('[data-magnific-inline]').magnificPopup({
      type: 'inline',
      overflowY: 'auto',
      preloader: false,
      removalDelay: 500,
      callbacks: {
        beforeOpen: function() {
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    $('[data-magnific-image]').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      fixedContentPos: false,
      closeBtnInside: false,
      removalDelay: 500,
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup 
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    if (!$('body').hasClass('elementor-page')) {
      $("a").each(function(i, el) {
        var href_value = el.href;
        if (/\.(jpg|png|gif)$/.test(href_value)) {
           $(el).magnificPopup({
              type: 'image',
              closeOnContentClick: true,
              fixedContentPos: false,
              closeBtnInside: false,
              removalDelay: 500,
              callbacks: {
                beforeOpen: function() {
                  // just a hack that adds mfp-anim class to markup 
                   this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                   this.st.mainClass = 'mfp-zoom-in';
                }
              },
            });
        }
      });
    }
    $('[data-magnific-video]').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      iframe: {
          patterns: {
              youtube_short: {
                index: 'youtu.be/',
                id: 'youtu.be/',
                src: 'https://www.youtube.com/embed/%id%?autoplay=1'
              }
          }
      },
      preloader: false,
      fixedContentPos: false,
      removalDelay: 500,
      callbacks: {
        markupParse: function(template, values, item) {
          template.find('iframe').attr('allow', 'autoplay');
        },
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup 
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    $('[data-magnific-music]').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      preloader: false,
      fixedContentPos: false,
      closeBtnInside: true,
      removalDelay: 500,
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup 
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    $('[data-magnific-gallery]').magnificPopup({
      gallery: {
          enabled: true
      },
      type: 'image',
      closeOnContentClick: false,
      fixedContentPos: false,
      closeBtnInside: false,
      removalDelay: 500,
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup 
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    $('[data-magnific-gallery-portfolio-carousel]').magnificPopup({
      gallery: {
          enabled: true
      },
      type: 'image',
      closeOnContentClick: false,
      fixedContentPos: false,
      closeBtnInside: false,
      removalDelay: 500,
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup 
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });

    /* smooth scroll */
    $('.mry-smooth-scroll').on("click", function () {
      $('html, body').stop().animate({
        scrollTop: $($(this).attr('href')).offset().top - 0
      }, 1000);
      return false;
    });

    if ($('html').hasClass('is-rendering')) {
      $("html, body").animate({
        scrollTop: 0
      }, 0);
    }

    /* menu */
    $('.menu-item').on('click', '> i', function () {
      $(this).closest('li').toggleClass('mry-active');
      $(this).closest('li').find('> .sub-menu').toggleClass('mry-active');
      return false;
    });

    $('.menu-item-has-children.menu-item-type-custom').on('click', '> a', function(){
      $(this).next('i').trigger('click');
    });

    $(document).on('click', function (e) {
      var el = '.mry-menu , .mry-menu-btn-frame , .mry-menu-btn';
      if (jQuery(e.target).closest(el).length) return;
      $('.mry-menu , .mry-menu-btn-frame , .mry-menu-btn').removeClass('mry-active');
    });

    $('.mry-anima-link').on('click', function () {
      $('.mry-menu , .mry-menu-btn-frame , .mry-menu-btn').removeClass('mry-active');
    });

    /* sliders */
    var progressbar = $(".mry-slider-progress-bar");
    var mousewheel_param =  parseInt( $('.mry-main-slider').data('mousewheel') );

    var swiper = new Swiper(".mry-main-slider", {
      autoplay: {
        delay: 10000,
        disableOnInteraction: false
      },
      loop: true,
      parallax: true,
      mousewheel: mousewheel_param,
      keyboard: true,
      speed: 1200,
      navigation: {
        nextEl: '.mry-button-next',
        prevEl: '.mry-button-prev',
      },
      pagination: {
        el: '.mry-slider-pagination',
        clickable: true,
      },
      on: {
        init: function () {
          progressbar.removeClass("animate");
          progressbar.removeClass("active");
          progressbar.eq(0).addClass("animate");
          progressbar.eq(0).addClass("active");
        },
        slideChangeTransitionStart: function () {
          progressbar.removeClass("animate");
          progressbar.removeClass("active");
          progressbar.eq(0).addClass("active");
        },
        slideChangeTransitionEnd: function () {
          progressbar.eq(0).addClass("animate");
        }
      }
    });

    var swiper = new Swiper(".mry-team-slider", {
      slidesPerView: 3,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: '.mry-button-team-next',
        prevEl: '.mry-button-team-prev',
      },
      speed: 1200,
      breakpoints: {
        0: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
      },
    });

    var swiper = new Swiper(".mry-testimonials-slider", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      navigation: {
        nextEl: '.mry-button-testimonials-next',
        prevEl: '.mry-button-testimonials-prev',
      },
      speed: 1200,
      breakpoints: {
        768: {
          slidesPerView: 1,
        },
      },
    });

    var swiper = new Swiper(".mry-blog-slider", {
      slidesPerView: 3,
      spaceBetween: 60,
      loop: true,
      navigation: {
        nextEl: '.mry-button-blog-next',
        prevEl: '.mry-button-blog-prev',
      },
      speed: 1200,
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
      },
    });
    
    /* scroll magic */
    var controller = new ScrollMagic.Controller();
    
    var fadestyles = {
      opacity: "0",
      transform: 'translateY(50px)'
    };

    $('.mry-fo').css(fadestyles);

    var scrolAnimation1 = document.getElementsByClassName('mry-fo');

    function createProjectScenes(object) {
      for (let i = 0; i < object.length; i++) {
        createScene(object[i], i);
      }
    };

    function createScene(element, i) {
      var scene = new ScrollMagic.Scene({
        triggerElement: element,
        offset: -360,
      })
        .setTween(element, .6, {
          opacity: 1,
          y: 0
        })
        .addTo(controller)
    };

    createProjectScenes(scrolAnimation1);

    var scrolAnimation2 = document.getElementsByClassName('mry-scale-object');

    function createProjectScenes2(object2) {
      for (let i = 0; i < object2.length; i++) {
        createScene2(object2[i], i);
      }
    };

    function createScene2(element2, i) {
      var scene = new ScrollMagic.Scene({
        triggerElement: element2,
        duration: 1800,
        offset: -350,
      })
        .setTween(element2, .6, {
          scale: '1.2',
          y: '10%'
        })
        .addTo(controller)
    }

    createProjectScenes2(scrolAnimation2);

    var scrolAnimation3 = document.getElementsByClassName('mry-curtain');

    function createProjectScenes3(object3) {
      for (let i = 0; i < object3.length; i++) {
        createScene3(object3[i], i);
      }
    };

    function createScene3(element3, i) {
      var scene = new ScrollMagic.Scene({
        triggerElement: element3,
        offset: -150,
      })
        .setTween(element3, .8, {
          x: '-100%'
        })
        .addTo(controller)
    }

    createProjectScenes3(scrolAnimation3);

    /* map lock/unlock */
    $(".mry-lock").on('click', function () {
      $('.mry-map').toggleClass('mry-active');
      $('.mry-lock').toggleClass('mry-active');
      $('.mry-lock .fas').toggleClass('fa-unlock');
    });
    
  })
} )( jQuery );
