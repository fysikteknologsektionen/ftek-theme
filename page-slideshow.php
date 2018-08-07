<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php
/**
 * Empty template for the slideshow to be displayed on the TV.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<head>
<meta http-equiv="refresh" content="900">

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?><?= bloginfo('name')?></title>
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" />
  	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php /*body_class();*/ ?>>
	<div id="page">

	<section id="content" class="committee-page single-page">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
				<?php get_template_part( 'article', 'page' ); ?>
			<?php endwhile; ?>
			
		<?php else : ?>
			<?php get_template_part( 'article', 'none' ); ?>
		<?php endif; ?>

	</section><!-- #content -->

</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>
