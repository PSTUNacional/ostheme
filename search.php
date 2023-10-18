<?php

/*
Template Name: Search Page
*/

get_header();

global $wp_query;
global $query_string;

$total_results = $wp_query->found_posts;

wp_parse_str($query_string, $search_query);

$current_page = array_key_exists('paged', $search_query)
    ? intval($search_query['paged'])
    : 1;

$search = $search_query['s'];
?>
<div class="content-area">
    <main>
        <div class="container">
            <h1 style="margin: 48px 0;"><span style="display:block; font-size:0.5em; color:var(--grey-500); font-weight:400"><b style="color:var(--primary);"><?= $total_results ?></b> resultados encontrados para:</span><?= the_search_query(); ?></h1>
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    <article class="article-01">
                        <a class="featured-image-container" href="<?= get_permalink($post->ID); ?>">
                            <div class="featured-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID); ?>')"></div>
                        </a>
                        <div class="post-info">

                            <h5 class="sup-category"><?= escape_categories(wp_get_post_categories($post->ID)); ?></h5>
                            <a href="<?= get_permalink($post->ID); ?>" title="<?= $posts[$i]->post_title; ?>">
                                <h2><?= $post->post_title; ?></h2>
                            </a>
                            <span class="author-line">Por <?= the_author_meta('display_name', $post->post_author); ?></span>
                            <p><?= formatDate($post->post_date) ?></p>
                        </div>
                    </article>
            <?php }
            } ?>
            <div class="search-pagination">
                <?php
                $totalPages = ceil($total_results / 10);
                if ($totalPages <= 6) {
                    for ($i = 1; $i <= $totalPages; $i++) {
                ?>
                        <a href='<?= get_site_url(); ?>/page/<?= $i ?>/?s=<?= $search; ?>'><?= $i ?></a>
                        <?php
                    }
                } else {
                    if ($current_page <= 4) {
                        for ($i = 1; $i <= 5; $i++) {
                        ?>
                            <a href='<?= get_site_url(); ?>/page/<?= $i ?>/?s=<?= $search; ?>'><?= $i ?></a>
                        <?php
                        } ?>
                        <span style="margin: 0 12px;">...</span>
                        <a href='<?= get_site_url(); ?>/page/<?= $totalPages ?>/?s=<?= $search; ?>'><?= $totalPages ?></a>
                    <?php
                    } elseif ($current_page >= ($totalPages - 4)) {
                    ?>
                        <a href='<?= get_site_url(); ?>/page/1/?s=<?= $search; ?>'>1</a>
                        <span style="margin: 0 12px;">...</span>
                        <?php
                        for ($i = ($totalPages - 4); $i <= $totalPages; $i++) {
                        ?>
                            <a href='<?= get_site_url(); ?>/page/<?= $i ?>/?s=<?= $search; ?>'><?= $i ?></a>

                        <?php
                        }
                    } else {
                        ?>
                        <a href='<?= get_site_url(); ?>/page/1/?s=<?= $search; ?>'>1</a>
                        <span style="margin: 0 12px;">...</span>
                        <?php
                        for ($i = ($current_page - 2); $i <= ($current_page + 2); $i++) {
                        ?>
                            <a href='<?= get_site_url(); ?>/page/<?= $i ?>/?s=<?= $search; ?>'><?= $i ?></a>

                        <?php
                        }
                        ?>
                        <span style="margin: 0 12px;">...</span>
                        <a href='<?= get_site_url(); ?>/page/<?= $totalPages ?>/?s=<?= $search ?>'><?= $totalPages ?></a>
                <?php

                    }
                }

                ?>
            </div>
        </div>
        </article>
    </main>
    <script>
        document.querySelectorAll('.search-pagination a').forEach(e=>{
            if(e.innerText == <?=$current_page?>){
                e.className = "active"
            }
        })
    </script>
</div>
<?php get_footer(); ?>