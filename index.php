<?php get_header(); ?>
<div class="content-area">
    <main>
        <section class="ads">
            <div class="container">
                <div class="ad-horizontal-large">
                    <h3>Espaço reservado para eventual campanha caso haja.</h3>
                </div>
            </div>
        </section>

        <?php include(__DIR__ . '/components/header_block_01.php'); ?>

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

    </main>
</div>

<?php get_footer(); ?>