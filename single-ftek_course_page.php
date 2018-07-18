<?php
/**
 * The template for displaying all single posts
 *
 * @package ftek
 * @since ftek 0.1
 */

get_header(); ?>


	<section id="content" class="course-page single-page">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'ftek_course_page' ); ?>
		<?php endwhile; ?>

    </section>

<?php get_footer(); ?>