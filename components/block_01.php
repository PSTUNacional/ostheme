<section>
    <div class="container">
        <div class="block-01">
            <?php foreach ($posts as $post) { ?>
                <article>
                    <?= os_render_thumbnail($post); ?> 
                    <h5 class="sup-category"><?= escape_categories(wp_get_post_categories($post->ID)); ?></h5>
                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                        <h2><?= $post->post_title; ?></h2>
                    </a>
                    <p><?= $post->post_excerpt; ?></p>
                </article>
            <?php }   ?>
        </div>
    </div>
</section>