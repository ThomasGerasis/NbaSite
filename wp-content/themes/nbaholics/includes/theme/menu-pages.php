<?php

add_action( 'do_meta_boxes', 'bh_menu_meta_remove', 9999 );

function bh_menu_meta_remove() {
    global $user_ID;
    $user = wp_get_current_user();
    if ( current_user_can( 'author' ) || current_user_can( 'contributor' ) ) {
        remove_meta_box('yasr_metabox_overall_rating','post','side');
        remove_meta_box('onesignal_notif_on_post','post','side');
    }
}

add_action( 'admin_init', 'bh_menu_pages_remove' );

function bh_menu_pages_remove() {

    global $user_ID;
    $user = wp_get_current_user();
    if ( current_user_can( 'author' ) || current_user_can( 'contributor' ) ) {
        if( !current_user_can( 'contributor' )){
            if($user->ID == '7'){ //bozio ή Λιβάνιος
                add_filter( 'list_terms_exclusions', 'wpse_55202_list_terms_exclusions', 10, 2 );
            }else{
                remove_menu_page( 'edit.php' );
                add_filter( 'list_terms_exclusions', 'wpse_55202_list_terms_exclusions', 10, 2 );
            }

        }
        if( current_user_can( 'contributor' ) ){
            remove_menu_page( 'edit.php?post_type=tipster' );
            add_filter( 'list_terms_exclusions', 'categories_for_special_lists', 10, 2 ); //κρύβει τα βασικά categories (για ανθρώπους που θέλουμε να γράφουν άρθρα και να ανήκους σε περιορισμένες κατηγορίες)
        }
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'index.php' );
        remove_menu_page( 'edit.php?post_type=cfs' );
        remove_menu_page( 'edit.php?post_type=mundial_sharkode' );
        remove_menu_page( 'edit.php?post_type=bookmakers' );
        remove_menu_page( 'edit.php?post_type=bookmakers_ad' );
        remove_menu_page( 'edit.php?post_type=thirstylink' );
        if($user->ID != '12' || $user->ID != '5') {
            remove_menu_page('edit.php?post_type=special_tips');
        }
        remove_menu_page( 'edit.php?post_type=timetable' );
        remove_menu_page( 'edit.php?post_type=nc_shortcodes' );
        remove_menu_page( 'wpcf7' );
        remove_meta_box('postexcerpt','post','normal');
        remove_meta_box('postexcerpt','tipster','normal');
        remove_meta_box('commentstatusdiv','tipster','normal');
        remove_meta_box('slugdiv','tipster','normal');
        remove_meta_box('seasondiv','tipster','side');
        remove_meta_box('seasondiv','special_tips','side');
        remove_meta_box('tipster_categorydiv','tipster','side');
        remove_meta_box('sticky-posts','tipster','side');
        remove_meta_box('sticky-posts','post','side');
        remove_meta_box('sticky-posts-2','post','side');
        remove_meta_box('formatdiv','post','side');
    }elseif (current_user_can( 'sub_editor' )){
        add_filter( 'list_terms_exclusions', 'categories_for_special_lists', 10, 2 );
        remove_menu_page( 'edit.php?post_type=bookmakers_ad' );
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'index.php' );
        remove_menu_page( 'edit.php?post_type=page' );
        remove_menu_page( 'edit.php?post_type=cfs' );
        remove_menu_page( 'edit.php?post_type=mundial_sharkode' );
        remove_menu_page( 'edit.php?post_type=bookmakers' );
        remove_menu_page( 'edit.php?post_type=thirstylink' );
        remove_menu_page( 'edit.php?post_type=timetable' );
        remove_menu_page( 'edit.php?post_type=nc_shortcodes' );
        remove_menu_page( 'wpcf7' );
        remove_meta_box('postexcerpt','post','normal');
        remove_meta_box('postexcerpt','tipster','normal');
        remove_meta_box('commentstatusdiv','tipster','normal');
        remove_meta_box('slugdiv','tipster','normal');
        remove_meta_box('seasondiv','tipster','side');
        remove_meta_box('seasondiv','special_tips','side');
        remove_meta_box('tipster_categorydiv','tipster','side');
        remove_meta_box('sticky-posts','tipster','side');
        remove_meta_box('sticky-posts','post','side');
        remove_meta_box('sticky-posts-2','post','side');
        remove_meta_box('formatdiv','post','side');
    }elseif(current_user_can('sub_contributor')){
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'edit.php' );
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'index.php' );
        remove_menu_page( 'edit.php?post_type=page' );
//        remove_menu_page( 'edit.php?post_type=tipster' );
        remove_menu_page( 'edit.php?post_type=cfs' );
        remove_menu_page( 'edit.php?post_type=mundial_sharkode' );
        remove_menu_page( 'edit.php?post_type=bookmakers' );
        remove_menu_page( 'edit.php?post_type=bookmakers_ad' );
        remove_menu_page( 'edit.php?post_type=thirstylink' );
        remove_menu_page( 'edit.php?post_type=timetable' );
        remove_menu_page( 'edit.php?post_type=nc_shortcodes' );
        remove_menu_page( 'wpcf7' );
        remove_meta_box('postexcerpt','post','normal');
        remove_meta_box('postexcerpt','tipster','normal');
        remove_meta_box('commentstatusdiv','tipster','normal');
        remove_meta_box('slugdiv','tipster','normal');
        remove_meta_box('seasondiv','tipster','side');
        remove_meta_box('seasondiv','special_tips','side');
        remove_meta_box('tipster_categorydiv','tipster','side');
        remove_meta_box('sticky-posts','tipster','side');
        remove_meta_box('sticky-posts','post','side');
        remove_meta_box('sticky-posts-2','post','side');
        remove_meta_box('formatdiv','post','side');
    }
}

function wpse_55202_list_terms_exclusions($exclusions,$args) {
    return $exclusions . " AND ( t.term_id <> 235 )  AND ( t.term_id <> 232 ) AND ( t.term_id <> 1 ) AND ( t.term_id <> 206 ) AND ( t.term_id <> 205 ) AND ( t.term_id <> 202 ) AND ( t.term_id <> 204 ) AND ( t.term_id <> 203 ) AND ( t.term_id <> 236 ) AND ( t.term_id <> 237 )";
}
function categories_for_special_lists($exclusions,$args) {
    return $exclusions . " AND ( t.term_id <> 232 ) AND ( t.term_id <> 1 ) AND ( t.term_id <> 206 ) AND ( t.term_id <> 205 ) AND ( t.term_id <> 202 ) AND ( t.term_id <> 204 ) AND ( t.term_id <> 203 )";
}

function add_bc_caps(){
    // gets the author role
    $role = get_role( 'contributor' );


    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'delete_published_posts' );
    $role->add_cap( 'edit_published_posts' );
    $role->add_cap( 'publish_posts' );
    $role->add_cap( 'upload_files' );

}
add_action( 'admin_init', 'add_bc_caps' );
