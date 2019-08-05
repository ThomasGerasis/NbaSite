<?php
/**
 * Allows templates for Custom Post Type to be in a separate folder
 *
 * @link https://wordpress.org/support/topic/custom-post-type-templates-and-custom-directory-locaiton
 */
function nba_custom_template_include( $template ) {

    $custom_template_location = '/post-templates/';

    if ( get_post_type() ) {
        if (is_archive()) :
            $page_id = get_queried_object_id();
            if(in_array($page_id, array('268','267','248'))){
                if ( file_exists( get_stylesheet_directory() . $custom_template_location . 'archive-' . get_post_type() . '-'.$page_id.'.php' ) ) {
                    return get_stylesheet_directory() . $custom_template_location . 'archive-' . get_post_type() . '-'.$page_id.'.php';
                }
            }else{
                if (file_exists(get_stylesheet_directory() . $custom_template_location . 'archive-' . get_post_type() . '.php')) {
                    return get_stylesheet_directory() . $custom_template_location . 'archive-' . get_post_type() . '.php';
                }
            }
        endif;
        if ( is_single() ) :
            if ( file_exists( get_stylesheet_directory() . $custom_template_location . 'single-' . get_post_type() . '.php' ) ) {
                return get_stylesheet_directory() . $custom_template_location . 'single-' . get_post_type() . '.php';
            }
        endif;
    }

    return $template;
}

add_filter( 'template_include', 'nba_custom_template_include' );
