<?php
/**
 * ftek theme back compat functionality.
 *
 * Prevents ftek theme from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backwards compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package ftek
 * @since ftek 0.1
 */

/**
 * Prevent switching to ftek theme on old versions of WordPress. Switches
 * to the default theme.
 *
 * @since ftek 0.1
 *
 * @return void
 */
function ftek_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'ftek_upgrade_notice' );
}
add_action( 'after_switch_theme', 'ftek_switch_theme' );

/**
 * Prints an update nag after an unsuccessful attempt to switch to
 * ftek theme on WordPress versions prior to 3.6.
 *
 * @since ftek 0.1
 *
 * @return void
 */
function ftek_upgrade_notice() {
	$message = sprintf( __( 'ftek theme requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ftek' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since ftek 0.1
 *
 * @return void
 */
function ftek_customize() {
	wp_die( sprintf( __( 'ftek theme requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ftek' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'ftek_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since ftek 0.1
 *
 * @return void
 */
function ftek_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'ftek theme requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ftek' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'ftek_preview' );