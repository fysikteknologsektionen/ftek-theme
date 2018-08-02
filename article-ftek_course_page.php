<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
				<header class="entry-header">
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
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
			

				<aside class="course-meta">
					<?php $links = course_pretty_links();
						  $representatives = course_pretty_representatives(); ?>

					<?php if ($links) : ?>
					<div class="course-links">
						<h2><?= __('Links', 'ftek')?></h2>
						<?= $links ?>
					</div>
					<?php endif; ?>

					<?php if ($representatives) : ?>
					<div class="course-representatives">
						<h2><?= __('Course representatives', 'ftek') ?></h2>
						<?= $representatives ?>
					</div>
					<?php endif; ?>
				</aside>


				<div class="entry-content">
					<?php the_content(); ?>
					
					<?php $vbl = course_vbl(); ?>
					<?php if ($vbl) : ?>
					<div class="course-vbl">
						<h2>Veckobladeriet</h2>
						<?= $vbl ?>
					</div>
					<?php endif; ?>
				</div>

			</article>