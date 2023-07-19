<section>
    <div class="container">
        <div class="block-01">
            <?php foreach ($posts as $post) { ?>
                <article>
                    <div class="featured-image-container">
                        <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID); ?>')"></div>
                    </div>
                    <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></h5>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <p><?= $post->post_excerpt; ?></p>
                </article>
            <?php }   ?>
        </div>
    </div>
</section>