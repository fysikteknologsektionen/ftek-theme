<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Get posts IDs from search results */
$post_ids = array();
while ( have_posts() ) : the_post();
   $post_ids[] = $post->ID; // Build array of post IDs
endwhile; wp_reset_query();

get_header(); ?>

		<main role="main" class="search-page">
			<article class="page">
			
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="<?= $_SERVER['REQUEST_URI'] ?>"><?= __('Search') ?></a>
					</h1>
					<?= get_search_form() ?>
				</header>
				<div class="entry-content">
					<?php 
						$sc_options = array(
							'post__in' => join(',', $post_ids), // Include posts from search
							'post_type' => 'any',
							'posts_per_page' => '12',
							'transition_container' => 'false',
							'scroll' => 'true',
							'scroll_distance' => '-250',
							'progress_bar' => 'true',
							'progress_bar_color' => '8d0000',
							'button_label' => '...',
							'button_loading_label' => '...',);
						print_ajax_loader($sc_options);
					?>
				</div>
		</main>

<?php get_footer(); ?>