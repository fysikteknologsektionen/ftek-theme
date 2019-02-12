<?php
/**
 * Template for displaying the meta sidebar in group pages (committees, functionaries and societies).
 *
 * @package ftek
 * @since ftek 2.0
 */

 global $post;

?>

<aside class="side-meta group-meta">
    <?php
    $parent_query = false;

    if (get_page_template_slug() !== 'page-group.php' && get_page_template_slug($post->post_parent) === 'page-group.php') {
        $args = array(
            'p'         => $post->post_parent,
            'post_type' => 'page'
        );
        $parent_query = new WP_Query($args);
        if ($parent_query->have_posts()) {
            $parent_query->the_post(); 
        }
    }

    $category = get_category_by_slug(get_post_field('post_name'));
    
    /* Logo */
    $logo = ftek_group_logo( $category->cat_ID );
    if ( $logo ) { ?>
        <section class="group-logo">
            <a href="<?=get_permalink()?>"><img src="<?=$logo?>" alt="logo" /></a>
        </section>
    <?php } else {
        $parent_ID = $post->post_parent;
        $is_parent = true;
        if ( !$parent_ID ) {
            $parent_ID = $post->ID;
        } 
        ?>
        <h1><a href="<?= get_permalink($parent_ID) ?>"><?= get_the_title($parent_ID) ?></a></h1>
    <?php }

    /* Sub-pages */
    $menu = ftek_page_menu($post);
    if($menu) : ?>

    <section class="entry-menu">
        <h2><?= __('Related pages', 'ftek') ?></h2>
        <?= $menu ?>
    </section>

    <?php endif;

    /* News */

    // Get events
    $events = eo_get_events(array(
        'numberposts'=>3,
        'event_start_after'=>'today',
        'event-category' => $category->slug,
    ));

    // Get posts
    $the_query = new WP_Query( array( 'category_name' => $category->slug, 'posts_per_page' => 3 ) ); ?>

    <?php if( $events || $the_query->have_posts() ) : ?>
    <section class="group-news">
        <h2><?=sprintf(__('%s News', 'ftek'), get_the_title())?></h2>
        <ul>
            <?php foreach ($events as $event):
            $format = ( eo_is_all_day($event->ID) ? get_option('date_format') : get_option('date_format').' '.get_option('time_format') ); ?>
            <li class="group-news-event">
            
                <a href="<?=get_permalink($event->ID)?>">
                    <?=get_the_title($event->ID)?>
                </a>
                —
                <time datetime="<?=eo_get_the_start( 'c', $event->ID, $event->occurrence_id )?>" class="relative-time">
                    <?=eo_get_the_start( $format, $event->ID, $event->occurrence_id )?>
                </time>
            </li>
            <?php endforeach; ?>

            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <li class="group-news-post" title="<?=substr(get_the_excerpt(),0, 100).'&hellip;'?>">
                <a href="<?=get_permalink()?>">
                    <?= get_the_title();?>
                </a>
                —
                <time datetime="<?=get_the_date( 'c' )?>" class="relative-time">
                    <?=date_i18n( get_option('date_format'), strtotime(get_the_date( 'c' )))?>
                </time>
            </li>
            <?php endwhile; ?>
            <?php if ($parent_query) { $parent_query->reset_postdata(); } else { wp_reset_postdata(); } ?>
        </ul>
        <p><a href="<?= get_category_link( $category->cat_ID ) ?>"><?=__('More news from','ftek').' '?> <?php the_title() ?> &rarr;</a></p>
        </section>
    <?php endif; ?>


    <?php 
    /* Contact */
    $contact_email = wp_get_terms_meta($category->cat_ID, 'email' , true);
    $contact_social = wp_get_terms_meta($category->cat_ID, 'social' , true);
    if ( $contact_email !== '' || $contact_social ) { ?>
        <section class="group-contact">
            <h2><?= __('Contact', 'ftek')?></h2>
            <ul>
                <?php if ($contact_email) : ?>
                <li><a href="mailto:<?=$contact_email?>" target="_blank"><?=$contact_email?></a></li>
                <?php endif; ?>
                <?php if ($contact_social) : ?>
                <li><a href="<?=$contact_social?>" target="_blank">Facebook</a></li>
                <?php endif; ?>
            </ul>
        </section>
    <?php }

    /* Social */
    $social = array('facebook', 'instagram', 'snapchat');
    $html = '<section class="group-social"><ul>';
    foreach ($social as $s) {
        $link = wp_get_terms_meta($category->cat_ID, $s , true);
        if ($link) {
            $html .= "<li><a href='$link' target='_blank' class='social-button' title='".ucfirst($s)."'><img src='".get_stylesheet_directory_uri()."/images/$s.png' alt='$s' /></a></li>";
        }
    }
    if ($html !== '<section class="group-social"><ul>') {
        $html .= '</ul></section>';
        echo $html;
    }

    /* Reset loop */
    if ($parent_query) { wp_reset_postdata(); } 

    ?>
</aside>