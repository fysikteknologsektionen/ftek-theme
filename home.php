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
 * @since ftek 0.1
 */

get_header(); ?>

	<main role="main">
		<?php if ( is_active_sidebar( 'home-top' ) ) {
			dynamic_sidebar( 'home-top' );
		} ?>
		<?php if ( is_active_sidebar( 'home' ) ) {
			dynamic_sidebar( 'home' );
		} ?>
	</main>
	
<?php get_footer(); ?>