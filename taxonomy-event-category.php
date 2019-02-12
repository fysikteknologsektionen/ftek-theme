<?php
/**
 * The template for displaying Event Category pages.
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Redirect to calendar with query */

$url = '/kalender/?category='.get_queried_object()->slug;
wp_redirect( $url, 301); // Status code: 301 Permanently moved 
exit;
?>