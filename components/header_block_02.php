<?php
?>
<section class="header-block-02-section">
    <div class="header-block-02">
        <div class="container">
            <article class="destak">
                <h5 class="badge primary"><?= get_cat_name(wp_get_post_categories($posts[0]->ID)[0]); ?></h5>
                <a href="<?= get_permalink($posts[0]->ID); ?>" title="<?= $posts[0]->post_title; ?>">
                    <h2><?= $posts[0]->post_title; ?></h2>
                </a>
            </article>
        </div>
        <div class="featured-image-container">
            <div class="featured-image" style="background: linear-gradient(90deg, #000f 0%, #0000 100%),url('<?= get_the_post_thumbnail_url($posts[0]->ID); ?>'); background-position: center; background-size:cover"></div>
        </div>
    </div>
</section>