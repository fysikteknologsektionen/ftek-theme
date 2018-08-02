<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Redirect to news feed with query */

$url = '/nyheter/?category[]='.get_queried_object()->slug;
wp_redirect( $url, 301); // Status code: 301 Permanently moved 
exit;
/*
					<header class="archive-header">
						<h1 class="archive-title"><a href="<?= get_category_link( get_queried_object()->term_id ) ?>"><?php printf( __( '%s News', 'ftek' ), __(single_cat_title( '', false )) ); ?></a></h1>
						<a href="/<?= get_queried_object()->slug ?>"><?= __('Go to page', 'ftek') ?></a>
						<?php if ( category_description() ) : // Show an optional category description ?>
							<div class="archive-meta"><?php echo category_description(); ?></div>
						<?php endif; ?>
					</header>
*/
?>