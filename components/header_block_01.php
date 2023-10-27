<?php
$skipDestak = []; // Prepare skip list;
?>
<section>
    <div class="container">
        <div class="header-block-01">
            <div class="col col-50">
                <article class="destak">
                    <?php
                    $post = $posts->posts[0];
                    array_push($skipDestak, $post->ID);
                    ?>
                    <a class="featured-image-container" href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID, 'large'); ?>')"></div>
                    </a>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                    <p><?= get_the_excerpt($post->ID); ?></p>
                </article>
            </div>
            <div class="divider"></div>
            <div class="col col-25 middle">
                <article>
                    <?php
                    $post = $posts->posts[1];
                    array_push($skipDestak, $post->ID); ?>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                </article>
                <article>
                    <?php
                    $post = $posts->posts[2];
                    array_push($skipDestak, $post->ID);
                    ?>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                </article>
                <article>
                    <?php
                    $post = $posts->posts[3];
                    array_push($skipDestak, $post->ID);
                    ?>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                </article>
                <article>
                    <?php
                    $post = $posts->posts[4];
                    array_push($skipDestak, $post->ID);
                    ?>
                    <span class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></span>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>" aria-label="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                </article>
            </div>
            <div class="divider"></div>
            <div class="col col-25">
                <?php
                $args = array('numberposts' => 1, 'category_name' => 'editorial', 'category__not_in' => array(1093));
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