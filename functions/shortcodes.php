<?php



/*
* Allow shortcodes in widgets
*/
add_filter('widget_html','do_shortcode');


// Trim whitespace inside shortcodes
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );

/* Generates a member entry, to be used on committee front pages */

function ftek_member_shortcode($atts, $content, $tag)
{
	// These are the options
    extract( shortcode_atts( array(
		'cid' => '',
        'name' => '',
        'position' => 'Ledamot',
        'email' => ''
	), $atts ) );
    
    if ($cid == '') {
        return '';
    }
    
    
    if (!$name) {
        $name = get_name_by_cid($cid);
    }
    
    if (!$email) {
	    $emailstring = '';
    }
    else {
	    $emailstring = ' (<a href="mailto:'.$email.'"class="member-email">'
                        	. $email
						. '</a>)';
    }

    $user = get_user_by('login', $cid);

    $userdata = get_user_meta( $user->ID );
    $description = $userdata['description'][0];
    if ($description !== '') {
        $content = $description;
    }
    
    return '<div class="member">'
    			. get_avatar( $user->ID, 75)
	            . '<div class="member-info">'
	                . '<div class="member-name">'
	                    . $name
	                . '</div>'
	                . '<div class="member-meta">'
	                    . '<span class="member-position">'
	                        . $position
	                    . '</span>'
	                    . $emailstring
	                . '</div>'
	                . '<div class="member-bio">'
	                    . $content
	                . '</div>'
				. '</div>'
            . '</div>';
}
add_shortcode('ftek_member', 'ftek_member_shortcode');

function get_name_by_cid($cid) {
    
    $user = get_user_by('login', $cid);
    
    if ($user) {
        $first = $user->user_firstname;
        $last  = $user->user_lastname;
        $nick = $user->nickname;
    
        // Only display nick if explicitly stated
        if (strcasecmp($nick, $cid) == 0 || 
            strcasecmp($nick, $first) == 0 || 
            strcasecmp($nick, $last) == 0) // Case insensitive compare
        {
            $nick = '';
        } 
        else {
            $nick = '“'.$nick.'”';
        }
    }
    else {
        $nick = '';
    }

    return "$first $nick $last";
}

/* The following two functions seem very similar, and they are, but they differ in so many small places (because API is not consistent) so it was more trouble than it was worth. */

/* Generates calendar subscription links for each category */

function ftek_cal_subscription_shortcode($atts, $content, $tag)
{
    extract( shortcode_atts( array(
		'exclude' => '',
	), $atts ) );
    $excludes = array_map( "trim", explode(',', $exclude) );
    $categories = get_terms('event-category');
    $protocol = "webcal";
    $output = '<ul class="cal-subscription-list">';
    $webcal = replace_http(eo_get_events_feed(), $protocol);
    $output .= "<li><a href='$webcal'>" . __('All', 'ftek') . "</a></li>";
    foreach ( $categories as $category ) {
        if ( in_array($category->slug, $excludes) ) {
            continue;
        }
        $url = eo_get_event_category_feed($category->slug);
        $webcal = replace_http($url, $protocol);
        $output .= "<li><a href='$webcal'>{$category->name}</a></li>";
    }
    return $output . "</ul>";
}
add_shortcode('ftek_cal_subscription', 'ftek_cal_subscription_shortcode');

/* Generates news subscription links for each category */

function ftek_news_subscription_shortcode($atts, $content, $tag)
{
    extract( shortcode_atts( array(
		'exclude' => '',
	), $atts ) );
    $excludes = array_map( "trim", explode(',', $exclude) );
    $categories = get_categories('category');
    $output = '<ul class="news-subscription-list">';
    $protocol = "feed";
    $feed = replace_http(get_feed_link(), $protocol);
    $output .= "<li><a href='$feed'>" . __('All', 'ftek') . "</a></li>";
    foreach ( $categories as $category ) {
        if ( in_array($category->slug, $excludes) ) {
            continue;
        }
        $url = get_category_feed_link( $category->cat_ID );
        $feed = replace_http($url, $protocol);
        $output .= "<li><a href='$feed'>{$category->cat_name}</a></li>";
    }
    return $output . "</ul>";
}
add_shortcode('ftek_news_subscription', 'ftek_news_subscription_shortcode');


function replace_http($url, $protocol) {
    return preg_replace( "#https?#", $protocol, $url, 1 );
}


/* Generates the menus on the Sektion page */

function ftek_menu_shortcode($atts, $content, $tag)
{
	extract(shortcode_atts(array(  
		'menu'            => '', 
		'container'       => 'div', 
		'container_class' => '', 
		'container_id'    => '', 
		'menu_class'      => '', 
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'depth'           => 0,
		'walker'          => '',
		'theme_location'  => ''), 
		$atts));

	return wp_nav_menu( array( 
		'menu'            => $menu, 
		'container'       => $container, 
		'container_class' => trim('menu-container '.$container_class), 
		'container_id'    => trim('menu-container-'.$menu.' '.$container_id), 
		'menu_class'      => trim('menu '.$menu_class), 
		'menu_id'         => trim('menu-'.$menu.' '.$menu_id),
		'echo'            => false,
		'fallback_cb'     => $fallback_cb,
		'before'          => $before,
		'after'           => $after,
		'link_before'     => $link_before,
		'link_after'      => $link_after,
		'depth'           => $depth,
		'walker'          => $walker,
		'theme_location'  => $theme_location));
}
add_shortcode('ftek_menu', 'ftek_menu_shortcode');


/*
* Shortcode for if user is logged in
*/
add_shortcode('not_logged_in', 'user_not_logged_in' );

function user_not_logged_in ($params, $content = null){
	if (!is_user_logged_in()){
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