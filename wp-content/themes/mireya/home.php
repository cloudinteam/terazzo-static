<?php
/**
 * The template for displaying all posts
 *
 * @package mireya
 */

if ( is_home() && ! is_front_page() ) {
	get_template_part( 'template-blog' );
} else {
	get_template_part( 'index' );
}

?>