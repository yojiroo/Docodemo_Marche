<?php 
add_filter( 'cmb2_admin_init', 'ascend_postheader_metaboxes');
function ascend_postheader_metaboxes(){
	$prefix = '_kad_';

	$kt_postheader = new_cmb2_box( array(
		'id'         	=> 'post_header_metabox',
		'title'      	=> __("Post Title and Subtitle", 'ascend'),
		'object_types'  => array( 'product', 'post', 'portfolio', 'staff', 'testimonial', 'tribe_events', 'recipe', 'kt_gallery', 'event', 'podcast'),
		'priority'   	=> 'default',
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Post Header Title", 'ascend'),
		'desc' => __( "Post Header Title", 'ascend'),
		'id'   => $prefix . 'post_header_title',
		'type' => 'textarea_code',
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Subtitle", 'ascend' ),
		'desc' => __( "Subtitle will go below post title", 'ascend' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'textarea_code',
	) );
	$kt_postheader->add_field( array(
		'name'    => __("Align Text", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'pagetitle_align',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Default", 'ascend' ),
			'left' 		=> __("Align Left", 'ascend' ),
			'center' 	=> __("Align Center", 'ascend' ),
			'right' 	=> __("Align Right", 'ascend' ),
		),
	) );
	$kt_postheader->add_field( array(
	    'name' 		=> 'Title Color',
	    'id'   		=> $prefix . 'pagetitle_title_color',
	    'type' 		=> 'colorpicker',
	    'default'  	=> '',
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Title Font Size", 'ascend' ),
		'desc' => __( "Overrides default - Just enter number e.g. 80", 'ascend' ),
		'id'   => $prefix . 'title_fs_large',
		'type' => 'kt_text_number',
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Smaller Device - Title Font Size", 'ascend' ),
		'desc' => __( "Overrides default - Just enter number e.g. 40", 'ascend' ),
		'id'   => $prefix . 'title_fs_small',
		'type' => 'kt_text_number',
	) );
	$kt_postheader->add_field( array(
	    'name' 		=> 'SubTitle Color',
	    'id'   		=> $prefix . 'pagetitle_sub_color',
	    'type' 		=> 'colorpicker',
	    'default'  	=> '',
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Subtitle Font Size", 'ascend' ),
		'desc' => __( "Overrides default - Just enter number e.g. 30", 'ascend' ),
		'id'   => $prefix . 'sub_fs_large',
		'type' => 'kt_text_number',
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Smaller Device - Subtitle Font Size", 'ascend' ),
		'desc' => __( "Overrides default - Just enter number e.g. 18", 'ascend' ),
		'id'   => $prefix . 'sub_fs_small',
		'type' => 'kt_text_number',
	) );
	$kt_postheader->add_field( array(
	    'name' 		=> 'Background Color',
	    'id'   		=> $prefix . 'pagetitle_bg_color',
	    'type' 		=> 'colorpicker',
	    'default'  	=> '',
	) );
	$kt_postheader->add_field( array(
	    'name' 	=> 'Background Image',
	    'desc' 	=> 'Upload an image.',
	    'id' 	=> $prefix . 'pagetitle_bg_image',
	    'type' 	=> 'file',
	    'allow' => array( 'url')
	) );
	$kt_postheader->add_field( array(
		'name'    => __("Background Image Position", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'pagetitle_bg_position',
		'type'    => 'select',
		'default' => 'center center',
		'options' => array(
			'left top' 		=> __("Left Top", 'ascend' ),
			'left center' 	=> __("Left Center", 'ascend' ),
			'left bottom' 	=> __("Left Bottom", 'ascend' ),
			'center top' 	=> __("Center Top", 'ascend' ),
			'center center' => __("Center Center", 'ascend' ),
			'center bottom' => __("Center Bottom", 'ascend' ),
			'right top' 	=> __("Right Top", 'ascend' ),
			'right center' 	=> __("Right Center", 'ascend' ),
			'right bottom' 	=> __("Right Bottom", 'ascend' ),
		),
	) );
	$kt_postheader->add_field( array(
	    'name' 	=> 'Repeat Background Image',
	    'desc' 	=> '',
	    'id' 	=> $prefix . 'pagetitle_bg_repeat',
	    'type' 	=> 'checkbox'
	) );
	$kt_postheader->add_field( array(
		'name'    => __("Background Size", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'pagetitle_bg_size',
		'type'    => 'select',
		'default' => 'cover',
		'options' => array(
			'cover' 	=> __("Cover", 'ascend' ),
			'contain' 	=> __("Contain", 'ascend' ),
			'auto'		=> __("Auto", 'ascend' ),
			'100% 100%' => __("100%", 'ascend' ),
		),
	) );
	$kt_postheader->add_field( array(
	    'name' 	=> __('Background Parallax - This will override the background size setting.', 'ascend'),
	    'desc' 	=> '',
	    'id' 	=> $prefix . 'pagetitle_bg_parallax',
	    'type' 	=> 'checkbox'
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Height", 'ascend' ),
		'desc' => __( "Overrides default - Just enter number e.g. 460", 'ascend' ),
		'id'   => $prefix . 'pagetitle_height',
		'type' => 'kt_text_number',
	) );
	$kt_postheader->add_field( array(
		'name' => __( "Smaller Device - Height", 'ascend' ),
		'desc' => __( "Overrides default - Just enter number e.g. 260", 'ascend' ),
		'id'   => $prefix . 'pagetitle_height_small',
		'type' => 'kt_text_number',
	) );
	$kt_postheader->add_field( array(
		'name' => __('Override and use a Shortcode Slider', 'ascend'),
		'desc' => __('Paste slider shortcode here (example: [kadence_slider id="200"])', 'ascend'),
		'id'   => $prefix . 'shortcode_slider',
		'type' => 'textarea_code',
	) );
	$kt_postheader->add_field( array(
		'name'    => __("Hide Page Title Area", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'pagetitle_hide',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Default", 'ascend' ),
			'show' 		=> __("Show", 'ascend' ),
			'hide' 		=> __("Hide", 'ascend' ),
		),
	) );
	$kt_postheader->add_field( array(
		'name'    => __("Transparent Header?", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'transparent_header',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Default", 'ascend' ),
			'true' 		=> __("True", 'ascend' ),
			'false' 		=> __("False", 'ascend' ),
		),
	) );

}