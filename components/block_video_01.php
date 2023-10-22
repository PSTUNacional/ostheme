<?php
$url = 'https://data.pstu.org.br/src/Api/YoutubeContent.php?method=listchannels';
$channels = file_get_contents($url);
$channels = json_decode($channels, true);
?>
<section class="video-section">
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span>Videos</span>
                <a href="videos" class="more">Ver todos</a>
            </h2>
            <div class="video-container">
                <?php
                $videos_arr = [];
                foreach ($channels as $channel) {
                    $url = 'https://data.pstu.org.br/src/Api/YoutubeContent.php?method=listvideos&channel=' . $channel['id'];
                    $videos = file_get_contents($url);
                    $videos = json_decode($videos, true);

                    array_push($videos_arr, $videos[0]);
                }

                $date = [];
                foreach ($videos_arr as $key => $row) {
                    $date[$key] = $row['date'];
                }

                array_multisort($date, SORT_DESC, $videos_arr);
                ?>
                <div class="col">
                    <a target="_blank" href="https://www.youtube.com/watch?v=<?= $videos_arr[0]['video_id'] ?>" aria-label="Clique para assistir o vídeo" class="video-item main" data-video="<?= $videos_arr[0]['video_id'] ?>">
                        <div class="video-thumb" style="background-image:url('https://i.ytimg.com/vi/<?= $videos_arr[0]['video_id'] ?>/mqdefault.jpg')"></div>
                        <div class="video-info">
                            <span class="badge primary"><?= $videos_arr[0]['channel_name'] ?></span>
                            <h3><?= $videos_arr[0]['title'] ?></h3>
                            <span class="date"><?= date("d M Y", strtotime($videos_arr[0]['date'])) ?></span>
                            <p class="description"><?= $videos_arr[0]['description'] ?></p>
                            <p class="duration"><?= $videos_arr[0]['duration'] ?></p>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a target="_blank" href="https://www.youtube.com/watch?v=<?= $videos_arr[0]['video_id'] ?>" aria-label="Clique para assistir o vídeo" class="video-item" data-video="<?= $videos_arr[1]['video_id'] ?>">
                        <div class="video-thumb" style="background-image:url('https://i.ytimg.com/vi/<?= $videos_arr[1]['video_id'] ?>/mqdefault.jpg')"></div>
                        <div class="video-info">
                            <span class="badge primary"><?= $videos_arr[1]['channel_name'] ?></span>
                            <h3><?= $videos_arr[1]['title'] ?></h3>
                            <span class="date"><?= date("d M Y", strtotime($videos_arr[1]['date'])) ?></span>
                            <p class="description"><?= $videos_arr[1]['description'] ?></p>
                            <p class="duration"><?= $videos_arr[1]['duration'] ?></p>
                        </div>
                    </a>
                    <a target="_blank" href="https://www.youtube.com/watch?v=<?= $videos_arr[0]['video_id'] ?>" aria-label="Clique para assistir o vídeo" class="video-item" data-video="<?= $videos_arr[2]['video_id'] ?>">
                        <div class="video-thumb" style="background-image:url('https://i.ytimg.com/vi/<?= $videos_arr[2]['video_id'] ?>/mqdefault.jpg')"></div>
                        <div class="video-info">
                            <span class="badge primary"><?= $videos_arr[2]['channel_name'] ?></span>
                            <h3><?= $videos_arr[2]['title'] ?></h3>
                            <span class="date"><?= date("d M Y", strtotime($videos_arr[2]['date'])) ?></span>
                            <p class="description"><?= $videos_arr[2]['description'] ?></p>
                            <p class="duration"><?= $videos_arr[2]['duration'] ?></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>