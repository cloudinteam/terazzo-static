( function( $ ) {
	'use strict';

	setHeightFullSection();
	$(window).resize(function() {
		setHeightFullSection();
	});

	/* menu custom link */
	$('.menu-item-type-custom').each(function () {
      $(this).find('> a').attr('data-no-swup', '');
    });

	var elementor = 0;
	if ( window.location.href.indexOf('/?elementor-preview=') > -1 ) {
		elementor = 1;
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
				 this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				 this.st.mainClass = 'mfp-zoom-in';
			}
		},
	});

	/* smooth scroll */
	if ($('html').hasClass('is-rendering')) {
		$("html, body").animate({
			scrollTop: 0
		}, 0);
	}

	/* menu */
	$('.mry-menu-btn').on('click', function () {
		$('.mry-menu-btn , .mry-menu').toggleClass('mry-active');
		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			$('body').css({'overflow':'visible'});
		}
		else {
			$(this).addClass('active');
			$('body').css({'overflow':'hidden'});
		}
	});

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
	
	/* header sticky */
	if($('.mry-top-panel').length) {
		$(window).on('scroll', function(){
			if ($(window).scrollTop() > 100) {
				$('.mry-top-panel').addClass('fixed');
			} 
			else {
				$('.mry-top-panel').removeClass('fixed');
			}
		});
	}

	/* cursor */
	if ($(window).width() > 782 ) {
	// console.clear();
	const element = document.querySelector(".mry-ball");
	const target = document.querySelector(".mry-magnetic-link");
	const text = document.querySelector(".mry-magnetic-object");
	class Cursor {
		constructor(el, target, text) {
			this.el = el;
			this.bind();
		}

		bind() {
			document.addEventListener("mousemove", this.move.bind(this), false);
		}

		move(e) {
			const cursorPosition = {
				left: e.clientX,
				top: e.clientY
			};

			document.querySelectorAll(".mry-magnetic-link").forEach(single => {
				const triggerDistance = single.getBoundingClientRect().width / 2;

				const targetPosition = {
					left: single.getBoundingClientRect().left +
						single.getBoundingClientRect().width / 2,
					top: single.getBoundingClientRect().top +
						single.getBoundingClientRect().height / 2
				};

				const distance = {
					x: targetPosition.left - cursorPosition.left,
					y: targetPosition.top - cursorPosition.top
				};

				const angle = Math.atan2(distance.x, distance.y);
				const hypotenuse = Math.sqrt(
					distance.x * distance.x + distance.y * distance.y);

				if (hypotenuse < triggerDistance) {
					TweenMax.to(single.querySelector(".mry-magnetic-object"), 0.4, {
						x: -(Math.sin(angle) * hypotenuse / 2),
						y: -(Math.cos(angle) * hypotenuse / 2),
					});
				} else {
					TweenMax.to(this.el, .6, {
						left: cursorPosition.left - 20,
						top: cursorPosition.top - 20,
					});

					TweenMax.to(single.querySelector(".mry-magnetic-object"), 0.4, {
						x: 0,
						y: 0
					});
				}
			});
		}
	}
	$(".mry-default-link").mouseenter(function (e) {
		TweenMax.to(element, 0.3, {
			scale: .6,
		});
		TweenMax.to(element, 0.3, {
			opacity: '1'
		});
	});
	$(".mry-default-link").mouseleave(function (e) {
		TweenMax.to(element, 0.3, {
			scale: 1
		});
		TweenMax.to(element, 0.3, {
			opacity: '.5'
		});
	});
	$(".mry-magnetic-link").mouseenter(function (e) {
		TweenMax.to(element, 0.3, {
			scale: 1.4,
		});
		TweenMax.to(element, 0.3, {
			opacity: '1'
		});
	});
	$(".mry-magnetic-link").mouseleave(function (e) {
		TweenMax.to(element, 0.3, {
			scale: 1
		});
		TweenMax.to(element, 0.3, {
			opacity: '.5'
		});
	});
	const cursor = new Cursor(element, target);
	}

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
		transform: 'translateY(50px) scale(.98)'
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
			offset: -400,
		})
			.setTween(element, .6, {
				opacity: 1,
				scale: '1',
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
			offset: -200,
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
	
	function setHeightFullSection() {
		var width = $(window).width();
		var height = $(window).height();
		$('.mry-project-slider-item, .mry-project-slider-item .mry-main-title-frame, .mry-content-frame, .mry-dots, .mry-slider-pagination-frame').css({'height': height});
		$('.logged-in .mry-project-slider-item, .logged-in .mry-project-slider-item .mry-main-title-frame, .logged-in .mry-content-frame, .logged-in .mry-dots, .logged-in .mry-slider-pagination-frame').css({'height': height-32});
		if( width < 783 ) {
			$('.mry-project-slider-item, .mry-project-slider-item .mry-main-title-frame, .mry-content-frame, .mry-dots, .mry-slider-pagination-frame').css({'height': height});
			$('.logged-in .mry-project-slider-item, .logged-in .mry-project-slider-item .mry-main-title-frame, .logged-in .mry-content-frame, .logged-in .mry-dots, .logged-in .mry-slider-pagination-frame').css({'height': height-46});
		}
	}

} )( jQuery );