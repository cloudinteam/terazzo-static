<?php
/**
 * The template for displaying search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package mireya
 */
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php echo esc_attr__( 'Search ...', 'mireya' ); ?>" />
	<button type="submit" class="searchform-btn"><?php echo esc_html__( 'Submit', 'mireya' ); ?></button>
</form>