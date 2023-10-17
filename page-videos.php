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

nav.main-menu{
    color:#fff;
}
@media screen and (max-width:560px){
    nav.main-menu{
    color:var(--black);
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
                    <div class="video-thumb"></div>
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