<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mireya
 */

?>

<?php

$footer_hide = get_field( 'footer_hide' );
$footer_copy = get_field( 'footer_copy', 'option' );
$footer_right = get_field( 'footer_right', 'option' );
$social_links = get_field( 'social_links', 'option' );

?>
				
				<?php if ( ! $footer_hide ) : ?>
				<!-- footer -->
				<footer class="mry-footer">
					<div class="mry-footer-copy">
						<div class="container">
							<?php if ( $footer_copy ) : ?>
							<div>
								<?php echo wp_kses_post( $footer_copy ); ?>		
							</div>
							<?php else : ?>
							<div>
								<?php echo esc_html__( '&copy; 2021. All rights reserved', 'mireya' ); ?>
							</div>
							<?php endif; ?>
							<?php if ( $social_links ) : ?>
							<ul class="mry-social">
								<?php foreach ( $social_links as $link ) : ?>
								<li>
									<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" title="<?php echo esc_attr( $link['name'] ); ?>">
										<?php echo wp_kses_post( $link['icon'] ); ?>
									</a>
								</li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
							<?php if ( $footer_right ) : ?>
							<div>
								<?php echo wp_kses_post( $footer_right ); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</footer>
				<!-- footer end -->
				<?php endif; ?>
			</div>
		</div>
		
	</div>
	
<?php wp_footer(); ?>

</body>
</html>