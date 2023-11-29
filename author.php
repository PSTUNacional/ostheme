<?php

/*
Template Name: Author page
*/

get_header();
$author_id = get_the_author_meta('ID');
$profile = get_avatar_url($author_id);

?>
<div class="content-area">
    <main>
        <div class="container">
            <div class="author-title">
                <div class="author-avatar" style="background-image:url('<?= $profile ?>')">
                    <?php
                    if (!$profile) { ?>
                        <i class="fa fa-user"></i>
                    <?php } ?>
                </div>
                <div class="info">
                    <span class="badge">Coluna de</span>
                    <h1><?= the_author_meta('display_name'); ?></h1>
                    <?php
                    if (get_the_author_meta('description') !== '') {
                        echo '<p>' . get_the_author_meta('description') . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        // ========== Ad Block ========== //
        if (get_option('theme_ads_01_options_active') == 'on') {
        ?>
            <section class=" ads">
                <a href="<?= get_option('theme_ads_01_options_link') ?>" class="container">
                    <div class="ad-horizontal-large" style="background-image:url('<?= get_option('theme_ads_01_options_background') ?>')">
                        <h3><?= get_option('theme_ads_01_options_title') ?></h3>
                    </div>
                </a>
            </section>
        <?php } ?>

        <?php
        // ========== Ad Block ========== //
        if (get_option('theme_ads_02_options_active') == 'on') {
        ?>
            <section class="ads">
                <a href="<?= get_option('theme_ads_02_options_link') ?>" class="container">
                    <div class="ad-horizontal-large" style="background-image:url('<?= get_option('theme_ads_02_options_background') ?>')">
                        <h3><?= get_option('theme_ads_02_options_title') ?></h3>
                    </div>
                </a>
            </section>
        <?php } ?>
        <div class="container">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
					$cats = wp_get_post_categories(get_the_id());
					foreach($cats as $cat){
						if($cat == 3793){
						
            ?>
                    <article class="article-01">
                        <?= os_render_thumbnail(get_the_id()); ?>
                        <div class="post-info">
                            <a href="<?= the_permalink(); ?>" title="<?= the_title() ?>">
                                <h2><?= the_title() ?></h2>
                            </a>
                            <p><?= the_date() ?></p>
                        </div>
                    </article>
            <?php
					}}
                }
            } else {
                echo '<h3>Ops... não há nada por aqui ainda. =/';
            } ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>