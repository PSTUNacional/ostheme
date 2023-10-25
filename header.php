<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!-- Meta tags -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-language" content="pt-br">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="follow">
	<meta name="description" content="O jornal oficial do PSTU. Uma visão socialista do mundo a serviço da classa trabalhadora.">

	<meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title('|', 1, 'right').' | '.bloginfo('name'); ?>"/>
	<meta property="og:type" content="article"/>
	<meta property="og:description" content="O jornal oficial do PSTU"/>
	<meta property="og:site_name" content="Opinião Socialista"/>
	<meta property="or:url" content=""/>
	<!-- End of Meta tags -->

	<!-- CSS -->
	<link rel="icon" type="image/x-icon" href=<?= get_template_directory_uri() . "/assets/img/favicon.gif" ?>>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<title><?php is_front_page() ? bloginfo('name') : wp_title('|', 1, 'right').' | '.bloginfo('name'); ?></title>

	<?php wp_head(); ?>



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
<?php
	include('nav.php');
?>