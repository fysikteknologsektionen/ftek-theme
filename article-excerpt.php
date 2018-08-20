<?php
/**
 * Template for displaying excerpt content.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>


<article id="post-<?= get_the_ID()?>" <?= post_class( (!has_post_thumbnail() ? 'has-post-thumbnail' : '') .'excerpt' ) ?>>
	<header class="entry-header">
        <?php if ( has_post_thumbnail() ) { ?>
                <?php the_post_thumbnail('medium_large', array('class' => 'entry-thumbnail')); ?>
        <?php }?>
        <h1 class="entry-title hyphenate">
            <?= the_title() ?>
        </h1>
    </header>
    
    <div class="entry-content excerpt">
        <p>
        <?php // Get first two sentences of excerpt ?>
        <?= preg_replace('/(.*?[?!.](?=\s|$).*?[?!.](?=\s|$)).*/', '\\1', strip_tags( get_the_excerpt() )); ?>
        </p>
    </div>

</article>