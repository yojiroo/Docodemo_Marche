<?php 
add_filter( 'cmb2_admin_init', 'ascend_post_metaboxes');
function ascend_post_metaboxes(){
	$prefix = '_kad_';
	$kt_standard_post = new_cmb2_box( array(
		'id'         	=> 'standard_post_metabox',
		'title'      	=> __("Standard Post Options", 'ascend'),
		'object_types'  => array('post'),
		'priority'   	=> 'high',
	) );
	$kt_standard_post->add_field( array(
		'name'    => __("Post Summary", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'post_summery',
		'type'    => 'select',
		'options' => array(
			'default' 		=> __('Standard Post Default', 'ascend' ),
			'text' 			=> __('Text', 'ascend' ),
			'img_portrait' 	=> __('Portrait Image', 'ascend'),
			'img_landscape' => __('Landscape Image', 'ascend'),
			),
	) );
	// IMAGE POST //
	$kt_image_post = new_cmb2_box( array(
		'id'         	=> 'image_post_metabox',
		'title'      	=> __("Image Post Options", 'ascend'),
		'object_types'  => array( 'post' ),
		'priority'   	=> 'high',
		) );
	
	$kt_image_post->add_field( array(
		'name'    => __("Head Content", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'image_blog_head',
		'type'    => 'select',
		'options' => array(
			'default' 		=> __("Image Post Default", 'ascend' ),
			'image' 		=> __("Image", 'ascend' ),
			'image_below' 	=> __("Image Below Title", 'ascend' ),
			'none' 			=> __("None", 'ascend' ),
			),
	) );
	$kt_image_post->add_field( array(
		'name' => __("Max Image Height", 'ascend' ),
		'desc' => __("Note: just input number, example: 350", 'ascend' ),
		'id'   => $prefix . 'image_posthead_height',
		'type' => 'text_small',
	) );
	$kt_image_post->add_field( array(
		'name' => __("Max Image Width", 'ascend' ),
		'desc' => __("Note: just input number, example: 650", 'ascend' ),
		'id'   => $prefix . 'image_posthead_width',
		'type' => 'text_small',
	) );

	$kt_image_post->add_field( array(
		'name'    => __("Post Summary", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'image_post_summery',
		'type'    => 'select',
		'options' => array(
			'default' 		=> __('Image Post Default', 'ascend' ),
			'text' 			=> __('Text', 'ascend' ),
			'img_portrait' 	=> __('Portrait Image', 'ascend'),
			'img_landscape' => __('Landscape Image', 'ascend'),
		),
	) );
	// GALLERY POST
	$kt_gallery_post = new_cmb2_box( array(
		'id'         	=> 'gallery_post_metabox',
		'title'      	=> __("Gallery Post Options", 'ascend'),
		'object_types'	=> array( 'post'),
		'priority'   	=> 'high',
	) );
	
	$kt_gallery_post->add_field( array(
		'name'    => __("Post Head Content", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'gallery_blog_head',
		'type'    => 'select',
		'options' => array(
			'default' 			=> __("Gallery Post Default", 'ascend' ),
			'flex' 				=> __("Image Slider - (Cropped Image Ratio)", 'ascend' ),
			'carouselslider' 	=> __("Image Slider - (Different Image Ratio)", 'ascend' ),
			'thumbslider' 		=> __("Image Slider with thumbnails - (Cropped Image Ratio)", 'ascend' ),
			'imgcarousel' 		=> __("Image Carousel - (Muiltiple Images Showing At Once)", 'ascend' ),
			'gallery' 			=> __("Image Collage - (Use 2 to 5 images)", 'ascend' ),
			'shortcode' 		=> __("Shortcode", 'ascend' ),
			'none' 				=> __("None", 'ascend' ),
			),
	) );
	$kt_gallery_post->add_field( array(
		'name' => __("Post Slider Gallery", 'ascend' ),
		'desc' => __("Add images for gallery here - Use large images", 'ascend' ),
		'id'   => $prefix . 'image_gallery',
		'type' => 'kad_gallery',
	) );

	$kt_gallery_post->add_field( array(
		'name' => __('Gallery Post Shortcode', 'ascend'),
		'desc' => __('If using shortcode place here.', 'ascend'),
		'id'   => $prefix . 'post_gallery_shortcode',
		'type' => 'textarea_code',
	) );
	$kt_gallery_post->add_field( array(
		'name' => __("Max Slider/Image Height", 'ascend' ),
		'desc' => __("Note: just input number, example: 350", 'ascend' ),
		'id'   => $prefix . 'gallery_posthead_height',
		'type' => 'text_small',
	) );
	$kt_gallery_post->add_field( array(
		'name' => __("Max Slider/Image Width", 'ascend' ),
		'desc' => __("Note: just input number, example: 650", 'ascend' ),
		'id'   => $prefix . 'gallery_posthead_width',
		'type' => 'text_small',
	) );
	$kt_gallery_post->add_field( array(
		'name'    => __("Post Summary", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'gallery_post_summery',
		'type'    => 'select',
		'options' => array(
			'default' 			=> __('Gallery Post Default', 'ascend' ),
			'img_portrait' 		=> __('Portrait Image (feature image)', 'ascend'),
			'img_landscape' 	=> __('Landscape Image (feature image)', 'ascend'),
			'slider_portrait' 	=> __('Portrait Image Slider', 'ascend'),
			'slider_landscape' 	=> __('Landscape Image Slider', 'ascend'),
			'gallery_grid' 		=> __('Photo Collage - (Use 2 to 5 images)', 'ascend'),
			),
	) );
	// VIDEO POST
	$kt_video_post = new_cmb2_box( array(
		'id'         	=> 'video_post_metabox',
		'title'      	=> __("Video Post Options", 'ascend'),
		'object_types'  => array( 'post'),
		'priority'   	=> 'high',
	) );
	$kt_video_post->add_field( array(
		'name'    => __("Post Head Content", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'video_blog_head',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __("Video Post Default", 'ascend' ),
			'video' 	=> __("Video", 'ascend' ),
			'none' 		=> __("None", 'ascend' ),
			),
	) );

	$kt_video_post->add_field( array(
		'name' => __('Video post embed', 'ascend'),
		'desc' => __('Place url, embed code or shortcode, works with youtube, vimeo. (Use the featured image for screen shot)', 'ascend'),
		'id'   => $prefix . 'post_video',
		'type' => 'textarea_code',
	) );
	$kt_video_post->add_field( array(
		'name' => __("Video Meta Title", 'ascend' ),
		'desc' => __("Used for SEO purposes", 'ascend' ),
		'id'   => $prefix . 'video_meta_title',
		'type' => 'text',
	) );
	$kt_video_post->add_field( array(
		'name' => __("Video Meta description", 'ascend' ),
		'desc' => __("Used for SEO purposes", 'ascend' ),
		'id'   => $prefix . 'video_meta_description',
		'type' => 'text',
	) );
	$kt_video_post->add_field( array(
		'name' => __("Max Video Width", 'ascend' ),
		'desc' => __("Note: just input number, example: 650", 'ascend' ),
		'id'   => $prefix . 'video_posthead_width',
		'type' => 'text_small',
	) );
	$kt_video_post->add_field( array(
		'name'    => __("Post Summary", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'video_post_summery',
		'type'    => 'select',
		'options' => array(
			'default' 		=> __('Video Post Default', 'ascend' ),
			'video' 		=> __('Video - (when possible)', 'ascend'),
			'img_portrait' 	=> __('Portrait Image (feature image)', 'ascend'),
			'img_landscape' => __('Landscape Image (feature image)', 'ascend'),
			),
	) );
	// Quote
	$kt_quote_post = new_cmb2_box( array(
		'id'         	=> 'quote_post_metabox',
		'title'      	=> __("Quote Post Options", 'ascend'),
		'object_types'  => array( 'post'),
		'priority'   	=> 'high',
	) );
	$kt_quote_post->add_field( array(
		'name' => __("Quote author", 'ascend' ),
		'id'   => $prefix . 'quote_author',
		'type' => 'text',
	) );
	// NORMAL 
	$kt_post = new_cmb2_box( array(
		'id'         	=> 'post_metabox',
		'title'      	=> __("Post Options", 'ascend'),
		'object_types'  => array( 'post'),
		'priority'   	=> 'high',
	));
	$kt_post->add_field( array(
		'name' 		=> __('Author Info', 'ascend'),
		'desc' 		=> __('Display an author info box?', 'ascend'),
		'id'   		=> $prefix . 'blog_author',
		'type'    	=> 'select',
		'options' 	=> array(
			'default' 	=> __('Default', 'ascend'),
			'no' 		=> __('No', 'ascend'),
			'yes' 		=> __('Yes', 'ascend'),
			),
	) );
	$kt_post->add_field( array(
		'name' 		=> __('Posts Carousel', 'ascend'),
		'desc' 		=> __('Display a carousel with similar or recent posts?', 'ascend'),
		'id'   		=> $prefix . 'blog_carousel_similar',
		'type'    	=> 'select',
		'options' 	=> array(
			'default' 	=> __('Default', 'ascend'),
			'no' 		=> __('No', 'ascend'),
			'recent' 	=> __('Yes - Display Recent Posts', 'ascend'),
			'similar' 	=> __('Yes - Display Similar Posts', 'ascend'),
			),
		
	) );
	$kt_post->add_field( array(
		'name' => __('Carousel Title', 'ascend'),
		'desc' => __('ex. Similar Posts', 'ascend'),
		'id'   => $prefix . 'blog_carousel_title',
		'type' => 'text_medium',
	) );

}