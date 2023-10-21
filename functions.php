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

function edition_query_vars($query_vars)
{
    $query_vars[] = 'edicao';
    return $query_vars;
}

add_action('template_include', function ($template) {
    if (get_query_var('edicao') == false || get_query_var('edicao') == '') {
        return $template;
    }
    return get_template_directory() . '/os-edition.php';
});

/*==============================

    API Modifyers

==============================*/


add_action('rest_api_init', 'register_rest_images' );

function register_rest_images()
{
    register_rest_field( array('post', 'search-result'),
        'fimg_url',
        array(
            'get_callback'    => 'get_rest_featured_image',
            'update_callback' => null,
            'schema'          => null,
        ));
}

function get_rest_featured_image( $object, $field_name, $request )
{

    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    } else {
        $img = get_the_post_thumbnail_url($object['id']);
        return $img;
    }
    return false;

}

add_action('rest_api_init', 'register_categories_names' );

function register_categories_names()
{
    register_rest_field( array('post', 'search-result'),
        'categories_names',
        array(
            'get_callback'    => 'get_categories_names',
            'update_callback' => null,
            'schema'          => null,
        ));
}

function get_categories_names( $object, $field_name, $request )
{
    $names = [];
    $cats = wp_get_post_categories($object['id']);
    foreach($cats as $cat)
    {
        $name = get_cat_name($cat);
        array_push($names, $name);
    }
    return $names;
}

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

/*==============================

    HELPERS

==============================*/

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

function escape_categories($cats)
{
    if (sizeof($cats) == 0) {
        $cat = 'Sem categoria';
    } else {
        $cat = get_cat_name($cats[0]);
        if ($cat == 'Opinião Socialista' && sizeof($cats) > 1) {
            $cat = get_cat_name($cats[1]);
        } elseif ($cat == 'Opinião Socialista' && sizeof($cats) <= 1) {
            $cat = 'Especial';
        }
    }
    return $cat;
}

function os_render_thumbnail($post, $size = "medium")
{
    $cats = wp_get_post_categories($post->ID);
    $link =  get_permalink($post->ID);
    $thumbURL = get_the_post_thumbnail_url($post->ID, $size);

    $tb = '<a class="featured-image-container" href="'. $link .'" title="'.$post->post_title.'" aria-label="'.$post->post_title.'"><div class="featured-image" style="background-image:url(\''. $thumbURL . '\')"></div></a>';

    foreach ($cats as $cat)
    {
        $name = get_cat_name($cat);
       
        if($name == 'Colunas')
        {
            $tb = '<a class="featured-image-container" href="'. $link .'" title="'.$post->post_title.'" aria-label="'.$post->post_title.'"><div class="opinion-ribbon">Opinião</div><div class="featured-image" style="background-image:url(\''. $thumbURL . '\')"></div></a>';
        }
    }

    return $tb;
}