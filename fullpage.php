<?php
/**
 Template Name: Helsida
 */

get_header(); ?>
	<main role="main" class="fullpage">
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php ftek_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

	</main><!-- #content -->
	
<?php get_footer(); ?>