<?php

/*
Template Name: Principal Versão 03
*/

get_header(); ?>
<div class="content-area">
    <main>

        <section class="ads">
            <div class="container">
                <div class="ad-horizontal-large">
                    <h3>Espaço reservado para eventual campanha caso haja.</h3>
                </div>
            </div>
        </section>

        <?php include(__DIR__ . '/components/header_block_03.php'); ?>

        <?php
        $cat = 50; // Editorial
        $args = array('numberposts' => 1, 'offset' => 0, 'category' => array($cat), 'tag__not_in' => array(5));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_05.php');
        ?>

        <section class="ads">
            <div class="container">
                <div class="ad-horizontal-large">
                    <h3>Espaço reservado para eventual campanha caso haja.</h3>
                </div>
            </div>
        </section>

        <?php
        $args = array('numberposts' => 4, 'offset' => 5, 'category__not_in' => array(50), 'tag__not_in' => array(5));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_01.php');
        ?>

        <?php
        include(__DIR__ . '/components/opinion_block_01.php');
        ?>

        <?php
        $cat = 26; // Internacional
        $args = array('numberposts' => 5, 'category' => array($cat), 'offset' => 5, 'tag__not_in' => array(5));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_02.php');
        ?>

        <?php
        $cat = 54; // Movimento
        $args = array('numberposts' => 5, 'category' => array($cat), 'offset' => 5, 'tag__not_in' => array(5));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_03.php');
        ?>

        <?php
        $cat = 148; // Mulheres
        $args = array('numberposts' => 2, 'category' => array($cat), 'offset' => 5, 'tag__not_in' => array(5));
        $posts = get_posts($args);
        include(__DIR__ . '/components/block_04.php');
        ?>

    </main>
</div>
<?php get_footer(); ?>