<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mireya
 */

?>

<?php

/* post content */
$current_categories = get_the_terms( get_the_ID(), 'portfolio_categories' );
$categories_string = '';
if ( $current_categories && ! is_wp_error( $current_categories ) ) {
  $arr_keys = array_keys( $current_categories );
  $last_key = end( $arr_keys );
  foreach ( $current_categories as $key => $value ) {
    if ( $key == $last_key ) {
      $categories_string .= $value->name . ' ';
    } else {
      $categories_string .= $value->name . esc_html__( ', ', 'mireya' );
    }
  }
}

$image = get_the_post_thumbnail_url( get_the_ID(), 'mireya_950xAuto' );
$title = get_the_title();
$href = get_the_permalink();
$short_description = get_field( 'short_description' );

$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );

?>

<div class="mry-card-item">
    <div class="mry-card-cover-frame mry-mb-20 mry-fo">
      <?php if ( $categories_string ) : ?>
      <div class="mry-badge"><?php echo esc_html( $categories_string ); ?></div>
      <?php endif; ?>
      <?php if ( $image ) : ?>
      <div class="mry-cover-overlay"></div>
      <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="mry-scale-object">
      <div class="mry-hover-links">
        <a<?php if ( ! $theme_lightbox ) : ?> data-magnific-gallery<?php endif; ?> data-no-swup data-elementor-lightbox-slideshow="gallery" data-elementor-lightbox-title="<?php echo esc_attr( $title ); ?>" href="<?php echo esc_url( $image ); ?>" class="mry-zoom mry-magnetic-link"><span class="mry-magnetic-object"><i
              class="fas fa-expand"></i></span></a>
        <a href="<?php echo esc_url( $href ); ?>" class="mry-more mry-magnetic-link mry-anima-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-right"></i></span></a>
      </div>
      <?php endif; ?>
    </div>
    <div class="mry-item-descr mry-fo">
      <?php if ( $title ) : ?>
      <h4 class="mry-mb-10"><a href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $title ); ?></a></h4>
      <?php endif; ?>
      <?php if ( $short_description ) : ?>
      <div class="mry-text"><?php echo wp_kses_post( $short_description ); ?></div>
      <?php endif; ?>
    </div>
  </div>