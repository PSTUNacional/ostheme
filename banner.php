<?php

/*
Template Name: Banners
*/

$dir = $_SERVER['DOCUMENT_ROOT'].'/automation/assets/rendered/';
$bannerList = scandir($dir);


get_header(); ?>

<div class="content-area">
    <main>
        <pre>
            <?=print_r($bannerList)?>
        </pre>
    </main>
</div>
<?php get_footer(); ?>