<?php

$args = [
	"cat" => 3793,
	'posts_per_page' => 4,
    'orderby' => 'menu_order'
];

$posts = new WP_Query($args);

?>

<section>
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span>Colunas</span>
                <a href="categoria/colunas" class="more">Ver todos</a>
            </h2>
            <div class="opinion-block-01">
                <?php if ( $posts->have_posts() ) {  
					while ( $posts->have_posts() ) {
						$posts->the_post();
						$profile = get_avatar_url( get_the_author_meta('ID'));
                    ?>
                    <article>
                        <div class="author-box">
                            <div class="author-avatar" style="background-image:url('<?=$profile?>')">
                            <?php
                                if(!$profile){ ?>
                                    <i class="fa fa-user"></i>
                                <?php } ?>
                            </div>
                            <span class="author-line"><a href="coluna/<?=the_author_meta('user_nicename')?>"><?= the_author_meta('display_name'); ?></a></span>
                        </div>
                        <a href="<?= the_permalink() ?>" title="<?= the_title() ?>">
                            <h2><?= the_title(); ?></h2>
                        </a>
                    </article>
                <?php  } }   ?>
            </div>
        </div> 
    </div>
</section>