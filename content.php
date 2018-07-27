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
