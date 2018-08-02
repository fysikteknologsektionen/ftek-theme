<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package ftek
 * @since ftek 2.0
 */

get_header(); ?>

	<main role="main" class="not-found-page">
		<article class="page">
			<h1><?= __('Page could not be found.', 'ftek') ?></h1>
			<?php get_search_form(); ?>
		</article>
	</main>

<?php get_footer(); ?>