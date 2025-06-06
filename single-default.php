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
      try {
        $evaluation = get_the_rate($post->ID);
        $evRate = round($evaluation['rate'], 2);
        $evTotal = round($evaluation['total']);
      } catch (Exception $e) {
        $evRate = 0;
        $evTotal = 0;
      }

      $slug = get_post()->post_name;
      $views = get_post_views_from_ga($slug);
      ?>
      <span>
        <i class="material-icons checked">star</i><?= $evRate ?> (<?= $evTotal ?>)
      </span>
      <span>
        <i class="material-icons checked">visibility</i> <?= $views ?>
      </span>
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
</article>