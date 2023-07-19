<section>
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span>Opinião</span>
            </h2>
            <div class="opinion-block-01">
                <?php foreach ($posts as $post) { ?>
                    <article>
                        <div class="author-box">
                            <div class="author-avatar">
                                <i class="fa fa-user"></i>
                            </div>
                            <h4 class="author-line"><?= the_author_meta('display_name', $post->post_author); ?></h4>
                        </div>
                        <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                            <h2><?= $post->post_title; ?></h2>
                        </a>
                    </article>
                <?php }   ?>
            </div>
        </div>
    </div>
</section>