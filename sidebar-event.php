<?php
/**
 * Default template for displaying the sidebar for related events.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<aside class="related-posts">
    <h1><?= __('Future events', 'event-organiser') ?></h1>
    
    <?php
    $content = '
    <a href="%event_url%" title="%event_title_attr%">
    <article class="post">
        <header class="entry-header">
            %event_thumbnail{full}%
            <h1 class="entry-title hyphenate">%event_title%</h1>
            <p><time class="relative-time" datetime="%start{c}{}%">%start%</time></p>
        </header>
        <div class="entry-content excerpt">
            <p>%event_excerpt{20}%</p>
        </div>
    </article>
    </a>';
    $shortcode = '[eo_events showpastevents="false" numberposts="5" no_events="Inga evenemang."]'.$content.'[/eo_events]';
    echo do_shortcode($shortcode);
    ?>
</aside>