<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ftek
 * @since ftek 0.1
 */

get_header(); ?>

		<section id="content" role="main" class="search-page single-page">

		<header id="search-form-wide">
            <?php get_search_form(); ?>
		</header>

		<?php if ( have_posts() ) : ?>


			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php ftek_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</section><!-- #content -->


<?php get_footer(); ?>