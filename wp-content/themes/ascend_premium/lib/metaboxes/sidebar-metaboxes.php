<?php 
add_filter( 'cmb2_admin_init', 'ascend_sidebar_metaboxes');
function ascend_sidebar_metaboxes(){
	$prefix = '_kad_';
	$kt_sidebar = new_cmb2_box( array(
		'id'         	=> 'sidebar_post_metabox',
		'title'      	=> __("Sidebar Options", 'ascend'),
		'object_types' 	=> ascend_all_custom_posts(),
		'priority'   	=> 'low',
		'context'      	=> 'side',
	) );
	$kt_sidebar->add_field( array(
		'name' 		=> __('Display Sidebar?', 'ascend'),
		'id'   		=> $prefix . 'post_sidebar',
		'type'    	=> 'select',
		'options' 	=> array(
			'default' 	=> __('Default', 'ascend'),
			'yes' 		=> __('Yes', 'ascend'),
			'no'		 => __('No', 'ascend'),
			),
	) );
	$kt_sidebar->add_field( array(
		'name'    => __('Choose Sidebar', 'ascend'),
		'desc'    => '',
		'id'      => $prefix . 'sidebar_choice',
		'type'    => 'select',
		'options' => ascend_cmb_sidebar_options(),
	) );
}