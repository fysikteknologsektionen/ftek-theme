<?php
/**
 * The template for displaying single events.
 *
 * @package ftek
 * @since ftek 2.0
 */


get_header(); ?>

	<main role="main" class="post-page">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
                <?php // Main post ?>
                <?php get_template_part( 'article', get_post_type() ); ?>
                
                <?php // Related posts ?>
                <?php get_template_part( 'sidebar', get_post_type() ); ?>

			<?php endwhile; ?>
			<?php else : ?>
				<?php get_template_part( 'article', 'none' ); ?>
			<?php endif; ?>

	</main>

<?php get_footer(); ?>
