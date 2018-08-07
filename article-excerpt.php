<?php
/**
 * Template for displaying excerpt content.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>


<article id="post-<?= get_the_ID()?>" <?= post_class(!has_post_thumbnail() ? 'has-post-thumbnail' : '') ?>>
	<header class="entry-header">
        <h1 class="entry-title hyphenate">
            <?= the_title() ?>
        </h1>
        <p class="entry-meta">
            
        </p>
        <?php if ( has_post_thumbnail() ) { ?>
            <p class="entry-thumbnail">
                <?php the_post_thumbnail('medium_large'); ?>
            </p>
        <?php }?>
	</header>
    <section class="entry-content excerpt">
        <?php the_excerpt(); ?>
    </section>
</article>