<?php

/*
Template Name: Página Principal
*/

get_header(); ?>
<div class="content-area">
    <main>

        <?php
        if (get_option('theme_ads_01_options_active') == 'on') {
        ?>
            <section class="ads">
                <a href="<?= get_option('theme_ads_01_options_link') ?>" class="container">
                    <div class="ad-horizontal-large" style="background-image:url('<?= get_option('theme_ads_01_options_background') ?>')">
                        <h3><?= get_option('theme_ads_01_options_title') ?></h3>
                    </div>
                </a>
            </section>
        <?php } ?>

        <?php

        $args = array(
            'numberposts' => 5,
            'category__not_in' => array(50),
            'tag__not_in' => array(4)
        );
        $posts = get_posts($args);

        $headerblock = get_option('headerblock_layout_version');
        include(__DIR__ . '/components/' . $headerblock . '.php'); ?>

        <?php
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

        <?php
        $args = array('numberposts' => 4, 'offset' => 5, 'category__not_in' => array(50), 'tag__not_in' => array(4));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_01.php');
        ?>

        <?php
        include(__DIR__ . '/components/os_last-edition.php');
        ?>

        <?php
        $args = array('numberposts' => 5, 'category__not_in' => array(50), 'tag__not_in' => array(4));
        $posts = get_posts($args);
        include(__DIR__ . '/components/opinion_block_01.php');
        ?>

        <?php
        $cat = 23; // Internacional
        $args = array('numberposts' => 5, 'category' => array($cat), 'offset' => 0, 'tag__not_in' => array(4));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_02.php');
        ?>

        <?php
        $cat = 9; // Movimento
        $args = array('numberposts' => 5, 'category' => array($cat), 'offset' => 0, 'tag__not_in' => array(4));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_03.php');
        ?>

        <?php
        $cat = 71; // Cultura
        $args = array('numberposts' => 2, 'category' => array($cat), 'offset' => 0, 'tag__not_in' => array(4));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_04.php');
        ?>
        <section>
            <div class="container">
                <div class="col col-33">
                    <?php
                    $cat = 7; // SNN
                    $args = array('numberposts' => 3, 'category' => array($cat), 'offset' => 0, 'tag__not_in' => array(5));
                    $posts = get_posts($args);
                    include(__DIR__ . '/components/block_06.php');
                    ?>
                </div>
                <div class="divider"></div>
                <div class="col col-33">
                    <?php
                    $cat = 81; // LGBT
                    $args = array('numberposts' => 3, 'category' => array($cat), 'offset' => 0, 'tag__not_in' => array(5));
                    $posts = get_posts($args);
                    include(__DIR__ . '/components/block_06.php');
                    ?>
                </div>
                <div class="divider"></div>
                <div class="col col-33">
                    <?php
                    $cat = 48; // Mulheres
                    $args = array('numberposts' => 3, 'category' => array($cat), 'offset' => 0, 'tag__not_in' => array(5));
                    $posts = get_posts($args);
                    include(__DIR__ . '/components/block_06.php');
                    ?>
                </div>
            </div>
        </section>

        <?php
        $cat = 10; // Debates
        $args = array('numberposts' => 5, 'category' => array($cat), 'offset' => 0, 'tag__not_in' => array(4));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_02.php');
        ?>

    </main>
</div>
<?php get_footer(); ?>