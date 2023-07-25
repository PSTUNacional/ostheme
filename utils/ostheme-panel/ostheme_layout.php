<?php

$options = [
    'headerblock_layout',
    'mainvideo_active',
    'mainvideo_url',
    'mainvideo_title',
    'mainvideo_description',
    'section01_layout',
    'section01_category',
    'section02_layout',
    'section02_category',
    'section03_layout',
    'section03_category',
    'section04_layout',
    'section04_category',
    'section05_layout',
    'section05_category',
    'section06_layout',
    'section06_category',
    'section07_layout',
    'section07_category',
    'section08_layout',
    'section08_category',
    'section09_layout',
    'section09_category',
    'section10_layout',
    'section10_category',

];

function render_blocks($value)
{
    $global_blocks = [
        [
            'name' => 'Fixos',
            'options' => [
                ['os_last-edition', 'OS Última edição'],
                ['opinion_block_01', 'Opinião']
            ]
        ],
        [
            'name' => 'Por Editoria',
            'options' => [
                ['block_01', 'Bloco 01'],
                ['block_02', 'Bloco 02'],
                ['block_03', 'Bloco 03'],
                ['block_04', 'Bloco 04'],
                ['block_05', 'Bloco 05'],
                ['block_06', 'Bloco 06']
            ]
        ],
    ];

    foreach ($global_blocks as $optgroup) {
        echo '<optgroup label=' . $optgroup['name'] . '>';
        foreach ($optgroup['options'] as $opt) {
            $value == $opt[0] ? $selected = 'selected' : $selected = '';
            echo '<option value="' . $opt[0] . '" ' . $selected . '>' . $opt[1] . '</option>';
        }
    }
}

$categories = get_categories();

function render_categories_dropdown(string $input_name, $value)
{

    global $categories;

    echo '<select name=' . $input_name . '>';
    foreach ($categories as $cat) {
        intval($value) == $cat->term_id ? $selected = 'selected' : $selected = '';
        echo '<option value=' . strval($cat->term_id) . ' ' . $selected . '>' . $cat->name . '</option>';
    }
    echo '</select>';
}

/*========================================

    SETTING REGISTER
    Header block layout

========================================*/

function theme_settings_layout()
{

    /***
     * 
     *  REGISTER SECTION
     * 
     */

    add_settings_section(
        'ostheme_homepage_layout', // ID
        'Definições globais de layout', // Title
        false, // Callback
        'ostheme' // Page
    );

    $options = $GLOBALS['options'];

    /***
     * 
     *  LOOP
     * 
     */

    foreach ($options as $opt) {

        $opt_name = 'ostheme_' . $opt;
        $opt_callback = $opt . '_callback';

        register_setting(
            'ostheme_homepage_layout',
            $opt_name, // Option Name
            $opt . '_sanitize' // Sanitize Callback
        );

        add_settings_field(
            $opt_name, // ID
            false, // Title
            $opt_callback, // Callback
            'ostheme', // Page
            'ostheme_homepage_layout' // Section
            // Args 
        );
    }
}


function headerblock_layout_callback()
{
?>
    <fieldset>
        <div class="header">
            <div class="title">
                <h3>Layout das manchetes</h3>
            </div>
            <p>Escolha o formato em que as manchetes principais serão exibidas no começo da página.</p>
        </div>
        <div class="block_layout_selector">
            <?php
            $value = get_option('ostheme_headerblock_layout');
            for ($i = 1; $i <= 3; $i++) {
                $checked = '';
                if ($value == 'header_block_0' . $i) {
                    $checked = 'checked';
                }

                $img = 'http://localhost:8080/wp-content/themes/ostheme/assets/img/panel/headerblock_layout_0' . $i . '.gif")';

                echo '<label for="headerblock_layout_version' . $i . '" style="background-image: url(' . $img . ')"><input type="radio" id="headerblock_layout_version' . $i . '" name="ostheme_headerblock_layout" value="header_block_0' . $i . '" ' . $checked . '/><span ></span></label>';
            }
            ?>
        </div>
    </fieldset>
<?php
}

add_action('admin_init', 'theme_settings_layout');

/*========================================

    SETTING REGISTER
    Header video

========================================*/

function mainvideo_active_callback()
{
    get_option('ostheme_mainvideo_active') == 'on' ? $active = 'checked' : $active = '';
?>
    <fieldset>
        <div class="header">
            <div class="title">
                <h3>Vídeo em destaque</h3>
            </div>
            <p>O video em destaque aparece antes das manchetes principais, no início da página.</p>
        </div>
        <div class="field-line">
            <div class="info">
                <p><b>Ativar vídeo em destaque</b></p>
            </div>
            <label class="switcher">
                <input type="checkbox" name="ostheme_mainvideo_active" <?= $active ?> />
                <span>
                    <span class="pin"></span>
            </label>
        </div>
    <?php
}

function mainvideo_url_callback()
{
    $value = get_option('ostheme_mainvideo_url');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Endereço do vídeo</b></p>
            </div>
            <input type="text" name="ostheme_mainvideo_url" value="<?= $value ?>" placeholder='Digite uma URL'>
        </div>
    <?php
}

function mainvideo_title_callback()
{
    $value = get_option('ostheme_mainvideo_title');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Título do vídeo</b></p>
            </div>
            <input type="text" name="ostheme_mainvideo_title" value="<?= $value ?>" placeholder='Digite um título'>
        </div>
    <?php
}

function mainvideo_description_callback()
{
    $value = get_option('ostheme_mainvideo_description');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Descrição do vídeo</b></p>
            </div>
            <textarea name="ostheme_mainvideo_description" rows="4" placeholder='Digite uma descrição'><?= $value ?></textarea>
        </div>
    </fieldset>
<?php
}

/* ==============================

    Sectiont 01

============================== */

function section01_layout_callback()
{
    $value = get_option('ostheme_section01_layout');
?>
    <fieldset id="sections">
        <div class="header">
            <div class="title">
                <h3>Blocos de conteúdo</h3>
            </div>
            <p>Escolha o formato do bloco e a editoria que será exibida no bloco.</p>
        </div>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 01</b></p>
            </div>
            <div>
                <select name="ostheme_section01_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section01_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section01_category',
                get_option('ostheme_section01_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 02

============================== */

        function section02_layout_callback()
        {
            $value = get_option('ostheme_section02_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 02</b></p>
            </div>
            <div>
                <select name="ostheme_section02_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section02_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section02_category',
                get_option('ostheme_section02_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 03

============================== */

        function section03_layout_callback()
        {
            $value = get_option('ostheme_section03_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 03</b></p>
            </div>
            <div>
                <select name="ostheme_section03_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section03_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section03_category',
                get_option('ostheme_section03_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 04

============================== */

        function section04_layout_callback()
        {
            $value = get_option('ostheme_section04_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 04</b></p>
            </div>
            <div>
                <select name="ostheme_section04_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section04_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section04_category',
                get_option('ostheme_section04_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 05

============================== */

        function section05_layout_callback()
        {
            $value = get_option('ostheme_section05_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 05</b></p>
            </div>
            <div>
                <select name="ostheme_section05_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section05_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section05_category',
                get_option('ostheme_section05_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 06

============================== */

        function section06_layout_callback()
        {
            $value = get_option('ostheme_section06_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 06</b></p>
            </div>
            <div>
                <select name="ostheme_section06_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section06_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section06_category',
                get_option('ostheme_section06_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 07

============================== */

        function section07_layout_callback()
        {
            $value = get_option('ostheme_section07_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 07</b></p>
            </div>
            <div>
                <select name="ostheme_section07_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section07_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section07_category',
                get_option('ostheme_section07_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 08

============================== */

        function section08_layout_callback()
        {
            $value = get_option('ostheme_section08_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 08</b></p>
            </div>
            <div>
                <select name="ostheme_section08_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section08_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section08_category',
                get_option('ostheme_section08_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 09

============================== */

        function section09_layout_callback()
        {
            $value = get_option('ostheme_section09_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 09</b></p>
            </div>
            <div>
                <select name="ostheme_section09_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section09_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section09_category',
                get_option('ostheme_section09_category')
            );
            ?>
            </div>
        </div>
    <?php
        }

        /* ==============================

    Sectiont 10

============================== */

        function section10_layout_callback()
        {
            $value = get_option('ostheme_section10_layout');
    ?>
        <div class="field-line">
            <div class="info">
                <p><b>Seção 10</b></p>
            </div>
            <div>
                <select name="ostheme_section10_layout" class="layout_selector">
                    <?php render_blocks($value); ?>
                </select>
            <?php
        }

        function section10_category_callback()
        {
            render_categories_dropdown(
                'ostheme_section10_category',
                get_option('ostheme_section10_category')
            );
            ?>
            </div>
        </div>
    <?php
        }


        /*========================================

    PAGE RENDER

========================================*/

        function render_theme_admin()
        {
            $options = $GLOBALS['options'];
    ?>
        <link rel="stylesheet" href="./style.css">
        <h1>Configurações de Anúncios</h1>
        <?php settings_errors(); // Exibe alertas na página 
        ?>
        <form action="options.php" method="POST" class="card">
            <?php

            settings_fields('ostheme_homepage_layout');


            do_settings_fields('ostheme', 'ostheme_homepage_layout');

            submit_button(
                'Salvar', // Text
                // Type
                // Name
                // Wrap
                // Other attributes
            );
            ?>
        </form>

        <script>
            document.querySelectorAll("#sections .layout_selector")
                .forEach(select => {
                    select.addEventListener('change', () => {
                        if (event.target.value == 'os_last-edition' || event.target.value == 'opinion_block_01') {
                            event.target.nextElementSibling.disabled = true
                        } else {
                            event.target.nextElementSibling.disabled = false
                        }
                    })
                })

            window.onload = () => {
                document.querySelectorAll('optgroup[label="Fixos"] option:checked')
                    .forEach(opt => {
                        opt.parentElement.parentElement.nextElementSibling.disabled = true
                    })
            }
        </script>
    <?php
        }
