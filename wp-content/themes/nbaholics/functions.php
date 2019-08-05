<?php
// get all files in the includes/functions folder
// for the glob() function to work properly, we give it an absolute path

$files = glob( get_template_directory() . '/includes/theme/*.php' );

foreach ( $files as $file ) {
include $file;

}
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter ( 'nav_menu_css_class', 'so_37823371_menu_item_class', 10, 4 );

function so_37823371_menu_item_class ( $classes, $item, $args, $depth ){
    $classes[] = 'nav-item pt-4';
    return $classes;
}

function atg_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'header') {
        $classes[] = 'nav-link';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

function add_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="nav-link py-0" id="heightnav"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');



?>


