<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package ftek
 * @since ftek 2.0
 */


get_header(); ?>
	<main role="main">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php /*
				<nav id="committee" class="horizontal">
                    <?= committee_menu($post); ?>
				</nav> */?>
				<?php get_template_part( 'article', 'page' ); ?>
			<?php endwhile; ?>

			<?php ftek_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'article', 'none' ); ?>
		<?php endif; ?>

	</main>
<?php get_footer(); ?>
