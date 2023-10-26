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
    if(strpos($content, 'OS-B') !== false )
    {
        array_push($banners, $content);
    }
    if(strpos($content, 'OS-S') !== false )
    {
        array_push($stories, $content);
    }
}


get_header(); ?>

<div class="content-area">
    <style>
        .banner-grid{
            display:flex;
            gap:8px;
        }
        .banner-grid .banner-card{
            aspect-ratio: 1;
            width: 100%;
            height: 100%;
            max-width: 180px;
        }

    </style>
    <main>
        <div class="banner-grid">
            <?php

            foreach($banners as $b)
            {
                echo '<div class="banner-card" style="background-image:url(\'https://opiniaosocialista.com.br/automation/assets/rendered/'.$b.'\')"></div>';
            }
            ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>