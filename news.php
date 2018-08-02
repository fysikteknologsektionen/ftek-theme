<?php
/**
 * The template for displaying news feed.
 *
 * @package ftek
 * @since ftek 2.0
 */
?>

<?php

    $sc_prefix = '[ajax_load_more ';
    $sc_suffix = ']';

    /* Post types */
    $all_post_types = array('post', 'event');
    $post_types = $_GET['post_types'];
    if (!$post_types) {
        $post_types = $all_post_types;
    }
    $post_types = array_intersect($post_types, $all_post_types);
    $sc_post_types = join(',', $post_types);

    /* Categories */
    $all_categories = array_map(function($o) { return $o->slug; }, get_categories());
    $categories = $_GET['category'];
    if (!$categories) {
        $sc_categories = $all_categories;
    }
    $categories = array_intersect($categories, $all_categories);
    $sc_categories = join(',', $categories);

    /* Options */
    $sc_options = array(
        'post_type' => $sc_post_types,
        'category' => $sc_categories,
        'taxonomy_terms' => $sc_categories,
        /* Default options don't change */
        'taxonomy' => 'event-category',
        'taxonomy_relation' => 'OR',
        'posts_per_page' => '12',
        'transition_container' => 'false',
        'scroll' => 'true',
        'scroll_distance' => '-250',
        'progress_bar' => 'true',
        'progress_bar_color' => '8d0000',
        'button_label' => '...',
        'button_loading_label' => '...',
    );

    if ($sc_options['category'] === '')
        unset($sc_options['category']);
    /*
    foreach ($sc_options as $key => &$value)
        $value = '"' . $value . '"';

    $sc_args = urldecode(http_build_query($sc_options, '', ' '));
    $shortcode = $sc_prefix . $sc_args . $sc_suffix;

    echo do_shortcode($shortcode);*/
    print_ajax_loader($sc_options);
?>