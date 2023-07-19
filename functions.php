<?php

/***
 * 
 * Load JS and CSS
 * 
 */
function load_scripts()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');
    wp_enqueue_script('functions', get_template_directory_uri() . '/assets/js/functions.js', array(), '1.0', true);
}

add_action('wp_enqueue_scripts', 'load_scripts');

function ostheme_config()
{

    /***
     * 
     * Register NAVs 
     * 
     */

    register_nav_menus(
        array(
            'main_menu' => 'Main Menu',
            'top_menu' => 'Top Menu'
        )
    );

    $args = array(
        'height'    => 225,
        'width'     => 1920 
    );
    add_theme_support( 'custom-header', $args );

    add_theme_support( 'post-thumbnails');
}

add_action( 'after_setup_theme', 'ostheme_config', 0 );

include get_template_directory() . '/utils/ostheme-panel/functions.php';