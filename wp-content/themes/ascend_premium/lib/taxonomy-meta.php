<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
add_action( 'admin_init', 'ascend_register_taxonomy_meta_boxes' );

function ascend_register_taxonomy_meta_boxes() {
	if ( !class_exists( 'Ascend_Taxonomy_Meta' ) )
		return;

	$meta_sections = array();
	$prefix = 'kad_';

	$meta_sections[] = array(
		'title'      => 'Portfolio Type Options',
		'taxonomies' => array('portfolio-type'),
		'id'         => 'portfolio_cat_image',
		'fields' => array(
			array(
			    'name' => __('Type Image', 'ascend' ),
			    'id' => 'category_image',
			    'type' => 'image',
			),
		),
	);
	$meta_sections[] = array(
		'title'      => 'Header Options',
		'taxonomies' => array('product_cat', 'product_tag','category', 'post_tag', 'portfolio-type', 'portfolio-tag', 'staff-group', 'testimonial-group', 'kt_album', 'series', 'speaker'),
		'id'         => 'ascend_archive_pageheader',
		'fields' => array(
			array(
				'name'    => __("Align Text", 'ascend' ),
				'id'      => $prefix . 'pagetitle_align',
				'type'    => 'select',
				'options' => array(
					'default' => __("Default", 'ascend' ),
					'left' => __("Align Left", 'ascend' ),
					'center' => __("Align Center", 'ascend' ),
					'right' => __("Align Right", 'ascend' ),
				),
			),
			array(
				'name' => __( "Title Font Size", 'ascend' ),
				'id'   => $prefix . 'pagetitle_title_fs_large',
				'desc' => __( "Overrides default - Just enter number e.g. 80", 'ascend' ),
				'type' => 'text',
			),
			array(
				'name' => __( "Smaller Device - Title Font Size", 'ascend' ),
				'id'   => $prefix . 'pagetitle_title_fs_small',
				'desc' => __( "Overrides default - Just enter number e.g. 40", 'ascend' ),
				'type' => 'text',
			),
			array(
				'name' => __( "Subtitle", 'ascend' ),
				'id'   => $prefix . 'pagetitle_subtitle',
				'desc' => __( "Appears below title", 'ascend' ),
				'type' => 'text',
			),
			array(
				'name' => __( "Subtitle Font Size", 'ascend' ),
				'id'   => $prefix . 'pagetitle_sub_fs_large',
				'desc' => __( "Overrides default - Just enter number e.g. 40", 'ascend' ),
				'type' => 'text',
			),
			array(
				'name' => __( "Smaller Device - Subtitle Font Size", 'ascend' ),
				'id'   => $prefix . 'pagetitle_sub_fs_small',
				'desc' => __( "Overrides default - Just enter number e.g. 15", 'ascend' ),
				'type' => 'text',
			),
			array(
			    'name' => __('Title Color', 'ascend'),
			    'id'   => $prefix . 'pagetitle_title_color',
			    'type' => 'color',
			),
			array(
			    'name' => __('Sub Title Color', 'ascend'),
			    'id'   => $prefix . 'pagetitle_sub_color',
			    'type' => 'color',
			),
			array(
			    'name' => __('Background Color', 'ascend'),
			    'id'   => $prefix . 'pagetitle_bg_color',
			    'type' => 'color',
			),
			array(
			    'name' => __('Background Image', 'ascend' ),
			    'id' => $prefix . 'pagetitle_bg_image',
			    'type' => 'image',
			),
			array(
				'name'    => __("Background Image Position", 'ascend' ),
				'id'      => $prefix . 'pagetitle_bg_position',
				'type'    => 'select',
				'options' => array(
					'left top' => __("Left Top", 'ascend' ),
					'left center' => __("Left Center", 'ascend' ),
					'left bottom' => __("Left Bottom", 'ascend' ),
					'center top' => __("Center Top", 'ascend' ),
					'center center' => __("Center Center", 'ascend' ),
					'center bottom' => __("Center Bottom", 'ascend' ),
					'right top' => __("Right Top", 'ascend' ),
					'right center' => __("Right Center", 'ascend' ),
					'right bottom' => __("Right Bottom", 'ascend' ),
				),
			),
			array(
			    'name' => __('Repeat Background Image', 'ascend' ),
			    'id' => $prefix . 'pagetitle_bg_repeat',
			    'type' => 'checkbox'
			),
			array(
				'name'    => __("Background Image Size", 'ascend' ),
				'id'      => $prefix . 'pagetitle_bg_size',
				'type'    => 'select',
				'options' => array(
					'cover' 	=> __("Cover", 'ascend' ),
					'contain' 	=> __("Contain", 'ascend' ),
					'auto'		=> __("Auto", 'ascend' ),
					'100% 100%' => __("100%", 'ascend' ),
				),
			),
			array(
			    'name' => __('Background Parallax', 'ascend' ),
			    'id' => $prefix . 'pagetitle_bg_parallax',
			    'type' => 'checkbox'
			),
			array(
				'name' => __( "Height", 'ascend' ),
				'id'   => $prefix . 'pagetitle_height',
				'desc' => __( "Overrides default - Just enter number e.g. 450", 'ascend' ),
				'type' => 'text',
			),
			array(
				'name' => __( "Small Device Height", 'ascend' ),
				'id'   => $prefix . 'pagetitle_height_small',
				'desc' => __( "Overrides default - Just enter number e.g. 250", 'ascend' ),
				'type' => 'text',
			),
			array(
				'name' => __( "Overide and use a Shortcode Slider", 'ascend' ),
				'id'   => $prefix . 'shortcode_slider',
				'desc' => __( 'Paste slider shortcode here (example: [kadence_slider id="200"])', 'ascend' ),
				'type' => 'text',
			),
			array(
				'name'    => __("Display Page Title", 'ascend' ),
				'id'      => $prefix . 'pagetitle_hide',
				'type'    => 'select',
				'options' => array(
					'defualt' => __("Default", 'ascend' ),
					'show' => __("Show", 'ascend' ),
					'hide' => __("Hide", 'ascend' ),
				),
			),
			array(
				'name'    => __("Transparent Header?", 'ascend' ),
				'id'      => $prefix . 'transparent_header',
				'type'    => 'select',
				'options' => array(
					'defualt' => __("Default", 'ascend' ),
					'true' => __("True", 'ascend' ),
					'false' => __("False", 'ascend' ),
				),
			),
		),
	);

	foreach ( $meta_sections as $meta_section )
	{
		new Ascend_Taxonomy_Meta( $meta_section );
	}
}