<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mireya
 */

?>

<!-- content none -->
<div class="qrt-content-none">
	<h2 class="qrt-el-title title--h3"><?php echo esc_html__( 'Nothing Found', 'mireya' ); ?></h2>
	
	<div class="qrt-el-description">
	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) :
		printf(
			'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mireya' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);
	elseif ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mireya' ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mireya' ); ?></p>
	<?php endif; ?>
	</div>
</div>