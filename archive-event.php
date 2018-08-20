<?php
/**
 * The template for displaying all events.
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Redirect to news page with event filter on */
$url = '/nyheter?post_types[]=event';
wp_redirect( $url, 301); // Status code: 301 Permanently moved 
exit;
?>