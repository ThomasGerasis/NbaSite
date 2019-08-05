<?php
include_once WP_CONTENT_DIR . '/themes/nbaholics/includes/plugins/wpalchemy/MetaBox.php';
require_once WP_CONTENT_DIR . '/themes/nbaholics/includes/plugins/wpalchemy/MediaAccess.php';


// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

if (!function_exists('metabox_style')) {
    function metabox_style() {
        if ( is_admin() )
        {
            wp_enqueue_style( 'wpalchemy-metabox', WP_CONTENT_DIR.'/themes/nbaholics/includes/plugins/wpalchemy/meta.css' );
        }
    }
}

$wpalchemy_media_access = new WPAlchemy_MediaAccess;


$full_mb = new WPAlchemy_MetaBox(array
(
    'id' => '_full_meta',
    'title' => 'Slider Frontpage',
    'types' => array('page'), // added only for pages and to custom post type "events"
    'context' => 'normal', // same as above, defaults to "normal"
    'priority' => 'high', // same as above, defaults to "high"
    'template' => get_stylesheet_directory() . '/includes/theme/metaboxes/front-page-meta.php'
));


