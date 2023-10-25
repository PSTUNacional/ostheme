<?php
?>
<section>
    <div class="container">
        <div class="header-block-04">
            <div class="col col-50">
                <article class="destak">
                    <?= os_render_thumbnail($posts[0], 'large') ?>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></span>
                    <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>" aria-label="<?= $posts[0]->post_title; ?>">
                        <h2><?= $posts[0]->post_title; ?></h2>
                    </a>
                    <!--<span class="author-line">Por <?= the_author_meta('display_name', $posts[0]->post_author); ?></span>-->
                    <p><?= get_the_excerpt($posts[0]->ID); ?></p>
                </article>
            </div>
            <div class="divider"></div>
            <div class="col col-50 middle">
                <article>
                <?= os_render_thumbnail($posts[1]) ?>
                    <div class="post-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[1]->ID)[0]); ?></span>
                        <a href="<?= get_permalink($posts[1]->ID); ?>" title="<?= $posts[1]->post_title; ?>" aria-label="<?= $posts[1]->post_title; ?>">
                            <h2><?= $posts[1]->post_title; ?></h2>
                        </a>
                        <!--<span class="author-line">Por <?= the_author_meta('display_name', $posts[1]->post_author); ?></span>-->
                    </div>
                </article>
                <article>
                <?= os_render_thumbnail($posts[2]) ?>
                    <div class="post-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[2]->ID)[0]); ?></span>
                        <a href="<?= get_permalink($posts[2]->ID); ?>" title="<?= $posts[2]->post_title; ?>" aria-label="<?= $posts[2]->post_title; ?>">
                            <h2><?= $posts[2]->post_title; ?></h2>
                        </a>
                        <!--<span class="author-line">Por <?= the_author_meta('display_name', $posts[2]->post_author); ?></span>-->
                    </div>
                </article>
                <article>
                <?= os_render_thumbnail($posts[3]) ?>
                    <div class="post-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[3]->ID)[0]); ?></span>
                        <a href="<?= get_permalink($posts[3]->ID); ?>" title="<?= $posts[3]->post_title; ?>" aria-label="<?= $posts[3]->post_title; ?>">
                            <h2><?= $posts[3]->post_title; ?></h2>
                        </a>
                        <!--<span class="author-line">Por <?= the_author_meta('display_name', $posts[3]->post_author); ?></span>-->
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>