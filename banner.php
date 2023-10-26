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
            flex-wrap: wrap;
            gap:8px;
            width: 100%;
  height: 100%;
        }
        .banner-grid .banner-card{
            aspect-ratio: 1;
            width: 100%;
            height: 100%;
            max-width: 240px;
            background-size:cover;
            background-position:Center;
            cursor:pointer;
        }

        .banner-grid .info{
            display: none;
            transition: all .3s ease-in-out;
            gap:8px;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background-color: #fffa;
        }

        .banner-grid .info a{
            width: 32px;
            height:32px;
            border-radius:50%;
            background-color: var(--primary);
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .banner-grid .banner-card:hover .info{
            display: flex;
            transition: all .3 ease-in-out;
        }

    </style>
    <main>
        <div class="container">
        <div class="banner-grid">
            <?php

            foreach($banners as $b)
            {

                $id = (int) filter_Var($b, FILTER_SANITIZE_NUMBER_INT);
                echo '<div class="banner-card" style="background-image:url(\'https://opiniaosocialista.com.br/automation/assets/rendered/'.$b.'\')"><div class="info"><a><i class="fa fa-file-download"></i></a><a href="https://www.opiniaosocialista.com.br/?p='.$id.'"><i class="fa fa-link"></i></a></div></div>';
            }
            ?>
        </div>
        </div>
    </main>
</div>
<?php get_footer(); ?>