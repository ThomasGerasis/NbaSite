<?php

/**
 * Register theme's navigation menus
 */
function bh_theme_menus() {
	register_nav_menus(
		array(
			'header-menu'  => __( 'Header', 'nba' ),
			'mobile-menu'  => __( 'Mobile Header', 'nba' ),
			'popular-menu' => __( 'Popular', 'nba' ),
			'footer-menu'  => __( 'Footer Right', 'nba' ),
			'footer-menu-2'  => __( 'Footer left', 'nba' ),
		)
	);
}

add_action( 'init', 'bh_theme_menus' );

class SH_Arrow_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if('header-menu' == $args->theme_location && $depth ==0){
            $output .='<span class="arrow"><i class="fa fa-caret-down"></i></span>';
        }
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
}
