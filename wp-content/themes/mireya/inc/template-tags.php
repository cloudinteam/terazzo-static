<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package mireya
 */

if ( ! function_exists( 'mireya_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function mireya_posted_on() {
		echo '<div class="date">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'mireya' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		echo '</div>';
	}
endif;

if ( ! function_exists( 'mireya_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function mireya_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'mireya' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'mireya' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			mireya_posted_by();

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( '', 'list item separator', 'mireya' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'mireya' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'mireya' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'mireya' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'mireya_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function mireya_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'mireya' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'mireya_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function mireya_post_thumbnail( $type = 'default' ) {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( is_singular() && $type == 'default' ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
		<?php if ( has_post_thumbnail() ) : ?>
		<a class="qrt-post-cover post-thumbnail" href="<?php echo esc_url( get_the_permalink() ); ?>">
			<?php
				the_post_thumbnail( 'mireya_1280x768', array(
					'alt' => the_title_attribute( array(
						'echo' => false,
					)),
				));
			?>
		</a>
		<?php endif; ?>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'mireya_single_navigantion' ) ) :
	/**
	 * Displays an optional prev/next/all nagigations.
	 */
	function mireya_single_navigantion() {
		if ( is_singular() ) :
			
			$prev_post = get_adjacent_post( false, '', true );
			$next_post = get_adjacent_post( false, '', false );
			$archive_url = false;
			$archive_page_id = get_field( get_post_type() . '_page', 'option' );
			if ( ! $archive_page_id ) {
				$archive_url = get_post_type_archive_link( get_post_type() );
			} else {
				$archive_url = get_permalink( $archive_page_id );
			}

			$prev_str = esc_html__( 'Previous', 'mireya' );
			$next_str = esc_html__( 'Next', 'mireya' );
			$all_str = esc_html__( 'All posts', 'mireya' );

			if ( get_post_type() == 'portfolio' ) {
				$prev_str = esc_html__( 'Previous project', 'mireya' );
				$next_str = esc_html__( 'Next project', 'mireya' );
				$all_str = esc_html__( 'All projects', 'mireya' );
			}

			?>

			<!-- container -->
			<div class="qrt-section qrt-section-sf qrt-section-wb">

			<!-- row -->
			<div class="row justify-content-center">

			  <!-- col -->
			  <div class="col-lg-8">

			    <!-- projects navigation -->
			    <div class="qrt-portfolio-pagination">
			      <?php if ( is_a( $prev_post, 'WP_Post' ) ) : ?>
			      <!-- button -->
			      <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="qrt-link qrt-color-link qrt-w-chevron qrt-left-link qrt-anima-link"><span><?php echo esc_html( $prev_str ); ?></span></a>
			      <?php endif; ?>
			      <?php if ( $archive_url ) : ?>
			      <div class="qrt-pagination-center qrt-m-hidden">
			        <a class="qrt-link qrt-anima-link" href="<?php echo esc_url( $archive_url ); ?>"><?php echo esc_html( $all_str ); ?></a>
			      </div>
			      <?php endif; ?>
			      <?php if ( is_a( $next_post, 'WP_Post' ) ) : ?>
			      <!-- button -->
			      <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="qrt-link qrt-color-link qrt-w-chevron qrt-anima-link"><span><?php echo esc_html( $next_str ); ?></span></a>
			      <?php endif; ?>
			    </div>
			    <!-- projects navigation end -->

			  </div>
			  <!-- col end -->

			</div>
			<!-- row end -->

			</div>
			<!-- container end -->

		<?php
		endif; // End is_singular().
	}
endif;