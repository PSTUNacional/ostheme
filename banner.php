<?php

/*
Template Name: Banners
*/

get_header(); ?>

<div class="content-area">
    <style>
        .banner-grid,
        .story-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            width: 100%;
            height: 100%;
            justify-content: center;
        }

        .story-grid {
            display: none;
        }

        .banner-grid .banner-card {
            aspect-ratio: 1;
            width: 100%;
            height: 100%;
            max-width: 240px;
            background-size: cover;
            background-position: Center;
            cursor: pointer;
            border-radius: 4px;
            overflow: hidden;
        }

        .story-grid .story-card {
            aspect-ratio: 9/16;
            width: 100%;
            height: 100%;
            max-width: 240px;
            background-size: cover;
            background-position: Center;
            cursor: pointer;
            border-radius: 4px;
            overflow: hidden;
        }

        .banner-grid .info,
        .story-grid .info {
            display: none;
            transition: all .3s ease-in-out;
            gap: 8px;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background-color: #fffa;
        }

        .banner-grid .info a,
        .story-grid .info a {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .banner-grid .banner-card:hover .info,
        .story-grid .story-card:hover .info {
            display: flex;
            transition: all .3 ease-in-out;
        }
    </style>
    <main>
        <div class="container ta-center" style="justify-content:center; margin: 48px auto">
            <button class="btn primary" onclick="changeContent('banner')">Banners</button>
            <button class="btn secondary" onclick="changeContent('story')">Stories</button>
        </div>
        <div class="container">
            <div class="banner-grid">

            </div>
            <div class="story-grid">

            </div>
        </div>
        <div class="container ta-center" style="justify-content:center; margin: 48px auto">
            <button class="btn primary" onclick="getContent()">Carregar mais</button>
        </div>
    </main>
    <script>
        var offset = 0
        async function getContent(offset) {
            await fetch('/automation/src/Controller/Content.php?method=getByType&type=Banner&limit=12&offset=' + offset)
                .then(resp => resp.json())
                .then(data => {
                    data.forEach(banner => {
                        webp = banner['filename'].substr(0, banner['filename'].lastIndexOf('.')) + '.webp'
                        c = '<div class="banner-card" style="background-image:url(\'https://opiniaosocialista.com.br/automation/assets/rendered/webp/' + webp + '\')"><div class="info"><a target="_blank" href="https://opiniaosocialista.com.br/automation/assets/rendered/' + banner['filename'] + '" dowload><i class="fa fa-file-download"></i></a><a target="_blank" href="' + banner['link'] + '"><i class="fa fa-link"></i></a></div></div>'

                        document.querySelector('.banner-grid').innerHTML += c
                    })
                })

            await fetch('/automation/src/Controller/Content.php?method=getByType&type=Story&limit=12&offset=' + offset)
                .then(resp => resp.json())
                .then(data => {
                    data.forEach(banner => {
                        webp = banner['filename'].substr(0, banner['filename'].lastIndexOf('.')) + '.webp'
                        c = '<div class="story-card" style="background-image:url(\'https://opiniaosocialista.com.br/automation/assets/rendered/webp/' + webp + '\')"><div class="info"><a target="_blank" href="https://opiniaosocialista.com.br/automation/assets/rendered/' + banner['filename'] + '" dowload><i class="fa fa-file-download"></i></a><a target="_blank" href="' + banner['link'] + '"><i class="fa fa-link"></i></a></div></div>'

                        document.querySelector('.story-grid').innerHTML += c
                    })
                })
            offset + 12;
            return offset
        }

        function changeContent(content) {
            if (content == 'banner') {
                document.querySelector('.banner-grid').style.display = 'flex'
                document.querySelector('.story-grid').style.display = 'none'
                document.querySelectorAll('main button')[0].className = "btn primary"
                document.querySelectorAll('main button')[1].className = "btn secondary"
            }
            if (content == 'story') {
                document.querySelector('.story-grid').style.display = 'flex'
                document.querySelector('.banner-grid').style.display = 'none'
                document.querySelectorAll('main button')[1].className = "btn primary"
                document.querySelectorAll('main button')[0].className = "btn secondary"
            }
        }
        window.addEventListener('load', function() {
            getContent()
        })
    </script>
</div>
<?php get_footer(); ?>