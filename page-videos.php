<?php

/*
Template Name: Vídeos
*/

$url = 'https://data.pstu.org.br/src/Api/YoutubeContent.php?method=listchannels';
$channels = file_get_contents($url);
$channels = json_decode($channels, true);

get_header(); ?>

<style>
    body {
        background-color: #000;
        position: relative;
    }

    .channel-section {
        display: block;
        padding: var(--gap);
    }

    .channel-section h3.channel-title {
        color: #fff;
        padding-bottom: 8px;
        border-bottom: 1px solid #fff;
        margin-bottom: var(--gap);
        margin-top: calc(2*var(--gap));
    }

    .video-container {

        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: calc(var(--gap)/2);
    }

    .video-item .description,
    .video-item .duration {
        display: none;
    }

    .video-info {
        display: flex;
        gap: 8px;
        flex-direction: column;
    }

    .video-info .badge {
        padding: 2px 8px;
    }

    .video-info h3 {
        color: #fff;
        font-size: 1rem;
    }

    .video-info .date {
        color: var(--gray-600);
        font-size: 0.7em;
    }

    .video-thumb {
        aspect-ratio: 16/9;
        margin-bottom: 8px;
        background-size: cover;
        background-position: center;
    }

    .video-destak {
        position: relative;
        display: flex;
        min-height: 560px;
    }

    .video-destak .container {
        width: 100%;
    }

    .video-destak button {
        color: #fff;
        cursor: pointer;
        background-color: var(--primary);
        padding: 12px 24px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: fit-content;
        border: none;
        gap: 8px;
    }

    .video-destak .video-thumb {
        position: absolute;
        width: 60%;
        height: 100%;
        top: 0;
        right: 0;
        z-index: 0;
        background-position: center;
        background-size: cover;
    }

    .video-thumb-container .gradient {
        background-image: linear-gradient(90deg, #000000ff 0%, #00000000 100%);
        position: absolute;
        width: 60%;
        height: 100%;
        top: 0;
        right: 0;
        z-index: 1;
    }


    .video-destak .video-info {
        position: relative;
        z-index: 2;
        max-width: 50%;
        margin-right: auto;
        color: #fff;
    }

    .video-destak .video-info h1 {
        font-size: 2rem;
    }

    #videoDuration {
        margin: var(--gap) 0;
    }

    @media screen and (max-width: 640px) {

        .video-thumb-container .gradient,
        .video-destak .video-thumb {
            width: 100%;
            height: 60%;
        }

        .video-thumb-container .gradient {
            background-image: linear-gradient(0deg, #000000ff 0%, #00000000 100%);
        }

        .video-destak .video-info {
            max-width: 100%;
            margin-top: 360px;
        }
    }


    /*
    *
    *   Video player
    *
    */

    .video-player {
        background-color: #000c;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 99;
        backdrop-filter: blur(5px);
    }

    .video-player i {
        color: #fff;
        font-size: 24px;
        position: absolute;
        top: -32px;
        right: 48px;
        cursor: pointer;
    }

    .video-player .video-container {
        position: relative;
        padding-bottom: 56.25%;
        width: 100%;
    }

    .video-player .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 48px;
    }

    @media screen and (max-width: 560px) {
        .video-player .video-container iframe {
            padding: 12px;
        }

        .video-player i {
            right: 12px;
        }
    }
</style>
<div class="video-player">
    <div class="video-container">
        <i class="fa fa-times" onclick="closeVideo()"></i>
        <iframe id="video-embed" width="720" height="405" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
</div>
<div class="content-area">
    <main>
        <section>
            <div class="video-destak">
                <div class="container">
                    <div class="video-info">
                        <span id="channelBadge"></span>
                        <h1></h1>
                        <span id="videoDuration"><i class="fa fa-clock"></i> <span></span></span>
                        <p id="videoDescription"></p>
                        <button onclick="playVideo()"><i class="fa fa-play-circle"></i> Assista agora</button>
                    </div>
                </div>
                <div class="video-thumb-container">
                    <div class="gradient"></div>
                    <div class="video-thumb">
                    </div>
                </div>
        </section>

        <?php
        foreach ($channels as $channel) {
            $url = 'https://data.pstu.org.br/src/Api/YoutubeContent.php?method=listvideos&channel=' . $channel['id'];
            $videos = file_get_contents($url);
            $videos = json_decode($videos, true);
        ?>
            <div class="channel-section">
                <h3 class="channel-title"><?= $channel['name'] ?></h3>
                <div class="video-container">
                    <?php
                    for ($i = 0; $i < 10; $i++) {
                    ?>

                        <div class="video-item" data-video="<?= $videos[$i]['video_id'] ?>">
                            <div class="video-thumb" style="background-image:url('https://i.ytimg.com/vi/<?= $videos[$i]['video_id'] ?>/mqdefault.jpg')"></div>
                            <div class="video-info">
                                <span class="badge primary"><?= $videos[$i]['channel_name'] ?></span>
                                <h3><?= $videos[$i]['title'] ?></h3>
                                <span class="date"><?= date("d M Y", strtotime($videos[$i]['date'])) ?></span>
                                <p class="description"><?= $videos[$i]['description'] ?></p>
                                <p class="duration"><?= $videos[$i]['duration'] ?></p>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        <?php } ?>

</div>
</main>
</div>

<script>
    videoheader = document.querySelector('.video-destak');
    video = ''

    videoItems = document.querySelectorAll('.video-item')
    videoItems.forEach(el => {
        el.addEventListener('click', () => {
            videoId = event.currentTarget.getAttribute('data-video')
            title = event.currentTarget.querySelector('h3').innerText
            description = event.currentTarget.querySelector('.description').innerText
            duration = event.currentTarget.querySelector('.duration').innerText

            videoheader.querySelector('.video-thumb').style.backgroundImage = "url('http://i3.ytimg.com/vi/" + videoId + "/maxresdefault.jpg')"
            videoheader.querySelector('h1').innerText = title
            videoheader.querySelector('#videoDescription').innerText = description
            videoheader.querySelector('#videoDuration span').innerText = duration
            video = videoId
            window.scrollTo(0, 0);
        })
    })

    function playVideo() {
        document.querySelector('.video-player').style.display = "flex";
        player = document.querySelector('.video-player iframe')
        url = player.src;
        if (!url.includes(video)) {
            player.src = "https://www.youtube.com/embed/" + video + "?enablejsapi=1"
        }
        player.onload = () => {
            document.getElementsByTagName("iframe")[0].contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
        }
        player.onready

    }

    function closeVideo() {
        pause = document.querySelector('[data-title-no-tooltip="Pausa"]')
        if (pause) {
            pause.click()
        }
        document.querySelector('.video-player').style.display = "none";
        document.getElementsByTagName("iframe")[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
    }

    window.onload = function() {
        setTimeout(() => {
            document.querySelector('.video-item').click();
        }, 100)

    }
</script>
<?php get_footer(); ?>