<?php
/**
 * The template for displaying date archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Load news page with date query */
$dates = array(
    'yearnum' => get_query_var('year'),
    'monthnum' => get_query_var('monthnum'),
    'daynum' => get_query_var('day'),
);

$url = '/nyheter/?'.http_build_query($dates, '&');
wp_redirect( $url, 301); // Status code: 301 Permanently moved 
exit;
?>