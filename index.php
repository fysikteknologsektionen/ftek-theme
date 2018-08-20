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

	<main role="main" class="home">
		<div class="widget-container widget-single">
		<?php if ( is_active_sidebar( 'home-top' ) ) {
			dynamic_sidebar( 'home-top' );
		} ?>
		</div>
		<div class="widget-container widget-column">
		<?php if ( is_active_sidebar( 'home' ) ) {
			dynamic_sidebar( 'home' );
		} ?>
		</div>
	</main>
	
<?php get_footer(); ?>