<?php
/**
 * The template for displaying Event Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Redirect to news feed with query */

$url = '/nyheter/?post_types[]=event&category[]='.get_queried_object()->slug;
wp_redirect( $url, 301); // Status code: 301 Permanently moved 
exit;
?>