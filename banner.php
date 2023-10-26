<?php

/*
Template Name: Banners
*/

$dir = $_SERVER['DOCUMENT_ROOT'].'/automation/assets/rendered/';
$bannerList = scandir($dir);

$banners = [];
$stories = [];

foreach($bannerList as $content)
{
    if(strpos($content, 'OS-B') == true )
    {
        array_push($banners, $content);
    }
    if(strpos($content, 'OS-S') == true )
    {
        array_push($stories, $content);
    }
}


get_header(); ?>

<div class="content-area">
    <main>
        <pre>
            <?=print_r($banners)?>
            <?=print_r($stories)?>
        </pre>
    </main>
</div>
<?php get_footer(); ?>