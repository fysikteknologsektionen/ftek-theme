<?php
/**
 * The template for displaying all single posts
 *
 * @package ftek
 * @since ftek 0.1
 */

get_header(); ?>


	<main role="main" class="course-page single-page">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'ftek_course_page' ); ?>
		<?php endwhile; ?>

    </main>

<?php get_footer(); ?>