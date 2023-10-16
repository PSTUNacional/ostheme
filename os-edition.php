<?php

/*
Template Name: OS Edition
*/

get_header(); ?>
<div class="content-area">
    <main>
        <?php
        if (get_query_var('edicao')) {
            $ed = get_query_var('edicao');
        ?>
            <div class="edition-header">
                <div class="container">
                    <div class="image-container" href="/edicao/<?= $ed ?>">
                        <div class="cover" style="background-image: url('/archive/cover/webp/os<?= $ed ?>.webp')"></div>
                    </div>
                    <div class="info">
                        <h1>Opinião Socialista Nº<?= $ed ?></h1>
                        <a class="btn secondary" target="_blank" href="/archive/pdf/os<?= $ed ?>.pdf"><i class="fa fa-file-pdf"></i> Baixar em PDF</a>
                    </div>
                </div>
            </div>
            <div class="os-edition">
                <div class="container">
                    <h3 class="block-header">
                        <span>Destaques</span>
                    </h3>
                    <div class="main-articles">
                        <?php
                        $args = array(
                            'numberposts' => 1,
                            'category_name' => 'editorial',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'name',
                                    'terms'    => "OS" . $ed,
                                )
                            )
                        );

                        $editorial = get_posts($args)[0];
                        ?>
                        <article>
                            <a class="featured-image-container" href="<?= get_permalink(); ?>">
                                <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($editorial->ID); ?>')"></div>
                            </a>
                            <div class="article-info">
                                <h5 class="sup-category">Editorial</h5>
                                <a href="<?= get_permalink($editorial->ID); ?>" title="<?= $editorial->post_title; ?>">
                                    <h2><?= $editorial->post_title; ?></h2>
                                </a>
                            </div>
                        </article>
                        <?php
                        $args = array(
                            'numberposts' => 1,
                            'tax_query' => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'name',
                                    'terms'    => "OS" . $ed
                                ),
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'name',
                                    'terms'    => 'centrais'
                                ),
                            )
                        );
                        $posts = get_posts($args);
                        foreach ($posts as $post) { ?>
                            <article>
                                <a class="featured-image-container" href="<?= get_permalink(); ?>">
                                    <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID); ?>')"></div>
                                </a>
                                <div class="article-info">
                                    <h5 class="sup-category">Centrais</h5>
                                    <a href="<?= get_permalink($post->ID); ?>" title="<?= $post->post_title; ?>">
                                        <h2><?= $post->post_title; ?></h2>
                                    </a>
                                </div>
                            </article>
                        <?php
                        }
                        ?>
                    </div>
                    <h3 class="block-header">
                        <span>Também nesta edição</span>
                    </h3>
                    <div class="article-list">
                        <?php
                        $args = array(
                            'numberposts' => 20,
                            'tag__not_in' => array(5),
                            'tax_query' => array(
                                'relation' => 'AND',
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'name',
                                    'terms'    => "OS" . $ed
                                ),
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'name',
                                    'terms'    => "centrais",
                                    'operator'  => 'NOT IN'
                                ),
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'name',
                                    'terms'    => "editorial",
                                    'operator'  => 'NOT IN'
                                ),
                                array(
                                    'taxonomy' => 'post_tag',
                                    'field'    => 'name',
                                    'terms'    => "oscapa",
                                    'operator'  => 'NOT IN'
                                ),
                            )
                        );
                        $posts = get_posts($args);
                        foreach ($posts as $post) {
                        ?>
                            <article class="article-01">
                                <a class="featured-image-container" href="<?= get_permalink($post->ID); ?>">
                                    <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID); ?>')"></div>
                                </a>
                                <div class="post-info">
                                    <h5 class="sup-category">
                                        <?php
                                        $cat = get_cat_name(wp_get_post_categories($post->ID)[0]);
                                        if ($cat == 'Opinião Socialista') {
                                            $cat = get_cat_name(wp_get_post_categories($post->ID)[1]);
                                        }
                                        echo $cat;
                                        ?>
                                    </h5>
                                    <a href="<?= get_permalink($posts[$i]->ID); ?>" title="<?= $post->post_title; ?>">
                                        <h2><?= $post->post_title; ?></h2>
                                    </a>
                                    <span class="author-line">Por <?= the_author_meta('display_name', $posts[3]->post_author); ?></span>
                                </div>
                            </article>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        } else {
            echo 'não está setado';
        }
        ?>
    </main>
</div>
<?php get_footer(); ?>