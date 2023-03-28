<?php
/**
 * Template part for displaying archive list
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sochi
 */

?>

<?php 

$layout = get_field( 'blog_layout', 'option' ); 

?>

<?php if ( $layout == 1 ) : ?>

<div class="container">
    <div class="row">

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-lg-4 mry-p-0-40">
                <?php get_template_part( 'template-parts/content-grid' ); ?>
            </div>
            <?php endwhile; ?>

            <div class="col-lg-12">
                <div class="pagination qrt-blog-pagination">
                    <?php
                        echo paginate_links( array(
                            'prev_text'     => esc_html__( 'Prev', 'mireya' ),
                            'next_text'     => esc_html__( 'Next', 'mireya' ),
                        ) );
                    ?>
                </div>
            </div>

        <?php else : ?>
        <div class="col-lg-12">
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        </div>
        <?php endif; ?>

    </div>  
</div>

<?php else : ?>

<div class="container">
    <!-- row -->
    <div class="row archive-row">
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <div class="col-lg-9">
        <?php else : ?>
        <div class="col-lg-12">
        <?php endif; ?>
        
            <?php if ( have_posts() ) : ?>        
            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post(); ?>

                <?php
                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content' );
                ?>
            
            <?php endwhile; ?>
            
            <?php if ( get_the_posts_pagination() ) : ?>
            <div class="pagination qrt-blog-pagination">
                <?php
                    echo paginate_links( array(
                        'prev_text'     => esc_html__( 'Prev', 'mireya' ),
                        'next_text'     => esc_html__( 'Next', 'mireya' ),
                    ) );
                ?>
            </div>
            <?php endif; ?>
            
            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>   
        </div>
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <div class="col-lg-3">
            <div class="col__sedebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <!-- row end -->
</div>

<?php endif; ?>