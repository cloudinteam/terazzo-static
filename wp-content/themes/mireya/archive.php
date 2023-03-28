<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mireya
 */

get_header();
?>
	
	<div class="mry-banner mry-title-archive mry-p-140-0 mry-p-0-100">
		<div class="container">
			<div class="mry-main-title mry-title-center">
				<h1 class="mry-mb-20 mry-fo">
					<?php echo wp_kses_post( get_the_archive_title() ); ?>
					<span class="mry-animation-el"></span>
				</h1>
			</div>
		</div>
	</div>

	<?php get_template_part( 'template-parts/archive-list' ); ?>

<?php
get_footer();