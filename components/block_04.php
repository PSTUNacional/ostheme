<section>
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span><?= get_cat_name($cat) ?></span>
                <a href="<?= get_category_link($cat) ?>" class="more">Ver todos</a>
            </h2>
            <div class="block-04">
                <article>
                    <?= os_render_thumbnail($posts[0]); ?>
                    <div class="article-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></span>
                        <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>">
                            <h2><?= $posts[0]->post_title; ?></h2>
                        </a>
                        <p><?= $posts[0]->post_excerpt; ?></p>
                        <div>
                </article>
                <article>
                    <?= os_render_thumbnail($posts[1]); ?>
                    <div class="article-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[1]->ID)[0]); ?></span>
                        <a href="<?= get_permalink($posts[1]->ID); ?>" title="<?= $posts[1]->post_title; ?>">
                            <h2><?= $posts[1]->post_title; ?></h2>
                        </a>
                        <p><?= $posts[1]->post_excerpt; ?></p>
                        <div>
                </article>
            </div>
        </div>
    </div>
</section>