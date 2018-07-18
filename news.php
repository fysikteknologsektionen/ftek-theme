<?php
/**
 Template Name: News
 */

get_header(); ?>

	<main role="main">
		<?php if ( have_posts() ) : ?>
            
			<?php /* The loop */ ?>
			<?php $home_query = new WP_Query( 'category_name=framsida' );
            while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php ftek_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</main>
	
<?php get_footer(); ?>