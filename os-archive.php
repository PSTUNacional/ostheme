<?php

/*
Template Name: OS Archive
*/

get_header(); ?>
<div class="content-area">
    <style>
        .content-area{
            background-color: var(--grey-400);
        }
        .edition-grid{
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(224px, 1fr));
            gap: calc(var(--gap)/2);
            padding: var(--gap);
        }
        .os-edition{
            aspect-ratio: 11/15;
        }
        .os-edition .image-container{
            width: 100%;
            height: 100%;
            overflow: hidden;
            transition: all .15s;
            box-shadow: 0 0 0 0 #0006;
        }
        .os-edition .image-container .cover {
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100%;
        }

        .os-edition:hover .image-container{
            transform:scale(1.05);
            transition: all .15s;
            box-shadow: 0 10px 20px 0 #000a;
        }
    </style>
    <main>
        <div class="edition-grid">
        <?php
        $editions = scandir(ABSPATH . '/archive/pdf/', 1);
        foreach ($editions as $e) {
            if (strpos($e, '.pdf')) {
                $ed = (int)filter_var($e, FILTER_SANITIZE_NUMBER_INT);
                $cover = '/archive/cover/webp/os' . $ed . '.webp';

        ?>
                <div class="os-edition">
                    <a class="image-container" href="/edicao/<?=$ed?>">
                        <div class="cover" style="background-image: url('<?= $cover ?>')"></div>
            </a>
                </div>
        <?php
            }
        }
        ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>