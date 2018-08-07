<?php
/**
 * Template for displaying content in pages.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title hyphenate <?= has_post_thumbnail() || has_post_thumbnail($post->post_parent) ? 'featured-image"':'' ?>
			<?php if (has_post_thumbnail()) {
				echo 'style="background-image: url(';
				the_post_thumbnail_url('full');
				echo ');';
			} else if (has_post_thumbnail($post->post_parent)) {
				echo 'style="background-image: url(';
				echo wp_get_attachment_image_src( get_post_thumbnail_id($post->post_parent), 'full' )[0];
				echo ');';
			} ?>
		">
			<a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
		</h1>
	</header>
	
	<div class="entry-main">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>

	<footer>
		<?php
			$date_updated = get_the_modified_time("c");
			$date_short = date_i18n( get_option('date_format'), strtotime($date_updated));
			$date_long = date_i18n( 'j F, Y', strtotime($date_updated)).' '.date_i18n( get_option('time_format'), strtotime($date_updated));
		?>
		<div class="entry-meta">
			<span class="entry-updated">
				<?=__('Latest updated', 'ftek').' '?>
				<time class="relative-time" datetime="<?=$date_updated?>" title="<?=$date_long?>">
					<?= $date_short ?>
				</time>.
			</span>
		</div>
	</footer>
</article>
