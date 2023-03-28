<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mireya
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-box">
		<div class="single-post-text">
			<?php
				the_content(); 

				wp_link_pages( array(
					'before' => '<div class="page-links"><span class="page-links-label">' . esc_html__( 'Pages:', 'mireya' ) . '</span>',
					'after'  => '</div>',
				) );
			?>
		</div>
		<div class="post-text-bottom">	
			<?php mireya_entry_footer(); ?>
		</div>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->