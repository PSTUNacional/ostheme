<?php

include get_template_directory() . '/autoloader.php';

use OS\Repository\EvaluationRepository;

/***
 * 
 * Load JS and CSS
 * 
 */
function load_scripts()
{
    // CSSs
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');

    // JS Scripts
    wp_enqueue_script('functions', get_template_directory_uri() . '/assets/js/functions.js', array(), '1.0', true);
    wp_enqueue_script('cookies', get_template_directory_uri() . '/assets/js/cookies.js', array(), '1.0', true);
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
    add_theme_support('custom-header', $args);

    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'ostheme_config', 0);

include get_template_directory() . '/utils/ostheme-panel/functions.php';


/*==============================

    Add METABOXES
    Tagline

==============================*/

function tagline_metabox()
{
    add_meta_box(
        'post_tagline',
        'Linha fina',
        'tagline_metabox_callback',
        'post',
        'normal',
        'high'
    );
}

function tagline_metabox_callback($post)
{
    $value = get_post_meta($post->ID, 'post_tagline', true); ?>
    <p>A linha fina é o resumo que aparece logo abaixo do título e funciona como uma síntese da matéria. Esse valor será exibido também na página inicial como chamada. Não havendo esse valor, o site usará o começo do texto (menos recomendável).</p>
    <textarea class="panel" id="post_tagline" name="post_tagline"><?= $value; ?></textarea>
<?php

}

add_action('add_meta_boxes', 'tagline_metabox');


function tagline_metabox_saver($postId)
{
    if (array_key_exists('post_tagline', $_POST)) {
        update_post_meta(
            $postId,
            'post_tagline',
            $_POST['post_tagline']
        );
    }
}

add_action('save_post', 'tagline_metabox_saver');

function get_the_rate($id)
{

    $evaluation = new EvaluationRepository;
    $result = $evaluation->getRateById($id);
    return ($result);
}

function formatDate($str)
{
    $months = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];
    $date = strtotime($str);
    $d = date('d', $date);
    $m = date('n', $date);
    $m = $months[$m - 1];
    $y = date('Y', $date);

    $result = $d . " de " . $m . " de " . $y;
    return $result;
}

add_action('init', 'edition_rewrite_rule');

function edition_rewrite_rule()
{
    add_rewrite_rule(
        'edicao/([0-9]+)[/]?$', 
        'edicao/?edicao=$1',
        'top'
    );
}

add_filter('query_vars', 'edition_query_vars');

function edition_query_vars( $query_vars )
{
    $query_vars[] = 'edicao';
    return $query_vars;
}

add_action( 'template_include' , function($template){
    if(get_query_var('edicao') == false || get_query_var('edicao') == ''){
        return $template;
    }
    return get_template_directory() . '/os-edition.php';
} );