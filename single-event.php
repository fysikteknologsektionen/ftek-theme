<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package ftek
 * @since ftek 0.1
 */

get_header(); ?>
		<section id="content" role="main" class="single-event single-page">
			<div class="content-inner">

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
					</section><!-- .entry-content -->
					
					<footer>
						<div class="event-map">
							<?php echo eo_get_venue_map(eo_get_venue(), array('width'=>'100%','height'=>'400px')); ?>
						</div>
						<div class="related-news">
						<?php
						    // Find connected events
						    $connected = new WP_Query( array(
						      'connected_type' => 'posts_to_events',
						      'connected_to' => $post,
						      'nopaging' => true,
						    ) );
						    
						    // Display connected events
						    if ( $connected->have_posts() ) :
						    ?>
						    <h2> 
						    	<?php _e("Related news", "ftek") ?>
						    </h2>
						    <ul class="connected-posts">
						    <?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
						    	<li>
						    		<a href="<?php the_permalink(); ?>">
						    			<?php the_title(); ?> 
						    		</a>
						    	</li>
						    <?php endwhile; ?>
						    </ul>
						    
						    <?php 
						    // Prevent weirdness
						    wp_reset_postdata();
						    
						    endif;
						?>
						</div>
					</footer>
				</article><!-- #post -->

			<?php endwhile; ?>
			</div>
		</section><!-- #content -->


<?php get_footer(); ?>
