<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ftek
 * @since ftek 2.0
 */

get_header(); ?>

	<main role="main">
		<?php if ( is_active_sidebar( 'home-top' ) ) {
			dynamic_sidebar( 'home-top' );
		} ?>
		<?php if ( is_active_sidebar( 'home' ) ) {
			dynamic_sidebar( 'home' );
		} ?>

		<h1>Välkommen till <?= bloginfo('name') ?>!</h1>
		<p>Vår hemsida är under konstruktion, men alla sidor som finns i navigeringsmenyn borde fungera som de ska.</p>

	</main>
	
<?php get_footer(); ?>