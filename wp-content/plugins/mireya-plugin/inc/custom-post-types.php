<?php

/**
 * Register Custom Post Type: Portfolio
 */

function mireya_register_portfolio() {
	register_post_type( 'portfolio', array(
			'label' => esc_html__( 'Portfolio', 'mireya-plugin' ),
	        'description' => esc_html__( 'Portfolio', 'mireya-plugin' ),
	        'supports' => array( 'title','editor','revisions','thumbnail','page-attributes' ),
	        'taxonomies' => array( 'portfolio_categories' ),
	        'hierarchical' => false,
	        'show_in_rest' => true,
	        'public' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'show_in_nav_menus' => true,
	        'show_in_admin_bar' => true,
	        'menu_position' => 20,
	        'menu_icon' => 'dashicons-images-alt2',
	        'can_export' => true,
	        'has_archive' => false,
	        'exclude_from_search' => true,
	        'publicly_queryable' => true,
	        'capability_type' => 'post',
	        'rewrite' => array( 'slug' => 'portfolio/item', 'with_front' => true  ),
			'labels' => array(
				'name' => esc_html__( 'Portfolio', 'mireya-plugin' ),
		        'singular_name' => esc_html__( 'Portfolio', 'mireya-plugin' ),
		        'menu_name' => esc_html__( 'Portfolio', 'mireya-plugin' ),
		        'parent_item_colon' => esc_html__( 'Parent Portfolio:', 'mireya-plugin' ),
		        'all_items' => esc_html__( 'All Portfolio', 'mireya-plugin' ),
		        'view_item' => esc_html__( 'View Portfolio', 'mireya-plugin' ),
		        'add_new_item' => esc_html__( 'Add New Portfolio', 'mireya-plugin' ),
		        'add_new' => esc_html__( 'New Portfolio', 'mireya-plugin' ),
		        'edit_item' => esc_html__( 'Edit Portfolio', 'mireya-plugin' ),
		        'update_item' => esc_html__( 'Update Portfolio', 'mireya-plugin' ),
		        'search_items' => esc_html__( 'Search Portfolio', 'mireya-plugin' ),
		        'not_found' => esc_html__( 'No portfolio found', 'mireya-plugin' ),
		        'not_found_in_trash' => esc_html__( 'No portfolio found in Trash', 'mireya-plugin' ),
			),
		)
	);
}
add_action( 'init', 'mireya_register_portfolio' );

function mireya_register_portfolio_categories() {
	register_taxonomy( 'portfolio_categories', array ( 0 => 'portfolio' ),
		array(
			'label' => esc_html__( 'Portfolio Categories', 'mireya-plugin' ),
			'hierarchical' => true,
			'show_ui' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'portfolio-categories' ),
			'labels' => array(
				'name'              => esc_html__( 'Portfolio Categories', 'mireya-plugin' ),
		        'singular_name'     => esc_html__( 'Portfolio Categories', 'mireya-plugin' ),
		        'search_items'      => esc_html__( 'Search Portfolio Category', 'mireya-plugin' ),
		        'all_items'         => esc_html__( 'All Portfolio Category', 'mireya-plugin' ),
		        'parent_item'       => esc_html__( 'Parent Portfolio Category', 'mireya-plugin' ),
		        'parent_item_colon' => esc_html__( 'Parent Portfolio Category:', 'mireya-plugin' ),
		        'edit_item'         => esc_html__( 'Edit Portfolio Category', 'mireya-plugin' ),
		        'update_item'       => esc_html__( 'Update Portfolio Category', 'mireya-plugin' ),
		        'add_new_item'      => esc_html__( 'Add New Portfolio Category', 'mireya-plugin' ),
		        'new_item_name'     => esc_html__( 'New Portfolio Category Name', 'mireya-plugin' ),
		        'menu_name'         => esc_html__( 'Portfolio Category', 'mireya-plugin' ),
			)
		)
	);
}
add_action( 'init', 'mireya_register_portfolio_categories' );