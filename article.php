<?php
/**
 * The default template for displaying content.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<a href="<?php the_permalink(); ?>" class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</a>
		<?php endif; ?>

		<h1 class="entry-title hyphenate" style="background-image: url(<?=the_post_thumbnail_url('full')?>)">
			<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
		
		</h1>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ftek' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	<?php if (get_post_type( $post ) == 'post' && is_single()): ?>
        <footer class="entry-meta">
            <?php ftek_entry_meta(); ?>
        </footer><!-- .entry-meta -->
    <?php endif; ?>
</article><!-- #post -->
