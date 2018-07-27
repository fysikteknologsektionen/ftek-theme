<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?> <?= bloginfo('name')?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />
  	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body>
	<header role="banner">
		<nav>
			<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_class' => 'nav-menu' ) ); ?>
		</nav>
		<div class="top-bar">
			<menu>
			<?php 
				$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if (qtrans_getLanguage() == 'sv') {
					$new_lang = "English";
					$lang_class = "lang-en";
					$new_url = qtrans_convertURL($url, 'en');
				}  
				else {
					$new_lang = "Svenska";
					$lang_class = "lang-sv";
					$new_url = qtranxf_convertURL($url, 'sv', $forceadmin = false, $showDefaultLanguage = true);
				}
				$new_url = preg_replace("/^http:/", "https:", $new_url);
			?>
				<li><a href="<?= $new_url ?>" title="<?=__( 'Byt till svenska', 'ftek' ) ?>" class="language-link <?= $lang_class?>"><?= $new_lang?></a></li>
			<?php if (!is_user_logged_in()) { ?>
				<li><a href="<?= wp_registration_url( get_permalink() ); ?>" class="register-link"><?= __( 'Register', 'ftek' ) ?></a></li>
				<li><a href="<?= wp_login_url( get_permalink() ); ?>" class="login-link"><?= __( 'Login', 'ftek' ) ?></a></li>
			<?php } else { ?>
				<li><a href="<?= admin_url( 'profile.php' ); ?>" class="settings-link"><?= __( 'Settings', 'ftek' ) ?></a></li>
				<li><a href="<?= wp_logout_url( get_permalink() ); ?>" class="logout-link"><?= __( 'Logout', 'ftek' ) ?></a></li>
				
			<?php } ?>
				<li><?php get_search_form(); ?></li>
			</menu>
		</div>
	</header>
