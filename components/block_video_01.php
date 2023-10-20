<?php
$url = 'https://data.pstu.org.br/src/Api/YoutubeContent.php?method=listchannels';
$channels = file_get_contents($url);
$channels = json_decode($channels, true);
?>
<section class="video-section">
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span><?= get_cat_name($cat) ?></span>
                <a href="<?= get_category_link($cat) ?>" class="more">Ver todos</a>
            </h2>

            <div class="video-container">
                <?php
                foreach ($channels as $channel) {
                    $url = 'https://data.pstu.org.br/src/Api/YoutubeContent.php?method=listvideos&channel=' . $channel['id'];
                    $videos = file_get_contents($url);
                    $videos = json_decode($videos, true);
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
    </div>
</section>