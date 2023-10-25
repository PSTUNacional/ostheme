<?php

/*
Template Name: Author page
*/

get_header();
$profile = get_avatar_url(get_the_author_meta('ID'));

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
                        echo '<p>, ' . get_the_author_meta('description') . '</p>';
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
            ?>
                    <article class="article-01">
                        <?= os_render_thumbnail(get_the_id()); ?>
                        <div class="post-info">
                            <a href="<?= the_permalink(); ?>" title="<?= the_title() ?>">
                                <h2><?= the_title() ?></h2>
                            </a>
                            <p><?= formatDate($posts[$i]->post_date) ?></p>
                        </div>
                    </article>
            <?php
                }
            } ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>