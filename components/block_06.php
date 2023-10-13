<h2 class="block-header">
    <span><?= get_cat_name($cat) ?></span>
    <a href="<?= get_category_link($cat)?>" class="more">Ver todos</a>
</h2>
<div class="block-06">
    <article class="main-article">
        <a class="featured-image-container" href="<?= get_permalink($posts[0]->ID); ?>">
            <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[0]->ID); ?>')"></div>
        </a>
        <div class="article-info">
            <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></h5>
            <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>">
                <h2><?= $posts[0]->post_title; ?></h2>
            </a>
            <p><?= $posts[0]->post_excerpt; ?></p>
            <div>
    </article>
    <div class="articles-column">
        <?php for ($i = 1; $i < 3; $i++) { ?>
            <article>
                <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[$i]->ID)[0]); ?></h5>
                <a href="<?= get_permalink($posts[$i]->ID); ?>" title="<?= $posts[$i]->post_title; ?>">
                    <h2><?= $posts[$i]->post_title; ?></h2>
                </a>
            </article>
        <?php }   ?>
    </div>
</div>