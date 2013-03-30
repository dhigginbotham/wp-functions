<?php
//add action to tap into the main query
add_action('pre_get_posts', 'query_multiple_posts_types', 1);
function query_multiple_posts_types( $q ) {
    if ( $q->is_main_query() && is_home() ) {
        //Display 20 posts
        $q->query_vars['posts_per_page'] = 3;
        //Display multiple post types
        $q->query_vars['post_type'] = array('post');
        
        return $q;

    }
}