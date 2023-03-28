<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mireya
 */

get_header();
?>

<?php

$blog_featured_img = get_field( 'blog_featured_img', 'option' );
$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );

$bg_image = get_the_post_thumbnail_url( 'mireya_1920xAuto' );
$categories_list = get_the_category_list( esc_html__( ', ', 'mireya' ) );
$title = get_the_title();

$title_array = explode( ' ', $title );
$title_length = count( $title_array );
$title_middle = ( int ) ( $title_length / 2 );

$title_1 = '';
$title_2 = '';

for ( $i = 0; $i<$title_middle; $i++ ) {
	$title_1 .= $title_array[$i] . ' ';
}
for ( $i = $title_middle; $i<$title_length; $i++ ) {
	$title_2 .= $title_array[$i] . ' ';
}

?>

	<?php while ( have_posts() ) : the_post(); ?>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="mry-head-bg">
		<img src="<?php the_post_thumbnail_url( 'mireya_1920xAuto' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
		<div class="mry-bg-overlay"></div>
	</div>
	<?php endif; ?>

	<div class="mry-banner mry-p-140-0 mry-p-0-100">
		<div class="container">
			<div class="mry-main-title mry-title-center">
				<?php if ( $categories_list ) : ?>
				<div class="mry-subtitle mry-mb-20 mry-fo">
					<?php echo wp_kses_post( $categories_list ); ?>
				</div>
				<?php endif; ?>
				<?php if ( $title_1 ) : ?>
				<h1 class="mry-mb-20 mry-fo">
					<?php if ( $title_1 ) : ?>
						<?php echo wp_kses_post( $title_1 ); ?>
		          		<br>
		          	<?php endif; ?>
		          	<?php if ( $title_2 ) : ?>
					<span class="mry-border-text">
						<?php echo wp_kses_post( $title_2 ); ?>
					</span>
					<?php endif; ?>
					<span class="mry-animation-el"></span>
				</h1>
				<?php endif; ?>
				<div class="mry-text mry-fo">
					<?php the_date(); ?>
				</div>
				<div class="mry-scroll-hint-frame">
					<a class="mry-scroll-hint mry-smooth-scroll mry-magnetic-link mry-fo" href="#mry-anchor">
						<span class="mry-magnetic-object"></span>
					</a>
					<div class="mry-label mry-fo"><?php echo esc_html__( 'Scroll Down', 'mireya' ); ?></div>
				</div>
			</div>
		</div>
	</div>

	<!-- publication -->
	<div class="mry-about mry-p-0-100">
		<div class="container">
			<div class="row justify-content-center">
				<?php if ( has_post_thumbnail() && ! $blog_featured_img ) : ?>
				<div class="col-lg-10">
					<div class="mry-about-video mry-mb-100 mry-fo">
						<div class="mry-video-cover-frame">
							<a<?php if ( ! $theme_lightbox ) : ?> data-magnific-image<?php endif; ?> data-no-swup href="<?php the_post_thumbnail_url( 'mireya_1920xAuto' ); ?>">
								<img class="mry-video-cover mry-scale-object" src="<?php the_post_thumbnail_url( 'mireya_1920xAuto' ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
							</a>
							<div class="mry-cover-overlay"></div>
							<div class="mry-curtain"></div>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<div class="col-lg-8">
					<div class="mry-mb-100">
						<?php get_template_part( 'template-parts/content', 'single' ); ?>
					</div>
				</div>
			</div>
			
			<?php mireya_single_navigantion(); ?>

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