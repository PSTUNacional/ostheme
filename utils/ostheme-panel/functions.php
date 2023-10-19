<?php

function theme_admin_css()
{
    echo '<link rel="stylesheet" href="../../assets/css/admin_panel.css" type="text/css" >';
}
add_action('admin_head', 'theme_admin_css');

/**
 * Add a new options page named "OS Tema".
 */
function theme_admin_page()
{
    add_menu_page(
        'OS Tema | Configurações', // Page title
        'OS Tema', // Menu title
        'manage_options', // Capabilities
        'ostheme', // Menu slug
        'render_theme_admin', // Function
        'dashicons-schedule' // Icon URL
        // Position
    );
    add_submenu_page(
        'ostheme', // Parent Slug
        'Página Inicial', // Page title
        'Página Inicial', // Menu title
        'manage_options', // Capabilities
        'ostheme', // Menu Slug
        'render_theme_admin', // Function
    );
    add_submenu_page(
        'ostheme', // Parent Slug
        'Anúncios', // Page title
        'Anúncios', // Menu title
        'manage_options', // Capabilities
        'ostheme_ads', // Menu Slug
        'render_theme_admin_ads', // Function
    );
}

add_action('admin_menu', 'theme_admin_page');

include get_template_directory() . '/utils/ostheme-panel/ostheme_layout.php';
include get_template_directory() . '/utils/ostheme-panel/ostheme_ads.php';