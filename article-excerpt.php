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
        <div class="entry-meta">
            <p class='entry-published'>
                <?= __('Published', 'ftek').' ' ?>
                <time class='relative-time' datetime='<?= get_the_time("c") ?>' >
                    <?= date_i18n( get_option('date_format'), strtotime(get_the_time("c"))) ?>
                </time>
            </p>
            <?php 
                if ( get_post_type() === 'post' ) {
                    echo '<ul class="post-categories">';
                    foreach((get_the_category()) as $category) {
                        echo '<li>'.$category->cat_name.'</li>';
                    }
                    echo '</ul>';
                }
            ?>
        </div>
    </header>
    
    <div class="entry-content excerpt">
        <?php 
        if (get_post_type() === 'event') { ?>
            <div class="event-info">
                <?= ftek_event_info(true); ?>
            </div>
        <?php
        } else {
            the_excerpt();
        }
        ?>
    </div>

</article>