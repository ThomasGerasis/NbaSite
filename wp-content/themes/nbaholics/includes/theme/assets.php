<?php

/**
 * Load theme's stylesheets and scripts
 */
function nba_theme_assets() {

	$styles_dir = get_template_directory_uri() . '/assets/styles/';
	$scripts_dir = get_template_directory_uri() . '/assets/scripts/';

	// Enqueue styles
	// --------------

	wp_enqueue_style( 'main', $styles_dir . 'main.css', array(), null, 'all' );
	//wp_enqueue_style( 'mainsd', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css', array(), null, 'all' );
	wp_enqueue_style( 'custom', 'https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css', array(), null, 'all' );

	//wp_enqueue_style( 'main', 'http://localhost/sass/bethoven/assets/styles/main.min.css', array(), null, 'all' );
	// wp_enqueue_style( 'animate', $styles_dir . 'animate.min.css', array(), null, 'all' );

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

	// Bootstrap
	// wp_enqueue_script( 'bootstrap', $scripts_dir . 'bootstrap.min.js', array(), null, true );

	// Google Maps API
	//wp_enqueue_script( 'google_maps', 'https://maps.google.com/maps/api/js', array(), null, true );

	// gmaps.js
	// wp_enqueue_script( 'gmaps', $scripts_dir . 'gmaps.min.js', array( 'google_maps', 'jquery' ), null, true );

	// magnific-popup.js
	// wp_enqueue_script( 'magnific-popup', $scripts_dir . 'vendor/magnific-popup/jquery.magnific-popup.min.js', array( 'jquery' ), null, true );

	// waypoints.js
	// wp_enqueue_script( 'waypoints', $scripts_dir . 'vendor/waypoints/jquery.waypoints.min.js', array( 'jquery' ), null, true );

	// Vendor scripts of theme
	wp_enqueue_script( 'vendor', $scripts_dir . 'vendor.min.js', array( 'jquery' ), null, true );

	// Custom scripts of theme
	//wp_enqueue_script( 'custom', 'http://localhost/sass/bethoven/assets/scripts/custom.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'custom0', $scripts_dir . 'jquery.countdown.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'custom', $scripts_dir . 'custom.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'custom1', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'custom2', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'custom3', 'https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js', array( 'jquery' ), null, true );
}

// Load theme's stylesheets and scripts
add_action( 'wp_enqueue_scripts', 'nba_theme_assets' );

//function my_scripts_admin_enqueue() {
//	wp_register_script( 'scriptjs', get_template_directory_uri().'/assets/scripts/admin_js.js', array('jquery'), '', true );
//	wp_enqueue_script( 'scriptjs' );
//}
//add_action( 'admin_enqueue_scripts', 'my_scripts_admin_enqueue' );


add_action('admin_head', 'admin_custom_fonts');

function admin_custom_fonts() {
  if (current_user_can( 'author' )){
	  echo '<style>
				.widget-control-actions .alignleft {
					display: none;
				}
				th#author, td.author.column-author {
					display: none;
				}
				div#onesignal_notif_on_post, div#yasr_metabox_overall_rating, div#tipster_categorydiv, div#seasondiv, li#menu-posts-bookmakers, li#menu-posts-thirstylink, li#menu-tools, li#menu-dashboard{
					display: none;
				}
				.inline-edit-date {
					display: none;
				}
			</style>';
	}	
}
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

add_action('admin_enqueue_scripts', 'cstm_css_and_js');

function cstm_css_and_js($hook) {
    wp_enqueue_style('boot_css', 'https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), null, 'all');
    wp_enqueue_script( 'boot_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), null, true );
//    wp_enqueue_script('boot_js', plugins_url('inc/bootstrap.js',__FILE__ ));
}