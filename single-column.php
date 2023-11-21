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
</article>

<!-- Related posts | Same author -->
<?php
$args = array(
  //'author'        =>  $post->post_author,
  'orderby'       =>  'post_date',
  'order'         =>  'ASC',
  'post__not_in'  =>  array($post->ID),
  'category__in'  =>  array(3793),
  'posts_per_page' => 3
);

$relatedPosts = new WP_Query($args);
?>

<div class="block-header">
    <span>Mais textos de <?=the_author_meta('display_name', $post->post_author);?></span>
  </div>
<div class="related-posts">
  <?php foreach ($relatedPosts->posts as $relpost) { ?>
    <article class="related-post">
      <?= os_render_thumbnail($relpost); ?>
      <a href="<?= get_permalink($relpost->ID); ?>" title="<?= $post->post_title; ?>" arial-label="<?= $post->post_title; ?>">
        <h3><?= $relpost->post_title; ?></h3>
      </a>
    </article>
  <?php } ?>
</div>