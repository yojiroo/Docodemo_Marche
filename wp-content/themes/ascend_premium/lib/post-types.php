<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Custom post types
function ascend_portfolio_post_init() {
  $portfoliolabels = array(
    'name' =>  __('Portfolio', 'ascend'),
    'singular_name' => __('Portfolio Item', 'ascend'),
    'add_new' => __('Add New', 'ascend'),
    'add_new_item' => __('Add New Portfolio Item', 'ascend'),
    'edit_item' => __('Edit Portfolio Item', 'ascend'),
    'new_item' => __('New Portfolio Item', 'ascend'),
    'all_items' => __('All Portfolio', 'ascend'),
    'view_item' => __('View Portfolio Item', 'ascend'),
    'search_items' => __('Search Portfolio', 'ascend'),
    'not_found' =>  __('No Portfolio Item found', 'ascend'),
    'not_found_in_trash' => __('No Portfolio Items found in Trash', 'ascend'),
    'parent_item_colon' => '',
    'menu_name' => __('Portfolio', 'ascend')
  );

  $portargs = array(
    'labels' => $portfoliolabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite'  => false,
    'has_archive' => false, 
    'capability_type' => apply_filters('kadence_portfolio_capability_type','post'), 
    'map_meta_cap' =>  apply_filters('kadence_portfolio_map_meta_cap',null),
    'hierarchical' => false,
    'menu_position' => 8,
    'menu_icon' => 'dashicons-format-gallery',
    'supports' => array( 'title', 'excerpt', 'editor', 'author', 'page-attributes', 'thumbnail', 'comments', 'revisions' )
  ); 
  // Initialize Taxonomy Labels
    $typelabels = array(
        'name' => __( 'Portfolio Type', 'ascend' ),
        'singular_name' => __( 'Type', 'ascend' ),
        'search_items' =>  __( 'Search Type', 'ascend' ),
        'all_items' => __( 'All Type', 'ascend' ),
        'parent_item' => __( 'Parent Type', 'ascend' ),
        'parent_item_colon' => __( 'Parent Type:', 'ascend' ),
        'edit_item' => __( 'Edit Type', 'ascend' ),
        'update_item' => __( 'Update Type', 'ascend' ),
        'add_new_item' => __( 'Add New Type', 'ascend' ),
        'new_item_name' => __( 'New Type Name', 'ascend' ),
    );
    $portfolio_type_slug = apply_filters('kadence_portfolio_type_slug', 'portfolio-type');
    // Register Custom Taxonomy
    register_taxonomy('portfolio-type',array('portfolio'), array(
        'hierarchical' => true, // define whether to use a system like tags or categories
        'labels' => $typelabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $portfolio_type_slug )
    ));
    $taglabels = array(
        'name' => __( 'Portfolio Tags', 'ascend' ),
        'singular_name' => __( 'Tags', 'ascend' ),
        'search_items' =>  __( 'Search Tags', 'ascend' ),
        'all_items' => __( 'All Tag', 'ascend' ),
        'parent_item' => __( 'Parent Tag', 'ascend' ),
        'parent_item_colon' => __( 'Parent Tag:', 'ascend' ),
        'edit_item' => __( 'Edit Tag', 'ascend' ),
        'update_item' => __( 'Update Tag', 'ascend' ),
        'add_new_item' => __( 'Add New Tag', 'ascend' ),
        'new_item_name' => __( 'New Tag Name', 'ascend' ),
    );
    $portfolio_tag_slug = apply_filters('kadence_portfolio_tag_slug', 'portfolio-tag');
    // Register Custom Taxonomy
    register_taxonomy('portfolio-tag',array('portfolio'), array(
        'hierarchical' => false,
        'labels' => $taglabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $portfolio_tag_slug )
    ));

  register_post_type( 'portfolio', $portargs );
}
add_action( 'init', 'ascend_portfolio_post_init', 1 );
    
function ascend_testimonial_post_init() {
  $testlabels = array(
    'name' =>  __('Testimonials', 'ascend'),
    'singular_name' => __('Testimonial', 'ascend'),
    'add_new' => __('Add New', 'ascend'),
    'add_new_item' => __('Add New Testimonial', 'ascend'),
    'edit_item' => __('Edit Testimonial', 'ascend'),
    'new_item' => __('New Testimonial', 'ascend'),
    'all_items' => __('All Testimonials', 'ascend'),
    'view_item' => __('View Testimonial', 'ascend'),
    'search_items' => __('Search Testimonials', 'ascend'),
    'not_found' =>  __('No Testimonials found', 'ascend'),
    'not_found_in_trash' => __('No Testimonials found in Trash', 'ascend'),
    'parent_item_colon' => '',
    'menu_name' => __('Testimonials', 'ascend')
  );
  $testimonial_post_slug = apply_filters('kadence_testimonial_post_slug', 'testimonial');
  $testargs = array(
    'labels' => $testlabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => $testimonial_post_slug ),
    'capability_type' => apply_filters('kadence_testimonial_capability_type','post'),
    'map_meta_cap' =>  apply_filters('kadence_testimonial_map_meta_cap',null),
    'has_archive' => false,  
    'hierarchical' => false,
    'menu_position' => 22,
    'menu_icon' => 'dashicons-testimonial',
    'supports' => array( 'title', 'excerpt', 'editor', 'page-attributes', 'thumbnail', 'revisions' )
  ); 
  // Initialize Taxonomy Labels
    $taxlabels = array(
        'name' => __( 'Testimonial Group', 'ascend' ),
        'singular_name' => __( 'Testimonials', 'ascend' ),
        'search_items' =>  __( 'Search Groups', 'ascend' ),
        'all_items' => __( 'All Groups', 'ascend' ),
        'parent_item' => __( 'Parent Groups', 'ascend' ),
        'parent_item_colon' => __( 'Parent Groups:', 'ascend' ),
        'edit_item' => __( 'Edit Group', 'ascend' ),
        'update_item' => __( 'Update Group', 'ascend' ),
        'add_new_item' => __( 'Add New Group', 'ascend' ),
        'new_item_name' => __( 'New Group Name', 'ascend' ),
    );
    $testimonial_group_slug = apply_filters('kadence_testimonial_group_slug', 'testimonial-group');
    // Register Custom Taxonomy
    register_taxonomy('testimonial-group',array('testimonial'), array(
        'hierarchical' => true, // define whether to use a system like tags or categories
        'labels' => $taxlabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $testimonial_group_slug )
    ));

  register_post_type( 'testimonial', $testargs );
}
add_action( 'init', 'ascend_testimonial_post_init' );

function ascend_staff_post_init() {
  $stafflabels = array(
    'name' =>  __('Staff', 'ascend'),
    'singular_name' => __('Staff', 'ascend'),
    'add_new' => __('Add New', 'ascend'),
    'add_new_item' => __('Add New Staff', 'ascend'),
    'edit_item' => __('Edit Staff', 'ascend'),
    'new_item' => __('New Staff', 'ascend'),
    'all_items' => __('All Staff', 'ascend'),
    'view_item' => __('View Staff', 'ascend'),
    'search_items' => __('Search Staff', 'ascend'),
    'not_found' =>  __('No Staff found', 'ascend'),
    'not_found_in_trash' => __('No Staff found in Trash', 'ascend'),
    'parent_item_colon' => '',
    'menu_name' => __('Staff', 'ascend')
  );
  $staff_post_slug = apply_filters('kadence_staff_post_slug', 'staff');
  $staffargs = array(
    'labels' => $stafflabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => $staff_post_slug ),
    'capability_type' => apply_filters('kadence_staff_capability_type','post'),
    'map_meta_cap' =>  apply_filters('kadence_staff_map_meta_cap',null),
    'has_archive' => false, 
    'hierarchical' => false,
    'menu_position' => 23,
    'menu_icon' => 'dashicons-id-alt',
    'supports' => array( 'title', 'excerpt', 'editor', 'page-attributes', 'thumbnail', 'revisions' )
  ); 
  // Initialize Taxonomy Labels
    $grouplabels = array(
        'name' => __( 'Staff Group', 'ascend' ),
        'singular_name' => __( 'Staff', 'ascend' ),
        'search_items' =>  __( 'Search Groups', 'ascend' ),
        'all_items' => __( 'All Groups', 'ascend' ),
        'parent_item' => __( 'Parent Groups', 'ascend' ),
        'parent_item_colon' => __( 'Parent Groups:', 'ascend' ),
        'edit_item' => __( 'Edit Group', 'ascend' ),
        'update_item' => __( 'Update Group', 'ascend' ),
        'add_new_item' => __( 'Add New Group', 'ascend' ),
        'new_item_name' => __( 'New Group Name', 'ascend' ),
    );
    $staff_group_slug = apply_filters('kadence_staff_group_slug', 'staff-group');
    // Register Custom Taxonomy
    register_taxonomy('staff-group',array('staff'), array(
        'hierarchical' => true, // define whether to use a system like tags or categories
        'labels' => $grouplabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $staff_group_slug )
    ));

  register_post_type( 'staff', $staffargs );
}
add_action( 'init', 'ascend_staff_post_init' );

