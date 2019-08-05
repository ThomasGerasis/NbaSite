<?php

/**
 * Basic Theme Setup
 */

/**
 * Add custom image sizes
 *
 * WordPress will create a copy of the post image with the specified
 * dimensions when uploading a new image
 */
function bh_theme_images() {

	// Enables post-thumbnail support for the theme
	add_theme_support( 'post-thumbnails' );

	// Add custom image sizes
	add_image_size( 'thumb-800', 800, 9999 );
	add_image_size( 'thumb-400', 400, 9999 );
	add_image_size( 'thumb-400s', 400, 250 );
	add_image_size( 'thumb-280', 280, 9999 );
	add_image_size( 'thumb-200', 200, 9999 );
	add_image_size( 'thumb-255', 255, 9999 );
	add_image_size( 'thumb-78', 78, 9999 );
	add_image_size( 'thumb-120', 120, 9999 );

}

add_action( 'after_setup_theme', 'bh_theme_images' );

//instert Custom sized image into post using Media Gallery for Slider

function nba_custom_sized_slider_image($sizes){

    $custom_sizes = array(
        'thumb-680' => '680px wide',
    );

    return array_merge( $sizes, $custom_sizes );

}
add_filter( 'image_size_names_choose', 'nba_custom_sized_slider_image' );

// Insert custom sized image into post using Media Gallery
function bh_custom_image_sizes_choose( $sizes ) {

	$custom_sizes = array(
		'thumb-800' => '800px wide',
		'thumb-400' => '400px wide',
	);

	return array_merge( $sizes, $custom_sizes );
}

add_filter( 'image_size_names_choose', 'bh_custom_image_sizes_choose' );



// Remove default image sizes
function bh_remove_default_image_sizes( $sizes ) {
	unset( $sizes['thumbnail'] );
	unset( $sizes['medium'] );
	unset( $sizes['large'] );

	return $sizes;
}

add_filter( 'intermediate_image_sizes_advanced', 'nba_remove_default_image_sizes' );

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function add_image_responsive_class($class){
    return $class . ' img-responsive';
}
add_filter('get_image_tag_class','add_image_responsive_class');
//function example_lazy_load($html, $id, $caption, $title, $align, $url) {
//    $src  = 'src="'.get_template_directory_uri().'/wp-content/themes/assets/images/blank.png"';
//    $html = str_replace( "&lt;img src", "&lt;img {$src} data-src", $html );
//    return $html;
//}
//add_filter( 'image_send_to_editor', 'example_lazy_load', 10, 9 );