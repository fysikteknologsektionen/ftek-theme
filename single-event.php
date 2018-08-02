<?php
/**
 * The template for displaying single events.
 *
 *
 * @package ftek
 * @since ftek 2.0
 */

get_header(); ?>

		<main role="main" class="single-event">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="event-<?php the_ID(); ?>" 
				<?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="entry-meta event-info">
                            <?= ftek_event_info(); ?>
                             – 
                             <time class="relative-time" datetime="<?php eo_the_start('c') ?>">
                                 om ett tag
                             </time>
						</div>
					</header><!-- .entry-header -->

					<section class="entry-content">
						<?php the_content(); ?>
					</section>
					
					<footer>
						<div class="event-map">
							<?php echo eo_get_venue_map(eo_get_venue(), array('width'=>'100%','height'=>'400px')); ?>
						</div>
					</footer>
				</article>

			<?php endwhile; ?>
		</main>


<?php get_footer(); ?>
