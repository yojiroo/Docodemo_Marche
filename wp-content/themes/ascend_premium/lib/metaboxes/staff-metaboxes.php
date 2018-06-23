<?php 
add_filter( 'cmb2_admin_init', 'ascend_staff_metaboxes');
function ascend_staff_metaboxes(){
	$prefix = '_kad_';
	$kt_staff_post = new_cmb2_box( array(
		'id'         	=> 'staff_post_metabox',
		'title'      	=> __("Staff Options", 'ascend'),
		'object_types'  => array('staff'),
		'priority'   	=> 'high',
	) );
	$kt_staff_post->add_field( array(
		'name' 	=> __('Job Title', 'ascend'),
		'desc' 	=> __('ex: Customer Service', 'ascend'),
		'id'   	=> $prefix . 'staff_job_title',
		'type' 	=> 'text',
	) );
	$kt_staff_post->add_field( array(
		'name'    	=> __('Email', 'ascend'),
		'id'      	=> $prefix . 'staff_email',
		'type'	  	=> 'text',
	) );
	$kt_staff_post->add_field( array(
		'name'    	=> __('Phone', 'ascend'),
		'id'      	=> $prefix . 'staff_phone',
		'type' 		=> 'text',
	) );
	$kt_staff_post->add_field( array(
		'name'    	=> __('Facebook Link', 'ascend'),
		'id'      	=> $prefix . 'staff_facebook',
		'type' 		=> 'text',
	) );
	$kt_staff_post->add_field( array(
		'name'    	=> __('Twitter Link', 'ascend'),
		'id'      	=> $prefix . 'staff_twitter',
		'type' 		=> 'text',
	) );
	$kt_staff_post->add_field( array(
		'name'    	=> __('Instagram Link', 'ascend'),
		'id'      	=> $prefix . 'staff_instagram',
		'type' 		=> 'text',
	) );
	$kt_staff_post->add_field( array(
		'name'    	=> __('Linkedin Link', 'ascend'),
		'id'      	=> $prefix . 'staff_linkedin',
		'type' 		=> 'text',
	) );
}
add_filter( 'cmb2_admin_init', 'ascend_staff_template_metaboxes');
function ascend_staff_template_metaboxes(){
	$prefix = '_kad_';
	$kt_staff_page = new_cmb2_box( array(
		'id'         	=> 'staff_page_metabox',
		'title'      	=> __("Staff Options", 'ascend'),
		'object_types'  => array('page'),
		'show_on'      	=> array( 'key' => 'page-template', 'value' => 'template-staff-grid.php' ),
		'priority'   	=> 'high',
	) );
	$kt_staff_page->add_field( array(
		'name'    => __("Columns", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'staff_columns',
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
	$kt_staff_page->add_field( array(
		'name' 		=> __('Staff Group', 'ascend'),
		'desc' 		=> '',
		'id'   		=> $prefix . 'staff_type',
		'type' 		=> 'kt_select_group',
		'taxonomy' 	=> 'staff-group',
	) );
	$kt_staff_page->add_field( array(
		'name'    => __("Items per Page", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'staff_items',
		'type'    => 'select',
		'default' => '-1',
		'options' => array(
			'-1' 	=> __("All", 'ascend' ),
			'2' 	=> __("2", 'ascend' ),
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
	$kt_staff_page->add_field( array(
		'name'    => __("Order by", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'staff_orderby',
		'type'    => 'select',
		'default' => 'menu_order',
		'options' => array(
			'menu_order' 	=> __("Menu Order", 'ascend' ),
			'date' 			=> __("Date", 'ascend' ),
			'title' 		=> __("Title", 'ascend' ),
			'rand' 			=> __("Random", 'ascend' ),
		),
	) );
	$kt_staff_page->add_field( array(
		'name'    => __("Image Ratio", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'staff_ratio',
		'type'    => 'select',
		'default' => 'square',
		'options' => array(
			'square' 		=> __("Square", 'ascend' ),
			'portrait' 		=> __("Portrait", 'ascend' ),
			'landscape' 	=> __("Landscape", 'ascend' ),
			'widelandscape' => __("Wide Landscape", 'ascend' ),
			'softcrop' 		=> __("Inherent from uploaded image", 'ascend' ),
		),
	) );
	$kt_staff_page->add_field( array(
		'name'    => __("Show Excerpt or full content", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'staff_content',
		'type'    => 'select',
		'default' => 'excerpt',
		'options' => array(
			'excerpt' 	=> __("Excerpt", 'ascend' ),
			'content' 	=> __("Full Content", 'ascend' ),
		),
	) );
	$kt_staff_page->add_field( array(
		'name'    => __("Add link to single post?", 'ascend' ),
		'desc'    => __("This adds a link to the title and image.", 'ascend' ),
		'id'      => $prefix . 'single_staff_link',
		'type'    => 'select',
		'default' => 'false',
		'options' => array(
			'false' => __("No, disabled", 'ascend' ),
			'true' 	=> __("Yes, enabled", 'ascend' ),
		),
	) );
	$kt_staff_page->add_field( array(
		'name'    => __("Enable Filter", 'ascend' ),
		'desc'    => __("This is only a filter for what is visible on the page does not query for more posts", 'ascend' ),
		'id'      => $prefix . 'staff_filter',
		'type'    => 'select',
		'default' => 'false',
		'options' => array(
			'false' => __("No, disabled", 'ascend' ),
			'true' 	=> __("Yes, enabled", 'ascend' ),
		),
	) );
}