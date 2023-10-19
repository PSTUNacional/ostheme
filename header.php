<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!-- Meta tags -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-language" content="pt-br">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="follow">
	<linl ref="canonical" href="https://www.opiniaosocialista.com.br"/>
	<meta name="description" content="O jornal oficial do PSTU"/>

	<meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title('|', 1, 'right').' | '.bloginfo('name'); ?>"/>
	<meta property="og:type" content="article"/>
	<meta property="og:description" content="O jornal oficial do PSTU"/>
	<meta property="og:site_name" content="Opinião Socialista"/>
	<meta property="or:url" content=""/>
	<!-- End of Meta tags -->

	<!-- CSS -->
	<link rel="icon" type="image/x-icon" href=<?= get_template_directory_uri() . "/assets/img/favicon.gif" ?>>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	

	<title><?php is_front_page() ? bloginfo('name') : wp_title('|', 1, 'right').' | '.bloginfo('name'); ?></title>

	<?php wp_head(); ?>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-JRDXFKDNWQ"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-JRDXFKDNWQ');
	</script>

</head>

<body <?php body_class(); ?>>
	<header>
		<section class="top-bar">
			<div class="container">
				<i class="hamb fa fa-bars" onclick="openMobileMenu()"></i>
				<a href="/">
					<svg xmlns="http://www.w3.org/2000/svg">
						<image href="<?= get_template_directory_uri() . '/assets/img/logos/os_logo_red.svg'; ?>" />
					</svg>
				</a>
				<div class="search">
					<button onclick="handleSearchBar()" aria-label="Buscar"><i class="fa fa-search"></i></button>
				</div>
			</div>
			<section id="search-bar">
				<div class="container">
					<?php get_search_form(array('aria_label' => 'modafuca')) ?>
					<div id="fast-results-header">
						<h5>Resultados rápidos</h5>
						<hr />
					</div>
					<div class="fast-results"></div>
				</div>
				</div>
			</section>
		</section>

		<section class="menu-area">
			<nav class="main-menu">
				<div class="mobile">
					<h4 style="color:var(--primary); text-transform:uppercase; padding-left:24px;">Opinião Socialista</h4>
					<hr />
				</div>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'main_menu'
					)
				); ?>
				<div class="mobile">
					<hr />
					<ul>
						<li><a>Contribua</a></li>
						<li><a>Seja um colaborador</a></li>
					</ul>
					<hr />
					<p style="padding-left:24px;">Siga o <b>Opinião</b></p><br />
					<div class="social-media" style="padding-left:24px;">
						<a href="https://www.facebook.com/opiniaosocialista" target="_blank"><i class="fab fa-facebook"></i></a>
						<a href="https://www.instagram.com/opiniaosocialista/" target="_blank"><i class="fab fa-instagram"></i></a>
					</div>
				</div>
			</nav>
			<div class="backdrop" onclick="openMobileMenu()"></div>
		</section>
	</header>