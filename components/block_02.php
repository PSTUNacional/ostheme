<section>
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span><?= get_cat_name($cat) ?></span>
                <a href="<?= get_category_link($cat)?>" class="more">Ver todos</a>
            </h2>
            
            <div class="block-02">
                <article class="main-article">
                <?= os_render_thumbnail($posts[0], 'large'); ?> 
                    <div class="article-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></span>
                        <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>" aria-label="<?= $posts[0]->post_title; ?>">
                            <h2><?= $posts[0]->post_title; ?></h2>
                        </a>
                        <p><?= get_the_excerpt($posts[0]->ID); ?></p>
                        <div>
                </article>
                <div class="articles-list">
                    <?php for ($i = 1; $i < 5; $i++) { ?>
                        <article>
                            <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[$i]->ID)[0]); ?></span>
                            <a href="<?= get_permalink($posts[$i]->ID); ?>" title="<?= $posts[$i]->post_title; ?>" aria-label="<?= $posts[$i]->post_title; ?>">
                                <h2><?= $posts[$i]->post_title; ?></h2>
                            </a>
                            <p><?= $posts[$i]->post_excerpt; ?></p>
                        </article>
                    <?php }   ?>
                </div>
            </div>
        </div>
    </div>
</section>