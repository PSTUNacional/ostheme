<?php

?>
<section>
    <div class="container">
        <div class="header-block-03">
            <article class="main-article">
                <?php $post = $posts->posts[0];?>
                <div class="article-info">
                    <h5 class="badge primary"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                        <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                            <h2><?= $post->post_title; ?></h2>
                        </a>
                        <p><?= get_the_excerpt($post->ID); ?></p>
                        </a>
                </div>
                <a class="featured-image-container" href="<?= get_permalink($post->ID); ?>" aria-label="<?= $post->post_title; ?>">
                    <div class="featured-image" style="background-image: url('<?= get_the_post_thumbnail_url($post->ID); ?>');"></div>
                </a>
            </article>
            <div class="articles-list">
                <?php for ($i = 1; $i < 5; $i++) { ?>
                    <article>
                        <?php $post = $posts->posts[$i];?>
                        <a class="featured-image-container" href="<?= get_permalink($post->ID); ?>" aria-label="<?= $post->post_title; ?>">
                            <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID); ?>')"></div>
                        </a>
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                        <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                            <h2><?= $post->post_title; ?></h2>
                        </a>
                    </article>
                <?php }   ?>
            </div>
        </div>

    </div>
</section>