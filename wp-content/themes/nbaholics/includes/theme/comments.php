<?php
/********************************* Make default comments option 'open' **********************************/	

function default_comments_on( $data ) {
    if( $data['post_type'] == array('tipster', 'posts') ) {
        $data['comment_status'] = 'open';
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_on' );
/********************************* END OF Make default comments option 'open' ****************************/	