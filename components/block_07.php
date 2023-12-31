<h2 class="block-header">
    <span><?= get_cat_name($cat) ?></span>
    <a href="<?= get_category_link($cat) ?>" class="more">Ver todos</a>
</h2>
<div class="block-06">
    <article class="main-article">
        <?= os_render_thumbnail($posts[0]); ?>
        <div class="article-info">
            <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></span>
            <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>" aria-label="<?= $posts[0]->post_title; ?>">
                <h2><?= $posts[0]->post_title; ?></h2>
            </a>
            <p><?= $posts[0]->post_excerpt; ?></p>
            <div>
    </article>
</div>