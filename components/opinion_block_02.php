<?php

$args = [
	"category_name" => "colunas",
	'posts_per_page' => 50,
    'order' => 'DESC',
    'orderby' => 'date'
];
$posts = new WP_Query($args);

// Author Filter

$authors = [];
$columns = [];

if($posts->have_posts())
{
	while($posts->have_posts())
	{
		$posts->the_post();
		$authorId = get_the_author_meta('ID');
		
		if(!in_array($authorId, $authors))
		{
			$authors[] = $authorId;
			$columns[] = [
				'title' => get_the_title(),		
				'permalink' => get_permalink(),
				'author_name' => get_the_author_meta('display_name'),
				'author_slug' => get_the_author_meta('user_nicename'),
				'author_avatar' => get_avatar_url($authorId)
			];
		}
		if (count($columns) >= 10) break;
	}
}
wp_reset_postdata();
?>

<section>
    <div class="container">
        <div class="col">
            <h2 class="block-header">
                <span>Colunas</span>
                <a href="categoria/colunas" class="more">Ver todos</a>
            </h2>
            <div class="opinion-block-01">
                <?php foreach ($columns as $column): ?>
                    <article>
                        <div class="author-box">
                            <div class="author-avatar" style="background-image:url('<?= esc_url($column['author_avatar']) ?>')">
                                <?php if (empty($column['author_avatar'])): ?>
                                    <i class="fa fa-user"></i>
                                <?php endif; ?>
                            </div>
                            <span class="author-line">
                                <a href="coluna/<?= esc_attr($column['author_slug']) ?>"><?= esc_html($column['author_name']) ?></a>
                            </span>
                        </div>
                        <a href="<?= esc_url($column['permalink']) ?>" title="<?= esc_attr($column['title']) ?>">
                            <h2><?= esc_html($column['title']) ?></h2>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div> 
    </div>
</section>