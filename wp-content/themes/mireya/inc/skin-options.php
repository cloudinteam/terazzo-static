<?php
/**
 * Skin
**/

if ( function_exists( 'get_field' ) ) {
	/**
	 * Light Version
	 */

	$theme_ui = get_field( 'theme_ui', 'option' );

	if ( $theme_ui ) {
		function mireya_dark_stylesheets() {
			wp_enqueue_style( 'mireya-dark', get_template_directory_uri() . '/assets/css/style-dark.css', '1.0' );
		}
		add_action( 'wp_enqueue_scripts', 'mireya_dark_stylesheets', 10 );
	}
}

function mireya_skin() {
	$theme_ui = get_field( 'theme_ui', 'option' );
	$theme_color = get_field( 'theme_color', 'options' );
	$heading_color = get_field( 'heading_color', 'options' );
	$text_color = get_field( 'text_color', 'options' );
	$btn_color = get_field( 'btn_color', 'options' );
	$menu_font_color = get_field( 'menu_font_color', 'options' );
	
	$heading_font_family = get_field( 'heading_font_family', 'options' );
	$text_font_family = get_field( 'text_font_family', 'options' );
	$menu_font_family = get_field( 'menu_font_family', 'options' );

	$heading_font_size = get_field( 'heading_font_size', 'options' );
	$text_font_size = get_field( 'text_font_size', 'options' );
	$menu_font_size = get_field( 'menu_font_size', 'options' );

	if ( $theme_ui ) {
		$heading_color = get_field( 'heading_color_light', 'options' );
		$text_color = get_field( 'text_color_light', 'options' );
		$menu_font_color = get_field( 'menu_font_color_light', 'options' );
		$btn_color = get_field( 'btn_color_light', 'options' );
	}

?>

<style>
	<?php if ( $heading_color ) : ?>
	/* Heading Color */
	.mry-h1, .mry-h2, .mry-h3, .mry-h4, .mry-h5, .mry-h6, h1, h2, h3, h4, h5, h6 {
		color: <?php echo esc_attr( $heading_color ); ?>;
	}
	<?php endif; ?>

	<?php if ( $heading_font_family ) : ?>
	/* Heading Font Family */
	.mry-h1, .mry-h2, .mry-h3, .mry-h4, .mry-h5, .mry-h6, h1, h2, h3, h4, h5, h6 {
		font-family: '<?php echo esc_attr( $heading_font_family['font_name'] ); ?>';
	}
	<?php endif; ?>

	<?php if ( $heading_font_size ) : ?>
	/* Heading Font Size */
	.mry-h1, h1, .mry-h2, h2 {
		font-size: <?php echo esc_attr( $heading_font_size ); ?>px;
	}
	<?php endif; ?>

	<?php if ( $text_color ) : ?>
	/* Text Color */
	body, 
	.mry-text, 
	.mry-menu nav ul .menu-item .sub-menu .menu-item a, 
	.mry-menu nav ul .menu-item.menu-item-has-children > i:after,
	.mry-menu .mry-info-box-frame .mry-info-box .mry-label,
	.mry-subtitle,
	.mry-arrows .mry-label,
	.mry-pagination a, 
	.mry-pagination span, 
	.qrt-blog-pagination a, 
	.qrt-blog-pagination span, 
	.page-links a, 
	.page-links span,
	.mry-footer .mry-footer-copy,
	.mry-footer .mry-footer-copy .container .mry-social li a,
	.mry-card-item .mry-card-cover-frame .mry-badge,
	.mry-lock {
		color: <?php echo esc_attr( $text_color ); ?>;
	}
	<?php endif; ?>

	<?php if ( $text_font_family ) : ?>
	/* Text Font Family */
	body, 
	.mry-text, 
	.mry-menu nav ul .menu-item .sub-menu .menu-item a, 
	/* .mry-menu nav ul .menu-item.menu-item-has-children > i:after, */
	.mry-menu .mry-info-box-frame .mry-info-box .mry-label,
	.mry-subtitle,
	.mry-arrows .mry-label,
	.mry-pagination a, 
	.mry-pagination span, 
	.qrt-blog-pagination a, 
	.qrt-blog-pagination span, 
	.page-links a, 
	.page-links span,
	.mry-footer .mry-footer-copy,
	.mry-footer .mry-footer-copy .container .mry-social li a,
	.mry-card-item .mry-card-cover-frame .mry-badge,
	.mry-lock {
		font-family: '<?php echo esc_attr( $text_font_family['font_name'] ); ?>';
	}
	<?php endif; ?>

	<?php if ( $text_font_size ) : ?>
	/* Text Font Size */
	body, 
	.mry-text, 
	.mry-menu nav ul .menu-item .sub-menu .menu-item a, 
	.mry-menu nav ul .menu-item.menu-item-has-children > i:after,
	.mry-menu .mry-info-box-frame .mry-info-box .mry-label,
	.mry-subtitle,
	.mry-arrows .mry-label,
	.mry-pagination a, 
	.mry-pagination span, 
	.qrt-blog-pagination a, 
	.qrt-blog-pagination span, 
	.page-links a, 
	.page-links span,
	.mry-footer .mry-footer-copy,
	.mry-footer .mry-footer-copy .container .mry-social li a,
	.mry-card-item .mry-card-cover-frame .mry-badge,
	.mry-lock {
		font-size: <?php echo esc_attr( $text_font_size ); ?>px;
	}
	<?php endif; ?>

	<?php if ( $menu_font_color ) : ?>
	/* Menu Color */
	.mry-menu nav ul .menu-item a {
		color: <?php echo esc_attr( $menu_font_color ); ?>;
	}
	<?php endif; ?>

	<?php if ( $menu_font_family ) : ?>
	/* Menu Font Family */
	.mry-menu nav ul .menu-item a {
		font-family: '<?php echo esc_attr( $menu_font_family['font_name'] ); ?>';
	}
	<?php endif; ?>

	<?php if ( $menu_font_size ) : ?>
	/* Menu Font Size */
	.mry-menu nav ul .menu-item a {
		font-size: <?php echo esc_attr( $menu_font_size ); ?>px;
	}
	<?php endif; ?>

	<?php if ( $btn_color ) : ?>
	/* Btn Color */
	.mry-btn, 
	.mry-btn-text, 
	.mry-link {
		color: <?php echo esc_attr( $btn_color ); ?>;
	}
	.mry-btn, .mry-btn-text {
		border-color: <?php echo esc_attr( $btn_color ); ?>;
	}
	<?php endif; ?>

	<?php if ( $theme_color ) : ?>
	/* Theme Color */
	.mry-app .mry-preloader .mry-preloader-content .mry-loader-bar .mry-loader,
	.mry-subtitle:before,
	.mry-slider-pagination-frame .mry-slider-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
	.mry-slider-progress-bar-frame .mry-slider-progress-bar .mry-progress:after,
	.mry-pagination a.current, 
	.mry-pagination span.current, 
	.qrt-blog-pagination a.current, 
	.qrt-blog-pagination span.current, 
	.page-links a.current, 
	.page-links span.current,
	.content-sidebar td#today,
	.single-post-text table td#today,
	.comment-form .btn.fill,
	form.post-password-form input[type="submit"],
	.content-sidebar .widget-title:before,
	.sticky:before,
	.wp-block-button a.wp-block-button__link {
		background-color: <?php echo esc_attr( $theme_color ); ?>;
	}
	.mry-text a,
	.mry-text a:hover,
	.mry-text .mry-color-text,
	.mry-btn:hover, 
	.mry-btn-text:hover,
	.mry-link:hover, 
	.mry-el-more .mry-link:hover,
	.mry-menu nav ul .menu-item.current-menu-item > a, 
	.mry-menu nav ul .menu-item.current-menu-parent > a, 
	.mry-menu nav ul .menu-item .sub-menu li.current-menu-item > a,
	.mry-star-rate li i,
	.mry-filter .mry-card-category.mry-current,
	.single-post-text p a,
	.comment-text p a,
	.error-page__num,
	.post-text-bottom .byline a {
		color: <?php echo esc_attr( $theme_color ); ?>;
	}
	.mry-form input:focus, 
	.mry-form textarea:focus,
	.wp-block-button.is-style-outline a.wp-block-button__link {
		border-color: <?php echo esc_attr( $theme_color ); ?>;
	}
	html.is-animating body .mry-ball svg path, 
	html.is-rendering body .mry-ball svg path,
	.mapboxgl-marker svg g {
		fill: <?php echo esc_attr( $theme_color ); ?>;
	}
	@media (max-width: 768px) {
		.mry-filter .mry-card-category.mry-current {
			color: <?php echo esc_attr( $theme_color ); ?>;
		}
	}
	<?php endif; ?>

</style>

<?php
}
add_action( 'wp_head', 'mireya_skin', 10 );