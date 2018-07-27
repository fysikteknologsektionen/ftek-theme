<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package ftek
 * @since ftek 2.0
 */

get_header(); ?>

	<main role="main" class="page-404">
		<h1><?= __('Page could not be found.', 'ftek') ?></h1>
		<?php get_search_form(); ?>
	</main>

<?php get_footer(); ?>