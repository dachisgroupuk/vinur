<?php

/** Tell WordPress to run vinur_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'vinur_post_types', 2 );

/**
 * Setup post types used in the site
 * Remember to update role capabilities too.
 *
 * @return void
 * @author Rich Holman
 * @version 1.0
 *
 **/
function vinur_post_types() {

  // Case Studies
  register_post_type( 'casestudy',
    array(
        'labels' => array(
        'name' => __( 'Case Study' ),
        'singular_name' => __( 'Case Study' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Case Study' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit Case Study' ),
        'new_item' => __( 'New Case Study' ),
        'view' => __( 'View Case Study' ),
        'view_item' => __( 'View Case Study' ),
        'search_items' => __( 'Search Case Study' ),
        'not_found' => __( 'No case studies found' ),
        'not_found_in_trash' => __( 'No case studies found in Trash' ),
        'parent' => __( 'Parent Study' ),
      ),
      'supports' => array(
          'title' ,
          'editor',
          'thumbnail',
          'custom-fields',
          'trackbacks',
          'comments',
          'excerpt',
          'revisions',
          'author'
      ),
      'menu_position' => 4,
      'public' => true,
      'rewrite' => array( 'slug' => 'casestudy', 'with_front' => true ),
      'register_meta_box_cb' => 'add_property_metaboxes',
    )
  );

}
