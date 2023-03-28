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

$image = get_the_post_thumbnail_url( get_the_ID(), 'mireya_950xAuto' );
$blog_excerpt = get_field( 'blog_excerpt', 'option' );
$excerpt_text = get_the_excerpt();

?>

<div class="swiper-slide">
	<div class="mry-card-item mry-fade-object" id="post-<?php the_ID(); ?>">
		<div class="mry-card-cover-frame mry-mb-20 mry-fo">
			<div class="mry-badge"><?php echo esc_html( get_the_date() ); ?></div>
			<?php if ( $image ) : ?>
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="mry-scale-object">
			<div class="mry-cover-overlay"></div>
			<div class="mry-hover-links">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="mry-more mry-magnetic-link mry-anima-link"><span class="mry-magnetic-object"><i class="fas fa-arrow-right"></i></span></a>
			</div>
			<?php endif; ?>
		</div>
		<div class="mry-item-descr">
			<h4 class="mry-mb-10 mry-fo"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h4>
			<?php if ( ! $blog_excerpt && $excerpt_text ) : ?>
			<div class="mry-text mry-mb-10 mry-fo">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>