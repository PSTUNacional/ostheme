<?php

/*
Template Name: OS Home Page
*/

get_header(); ?>
<div class="content-area">
    <main>

        <?php

        // ========== Main video ========== //
        $mainvideo_url =  get_option('ostheme_mainvideo_url');

        if (get_option('ostheme_mainvideo_active') == 'on' && $mainvideo_url !== '') {
            preg_match("/v=(.*)/", $mainvideo_url, $url);
            $videoId = $url[1];

        ?>
            <section>
                <div class="container">
                    <div class="mainvideo">
                        <div class="video-info">
                            <span class="badge primary">ASSISTA AGORA</span>
                            <h1><?= get_option('ostheme_mainvideo_title') ?></h1>
                            <p id="videoDescription"><?= get_option('ostheme_mainvideo_description') ?></p>
                            <a class="btn" href="<?= $mainvideo_url ?>" target="_blank"><i class="fa fa-play-circle"></i> Assistir!</a>
                        </div>
                        <div class="video-thumb-container">
                            <div class="gradient"></div>
                            <div class="video-thumb" style="background-image:url('https://i3.ytimg.com/vi/<?= $videoId ?>/maxresdefault.jpg')"></div>
                        </div>
                    </div>
            </section>
        <?php } ?>

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

        // ========== Header Block ========== //
        $args = array(
            'numberposts' => 5,
            'category__not_in' => array(50),
            'tag__not_in' => array(4),
            'orderby'   => 'menu_order'
        );
        $posts = new WP_Query( $args );

        $headerblock = get_option('ostheme_headerblock_layout');
        $headerblock == '' ? $headerblock = 'header_block_01' : '';
        include(__DIR__ . '/components/' . $headerblock . '.php'); ?>

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
        <?php }

        $args = array(
            'numberposts' => 4,
            'post__not_in' => $skipDestak,
            'category__not_in' => array(50,3793,91),
            'tag__not_in' => array(4));

        $posts = get_posts( $args );
        include(__DIR__ . '/components/block_01.php');

        /***
         * 
         *  Sections
         *          
         */

        render_section('01', 4);

        render_section('02');

        render_section('03');

        render_section('04');

        // Video section

        include(__DIR__ . '/components/block_video_01.php');

        ?>
        <section>
            <div class="container">
                <div class="col col-33">
                    <?php render_section('05') ?>
                </div>
                <div class="divider"></div>
                <div class="col col-33">
                    <?php render_section('06') ?>
                </div>
                <div class="divider"></div>
                <div class="col col-33">
                    <?php render_section('07') ?>
                </div>
            </div>
        </section>

        <?php
        render_section('08');
        ?>
        <section>
            <div class="container">
                <div class="col col-33">
                    <?php render_section('09') ?>
                </div>
                <div class="divider"></div>
                <div class="col col-33">
                    <?php render_section('10') ?>
                </div>
                <div class="divider"></div>
                <div class="col col-33">
                    <?php render_section('11') ?>
                </div>
            </div>
        </section>
    </main>
</div>
<?php get_footer(); ?>