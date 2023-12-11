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
          $categoriesArr = [];
          foreach ($categories as $a) {
            array_push($categoriesArr, $a->name);
          }
          $profile = get_avatar_url($post->post_author);

          if(in_category('colunas'))
          {
            include('single-column.php');
          } else {
            include('single-default.php');
          }
        }
      } ?>
    </div>
    <div class="container">
    <a href="https://facaparte.pstu.org.br/?utm_source=opiniao&utm_medium=materia&utm_campaign=regular" style="margin: auto">
      <img style="width:100%; max-width:900px; margin:auto" src="/wp-content/themes/ostheme/assets/img/ads/facaparte_2023v1.jpg"/>
    </a>
    </div>
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

    ads_list = [{
        'category': 'contribua',
        'version': 'v1'
      },
      {
        'category': 'contribua',
        'version': 'v2'
      },
      {
        'category': 'contribua',
        'version': 'v3'
      },
    ]

    item = ads_list[Math.floor(Math.random() * ads_list.length)]
    ad = document.createElement('a')
    ad.className = 'post-insert'
    img = item['category'] + '_' + item['version'] + '.jpg'
    ad.innerHTML = '<img src="/wp-content/themes/ostheme/assets/img/ads/' + img + '" alt="Faça uma doação" />'

    ad.href = 'https://www.opiniaosocialista.com.br/contribua/?utm_source=opiniao&utm_medium=' + item['category'] + '-' + item['version'] + '&utm_campaign=regular'
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