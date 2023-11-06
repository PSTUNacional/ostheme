<?php

/*
Template Name: Category Page
*/

$cat = get_queried_object();
$cat = $cat->term_id;

get_header(); ?>
<style>
    .columns{
        display:flex;
        flex-direction: row;
        gap:var(--gap);
        max-width:var(--max-width);
        margin: auto;
    }
    .author-col{
        display: flex;
        flex-direction: column;
        gap:calc(var(--gap)/2);
        min-width: 256px;
    }
    .author-col h3{
        padding-bottom: 12px;
        border-bottom: 1px solid var(--grey-400);
        width: 100%;
        margin-bottom: var(--gap);
    }
</style>
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
        global $wpdb;
        $authors = $wpdb->get_results(
            "SELECT DISTINCT post_author,
            COUNT(id) as total
            FROM {$wpdb->prefix}posts
            LEFT JOIN {$wpdb->prefix}term_relationships
            ON {$wpdb->prefix}posts.id = {$wpdb->prefix}term_relationships.object_id
            WHERE {$wpdb->prefix}posts.post_type = 'post'
            AND {$wpdb->prefix}term_relationships.term_taxonomy_id = 3793
            GROUP BY {$wpdb->prefix}posts.post_author",
            ARRAY_A
        );
        ?>
        <div class="columns">
            <div class="container">
                <?php
                if (sizeof($posts->posts) > 4) {
                    for ($i = 0; $i < 19; $i++) {
                        $post = $posts->posts[$i];
                        if ($post->post_title) {
                            $profile = get_avatar_url($post->post_author);

                ?>
                            <article class="opinion-article-01">
                                <div class="author-avatar" style="background-image:url('<?= $profile ?>')"></div>
                                <div class="post-info">
                                    <span class="sup-category"><a href="/coluna/<?= the_author_meta('user_nicename', $post->post_author) ?>"><?= the_author_meta('display_name', $post->post_author); ?></a></span>
                                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                                        <h2><?= $post->post_title; ?></h2>
                                    </a>
                                    <p><?= formatDate($post->post_date) ?></p>
                                </div>
                            </article>
                <?php }
                    }
                } ?>
            </div>
            <div class="author-col">
                <h3>Colunistas</h3>
                <?php
                foreach ($authors as $author) {
                ?>
                    <a href="/coluna/<?= the_author_meta('user_nicename', $author['post_author']) ?>">
                        <?= the_author_meta('display_name', $author['post_author']) ?> (<?= $author['total'] ?>)</a>
                <?php
                }

                ?>
            </div>
        </div>
    </main>
</div>
<?php get_footer(); ?>