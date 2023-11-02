<?php

get_header(); ?>

<div class="content-area">

  <main>
    <div class="container">
      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          $categories = get_the_category();
          $profile = get_avatar_url($post->post_author);
      ?>
          <article class="post" id=<?= $post->ID ?>>
            <div class="block-header">
              <span><?= $categories[0]->name; ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
            <h3 class="tagline">
              <?php
              $tagline = get_post_meta($post->ID, 'post_tagline', true);
              if (!$tagline == '') {
                echo $tagline;
              }

              ?>
            </h3>

            <!-- Author Box -->
            <div class="metainfo">
              <div class="author-box">
                <div class="author-avatar" style="background-image:url('<?= $profile ?>')">
                  <?php
                  if (!$profile) { ?>
                    <i class="fa fa-user"></i>
                  <?php } ?>
                </div>
                <div class="info">
                  <h4 class="author-line">
                    <?php
                    echo the_author_meta('display_name', $post->post_author);
                    if (get_the_author_meta('description') !== '') {
                      echo '<span style="font-weight:300">, ' . get_the_author_meta('description') . '</span>';
                    }


                    ?>
                  </h4>
                  <span><?= get_the_date() ?></span>
                </div>
              </div>
              <div class="socialmedia">
                <a href="whatsapp://send?text=<?= the_title(); ?>%0A%0A<?= get_permalink(); ?>" data-action="share/whatsapp/share" class="wa share" target="_blank"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.facebook.com/sharer.php?u=<?= urlencode(get_permalink()); ?>" class="fb share" target="_blank"> <i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/intent/tweet?text=<?= urlencode(the_title()); ?>&url=<?= get_permalink(); ?>%0A%0A&via=opiniaosocialista" class="tw share" target="_blank"><i class="fab fa-twitter"></i></a>
              </div>

              <div class="rate-box">
                <?php
                $evaluation = get_the_rate($post->ID);
                $evRate = round($evaluation['rate'], 2);
                $evTotal = round($evaluation['total']);

                echo '<i class="material-icons checked">star</i>' . $evRate . ' (' . $evTotal . ' avaliações)'; ?>
              </div>
            </div>

            <div class="thumbnail-container">
              <?= the_post_thumbnail() ?>
              <div class="caption">
                <?= the_post_thumbnail_caption(); ?>
              </div>
            </div>

            <!-- Content -->
            <div class="container" id="post-content">
              <?php the_content(); ?>
            </div>

        <?php }
        $cats = get_the_category();
        $categoriesArr = [];
        foreach ($cats as $a) {
          array_push($categoriesArr, $a->name);
        }
      } ?>

    </div>
    </article>
  </main>
</div>
<script>
  let getPostInfo = () => {
    return ({
      id: "<?= get_the_ID() ?>",
      type: "<?= get_post_type() ?>",
      category: <?= json_encode($categoriesArr) ?>,
      origin: document.referrer
    })
  }
  setTimeout(() => {
    renderEvaluationScale(<?= get_the_ID() ?>)
  }, 10000)

  window.onload = () => {

    ////////// Ads //////////

    ads_list = [
      {
        'category' : 'contribua',
        'version' : 'v1'
      },
      {
        'category' : 'contribua',
        'version' : 'v2'
      },
      {
        'category' : 'contribua',
        'version' : 'v3'
      },
    ]

    item = ads_list[Math.floor(Math.random()*ads_list.length)]
    ad = document.createElement('a')
    ad.className = 'post-insert'
    img = item['category']+'_'+item['version']+'.jpg'
    ad.innerHTML = '<img src="/wp-content/themes/ostheme/assets/img/ads/'+img+'" alt="Faça uma doação" />'

    ad.href = 'https://doe.pstu.org.br/?utm_source=opiniao&utm_medium='+item['category']+item['version']+'&utm_campaign=regular'
    place = document.querySelectorAll('#post-content p')[2]
    place.after(ad)

    ////////// Player de áudio //////////
    raw_id = document.querySelector('article').id
    id = raw_id.replace(/[ˆa-z | -]/g, '')
    fetch('https://www.opiniaosocialista.com.br/automation/src/Controller/Content.php?method=getAudioByPostId&id=' + id)
      .then(resp => resp.json())
      .then(data => {
        place = document.querySelector('#post-content')
        p = document.createElement('audio')
        p.setAttribute('controls', true)
        p.style.width = "100%"
        s = document.createElement('source')
        ref = 'https://www.opiniaosocialista.com.br/archive/audio/' + data[0]['filename']
        s.setAttribute('src', ref)
        p.prepend(s)
        place.prepend(p)
      })
  }
</script>
<?php get_footer(); ?>