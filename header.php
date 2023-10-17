<!DOCTYPE html>
<html lang="pt-br">

<head>
	<link rel="icon" type="image/x-icon" href=<?= get_template_directory_uri() . "/assets/img/favicon.gif" ?>>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Opinião Socialista</title>
	<?php wp_head(); ?>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body <?php body_class(); ?>>
	<header>
		<section class="top-bar">
			<a href="/">
				<svg xmlns="http://www.w3.org/2000/svg">
					<image href="<?= get_template_directory_uri() . '/assets/img/logos/os_logo_red.svg'; ?>"/>
				</svg>
			</a>
			<i class="hamb fa fa-bars" onclick="openMobileMenu()"></i>
		</section>
		<section class="menu-area">
			<nav class="main-menu">
				<div class="mobile">
					<h4 style="color:var(--primary); text-transform:uppercase">Opinião Socialista</h4>
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
					<p>Siga o <b>Opinião</b></p><br />
					<div class="social-media">
						<a href="https://www.facebook.com/opiniaosocialista" target="_blank"><i class="fab fa-facebook"></i></a>
						<a href="https://www.instagram.com/opiniaosocialista/" target="_blank"><i class="fab fa-instagram"></i></a>
					</div>
				</div>
			</nav>
			<div class="backdrop" onclick="openMobileMenu()"></div>
		</section>
	</header>