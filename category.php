<?php

/*
Template Name: Category Page
*/

$cat = get_queried_object();
$cat = $cat->term_id;

function render_section($section_id)
{
    $cat = get_option('ostheme_section' . $section_id . '_category');
    $layout = get_option('ostheme_section' . $section_id . '_layout');
    $block_path = __DIR__ . '/components/' . $layout . '.php';

    $args = array(
        'numberposts' => 5,
        'category' => array($cat),
        'offset' => 0,
        'tag__not_in' => array(4)
    );

    $posts = get_posts($args);
    include($block_path);
}

get_header(); ?>
<div class="content-area">
    <main>
        <div class="container">
            <div class="category-title">
                <h1><?php single_cat_title(); ?></h1>
            </div>
        </div>
        <?php
        // ========== Ad Block ========== //
        if (get_option('theme_ads_01_options_active') == 'on') {
        ?>
            <section class=" ads">
                <a href="<?= get_option('theme_ads_01_options_link') ?>" class="container">
                    <div class="ad-horizontal-large" style="background-image:url('<?= get_option('theme_ads_01_options_background') ?>')">
                        <h3><?= get_option('theme_ads_01_options_title') ?></h3>
                    </div>
                </a>
            </section>
        <?php } ?>

        <?php
        $args = array(
            'category' => $cat,
            'numberposts' => 19,
        );
        $posts = get_posts($args);

        // ========== Header Block ========== //
        include(__DIR__ . '/components/header_block_04.php'); ?>

        <?php
        // ========== Ad Block ========== //
        if (get_option('theme_ads_02_options_active') == 'on') {
        ?>
            <section class="ads">
                <a href="<?= get_option('theme_ads_02_options_link') ?>" class="container">
                    <div class="ad-horizontal-large" style="background-image:url('<?= get_option('theme_ads_02_options_background') ?>')">
                        <h3><?= get_option('theme_ads_02_options_title') ?></h3>
                    </div>
                </a>
            </section>
        <?php } ?>
        <div class="container">
            <?php
            for ($i = 4; $i < 19; $i++) {

                if ($posts[$i]->post_title) { ?>
                    <article class="article-01">
                        <a class="featured-image-container" href="<?= get_permalink($posts[$i]->ID); ?>">
                            <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[$i]->ID); ?>')"></div>
                        </a>
                        <div class="post-info">
                            <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[$i]->ID)[0]); ?></h5>
                            <a href="<?= get_permalink($posts[$i]->ID); ?>" title="<?= $posts[$i]->post_title; ?>">
                                <h2><?= $posts[$i]->post_title; ?></h2>
                            </a>
                            <span class="author-line">Por <?= the_author_meta('display_name', $posts[3]->post_author); ?></span>
                            <p><?= formatDate($posts[$i]->post_date) ?></p>
                        </div>
                    </article>

            <?php }
            } ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>