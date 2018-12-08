<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?> <?= bloginfo('name')?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />
	<?php if (is_home()) { ?>
 	<meta name="description" content="<?php bloginfo('description');?>" />
	<?php } ?>
  	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body>
	<header role="banner">
		<nav class="main-menu">
			<?php
			$args = array(
				'theme_location' => 'top',
				'menu_class' => 'nav-menu',
				'after' => '<a role="button" class="menu-dropdown-button"></a>'
			);
			wp_nav_menu( $args );
			?>
			<?php 
				$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if (qtrans_getLanguage() == 'sv') {
					$lang_class = "qtranxs_flag_en";
					$new_url = qtrans_convertURL($url, 'en');
				}  
				else {
					$lang_class = "qtranxs_flag_sv";
					$new_url = qtranxf_convertURL($url, 'sv', $forceadmin = false, $showDefaultLanguage = true);
				}
				$new_url = preg_replace("/^http:/", "https:", $new_url);
			?>
		</nav>
		<ul class="extra-nav">
			<li class="language"><a href="<?= $new_url ?>" title="<?=__( 'Byt till svenska', 'ftek' ) ?>" class="language-link <?= $lang_class?>"></a></li>
			<li><a href="/?s" title="<?=__( 'Search' ) ?>" class="search"></a></li>
		</ul>
	</header>
