<?php
?>
<section>
    <div class="container">
        <div class="header-block-04">
            <div class="col col-50">
                <article class="destak">
                    <a class="featured-image-container" href="<?= get_permalink($posts[0]->ID); ?>">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[0]->ID); ?>')"></div>
                    </a>
                    <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></h5>
                    <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>">
                        <h2><?= $posts[0]->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $posts[0]->post_author); ?></span>
                    <p><?= get_the_excerpt($posts[0]->ID); ?></p>
                </article>
            </div>
            <div class="divider"></div>
            <div class="col col-50 middle">
                <article>
                    <a class="featured-image-container" href="<?= get_permalink($posts[1]->ID); ?>">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[1]->ID); ?>')"></div>
                    </a>
                    <div class="post-info">
                        <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[1]->ID)[0]); ?></h5>
                        <a href="<?= get_permalink($posts[1]->ID); ?>" title="<?= $posts[1]->post_title; ?>">
                            <h2><?= $posts[1]->post_title; ?></h2>
                        </a>
                        <span class="author-line">Por <?= the_author_meta('display_name', $posts[1]->post_author); ?></span>
                    </div>
                </article>
                <article>
                    <a class="featured-image-container" href="<?= get_permalink($posts[2]->ID); ?>">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[2]->ID); ?>')"></div>
                    </a>
                    <div class="post-info">
                        <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[2]->ID)[0]); ?></h5>
                        <a href="<?= get_permalink($posts[2]->ID); ?>" title="<?= $posts[2]->post_title; ?>">
                            <h2><?= $posts[2]->post_title; ?></h2>
                        </a>
                        <span class="author-line">Por <?= the_author_meta('display_name', $posts[2]->post_author); ?></span>
                    </div>
                </article>
                <article>
                    <a class="featured-image-container" href="<?= get_permalink($posts[3]->ID); ?>">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[3]->ID); ?>')"></div>
                    </a>
                    <div class="post-info">
                        <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[3]->ID)[0]); ?></h5>
                        <a href="<?= get_permalink($posts[3]->ID); ?>" title="<?= $posts[3]->post_title; ?>">
                            <h2><?= $posts[3]->post_title; ?></h2>
                        </a>
                        <span class="author-line">Por <?= the_author_meta('display_name', $posts[3]->post_author); ?></span>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>