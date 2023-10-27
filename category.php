<?php

/*
Template Name: Category Page
*/

$cat = get_queried_object();
$cat = $cat->term_id;

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
            'cat' => $cat,
            'posts_per_page' => 20,
        );
        $posts = new WP_Query($args);

        // ========== Header Block ========== //

        if (sizeof($posts->posts) > 0) {
            include(__DIR__ . '/components/header_block_04.php');
        } else {
            echo '<section><h3 class="ta-center">Ainda não há conteúdo aqui...</h3></section>';
        } ?>

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
            if (sizeof($posts->posts) > 4) {
                for ($i = 4; $i < 19; $i++) {
                    $post = $posts->posts[$i];
                    if ($post->post_title) {
            ?>
                        <article class="article-01">
                            <?= os_render_thumbnail($post); ?>
                            <div class="post-info">
                                <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                                <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                                    <h2><?= $post->post_title; ?></h2>
                                </a>
                                <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                                <p><?= formatDate($post->post_date) ?></p>
                            </div>
                        </article>
            <?php }
                }
            } ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>