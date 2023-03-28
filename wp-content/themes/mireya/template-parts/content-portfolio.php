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
$categories_slugs_string = '';
if ( $current_categories && ! is_wp_error( $current_categories ) ) {
	$arr_keys = array_keys( $current_categories );
	$last_key = end( $arr_keys );
	foreach ( $current_categories as $key => $value ) {
		if ( $key == $last_key ) {
			$categories_string .= $value->name . ' ';
		} else {
			$categories_string .= $value->name . esc_html__( ', ', 'mireya' );
		}
		$categories_slugs_string .= 'category-' . $value->slug . ' ';
	}
}

$image = get_the_post_thumbnail_url( get_the_ID(), 'mireya_800x800' );
$title = get_the_title();
$href = get_the_permalink();
$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );
$grid_size = get_field( 'grid_size' );
$short_description = get_field( 'short_description' );

$grid_class = 'mry-masonry-grid-item-33';

$layout = get_query_var( 'layout' );
$masonry = get_query_var( 'masonry' );

if ( $layout == 'column-2' ) {
  $grid_class = 'mry-masonry-grid-item-50';
}
if ( $layout == 'column-3' ) {
  $grid_class = 'mry-masonry-grid-item-33';
}

if ( $grid_size == 1 && $masonry == 'yes' ) {
  $grid_class .= ' mry-masonry-grid-item-h-x-2';
}
if ( $grid_size == 2 ) {
  $grid_class == 'mry-masonry-grid-item-100';
}

?>

<div class="mry-masonry-grid-item <?php echo esc_attr( $grid_class ); ?> <?php echo esc_attr( $categories_slugs_string ); ?>">
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
</div>