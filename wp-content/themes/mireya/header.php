<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mireya
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Meta Data -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php $header_logo = get_field( 'header_logo', 'option' ); ?>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
  <div class="mry-app">

    <?php
    $preloader_hide_logo = get_field( 'preloader_hide_logo', 'option' );
    $preloader_text = get_field( 'preloader_text', 'option' );
    ?>
    <!-- preloader -->
    <div class="mry-preloader mry-active">
      <div class="mry-preloader-content">
        <?php if ( ! $preloader_hide_logo && $header_logo ) : ?>
        <img class="mry-logo mry-mb-20" src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
        <?php endif; ?>
        <div class="mry-loader-bar">
          <div class="mry-loader"></div>
        </div>
        <div class="mry-label"><?php echo esc_html( $preloader_text ); ?></div>
      </div>
    </div>
    <!-- preloader end -->

    <?php 
    $cursor_hide = get_field( 'cursor_hide', 'option' );
    if ( ! $cursor_hide ) : 
    ?>
    <!-- cursor -->
    <div class="mry-magic-cursor">
      <div class="mry-ball">
        <div class="mry-loader">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50"
            style="enable-background:new 0 0 50 50;" xml:space="preserve">
            <path d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
              <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite" />
            </path>
          </svg>
        </div>
      </div>
    </div>
    <!-- cursor end -->
    <?php endif; ?>
    
    <!-- top panel -->
    <div class="mry-top-panel">
      <div class="mry-logo-frame">
        <a href="<?php echo esc_url( home_url() ); ?>" class="mry-default-link mry-anima-link">
          <?php if ( $header_logo ) : ?>
          <img class="mry-logo" src="<?php echo esc_url( $header_logo ); ?>" alt="<?php echo esc_attr( bloginfo('name') ); ?>">
          <?php else : ?>
          <span class="mry-logo-text"><?php echo esc_html( bloginfo('name') ); ?></span>
          <span class="mry-logo-sub"><?php echo esc_html( bloginfo('description') ); ?></span>
          <?php endif; ?>
        </a>
      </div>

      <div class="mry-menu-button-frame">
        <div class="mry-label"><?php echo esc_html__( 'Menu', 'mireya' ); ?></div>

        <div class="mry-menu-btn mry-magnetic-link">
          <div class="mry-burger mry-magnetic-object">
            <span></span>
          </div>
        </div>
      </div>
    </div>
    <!-- top panel end -->

    <!-- menu -->
    <div class="mry-menu">
      <div class="container">
        <div class="row justify-content-between">
          <div class="col-md-4">
            <nav id="mry-dynamic-menu">
              <?php if ( has_nav_menu( 'primary' ) ) :
                wp_nav_menu( array(
                  'theme_location' => 'primary',
                  'container' => '',
                  'menu_class' => '',
                  'walker' => new Mireya_Header_Menu_Walker(),
                ) );
              endif; ?>
            </nav>
          </div>
          <?php $header_info = get_field( 'header_info', 'option' ); ?>
          <div class="col-md-4">
            <?php if ( $header_info ) : ?>
            <div class="mry-info-box-frame">
              <div class="mry-info-box">
                <?php foreach ( $header_info as $item ) : ?>
                <div class="mry-mb-20">
                  <div class="mry-label mry-mb-5"><?php echo esc_html( $item['label'] ); ?></div>
                  <div class="mry-text"><?php echo wp_kses_post( $item['value'] ); ?></div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <!-- menu end -->

    <div id="mry-dynamic-content" class="transition-fade">
      <div class="mry-content-frame" id="scroll">