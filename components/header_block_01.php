<?php
?>
<section>
    <div class="container">
        <div class="header-block-01">
            <div class="col col-50">
                <article class="destak">
                    <a class="featured-image-container" href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>" aria-label="<?= $posts[0]->post_title; ?>">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[0]->ID); ?>','medium')"></div>
                    </a>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></span>
                    <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>" aria-label="<?= $posts[0]->post_title; ?>">
                        <h2><?= $posts[0]->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $posts[0]->post_author); ?></span>
                    <p><?= get_the_excerpt($posts[0]->ID); ?></p>
                </article>
            </div>
            <div class="divider"></div>
            <div class="col col-25 middle">
                <article>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[1]->ID)[0]); ?></span>
                    <a href="<?= get_permalink($posts[1]->ID); ?>" title="<?= $posts[1]->post_title; ?>" aria-label="<?= $posts[1]->post_title; ?>">
                        <h2><?= $posts[1]->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $posts[1]->post_author); ?></span>
                </article>
                <article>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[2]->ID)[0]); ?></span>
                    <a href="<?= get_permalink($posts[2]->ID); ?>" title="<?= $posts[2]->post_title; ?>" aria-label="<?= $posts[2]->post_title; ?>">
                        <h2><?= $posts[2]->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $posts[2]->post_author); ?></span>
                </article>
                <article>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[3]->ID)[0]); ?></span>
                    <a href="<?= get_permalink($posts[3]->ID); ?>" title="<?= $posts[3]->post_title; ?>" aria-label="<?= $posts[3]->post_title; ?>">
                        <h2><?= $posts[3]->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $posts[3]->post_author); ?></span>
                </article>
                <article>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[4]->ID)[0]); ?></span>
                    <a href="<?= get_permalink($posts[4]->ID); ?>" title="<?= $posts[4]->post_title; ?>" aria-label="<?= $posts[4]->post_title; ?>">
                        <h2><?= $posts[4]->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $posts[4]->post_author); ?></span>
                </article>
            </div>
            <div class="divider"></div>
            <div class="col col-25">
                <?php
                $args = array('numberposts' => 1, 'category_name' => 'editorial',);
                $editorial = get_posts($args);
                ?>
                <article class="article-editorial">
                    <span class="badge primary">Editorial</span>
                    <a class="featured-image-container" href="<?= get_permalink($editorial[0]->ID); ?>" aria-label="<?= $editorial[0]->post_title; ?>">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($editorial[0]->ID); ?>')"></div>

                    </a>
                    <a href="<?= get_permalink($editorial[0]->ID); ?>" title="<?= $editorial[0]->post_title; ?>">
                        <h2><?= $editorial[0]->post_title; ?></h2>
                    </a>
                    <p><?= $editorial[0]->post_excerpt; ?></p>
                </article>
            </div>
        </div>
    </div>
</section>