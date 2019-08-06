<?php

/**
 * Load theme's stylesheets and scripts
 */
function nba_theme_assets() {

	$styles_dir = get_template_directory_uri() . '/assets/styles/';
	$scripts_dir = get_template_directory_uri() . '/assets/js/';

	// Enqueue styles
	// --------------

	wp_enqueue_style( 'main', $styles_dir . 'main.css', array(), null, 'all' );
	wp_enqueue_style( 'mainsd', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css', array(), null, 'all' );
	wp_enqueue_style( 'custom', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), null, 'all' );

	// Enqueue scripts
	// ---------------

	// jquery
	if ( ! is_admin() ) {

		// deregisters the default WordPress jQuery
		wp_deregister_script( 'jquery' );

		// the URL to check against
		$cdn_url = 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js';

		// test parameters
		$test_cdn_url = @fopen( $cdn_url, 'r' );

		if ( false !== $test_cdn_url ) {
			// register the cdn file
			//wp_register_script( 'jquery', $cdn_url, array(), null, true );

			// enqueue the cdn file
			//wp_enqueue_script( 'jquery' );
		} else {
			// register the local file
			//wp_register_script( 'jquery', $scripts_dir . 'vendor/jquery/3.2.1/jquery.min.js', array(), null, true );

			// enqueue the local file
		//	wp_enqueue_script( 'jquery' );
		}
	}else{
		//wp_register_script( 'jquery', $cdn_url, array(), null, true );
	}

	// Vendor scripts of theme
	wp_enqueue_script( 'vendor', $scripts_dir . 'vendor.min.js', array( 'jquery' ), null, true );

	// Custom scripts of theme

    wp_enqueue_script( 'custom4', $scripts_dir. 'scripts.min.js' , array( 'jquery' ), null, true );
}

// Load theme's stylesheets and scripts
add_action( 'wp_enqueue_scripts', 'nba_theme_assets' );

////////////// AJAX CALLS JS

add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts' );
function ajax_enqueue_scripts() {

	wp_enqueue_script( 'ajax-tables', get_template_directory_uri().'/assets/scripts/ajax-calls.js', array('jquery'), '1.0', true );

	wp_localize_script( 'ajax-tables', 'ajaxtables', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	));

}

// Για να δω ποια scipt έχουν γίνει enqueue:  admin-bar | contact-form-7 | remove-uppercase-accents | ta_main_js | rateit | jquery-ui-progressbar | jquery-ui-tooltip | yasrfront | vendor | custom0 | custom | custom1 | custom2 | custom3 | ajax-tables | BJLL | 


//add_action( 'wp_print_scripts', 'wsds_detect_enqueued_scripts', 99 );
function wsds_detect_enqueued_scripts() {
	global $wp_scripts;
	wp_deregister_script( 'yasrfront' );
	foreach( $wp_scripts->queue as $handle ) :
		echo $handle . ' | ';
	endforeach;
} 

// Για να δω ποια style έχουν γίνει enqueue admin-bar | contact-form-7 | math-captcha-frontend | yasrcss | jquery-ui | dashicons | yasrcsslightscheme | yoast-seo-adminbar | main | custom | duplicate-post | 


add_action( 'wp_print_styles', 'wsds_detect_enqueued_styles', 99 );
function wsds_detect_enqueued_styles() {
	/* wp_deregister_style( 'contact-form-7' );
	wp_deregister_style( 'yasrcss' );
	wp_deregister_style( 'yasrcsslightscheme ' );
	wp_deregister_style( 'dashicons' );
	wp_deregister_style( 'yoast-seo-adminbar' );
	wp_deregister_style( 'duplicate-post ' );
	wp_dequeue_style( 'contact-form-7' );
	wp_dequeue_style( 'yasrcss' );
	wp_dequeue_style( 'yasrcsslightscheme ' );
	wp_dequeue_style( 'dashicons' );
	wp_dequeue_style( 'yoast-seo-adminbar' );
	wp_dequeue_style( 'duplicate-post ' );
	 */
	global $wp_styles;
	foreach( $wp_styles->queue as $handlez ) :
		echo $handlez . ' | ';
	endforeach;
} 

add_filter( 'script_loader_tag', 'wsds_defer_scripts', 10, 3 );

function wsds_defer_scripts( $tag, $handle, $src ) {

	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array( 
		'remove-uppercase-accents',
	);

    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }
    
    return $tag;
}
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');



// Slick slider styles
function slick_slider_styles() {
    wp_enqueue_style( 'slick-slider-styles', get_template_directory_uri(). '/includes/plugins/slick/slick.css' );
    wp_enqueue_style( 'slick-slider-theme-styles', get_template_directory_uri(). '/includes/plugins/slick/slick-theme.min.css' );
}
add_action( 'wp_enqueue_scripts', 'slick_slider_styles');

// Slick slider js
function slick_slider_js() {
    wp_enqueue_script('slick-slider-js', get_template_directory_uri(). '/includes/plugins/slick/slick.min.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'slick_slider_js');

