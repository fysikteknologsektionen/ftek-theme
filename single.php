<?php
/**
 * The template for displaying all single posts
 *
 * @package ftek
 * @since ftek 2.0
 */

get_header(); ?>

	<main role="main">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'article', get_post_type() ); ?>
			<?php //ftek_post_nav(); ?>

		<?php endwhile; ?>

    </main>

<?php get_footer(); ?>