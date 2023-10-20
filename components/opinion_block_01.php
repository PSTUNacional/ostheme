<section>
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span>Colunas</span>
                <a href="categoria/colunas" class="more">Ver todos</a>
            </h2>
            <div class="opinion-block-01">
                <?php foreach ($posts as $post) {   
                    the_post(); 
                    $profile = get_avatar_url($post->post_author);
                    ?>
                    <article>
                        <div class="author-box">
                            <div class="author-avatar" style="background-image:url('<?=$profile?>')">
                            <?php
                                if(!$profile){ ?>
                                    <i class="fa fa-user"></i>
                                <?php } ?>
                            </div>
                            <span class="author-line"><?= the_author_meta('display_name', $post->post_author); ?></span>
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