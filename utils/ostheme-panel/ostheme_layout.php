<?php

/*========================================

    SETTING REGISTER

========================================*/

function theme_settings_layout()
{

    add_settings_section(
        'theme_headerblock_options', // ID
        'Bloco de Cabeçalho', // Title
        false, // Callback
        'ostheme' // Page
    );

    register_setting(
        'headerblock_options_group', // Option Group
        'headerblock_layout_version', // Option Name
        // Sanitize Callback
    );

    add_settings_field(
        'headerblock_layout_version', // ID
        false, // Title
        'headerblock_layout_callback', // Callback
        'ostheme', // Page
        'theme_headerblock_options' // Section
        // Args 
    );
}


function headerblock_layout_callback()
{
    echo '<fieldset>
    <div class="header">
        <h3>Layout das manchetes</h3>
        <p>Escolha o formato em que as manchetes principais serão exibidas no começo da página.</p>
    </div>
    <div class="block_layout_selector">';
    $value = get_option('headerblock_layout_version');
    for ($i = 1; $i <= 3; $i++) {
        $checked = '';
        if ($value == 'header_block_0' . $i) {
            $checked = 'checked';
        }

        $img = 'http://localhost:8080/wp-content/themes/ostheme/assets/img/panel/headerblock_layout_0'.$i.'.gif")';

        echo '<label for="headerblock_layout_version'.$i.'" style="background-image: url('.$img.')"><input type="radio" id="headerblock_layout_version'.$i.'" name="headerblock_layout_version" value="header_block_0' . $i . '" ' . $checked . '/><span ></span></label>';
    }
    echo '</div></fieldset>';
}

function render_theme_admin()
{
?>
    <link rel="stylesheet" href="./style.css">
    <h1>Configurações de Anúncios</h1>
    <?php settings_errors(); // Exibe alertas na página 
    ?>
    <h2 id="kkk" class="teste">Eitaaaa</h2>
    <form action="options.php" method="POST" class="card">
            <?php
            settings_fields('headerblock_options_group');
            do_settings_fields('ostheme', 'theme_headerblock_options');
             ?>
        <?php
            submit_button(
                'Salvar', // Text
                // Type
                // Name
                // Wrap
                // Other attributes
            );
        ?>
    </form>
<?php
}
add_action('admin_init', 'theme_settings_layout');
