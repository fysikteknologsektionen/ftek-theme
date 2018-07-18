<?php
/**
 * The template for displaying all single posts
 *
 * @package ftek
 * @since ftek 0.1
 */

get_header(); ?>

	<main role="main" class="single-page">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>
			<?php ftek_post_nav(); ?>

		<?php endwhile; ?>

    </main>

<?php get_footer(); ?>