<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ftek
 * @since ftek 2.0
 */

get_header(); ?>

		<main role="main">
<?php /*

			<header class="archive-header">
				<h1 class="archive-title"><a href="<?= get_category_link( get_the_category()[0]->term_id ) ?>"><?php printf( __( '%s News', 'ftek' ), single_cat_title( '', false ) ); ?></a></h1>
				<a href=""><?= __('Go to page', 'ftek') ?></a>
				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->

			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php ftek_paging_nav(); ?>

		<?php else : ?>
			<p><?= __('No posts found.', 'ftek') ?></p>
		<?php endif; ?>

		*/?>
		<header class="archive-header">
				<h1 class="archive-title"><a href="<?= get_category_link( get_queried_object()->term_id ) ?>"><?php printf( __( '%s News', 'ftek' ), __(single_cat_title( '', false )) ); ?></a></h1>
				<a href="/<?= get_queried_object()->slug ?>"><?= __('Go to page', 'ftek') ?></a>
				<?= var_dump() ?>
				<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
		</header>
		<?=
		do_shortcode('[ajax_load_more id="2850290340" category="'. get_queried_object()->slug .'" post_type="post, event" posts_per_page="12" transition_container="false" scroll="true" progress_bar="true" progress_bar_color="8d0000" button_label="..." button_loading_label="..."]');
		?>
		</main>

<?php get_footer(); ?>