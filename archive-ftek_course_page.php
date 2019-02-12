<?php
/**
 * The template for displaying all course pages.
 *
 * @package ftek
 * @since ftek 2.0
 */

/* Redirect to all courses page */

$url = '/kurser';
wp_redirect( $url, 301); // Status code: 301 Permanently moved 
exit;
?>