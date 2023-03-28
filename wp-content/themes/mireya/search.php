<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package mireya
 */

get_header();
?>
	<div class="mry-banner mry-title-archive mry-p-140-0 mry-p-0-100">
		<div class="container">
			<div class="mry-main-title mry-title-center">
				<h1 class="mry-mb-20 mry-fo">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search: %s', 'mireya' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
					?>
					<span class="mry-animation-el"></span>
				</h1>
				<div class="mry-text mry-fo">
					<?php echo esc_html__( 'Search Results', 'mireya' ); ?>
				</div>
			</div>
		</div>
	</div>

    <?php get_template_part( 'template-parts/archive-list' ); ?>

<?php
get_footer();