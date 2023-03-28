<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mireya
 */

get_header();
?>
	
	<?php while ( have_posts() ) : the_post(); ?>

	<div class="mry-banner mry-title-archive mry-p-140-0 mry-p-0-100">
		<div class="container">
			<div class="mry-main-title mry-title-center">
				<h1 class="mry-mb-20 mry-fo">
					<?php the_title(); ?>
					<span class="mry-animation-el"></span>
				</h1>
			</div>
		</div>
	</div>

	<!-- publication -->
	<div class="mry-about mry-p-0-100">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="mry-mb-100">
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
					</div>
				</div>
			</div>

			<?php if ( comments_open() || get_comments_number() ) : ?>
			<!-- row -->
			<div class="row justify-content-center">
				<!-- col -->
				<div class="col-lg-8">
				    <?php
					// If comments are open or we have at least one comment, load up the comment template.
					comments_template();
				    ?>
				</div>
				<!-- col end -->
			</div>
		    <!-- row end -->
		    <?php endif; ?>
		</div>
	</div>

	<?php endwhile; ?>

<?php
get_footer();
