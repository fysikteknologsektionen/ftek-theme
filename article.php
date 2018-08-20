<?php
/**
 * Default template for displaying content.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php get_template_part('entry', 'header'); ?>
	
	<div class="entry-main">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<?php if (get_page_template_slug($post->post_parent) === 'page-group.php') : ?>
			<?php get_template_part( 'meta', 'group' ); ?>
		<?php else : ?>
			<?php get_template_part( 'meta', get_post_type() ) ?>
		<?php endif; ?>
		
	</div>

	<footer>
		<?= ftek_entry_meta() ?>
	</footer>
</article>