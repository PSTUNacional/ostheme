<?php

?>
<section>
    <div class="container">
        <div class="header-block-03">
            <article class="main-article">
                <div class="article-info">
                    <h5 class="badge primary"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></span>
                    <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>">
                        <h2><?= $posts[0]->post_title; ?></h2>
                    </a>
                    <p><?= get_the_excerpt($posts[0]->ID); ?></p>
                    </a>
                </div>
                <a class="featured-image-container" href="<?= get_permalink($posts[0]->ID); ?>">
                    <div class="featured-image" style="background-image: url('<?= get_the_post_thumbnail_url($posts[0]->ID); ?>');"></div>
                </a>
            </article>
            <div class="articles-list">
                <?php for ($i = 1; $i < 5; $i++) { ?>
                    <article>
                        <a class="featured-image-container" href="<?= get_permalink($posts[$i]->ID); ?>">
                            <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($posts[$i]->ID); ?>')"></div>
                        </a>
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($posts[$i]->ID)[0]); ?></span>
                        <a href="<?= get_permalink($posts[$i]->ID); ?>" title="<?= $posts[$i]->post_title; ?>">
                            <h2><?= $posts[$i]->post_title; ?></h2>
                        </a>
                    </article>
                <?php }   ?>
            </div>
        </div>

    </div>
</section>