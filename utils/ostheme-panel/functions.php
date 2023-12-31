<?php

function theme_admin_css()
{
    $url = get_theme_root_uri().'/ostheme/assets/css/admin_panel.css';
    echo '<link rel="stylesheet" href="'.$url.'" type="text/css" >';
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

    add_menu_page(
        'Ombusdman', // Page title
        'Ombudsman', // Menu title
        'manage_options', // Capabilities
        'os_ombudsman', // Menu slug
        'render_theme_ombudsman', // Function
        'dashicons-star-filled' // Icon URL
        // Position
    );
    add_menu_page(
        'Matérias em Áudio', // Page title
        'Áudios', // Menu title
        'manage_options', // Capabilities
        'os_audio', // Menu slug
        'render_theme_audio', // Function
        'dashicons-controls-volumeon' // Icon URL
        // Position
    );
    add_menu_page(
        'Estatísticas do portal', // Page title
        'Dados', // Menu title
        'manage_options', // Capabilities
        'os_stats', // Menu slug
        'render_theme_stats', // Function
        'dashicons-chart-line' // Icon URL
        // Position
    );
}

add_action('admin_menu', 'theme_admin_page');

include get_template_directory() . '/utils/ostheme-panel/ostheme_layout.php';
include get_template_directory() . '/utils/ostheme-panel/ostheme_ads.php';
include get_template_directory() . '/utils/ostheme-panel/ostheme_ombudsman.php';
include get_template_directory() . '/utils/ostheme-panel/ostheme_audio.php';
include get_template_directory() . '/utils/ostheme-panel/ostheme_stats.php';