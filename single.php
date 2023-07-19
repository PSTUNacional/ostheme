<?php get_header(); ?>
<div class="content-area">
  <main>
    <div class="container">
      <article class="post">
        <?php
        if (have_posts()) {
          while (have_posts()) {
            the_post();
            $categories = get_the_category(); ?>
            <div class="block-header">
              <span><?= $categories[0]->name; ?></span>
            </div>
            <h1><?php the_title(); ?></h1>
            <h3 class="tagline"><?= get_the_excerpt();?></h3>
            <?php if (the_post_thumbnail()) { ?>
              <div>
                <?php the_post_thumbnail() ?>
              </div>
            <?php } ?>

            <div class="container">
            <div class="author-box">
              <div class="author-avatar">
                <i class="fa fa-user"></i>
              </div>
              <div class="info">
              <h4 class="author-line"><?= the_author_meta('display_name', $post->post_author); ?></h4>
              <span><?= get_the_date()?></span>
            </div>
            </div>
            <!-- Conteudo -->
              <?php the_content(); ?>
            </div>

        <?php }
        } ?>
      </article>
    </div>
  </main>
</div>
<?php get_footer(); ?>