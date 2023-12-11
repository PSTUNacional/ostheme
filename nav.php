<header>
	<section class="top-bar">
		<div class="container">
			<div id="socialmediatop" style="padding-left:24px;">
				<a href="https://www.facebook.com/opiniaosocialista" target="_blank" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
				<a href="https://www.instagram.com/opiniaosocialista/" target="_blank" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
				<a href="https://twitter.com/opsocialista" target="_blank" title="X / Twitter" aria-label="X/Twitter"><i class="fab fa-twitter"></i></a>
				<a target="_blank" href="https://t.me/JornalOpiniaoSocialistaPSTU"><i class="fab fa-telegram"></i></a>
			</div>
			<i class="hamb fa fa-bars" onclick="openMobileMenu()"></i>
			<a href="/" title="Opinião Socialista" aria-label="Página inicial">
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
					<li><a href="colabore" targe="_blank">Seja um colaborador</a></li>
					<li><a href="https://www.opiniaosocialista.com.br/contribua/?utm_source=opiniao&utm_medium=navmenu&campaign=regular" target="_blank">Contribua</a></li>
					<li><a href="https://facaparte.pstu.org.br" targe="_blank">Venha para o PSTU</a></li>
				</ul>
				<hr />
				<p style="padding-left:24px;">Siga o <b>Opinião</b></p><br />
				<div class="social-media" style="padding-left:24px;">
					<a href="https://www.facebook.com/opiniaosocialista" target="_blank" title="Facebook" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
					<a href="https://www.instagram.com/opiniaosocialista/" target="_blank" title="Instagram" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
					<a href="https://twitter.com/opsocialista" target="_blank" title="X / Twitter" aria-label="X/Twitter"><i class="fab fa-twitter"></i></a>
					<a target="_blank" href="https://t.me/JornalOpiniaoSocialistaPSTU"><i class="fab fa-telegram"></i></a>
				</div>
			</div>
		</nav>
		<div class="backdrop" onclick="openMobileMenu()"></div>
	</section>
</header>