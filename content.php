<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package ftek
 * @since ftek 0.1
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<a href="<?php the_permalink(); ?>" class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</a>
		<?php endif; ?>
		
		
		
		<h1 class="entry-title hyphenate">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		<?php edit_post_link( __( 'Edit', 'ftek' ), '<span class="edit-link">', '</span>' ); ?>
		</h1>
	</header><!-- .entry-header -->
	
	<?php
		// Find connected events
		$connected = new WP_Query( array(
		  'connected_type' => 'posts_to_events',
		  'connected_from' => $post,
		  'nopaging' => true,
		) );

		
		// Display connected events, commented out to prevent old events from being displayed on all pages after update to WP 3.9.1
	/*	if ( $connected->have_posts() ) :
		?>
		
		<ul class="connected-events event-info">
		<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); print "test1" ?></a>
				<span class="inline-block">
					<?= ftek_event_info(); ?>
                </span>
                <span class="inline-block">
				–
				<time class="relative-time" datetime="<?php eo_the_start('c') ?>">om ett tag</time>
                </span>
			</li>
		<?php endwhile; ?>
		</ul>			
		
		<?php 
		// Prevent weirdness
		wp_reset_postdata();
		
		endif; */
	?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ftek' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ftek' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	<?php if (get_post_type( $post ) == 'post' && is_single()): ?>
        <footer class="entry-meta">
            <?php ftek_entry_meta(); ?>
        </footer><!-- .entry-meta -->
    <?php endif; ?>
</article><!-- #post -->
