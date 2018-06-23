<?php 
add_filter( 'cmb2_admin_init', 'ascend_testimonial_metaboxes');
function ascend_testimonial_metaboxes(){
	$prefix = '_kad_';
	$kt_testimonial_post = new_cmb2_box( array(
		'id'         	=> 'testimonial_post_metabox',
		'title'      	=> __("testimonial Options", 'ascend'),
		'object_types'  => array('testimonial'),
		'priority'   	=> 'high',
	) );
	$kt_testimonial_post->add_field( array(
		'name' 	=> __('Location', 'ascend'),
		'desc' 	=> __('ex: New York, NY', 'ascend'),
		'id'   	=> $prefix . 'testimonial_location',
		'type' 	=> 'text',
	) );
	$kt_testimonial_post->add_field( array(
		'name' 	=> __('Occupation', 'ascend'),
		'desc' 	=> __('ex: CEO of Example Inc', 'ascend'),
		'id'   	=> $prefix . 'testimonial_occupation',
		'type' 	=> 'text',
	) );
	$kt_testimonial_post->add_field( array(
		'name' 	=> __('Link', 'ascend'),
		'desc' 	=> __('ex: http://www.example.com', 'ascend'),
		'id'   	=> $prefix . 'testimonial_link',
		'type' 	=> 'text',
	) );
	
}

add_filter( 'cmb2_admin_init', 'ascend_testimonial_template_metaboxes');
function ascend_testimonial_template_metaboxes(){
	$prefix = '_kad_';
	$kt_testimonial_page = new_cmb2_box( array(
		'id'         	=> 'testimonial_page_metabox',
		'title'      	=> __("Testimonial Options", 'ascend'),
		'object_types'  => array('page'),
		'show_on'      	=> array( 'key' => 'page-template', 'value' => 'template-testimonial-grid.php' ),
		'priority'   	=> 'high',
	) );
	$kt_testimonial_page->add_field( array(
		'name'    => __("Columns", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'testimonial_columns',
		'type'    => 'select',
		'default' => '3',
		'options' => array(
			'1' 	=> __("One Columns", 'ascend' ),
			'2' 	=> __("Two Columns", 'ascend' ),
			'3' 	=> __("Three Columns", 'ascend' ),
			'4' 	=> __("Four Columns", 'ascend' ),
			'5' 	=> __("Five Columns", 'ascend' ),
			'6' 	=> __("Six Columns", 'ascend' ),
		),
	) );
	$kt_testimonial_page->add_field( array(
		'name' 		=> __('Testimonial Group', 'ascend'),
		'desc' 		=> '',
		'id'   		=> $prefix . 'testimonial_type',
		'type' 		=> 'kt_select_group',
		'taxonomy' 	=> 'testimonial-group',
	) );
	$kt_testimonial_page->add_field( array(
		'name'    => __("Items per Page", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'testimonial_items',
		'type'    => 'select',
		'default' => '-1',
		'options' => array(
			'-1' 	=> __("All", 'ascend' ),
			'3' 	=> __("3", 'ascend' ),
			'4' 	=> __("4", 'ascend' ),
			'5' 	=> __("5", 'ascend' ),
			'6' 	=> __("6", 'ascend' ),
			'7' 	=> __("7", 'ascend' ),
			'8' 	=> __("8", 'ascend' ),
			'9' 	=> __("9", 'ascend' ),
			'10' 	=> __("10", 'ascend' ),
			'11' 	=> __("11", 'ascend' ),
			'12' 	=> __("12", 'ascend' ),
			'13' 	=> __("13", 'ascend' ),
			'14' 	=> __("14", 'ascend' ),
			'15' 	=> __("15", 'ascend' ),
			'16' 	=> __("16", 'ascend' ),
			'17' 	=> __("17", 'ascend' ),
			'18' 	=> __("18", 'ascend' ),
		),
	) );
	$kt_testimonial_page->add_field( array(
		'name'    => __("Order by", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'testimonial_orderby',
		'type'    => 'select',
		'default' => 'menu_order',
		'options' => array(
			'menu_order' 	=> __("Menu Order", 'ascend' ),
			'date' 			=> __("Date", 'ascend' ),
			'title' 		=> __("Title", 'ascend' ),
			'rand' 			=> __("Random", 'ascend' ),
		),
	) );
	$kt_testimonial_page->add_field( array(
		'name'    => __("Show Excerpt or full content", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'testimonial_content',
		'type'    => 'select',
		'default' => 'content',
		'options' => array(
			'content' 	=> __("Full Content", 'ascend' ),
			'excerpt' 	=> __("Excerpt", 'ascend' ),
		),
	) );
	$kt_testimonial_page->add_field( array(
		'name'    => __("Add link to single post?", 'ascend' ),
		'desc'    => __("This is only for when showing full content.", 'ascend' ),
		'id'      => $prefix . 'single_testimonial_link',
		'type'    => 'select',
		'default' => 'false',
		'options' => array(
			'false' => __("No, disabled", 'ascend' ),
			'true' 	=> __("Yes, enabled", 'ascend' ),
		),
	) );
}

