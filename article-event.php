<?php
/**
 * Template for displaying content in events.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('main-post'); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<?php the_post_thumbnail('full', array('class' => 'entry-thumbnail')); ?>
		<?php endif; ?>
		
		<h1 class="entry-title hyphenate">
			<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
			
		</h1>
	</header>
	
	<div class="entry-main">
		
		<div class="entry-content">
			<div class="event-info">
				<?= ftek_event_info(); ?>
			</div>
			<?php the_content(); ?>
		</div>

	</div>
	
    <footer class="entry-footer">
		<?= ftek_entry_meta( get_post_type() ); ?>
    </footer>
</article>
