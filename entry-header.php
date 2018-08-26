<?php
/**
 * Template for displaying headers in articles.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<header class="entry-header">
		<h1 class="entry-title hyphenate <?= has_post_thumbnail() || has_post_thumbnail($post->post_parent) ? 'featured-image"':'' ?>
			<?php if (has_post_thumbnail()) {
				echo 'style="background-image: url(';
				the_post_thumbnail_url('full');
				echo ');';
			} elseif (has_post_thumbnail($post->post_parent)) {
				echo 'style="background-image: url(';
				echo wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'full' )[0];
				echo ');';
			} ?>
		">
			<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
			<?php
			if (has_post_thumbnail()) {
				echo '<img style="opacity:0;width:0;height:0;position:absolute;" src="';
				the_post_thumbnail_url('full');
				echo '" />';
			} elseif (has_post_thumbnail($post->post_parent)) {
				echo '<img style="opacity:0;width:0;height:0;position:absolute;" src="';
				echo wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'full' )[0];
				echo '" />';
			} ?>
        </h1>
</header>