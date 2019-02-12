<?php
/**
 * The template for displaying all events.
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Redirect to calendar */
/*
$dates = array(
    'yearnum' => get_query_var('year'),
    'monthnum' => get_query_var('monthnum'),
    'daynum' => get_query_var('day'),
);
$url = '/kalender/?'.http_build_query($dates, '&');
*/
$url = '/kalender/';
wp_redirect( $url, 301); // Status code: 301 Permanently moved 
exit;
?>