<?php

/* Generates the menu on each committee page */

function committee_menu($post)
{
    $main_ID = $post->post_parent;
	if ( !$main_ID ) {
        $main_ID = $post->ID;
	}
    $main = get_post( $main_ID );
    $cat  = get_category_by_slug( $main->post_name );
    if ($cat) {
        $url = get_category_link( $cat->cat_ID );
        $news_item = "<li><a href='$url'>".__("News","ftek").'</a></li>';
    }
    
	//$menu_items  = wp_list_pages("title_li=&include=".$main_ID."&echo=0");
    $menu_items .= $news_item;
    $menu_items .= wp_list_pages("title_li=&child_of=".$main_ID."&depth=1&echo=0");
    /*if (function_exists('get_all_wp_terms_meta')) { 
        $menu_items .= '<li>'. get_all_wp_terms_meta($cat->cat_ID)['email'][0] .'</li>';
    }*/
	if ($menu_items) {
        return '<ul>'. $menu_items . '</ul>';
    }
    else {
        return '';
    }
}
