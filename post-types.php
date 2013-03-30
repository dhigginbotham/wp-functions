<?php
function custom_posts() {

  $postArray = array(
      array('agents', 'Agents', 'user--plus.png', 'agents'),
      array('awards', 'Awards', 'trophy.png', 'awards'),
      array('faq', 'FAQ', 'question-shield.png', 'faq'),
      array('properties', 'Properties', 'home--plus.png', 'property'),
      array('testimonials', 'Testimonials', 'star.png', 'testimonials'),
      array('services', 'Services', 'star.png', 'services')
    );

  $post_types = array('testimonials', 'faq', 'properties', 'agents', 'awards'); //just add more types to this array, ie this example
  foreach ($postArray as $pt) {
      // creating (registering) the custom type 
      register_post_type( $pt[0], /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
        // let's now add all the options for this post type
        array('labels' => array(
          'name' => __($pt[1], 'trinity_re'), /* This is the Title of the Group */
          'singular_name' => __($pt[1], 'trinity_re'), /* This is the individual type */
          'all_items' => __('All ' . $pt[1], 'trinity_re'), /* the all items menu item */
          'add_new' => __('Add New', 'trinity_re'), /* The add new menu item */
          'add_new_item' => __('Add New ' . $pt[1], 'trinity_re'), /* Add New Display Title */
          'edit' => __( 'Edit', 'trinity_re' ), /* Edit Dialog */
          'edit_item' => __('Edit Post ' . $pt[1], 'trinity_re'), /* Edit Display Title */
          'new_item' => __('New', 'trinity_re'), /* New Display Title */
          'view_item' => __('View', 'trinity_re'), /* View Display Title */
          'search_items' => __('Search ' . $pt[1], 'trinity_re'), /* Search Custom Type Title */ 
          'not_found' =>  __('Nothing found in the Database.', 'trinity_re'), /* This displays if there are no entries yet */ 
          'not_found_in_trash' => __('Nothing found in Trash', 'trinity_re'), /* This displays if there is nothing in the trash */
          'parent_item_colon' => ''
          ), /* end of arrays */
          'description' => __( 'Section for ' . $pt[1], 'trinity_re' ), /* Custom Type Description */
          'public' => true,
          'publicly_queryable' => true,
          'exclude_from_search' => false,
          'show_ui' => true,
          'query_var' => true,
          'menu_position' => 250, /* this is what order you want it to appear in on the left hand side menu */ 
          'menu_icon' => get_stylesheet_directory_uri() . '/lib/images/icons/' . $pt[2], /* the icon for the custom post type menu */
          'rewrite' => array( 'slug' => $pt[3], 'with_front' => false ), /* you can specify its url slug */
          'has_archive' => $pt[3], /* you can rename the slug here */
          'capability_type' => 'post',
          'hierarchical' => false,
          /* the next one is important, it tells what's enabled in the post editor */
          'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments'),
          'taxonomies' => array('category', 'post_tag')
        ) /* end of options */
      ); /* end of register post type */

      /* this adds your post categories to your custom post type */
      register_taxonomy_for_object_type('category', $pt[0]);
      /* this adds your post tags to your custom post type */
      register_taxonomy_for_object_type('post_tag', $pt[0]);

    }     

  } 

  // adding the function to the Wordpress init
  add_action( 'init', 'custom_posts');

// Add to the init hook of your theme functions.php file
add_filter('request', 'add_tags_and_categories');  
function add_tags_and_categories($q) {
  if (isset($q['tag']) || isset($q['category_name'])) {
    $q['post_type'] = get_post_types();

    return $q;
  }

  return $q;
}

?>