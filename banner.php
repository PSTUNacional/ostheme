<?php

/*
Template Name: Banners
*/

get_header(); ?>

<div class="content-area">
    <style>
        .banner-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            width: 100%;
            height: 100%;
        }

        .banner-grid .banner-card {
            aspect-ratio: 1;
            width: 100%;
            height: 100%;
            max-width: 240px;
            background-size: cover;
            background-position: Center;
            cursor: pointer;
        }

        .banner-grid .info {
            display: none;
            transition: all .3s ease-in-out;
            gap: 8px;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background-color: #fffa;
        }

        .banner-grid .info a {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }


        .banner-grid .banner-card:hover .info {
            display: flex;
            transition: all .3 ease-in-out;
        }
    </style>
    <main>
        <div class="container">
            <div class="banner-grid">
              
            </div>
        </div>
    </main>
    <script>
        async function getContent(){
            await fetch('automation/src/Controller/Content.php?method=getByType&type=Banner&limit=9')
            .then(resp=>resp.json())
            .then(data=>{
                data.foreach(banner =>{
                    c = '<div class="banner-card" style="background-image:url(\'https://opiniaosocialista.com.br/automation/assets/rendered/'+c['filename']+'\')"><div class="info"><a><i class="fa fa-file-download"></i></a><a href="'+c['link']+'"><i class="fa fa-link"></i></a></div></div>'

                    document.querySelector('.banner-grid').innerHTML += c
                })
            })
        }
    </script>
</div>
<?php get_footer(); ?>