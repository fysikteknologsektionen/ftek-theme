<?php
/**
* ftek theme functions and definitions.
*
* Sets up the theme and provides some helper functions, which are used in the
* theme as custom template tags. Others are attached to action and filter
* hooks in WordPress to change core functionality.
*
* When using a child theme (see http://codex.wordpress.org/Theme_Development
* and http://codex.wordpress.org/Child_Themes), you can override certain
* functions (those wrapped in a function_exists() call) by defining them first
* in your child theme's functions.php file. The child theme's functions.php
* file is included before the parent theme's file, so the child theme
* functions would be used.
*
* Functions that are not pluggable (not wrapped in function_exists()) are
* instead attached to a filter or action hook.
*
* For more information on hooks, actions, and filters,
* see http://codex.wordpress.org/Plugin_API
*
* @package ftek
* @since ftek 1.0
*/

// set the default timezone to use. Available since PHP 5.1 03
date_default_timezone_set('Europe/Stockholm');

/**
* ftek theme only works in WordPress 3.6 or later.
*/
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
require get_template_directory() . '/inc/back-compat.php';

/**
* Sets up theme defaults and registers the various WordPress features that
* ftek theme supports.
*
* @uses load_theme_textdomain() For translation/localization support.
* @uses add_editor_style() To add Visual Editor stylesheets.
* @uses add_theme_support() To add support for automatic feed links, post
* formats, and post thumbnails.
* @uses register_nav_menu() To add support for a navigation menu.
* @uses set_post_thumbnail_size() To set a custom post thumbnail size.
*
* @since ftek 2.0
*
* @return void
*/
function ftek_setup() {
	/*
	* Makes ftek theme available for translation.
	*
	* Translations can be added to the /languages/ directory.
	* If you're building a theme based on ftek theme, use a find and
	* replace to change 'ftek' to the name of your theme in all
	* template files.
	*/
	load_theme_textdomain( 'ftek', get_template_directory() . '/languages' );
	
	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	// Deactivated because of bugs: https://core.trac.wordpress.org/ticket/17154
	// If we make a custom stylesheet for editor with workarounds it might work
	
	// add_editor_style( array( 'style.css' ) );
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	
	// This theme uses one main top menu.
	register_nav_menu( 'top', __( 'Top Menu', 'ftek' ) );
	
	/*
	* This theme uses a custom image size for featured images, displayed on
	* "standard" posts and pages.
	*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600, 100, true );
	
	// This theme uses its own gallery styles.
	//add_filter( 'use_default_gallery_style', '__return_false' );
	
	// Allows use of shortcodes in the text widget
	add_filter('widget_text', 'do_shortcode');
}

add_action( 'after_setup_theme', 'ftek_setup' );

/**
* Enqueues scripts and styles for front end.
*
* @since ftek 2.0
*
* @return void
*/
function ftek_scripts_styles() {
	
	wp_enqueue_script( 'jquery-timeago', get_template_directory_uri() . '/js/jquery.timeago.js', array( 'jquery' ), '1.3.0', true );
	wp_enqueue_script( 'ftek-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), null, true );
	$ftek_info = array('language' => get_bloginfo("language") );
	wp_localize_script( 'ftek-script', 'ftek_info', $ftek_info );
	wp_enqueue_script( 'ftek-hyphenator', get_template_directory_uri() . '/js/hyphenator.js', false, '2014-02-22', true);
	wp_enqueue_style( 'ftek-style', get_stylesheet_uri(), array(), null, 'all');
	//wp_enqueue_style( 'ftek-style-print', get_stylesheet_directory_uri(), array(), null, 'print');
	
	// Calendar page
	if ( is_page( 'kalender' ) ) {
		wp_enqueue_script( 'ftek-calendar-script', get_template_directory_uri() . '/js/calendar.js', array( 'jquery' ), null, true );
		wp_localize_script( 'ftek-calendar-script', 'get_vars', $_GET );
	}
}
add_action( 'wp_enqueue_scripts', 'ftek_scripts_styles' );


function ftek_widgets_init() {
	
	// Homepage top widget (one column)
	register_sidebar( array(
		'name'          => "Homepage top",
		'id'            => 'home-top',
		'description'   => "Fullpage widget at top",
		'before_widget' => '<section id="%1$s" class="widget-top %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',)
	);
	
	// Homepage middle widget (multiple columns)
	register_sidebar( array(
		'name'          => "Homepage middle",
		'id'            => 'home',
		'description'   => "Widgets in multiple columns on homepage",
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
		)
	);
}
add_action( 'widgets_init', 'ftek_widgets_init' );


if ( ! function_exists( 'ftek_paging_nav' ) ) :
	/**
	* Displays navigation to next/previous set of posts when applicable.
	*
	* @since ftek 2.0
	*
	* @return void
	*/
	function ftek_paging_nav() {
		global $wp_query;
		
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 )
		return;
		?>
		<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'ftek' ); ?></h1>
		<div class="nav-links">
		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'ftek' ) ); ?></div>
		<?php endif; ?>
		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'ftek' ) ); ?></div>
		<?php endif; ?>
		</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'ftek_post_nav' ) ) :
	/**
	* Displays navigation to next/previous post when applicable.
	*
	* @since ftek theme 1.0
	*
	* @return void
	*/
	function ftek_post_nav() {
		global $post;
		
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		
		if ( ! $next && ! $previous )
		return;
		?>
		<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'ftek' ); ?></h1>
		<div class="nav-links">
		<div class="nav-previous"><?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'ftek' ) ); ?></div>
		<div class="nav-next"><?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'ftek' ) ); ?></div>
		</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

if ( ! function_exists( 'ftek_entry_meta' ) ) :
	/**
	* Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	*
	* Create your own ftek_entry_meta() to override in a child theme.
	*
	* @since ftek 2.0
	*
	* @return void
	*/
	function ftek_entry_meta( $post_type ) {
		echo "<div class='entry-meta'>";
		if ( $post_type == 'post' ) {
			$categories_list = get_the_category_list();
			if ( $categories_list ) {
				echo $categories_list;
			}
		}
		echo ftek_updated_meta( $post_type );
		echo '</div>';
	}
endif;

if ( ! function_exists( 'ftek_the_attached_image' ) ) :
	/**
	* Prints the attached image with a link to the next attached image.
	*
	* @since ftek 2.0
	*
	* @return void
	*/
	function ftek_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'ftek_attachment_size', array( 724, 724 ) );
		$next_attachment_url = wp_get_attachment_url();
		
		/**
		* Grab the IDs of all the image attachments in a gallery so we can get the URL
		* of the next adjacent image in a gallery, or the first image (if we're
		* looking at the last image in a gallery), or, in a gallery of one, just the
		* link to that image file.
		*/
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => -1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
			) );
			
			// If there is more than 1 attachment in a gallery...
			if ( count( $attachment_ids ) > 1 ) {
				foreach ( $attachment_ids as $attachment_id ) {
					if ( $attachment_id == $post->ID ) {
						$next_id = current( $attachment_ids );
						break;
					}
				}
				
				// get the URL of the next image attachment...
				if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );
				
				// or get the URL of the first image attachment.
				else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
			}
			
			printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( array( 'echo' => false ) ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif;


/*
* Begin own stuff (not reused from Twenty Thirteen theme)
*/


function ftek_disable_profile_fields() {
	global $pagenow;
	
	// Only show on profile page for non-admins
	if ($pagenow == 'profile.php' && !current_user_can( 'manage_options' )) { ?>
		<script>
		jQuery(document).ready(function ($) {
			if ($('input[name=email]').length) {
				$('h2:nth-of-type(3), h2:nth-of-type(3) + table, \
				h2:nth-of-type(2), \
				h2:nth-of-type(4), \
				tr.user-comment-shortcuts-wrap, \
				tr.user-email-wrap, \
				tr.user-admin-color-wrap, \
				h3:nth-of-type(1), h3:nth-of-type(1) + ul, \
				h3:nth-of-type(2), h3:nth-of-type(2) + table, \
				div#screen-meta-links, \
				div#wpfooter \
				').css("display","none");
			}
		});
		</script>
		<?php
	}
}
add_action('admin_footer', 'ftek_disable_profile_fields');


function set_default_admin_color($user_id) {
	$args = array(
		'ID' => $user_id,
		'admin_color' => 'midnight'
	);
	wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');



function generate_footer_quote()
{
	$quotes = array(
		"It is terror for the evil man to awake in darkness and see The Phantom.",
		"He who looks upon the Phantom's face will die a horrible death.",
		"There are times when the Phantom leaves the jungle and walks the streets of the town like an ordinary man.",
		"You never find the Phantom – he finds you.",
		"When the Phantom asks, you answer.",
		"When the Phantom moves, lightning stands still.",
		"The voice of the Phantom turns the blood to ice.",
		"The Phantom has the strength of ten tigers.",
		"The Phantom has a thousand eyes and a thousand ears.",
		"The Phantom moves as silently as the jungle cat.",
		"The Phantom is rough with roughnecks.",
		"Never point a gun at the Phantom.",
		"Learn to love the darkness."
	);
	return $quotes[array_rand($quotes)];
}

/*
* Pretty printing for event stuff
*/

function ftek_event_info() {
	$result = ftek_event_date();
	$venue = eo_get_venue_name();
	if ($venue != '') {
		$result .= ' @ <a href="/evenemang/plats/'. eo_get_venue_slug() .'" title="Evenemang på '. $venue .'">'. $venue . '</a>';
	}
	return $result;
}

function ftek_event_date() {
	$date_format = get_option('date_format');
	$time_format = get_option('time_format');
	if ( eo_is_all_day() ) {
		$start_date = eo_get_the_start($date_format);
		$end_date = eo_get_the_end($date_format);
		if ($start_date == $end_date) {
			return $start_date;
		}
		else {
			return $start_date.'–'.$end_date;
		}
	}
	else {
		return eo_get_the_start($date_format.' '.$time_format);
	}
}

function ftek_group_logo($slug) {
	if (function_exists('wp_get_terms_meta')) {
		return wp_get_terms_meta($slug, 'logo' , true);
	} else {
		return false;
	}
}

function ftek_updated_meta( $post_type ) {
	$date_updated = get_the_modified_time("c");
	$date = date_i18n( get_option('date_format'), strtotime($date_updated)).' '.date_i18n( get_option('time_format'), strtotime($date_updated));
	if ($post_type == 'post') {
		// Published
		$html .= "<p class='entry-published'>";
		$html .= __('Published').' ';
		$html .= "<time class='relative-time' datetime='$date_updated'>";
		$html .= $date;
		$html .= '</time></p>';
	}
	// Updated
	$html .= "<p class='entry-updated'>";
	$html .= __('Updated', 'ftek').' ';
	$html .= "<time class='relative-time' datetime='$date_updated'>";
	$html .= $date;
	$html .= '</time>';
	
	$html .= '</p>';
	return $html;
}

function ftek_page_menu($post)
{
	$main_ID = $post->post_parent;
	if ( !$main_ID ) {
		$main_ID = $post->ID;
	}
	$main = get_post( $main_ID );
	$menu_items .= wp_list_pages("title_li=&child_of=".$main_ID."&depth=1&echo=0");
	if ($menu_items) {
		return '<ul>'. $menu_items . '</ul>';
	} else {
		return false;
	}
}


/* Allow style tags in pages and posts (and also comments - YOU CAN NEVER ENABLE COMMENTS ANYWHERE) */

if( !function_exists('ftek_add_allowed_tags') ) {
	function ftek_add_allowed_tags($tags) {
		/*$tags['time'] = array(
			'datetime' => true,
		);*/
		$tags['style'] = array();
		return $tags;
	}
	add_filter('wp_kses_allowed_html', 'ftek_add_allowed_tags');
}

/*
* Fixes english home link
*/
if ( function_exists('qtrans_convertURL') ) {
	function qtrans_convertHomeURL($url, $what) {
		if($what=='/') return qtrans_convertURL($url);
		return $url;
	}
	add_filter('home_url', 'qtrans_convertHomeURL', 10, 2);
}

/*
* Change wordpress logo
*/
function my_login_logo() { ?>
	<style type="text/css">
	#login h1 a, .login h1 a {
		background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg);
		height:128px;
		width:320px;
		background-size: 128px 128px;
		background-repeat: no-repeat;
		padding-bottom: 0px;
		filter: invert(1);
	}
	#login a, #login #nav a, #login #backtoblog a {
		color: white;
	}
	body.login {
		background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/phantom-bg.jpg);
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center right;
		background-attachment: fixed;
	}
	div#login {
		padding: 5% 0 0;
	}
	</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );
	
	
	/*
	* Change top link on login page to homepage
	*/
	
	function my_login_logo_url() {
		return home_url();
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );
	
	/*
	* Remove username in registration form
	*/
	add_action('login_head', function(){
		?>
		
		<script type="text/javascript" src="<?php echo site_url('/wp-includes/js/jquery/jquery.js'); ?>"></script>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#registerform > p:first-child').remove();
		});
		</script>
		<?php
	});
	
	/*
	* Remove error for username, only show error for email only.
	*/
	add_filter('registration_errors', function($wp_error, $sanitized_user_login, $user_email){
		if(isset($wp_error->errors['empty_username'])){
			unset($wp_error->errors['empty_username']);
		}
		
		if(isset($wp_error->errors['username_exists'])){
			unset($wp_error->errors['username_exists']);
		}
		return $wp_error;
	}, 10, 3);
	
	/*
	* Make CID username
	
	add_action('login_form_register', function(){
		if(isset($_POST['user_email']) && !empty($_POST['user_email'])){
			preg_match('/(.+)@.*chalmers.se/',$_POST['user_email'], $cid);
			$_POST['user_login'] = $cid[1];
		}
	}); */
	
	/*
	* Set first and last name and username
	*/
	
	add_action( 'user_register', function($user_id){
		$user = get_userdata($user_id);
		global $wpdb;
		$tablename = $wpdb->prefix . "users";
		// Set username to full email if domain is ftek.se else set to part before @
		if (explode('@', $user->user_email)[1] === 'ftek.se') {
			$wpdb->update( $tablename, array( 'user_login' => $user->user_email ), array( 'ID' => $user_id ) );
		} else {
			$wpdb->update( $tablename, array( 'user_login' => explode('@', $user->user_email)[0] ), array( 'ID' => $user_id ) );
		}

		// Find names in LDAP directory
		set_include_path(get_include_path().PATH_SEPARATOR.'/usr/local/spidera/php/');
		include_once('ldap_functions.php');
		if ( class_exists('LDAPUser') ) {
			$ldap_user = new LDAPUser($user->user_login);
			if ($ldap_user->cid != $ldap_user->given_name) {
				update_user_meta($user_id, 'first_name', $ldap_user->given_name);
				update_user_meta($user_id, 'last_name', $ldap_user->surname);
			}
		}
	});
	
	
	/*
	* Shortcode for if user is logged in
	*/
	add_shortcode('not_logged_in', 'user_not_logged_in' );
	
	function user_not_logged_in ($params, $content = null){
		if (is_user_logged_in()){
			return;
		} else {
			return do_shortcode($content);
		}
	}
	
	add_shortcode('logged_in', 'user_logged_in');
	
	function user_logged_in ($params, $content = null){
		if (is_user_logged_in()){
			return do_shortcode($content);
		} else {
			return;
		}
	}
	
	/*
	* Allow shortcodes in widgets, requested by wello
	*/
	add_filter('widget_html','do_shortcode');
	
	
	/* Ajax load more helper function */
	// Prints ajax_load_more shortcode
	function print_ajax_loader($sc_options = array( 'post_type' => 'any', 'posts_per_page' => '12', 'transition_container' => 'false', 'scroll' => 'true', 'scroll_distance' => '-250', 'progress_bar' => 'true', 'progress_bar_color' => '8d0000', 'button_label' => '...', 'button_loading_label' => '...',)) {
		$sc_prefix = '[ajax_load_more ';
		$sc_suffix = ']';
		
		foreach ($sc_options as $key => &$value)
		$value = '"' . $value . '"';
		$sc_args = urldecode(http_build_query($sc_options, '', ' '));
		$shortcode = $sc_prefix . $sc_args . $sc_suffix;
		echo do_shortcode($shortcode);
	}
	
	/* Event Organiser calendar helper function */
	// Prints eo_fullcalendar shortcode
	function print_eo_calendar($sc_options = array( 'tooltip' => 'false', 'headerLeft' => 'today, prev, next, goto, title', 'headerCenter' => '', 'headerRight' => 'month, basicWeek, basicDay, category', ) ) {
		
		$sc_prefix = '[eo_fullcalendar ';
		$sc_suffix = ']';
		
		foreach ($sc_options as $key => &$value)
		$value = '"' . $value . '"';
		$sc_args = urldecode(http_build_query($sc_options, '', ' '));
		$shortcode = $sc_prefix . $sc_args . $sc_suffix;
		echo do_shortcode($shortcode);
	}
	
	/* Redirect to date.php even when no posts */
	function wpd_date_404_template( $template = '' ){
		global $wp_query;
		if( isset($wp_query->query['year'])
		|| isset($wp_query->query['monthnum'])
		|| isset($wp_query->query['day']) ){
			$template = locate_template( 'date.php', false );
		}
		return $template;
	}
	add_filter( '404_template', 'wpd_date_404_template' );
	
	/* Keep users logged in for 1 year */
	function ftek_login_expiration( $expirein ) {
		return 31556926; // 1 year in seconds
	}
	add_filter( 'auth_cookie_expiration', 'ftek_login_expiration' );

	
	/* Imports */
	
	include("functions/admin_UI.php");
	include("functions/shortcodes.php");
	
	

?>
