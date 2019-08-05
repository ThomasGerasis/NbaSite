<?php

/**
 * Basic Theme Setup
 */
function nba_theme_setup() {

	// Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'feed_links', 2 );

	// Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'rsd_link' );

	// Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// index link
	remove_action( 'wp_head', 'index_rel_link' );

	// prev link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

	// Display the XHTML generator that is generated on the wp_head hook, WP version
	//remove_action('wp_head', 'wp_generator');

	// Remove Emoji support and the corresponding scripts in header
	//remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	//remove_action( 'wp_print_styles', 'print_emoji_styles' );

	// Allows the use of HTML5 markup
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	add_theme_support( 'post-formats', array( 'video', 'gallery' ) );

	add_theme_support( 'title-tag' );

}

//
add_action( 'after_setup_theme', 'nba_theme_setup' );
