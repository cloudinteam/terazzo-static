<?php

if ( class_exists( 'MireyaPlugin' ) ) {

function mireya_ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => esc_attr__( 'Default', 'mireya' ),
            'categories'                   => array( esc_attr__( 'Main', 'mireya' ) ),
            'import_file_url'            => MIREYA_EXTRA_PLUGINS_DIRECTORY . 'normal/ocdi-import/demo/01/content.xml',
            'preview_url'                  => 'https://1.envato.market/c/1790164/275988/4415?u=https://themeforest.net/item/mireya-architecture-portfolio-wordpress-theme/full_screen_preview/31598936',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'mireya_ocdi_import_files' );

function mireya_ocdi_after_import_setup( $selected_import ) {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'posts_per_page', 6 );

    $ocdi_fields_static = array(
        'options_theme_color' => '',
        '_options_theme_color' => 'field_5b68d509665d9',
        'options_heading_color' => '',
        '_options_heading_color' => 'field_5b68d5d8665da',
        'options_heading_color_light' => '#e6e6e6',
        '_options_heading_color_light' => 'field_606f2f32f8890',
        'options_text_color' => '',
        '_options_text_color' => 'field_5b68d617665db',
        'options_text_color_light' => '#d7d7d7',
        '_options_text_color_light' => 'field_606f3512f8891',
        'options_menu_font_color' => '',
        '_options_menu_font_color' => 'field_5eea679c5ad20',
        'options_menu_font_color_light' => '#e6e6e6',
        '_options_menu_font_color_light' => 'field_606f36f3f8892',
        'options_heading_font_size' => '',
        '_options_heading_font_size' => 'field_5eea66185ad1d',
        'options_text_font_size' => '',
        '_options_text_font_size' => 'field_5eea66ad5ad1e',
        'options_menu_font_size' => '',
        '_options_menu_font_size' => 'field_5eea67685ad1f',
        'options_heading_font_family' => 0,
        '_options_heading_font_family' => 'field_5b68cfc4906fc',
        'options_text_font_family' => 0,
        '_options_text_font_family' => 'field_5b68d188906fd',
        'options_menu_font_family' => 0,
        '_options_menu_font_family' => 'field_5eea67ef5ad21',
        'options_btn_color' => '',
        '_options_btn_color' => 'field_606f3833cae41',
        'options_btn_color_light' => '#e1e1e1',
        '_options_btn_color_light' => 'field_606f37cccae40',
        'options_header_sm_logo' => '',
        '_options_header_sm_logo' => 'field_602faa4b9fa62',
        'options_header_btn' => 0,
        '_options_header_btn' => 'field_602fc13b530e7',
        'options_blog_layout' => 1,
        '_options_blog_layout' => 'field_6030235cbbc92',
        'options_post_page' => '',
        '_options_post_page' => 'field_5f588f84087e0',
        'options_blog_categories' => 1,
        '_options_blog_categories' => 'field_5b81b6d930cb9',
        'options_blog_excerpt' => 0,
        '_options_blog_excerpt' => 'field_5b81b7ca30cba',
        'options_blog_featured_img' => 1,
        '_options_blog_featured_img' => 'field_5ee8e1ce18975',
        'options_social_share' => 'a:5:{i:0;s:8:"facebook";i:1;s:7:"twitter";i:2;s:8:"linkedin";i:3;s:6:"reddit";i:4;s:9:"pinterest";}',
        '_options_social_share' => 'field_5c610c399cf20',
        'options_post_layout' => 0,
        '_options_post_layout' => 'field_602308ace2a3b',
        'options_portfolio_page' => 122,
        '_options_portfolio_page' => 'field_5f58901c087e1',
        'options_portfolio_lightbox_disable' => 1,
        '_options_portfolio_lightbox_disable' => 'field_5f58eee9befad',
        'options_portfolio_layout' => 0,
        '_options_portfolio_layout' => 'field_6043acea9cc82',
        'options_p404_title' => 'Whoops!',
        '_options_p404_title' => 'field_5d180fd559b7f',
        'options_p404_content' => 'The page you\'re looking for doesn\'t exist or has been moved.',
        '_options_p404_content' => 'field_5d180feb59b80',
        'options_header_info' => 5,
        '_options_header_info' => 'field_60551dc58b483',
        'options_header_info_0_label' => 'Country:',
        '_options_header_info_0_label' => 'field_60551dc78b484',
        'options_header_info_0_value' => 'Canada',
        '_options_header_info_0_value' => 'field_60551dcc8b485',
        'options_header_info_1_label' => 'City:',
        '_options_header_info_1_label' => 'field_60551dc78b484',
        'options_header_info_1_value' => 'Toronto',
        '_options_header_info_1_value' => 'field_60551dcc8b485',
        'options_header_info_2_label' => 'Adress:',
        '_options_header_info_2_label' => 'field_60551dc78b484',
        'options_header_info_2_value' => 'HTGS 4456 North Av.',
        '_options_header_info_2_value' => 'field_60551dcc8b485',
        'options_header_info_3_label' => 'Email:',
        '_options_header_info_3_label' => 'field_60551dc78b484',
        'options_header_info_3_value' => 'mireya.inbox@mail.com',
        '_options_header_info_3_value' => 'field_60551dcc8b485',
        'options_header_info_4_label' => 'Phone:',
        '_options_header_info_4_label' => 'field_60551dc78b484',
        'options_header_info_4_value' => '+4 9(054) 996 84 25',
        '_options_header_info_4_value' => 'field_60551dcc8b485',
        'options_social_links' => 4,
        '_options_social_links' => 'field_60551e658b486',
        'options_social_links_0_icon' => 'fab fa-facebook-f',
        '_options_social_links_0_icon' => 'field_60551e658b487',
        'options_social_links_0_url' => 'https://facebook.com/',
        '_options_social_links_0_url' => 'field_60551e658b488',
        'options_social_links_0_name' => 'Facebook',
        '_options_social_links_0_name' => 'field_60551f038b48e',
        'options_social_links_1_icon' => 'fab fa-instagram',
        '_options_social_links_1_icon' => 'field_60551e658b487',
        'options_social_links_1_url' => 'https://instagram.com/',
        '_options_social_links_1_url' => 'field_60551e658b488',
        'options_social_links_1_name' => 'Instagram',
        '_options_social_links_1_name' => 'field_60551f038b48e',
        'options_social_links_2_icon' => 'fab fa-behance',
        '_options_social_links_2_icon' => 'field_60551e658b487',
        'options_social_links_2_url' => 'https://behance.com/',
        '_options_social_links_2_url' => 'field_60551e658b488',
        'options_social_links_2_name' => 'Behance',
        '_options_social_links_2_name' => 'field_60551f038b48e',
        'options_social_links_3_icon' => 'fab fa-dribbble',
        '_options_social_links_3_icon' => 'field_60551e658b487',
        'options_social_links_3_url' => 'https://dribbble.com/',
        '_options_social_links_3_url' => 'field_60551e658b488',
        'options_social_links_3_name' => 'Dribbble',
        '_options_social_links_3_name' => 'field_60551f038b48e',
        'options_preloader_text' => 'Please wait',
        '_options_preloader_text' => 'field_60551a19e0075',
        'options_footer_copy' => '&copy; 2021. All rights reserved',
        '_options_footer_copy' => 'field_60551e948b48a',
        'options_footer_right' => 'By: <a href="https://themeforest.net/user/beshleyua/" class="mry-default-link" target="_blank">beshleyua</a>',
        '_options_footer_right' => 'field_60551ebe8b48d',
        'options_cursor_hide' => 0,
        '_options_cursor_hide' => 'field_60551c2bfe60a',
    );
    $ocdi_fields_to_change = array();

    if( 'Default' === $selected_import['import_file_name'] ) {
        $ocdi_fields_to_change = array(
            'options_header_logo' => 485,
            '_options_header_logo' => 'field_602faa369fa61',
            'options_preloader_hide_logo' => 0,
            '_options_preloader_hide_logo' => 'field_5f58b3fc5f79f',
            'options_theme_transition' => 0,
            '_options_theme_transition' => 'field_5f5c89409b5e6',
            'options_theme_scrolling' => 0,
            '_options_theme_scrolling' => 'field_5f73a3eb21ad3',
            'options_theme_ui' => 0,
            '_options_theme_ui' => 'field_606f2ec4f888f',
        );
    }

    global $wpdb;
    foreach ( array_merge( $ocdi_fields_static, $ocdi_fields_to_change ) as $field => $value ) {
        if ( $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->options WHERE option_name = %s", $field ) ) == 0 ) {
            $wpdb->query( $wpdb->prepare( "INSERT INTO $wpdb->options ( option_name, option_value, autoload ) VALUES (%s, %s, 'no')", $field, $value ) );
        } else {
            $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->options SET option_value = %s WHERE option_name = %s", $value, $field ) );
        }
    }

}
add_action( 'pt-ocdi/after_import', 'mireya_ocdi_after_import_setup' );

}
