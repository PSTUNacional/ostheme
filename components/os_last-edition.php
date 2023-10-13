<section id="lastOS">

    <?php
    $args = array(
        'numberposts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'name',
                'terms'    => 'oscapa')
            ),
        );
    $posts = get_posts($args);
    $edition = (int)filter_var($posts[0]->post_title, FILTER_SANITIZE_NUMBER_INT);
    ?>
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span>Última edição | Nº<?= $edition; ?></span>
            </h2>
            <div class="content">
                <div class="oscover">
                    <img src="<?= '/archive/cover/webp/os'.$edition.'.webp'?>" />
                </div>
                <div class="edition-info">
                    <h3>Destaques</h3>
                    <div class="main-articles">
                        <?php
                        $args = array(
                            'numberposts' => 16,
                            'tag__not_in' => array(5),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'name',
                                    'terms'    => "OS" . $edition,
                                )
                            )
                        );
                        $posts = get_posts($args);
                        foreach ($posts as $post) {

                            $tags = get_the_tags($post);
                            foreach ($tags as $tag) {
                                if ($tag->slug == 'editorial' || $tag->slug == 'centrais') { ?>

                                    <article>
                                        <div class="featured-image-container">
                                            <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID); ?>')"></div>
                                        </div>
                                        <div class="article-info">
                                            <h5 class="sup-category"><?= ucfirst($tag->slug) ?></h5>
                                            <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                                                <h2><?= $post->post_title; ?></h2>
                                            </a>
                                        </div>
                                    </article>

                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <h3>Também nessa edição</h3>
                    <div class="article-list">
                        <?php
                        foreach ($posts as $post) {
                            $publish = true;
                            $tags = get_the_tags($post);

                            foreach ($tags as $tag) {
                                if ($tag->slug == 'editorial' || $tag->slug == 'centrais' || $tag->slug == 'oscapa') {
                                    $publish = false;
                                }
                            }
                            if ($publish == true) { ?>

                                <article>
                                    <div class="article-info">
                                        <h5 class="sup-category"><?= get_cat_name(wp_get_post_categories($post->ID)[0]); ?></h5>
                                        <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                                            <h2><?= $post->post_title; ?></h2>
                                        </a>
                                    </div>
                                </article>

                        <?php
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cta">
        <div class="container">
            <h3>Leia a edição completa no nosso leitor.</h3>
            <a href="">Leia aqui</a>
        </div>
    </div>
</section>