<?php

/*========================================

    SETTING REGISTER

========================================*/

function theme_settings_ads()
{

    $totalAds = [
        '01' => 'Anúncio no topo',
        '02' => 'Anúncio embaixo das manchetes'
    ];

    foreach ($totalAds as $adPlace => $title) {

        add_settings_section(
            'theme_ads_' . $adPlace . '_options', // ID
            $title, // Title
            false, // Callback
            'ostheme_ads' // Page
        );

        $args = [
            'active' => 'Ativo',
            'title' => 'Título',
            'background' => 'Image de fundo (URL)',
            'link' => 'Link do banner'
        ];

        foreach ($args as $key => $value) {
            register_setting(
                'ads_options_group', // Option Group
                'theme_ads_' . $adPlace . '_options_' . $key, // Option Name
                // Sanitize Callback
            );

            add_settings_field(
                'theme_ads_' . $adPlace . '_options_' . $key, // ID
                $value, // Title
                'home_ad_' . $adPlace . '_' . $key . '_callback', // Callback
                'ostheme_ads', // Page
                'theme_ads_' . $adPlace . '_options' // Section
                // Args 
            );
        }
    }
}

function home_ad_01_active_callback()
{
    get_option('theme_ads_01_options_active') == 'on' ? $value = 'checked' : $value = '';
    echo '<input type="checkbox" name="theme_ads_01_options_active" ' . $value . '/>';
}
function home_ad_01_title_callback()
{
    $value = get_option('theme_ads_01_options_title');
    echo '<input type="text" name="theme_ads_01_options_title" value="' . $value . '"/>';
}
function home_ad_01_background_callback()
{
    $value = get_option('theme_ads_01_options_background');
    echo '<input type="text" name="theme_ads_01_options_background" value="' . $value . '"/>';
}
function home_ad_01_link_callback()
{
    $value = get_option('theme_ads_01_options_link');
    echo '<input type="text" name="theme_ads_01_options_link" value="' . $value . '"/>';
}


function home_ad_02_active_callback()
{
    get_option('theme_ads_02_options_active') == 'on' ? $value = 'checked' : $value = '';
    echo '<input type="checkbox" name="theme_ads_02_options_active" ' . $value . '/>';
}
function home_ad_02_title_callback()
{
    $value = get_option('theme_ads_02_options_title');
    echo '<input type="text" name="theme_ads_02_options_title" value="' . $value . '"/>';
}
function home_ad_02_background_callback()
{
    $value = get_option('theme_ads_02_options_background');
    echo '<input type="text" name="theme_ads_02_options_background" value="' . $value . '"/>';
}
function home_ad_02_link_callback()
{
    $value = get_option('theme_ads_02_options_link');
    echo '<input type="text" name="theme_ads_02_options_link" value="' . $value . '"/>';
}

function render_theme_admin_ads()
{
?>
    <style>
        fieldset {
            margin-bottom: 24px;
        }

        fieldset h2 {
            border-bottom: 1px solid #ccc;
            padding-bottom: 24px;
        }
    </style>
    <h1>Configurações de Anúncios</h1>
    <?php
    settings_errors(); // Exibe alertas na página
    settings_fields('ads_options_group');

    ?>
    <form action="options.php" method="POST" class="card">
        <fieldset>
            <table class="form-table">
                <?php
                settings_fields('ads_options_group');
                do_settings_fields('ostheme_ads', 'theme_ads_01_options');
                ?>
            </table>
        </fieldset>
        <fieldset>
            <table class="form-table">
                <?php
                settings_fields('ads_options_group');
                do_settings_fields('ostheme_ads', 'theme_ads_02_options');
                ?>
            </table>
        </fieldset>
        <?php
        submit_button(
            'Salvar', // Text
            // Type
            // Name
            // Wrap
            // Other attributes
        ); ?>
    </form>
<?php
}
add_action('admin_init', 'theme_settings_ads');
