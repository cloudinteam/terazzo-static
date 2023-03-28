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

$blog_categories = get_field( 'blog_categories', 'option' );
$blog_excerpt = get_field( 'blog_excerpt', 'option' );
$excerpt_text = get_the_excerpt();

?>

<!-- blog post card -->
<div class="mry-blog-card">
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	  <!-- post cover -->
	  <?php mireya_post_thumbnail( 'blog' ); ?>
	  <!-- post cover end -->
	  <!-- post description -->
	  <div class="mry-post-description">
	  	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="mry-project-category mb-15">
			<span class="mry-el-date">
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</a>
			</span>
			<?php
			if( $blog_categories ) :
				$categories_list = get_the_category();
				if ( $categories_list ) :
					echo esc_html__( ' / ', 'mireya' );
					$total = count( $categories_list );
					$i = 0;
					echo '<span class="mry-el-category">';
					foreach ( $categories_list as $category ) { $i++;
						if ( $total != $i ) {
							echo esc_html( $category->cat_name ) . esc_html__( ', ', 'mireya' );
						} else {
							echo esc_html( $category->cat_name );
						}
					}
					echo '</span>';
				endif;
			endif;
			?>
		</div>
		<?php endif; ?>
	    <!-- title -->
	    <h4 class="mry-el-title mb-15">
	    	<a href="<?php echo esc_url( get_permalink() ); ?>">
	      		<?php the_title(); ?>
	    	</a>
		</h4>
	    <?php if ( ! $blog_excerpt && $excerpt_text ) : ?>
	    <!-- text -->
	    <div class="mry-el-description">
	    	<?php the_excerpt(); ?>
	    </div>
	    <?php endif; ?>
	  </div>
	  <!-- post description end -->
  </div>
</div>
<!-- blog post card end -->