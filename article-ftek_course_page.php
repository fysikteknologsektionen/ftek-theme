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


		<aside class="side-meta course-meta">
			<?php $links = course_pretty_links();
					$representatives = course_pretty_representatives(); ?>

			<?php if ($links) : ?>
			<section class="course-links">
				<h2><?= __('Links', 'ftek')?></h2>
				<?= $links ?>
			</section>
			<?php endif; ?>

			<?php if ($representatives) : ?>
			<section class="course-representatives">
				<h2><?= __('Course representatives', 'ftek') ?></h2>
				<?= $representatives ?>
			</section>
			<?php endif; ?>
		</aside>

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