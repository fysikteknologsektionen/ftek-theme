<?php
/**
 * Template for displaying content in course pages.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" >
				<?php the_title(); ?>
			</a>
		</h1>
		<div class="course-time">
			<?php 
			$infos = array('<span title="'.__('Course code', 'ftekcp').'">' . course_code() . '</span>',
			'<span title="'.__('Course credit', 'ftekcp').'">' . course_credit() . '</span>',
						course_pretty_classes(),
						'<span title="'. __('Study period', 'ftekcp') .'">'.__('SP', 'ftekcp').'</span> ' . course_pretty_study_periods());
			echo join( " | ", array_filter($infos) ); ?>
		</div>
	</header>

	<div class="entry-main">

		<div class="entry-content">
			<section>
				<h2><?=__('Description', 'ftek')?></h2>
				<?php the_content(); ?>
			</section>
			<?php $vbl = course_vbl(); ?>
			<?php if ($vbl) : ?>
			<section class="course-vbl">
				<h2>Veckobladeriet</h2>
				<?= $vbl ?>
			</section>
			<?php endif; ?>
		</div>

		<?php get_template_part('meta', get_post_type()) ?>

	</div>

	<footer class="entry-footer">
		<?= ftek_entry_meta( get_post_type() ); ?>
    </footer>
</article>