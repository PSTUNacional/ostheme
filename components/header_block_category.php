<?php
?>
<section>
    <div class="container">
        <div class="header-block-04">
            <div class="col col-50">
                <article class="destak">
                    <?php $post = $posts->posts[0]; ?>
                    <?= os_render_thumbnail($post, 'large') ?>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                    <p><?= get_the_excerpt($post->ID); ?></p>
                </article>
            </div>
            <div class="divider"></div>
            <div class="col col-50 middle">
                <?php $post = $posts->posts[1];
                if($post !== null){ ?>
                <article>
                    <?= os_render_thumbnail($post) ?>
                    <div class="post-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                        <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                            <h2><?= $post->post_title; ?></h2>
                        </a>
                        <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                    </div>
                </article>
                <?php 
                }
                $post = $posts->posts[2];
                if($post !== null){ ?>
                <article>
                    <?= os_render_thumbnail($post) ?>
                    <div class="post-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                        <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                            <h2><?= $post->post_title; ?></h2>
                        </a>
                        <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                    </div>
                </article>
                <?php
                }
                $post = $posts->posts[3];
                if($post !== null){ ?>
                <article>
                    <?= os_render_thumbnail($post) ?>
                    <div class="post-info">
                        <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                        <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                            <h2><?= $post->post_title; ?></h2>
                        </a>
                        <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                    </div>
                </article>
                <?php } ?>
            </div>
        </div>
    </div>
</section>