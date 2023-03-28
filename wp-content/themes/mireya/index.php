<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
					<?php echo esc_html__( 'Latest Posts', 'mireya' ); ?>
					<span class="mry-animation-el"></span>
				</h1>
			</div>
		</div>
	</div>

    <?php get_template_part( 'template-parts/archive-list' ); ?>

	</div>
<?php
get_footer();