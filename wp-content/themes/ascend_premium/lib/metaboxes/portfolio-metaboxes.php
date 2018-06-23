<?php 
add_filter( 'cmb2_admin_init', 'ascend_portfolio_metaboxes');
function ascend_portfolio_metaboxes(){
	$prefix = '_kad_';
	$kt_portfolio_post = new_cmb2_box( array(
		'id'         	=> 'portfolio_post_metabox',
		'title'      	=> __("Portfolio Options", 'ascend'),
		'object_types'  => array('portfolio'),
		'priority'   	=> 'high',
	) );
	$kt_portfolio_post->add_field( array(
		'name'    => __('Project Layout', 'ascend'),
		'desc'    => '<a href="http://docs.kadencethemes.com/ascend-premium/portfolio-posts/" target="_blank" >Whats the difference?</a>',
		'id'      => $prefix . 'ppost_layout',
		'type'    => 'radio_inline',
		'default' => 'default',
		'options' => array(
			'default' 		=> __("Default", 'ascend' ),
			'beside' 		=> __("Beside 40%", 'ascend' ),
			'besidesmall' 	=> __("Beside 33%", 'ascend' ),
			'above' 		=> __("Above", 'ascend' ),
			//'three' 		=> __("Page Builder", 'ascend' ),
		),
	) );
	$kt_portfolio_post->add_field( array(
		'name'    => __('Project Options', 'ascend'),
		'desc'    => '',
		'id'      => $prefix . 'ppost_type',
		'type'    => 'select',
		'options' => array(
			'image' 			=> __("Image", 'ascend' ),
			'flex' 				=> __("Image Slider (Cropped Image Ratio)", 'ascend' ),
			'carouselslider' 	=> __("Image Slider - (Different Image Ratio)", 'ascend' ),
			'thumbslider' 		=> __("Image Slider with thumbnails (Cropped Image Ratio)", 'ascend' ),
			'imgcarousel' 		=> __("Image Carousel - (Muiltiple Images Showing At Once)", 'ascend' ),
			'imagelist' 		=> __("Image List", 'ascend' ),
			'collage' 			=> __("Image Collage - (Use 2 to 5 images)", 'ascend' ),
			'imagegrid' 		=> __("Image Grid", 'ascend' ),
			'video' 			=> __("Video", 'ascend' ),
			'shortcode' 		=> __("Shortcode", 'ascend' ),
			'none' 				=> __("None", 'ascend' ),
		),
	) );
	$kt_portfolio_post->add_field( array(
		'name'    => __('Columns', 'ascend'),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_img_grid_columns',
		'type'    => 'select',
		'default' => '3',
		'options' => array(
			'2' 		=> __("Two Columns", 'ascend' ),
			'3' 		=> __("Three Columns", 'ascend' ),
			'4' 		=> __("Four Columns", 'ascend' ),
			'5' 		=> __("Five Columns", 'ascend' ),
			'6' 		=> __("Six Columns", 'ascend' ),
		),
	) );
	$kt_portfolio_post->add_field( array(
		'name' => __("Portfolio Image Gallery", 'ascend' ),
		'desc' => __("Add images for gallery here - Use large images", 'ascend' ),
		'id'   => $prefix . 'image_gallery',
		'type' => 'kad_gallery',
	) );
	$kt_portfolio_post->add_field( array(
		'name' => __('Gallery Post Shortcode', 'ascend'),
		'desc' => __('If using shortcode place here.', 'ascend'),
		'id'   => $prefix . 'portfolio_shortcode',
		'type' => 'textarea_code',
	) );
	$kt_portfolio_post->add_field( array(
		'name' => __('Video embed', 'ascend'),
		'desc' => __('Place url, embed code or shortcode, works with youtube, vimeo. (Use the featured image for screen shot)', 'ascend'),
		'id'   => $prefix . 'post_video',
		'type' => 'textarea_code',
	) );
	$kt_portfolio_post->add_field( array(
		'name' => __("Max Slider/Image Width", 'ascend' ),
		'desc' => __("Note: just input number, example: 650", 'ascend' ),
		'id'   => $prefix . 'portfolio_slider_width',
		'type' => 'text_small',
	) );
	$kt_portfolio_post->add_field( array(
		'name' => __("Max Slider/Image Height", 'ascend' ),
		'desc' => __("Note: just input number, example: 350", 'ascend' ),
		'id'   => $prefix . 'portfolio_slider_height',
		'type' => 'text_small',
	) );
	$kt_portfolio_post->add_field( array(
		'name'    => __('Project Summary', 'ascend'),
		'desc'    => 'This determines how its displayed in the Portfolio Archives',
		'id'      => $prefix . 'post_summery',
		'type'    => 'select',
		'options' => array(
			'image' 		=> __("Image", 'ascend' ),
			'slider' 		=> __("Image Slider", 'ascend' ),
			'videolight' 	=> __("Image with video lightbox (must be url)", 'ascend' ),
		),
	) );
}
add_filter( 'cmb2_admin_init', 'ascend_portfolio_carousel_metaboxes');
function ascend_portfolio_carousel_metaboxes(){
	$prefix = '_kad_';
	$kt_portfolio_carousel = new_cmb2_box( array(
		'id'         	=> 'portfolio_post_carousel_metabox',
		'title'      	=> __("Portfolio Bottom Carousel Options", 'ascend'),
		'object_types'  => array('portfolio'),
		'priority'   	=> 'high',
	) );
	$kt_portfolio_carousel->add_field( array(
		'name' => __('Carousel Title', 'ascend'),
		'desc' => __('ex. Similar Projects', 'ascend'),
		'id'   => $prefix . 'portfolio_carousel_title',
		'type' => 'text_medium',
	));
	$kt_portfolio_carousel->add_field( array(
		'name' => __('Bottom Portfolio Carousel', 'ascend'),
		'desc' => __('Display a carousel with portfolio items below project?', 'ascend'),
		'id'   => $prefix . 'portfolio_carousel',
		'type'    => 'select',
		'options' => array(
			'default' 		=> __("Default", 'ascend' ),
			'related' 		=> __("Related Post Carousel", 'ascend' ),
			'recent' 		=> __("Recent Portfolio Carousel", 'ascend' ),
			'none' 	=> __("No Carousel", 'ascend' ),
		),
	));
}


add_filter( 'cmb2_admin_init', 'ascend_portfolio_template_metaboxes');
function ascend_portfolio_template_metaboxes(){
	$prefix = '_kad_';
	$kt_portfolio_page = new_cmb2_box( array(
		'id'         	=> 'portfolio_page_metabox',
		'title'      	=> __("Portfolio Options", 'ascend'),
		'object_types'  => array('page'),
		'show_on'      	=> array( 'key' => 'page-template', 'value' => 'template-portfolio-grid.php' ),
		'priority'   	=> 'high',
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Portfolio Style", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_style',
		'type'    => 'select',
		'default' => 'portfolio-grid',
		'options' => array(
			'pgrid' 			=> __("Normal Grid", 'ascend' ),
			'pgrid-no-margin' 	=> __("Grid without margin between items", 'ascend' ),
			'poststyle' 		=> __("Post style", 'ascend' ),
			'mosaic' 			=> __("Mosaic", 'ascend' ),
			'tiles' 			=> __("Tiles", 'ascend' ),
		),
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Image Ratio", 'ascend' ),
		'desc'    => __("This doens't apply when using mosaic or tiles style.", 'ascend' ),
		'id'      => $prefix . 'portfolio_ratio',
		'type'    => 'select',
		'default' => 'square',
		'options' => array(
			'square' 		=> __("Square", 'ascend' ),
			'portrait' 		=> __("Portrait", 'ascend' ),
			'landscape' 	=> __("Landscape", 'ascend' ),
			'widelandscape' => __("Wide Landscape", 'ascend' ),
			'softcrop' 		=> __("Inherit from uploaded image", 'ascend' ),
		),
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Columns", 'ascend' ),
		'desc'    => __("This doens't apply when using mosaic or tiles style.", 'ascend' ),
		'id'      => $prefix . 'portfolio_columns',
		'type'    => 'select',
		'default' => '3',
		'options' => array(
			'2' 	=> __("Two Columns", 'ascend' ),
			'3' 	=> __("Three Columns", 'ascend' ),
			'4' 	=> __("Four Columns", 'ascend' ),
			'5' 	=> __("Five Columns", 'ascend' ),
			'6' 	=> __("Six Columns", 'ascend' ),
		),
	) );
	$kt_portfolio_page->add_field( array(
		'name' 		=> __('Portfolio Type', 'ascend'),
		'desc' 		=> '',
		'id'   		=> $prefix . 'portfolio_type',
		'type' 		=> 'kt_select_type',
		'taxonomy' 	=> 'portfolio-type',
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Items per Page", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_items',
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
	$kt_portfolio_page->add_field( array(
		'name'    => __("Order by", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_orderby',
		'type'    => 'select',
		'default' => 'menu_order',
		'options' => array(
			'menu_order' 	=> __("Menu Order", 'ascend' ),
			'date' 			=> __("Date", 'ascend' ),
			'title' 		=> __("Title", 'ascend' ),
			'rand' 			=> __("Random", 'ascend' ),
		),
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Show Type?", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_types',
		'type'    => 'select',
		'default' => 'true',
		'options' => array(
			'true' 	=> __("Yes, enabled", 'ascend' ),
			'false' => __("No, disabled", 'ascend' ),
		),
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Show Excerpt?", 'ascend' ),
		'desc'    => '',
		'id'      => $prefix . 'portfolio_excerpt',
		'type'    => 'select',
		'default' => 'false',
		'options' => array(
			'false' => __("No, disabled", 'ascend' ),
			'true' 	=> __("Yes, enabled", 'ascend' )
		),
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Add lightbox link?", 'ascend' ),
		'desc'    => __("This adds a lightbox icon to post.", 'ascend' ),
		'id'      => $prefix . 'portfolio_lightbox',
		'type'    => 'select',
		'default' => 'true',
		'options' => array(
			'true' 	=> __("Yes, enabled", 'ascend' ),
			'false' => __("No, disabled", 'ascend' ),
		),
	) );
	$kt_portfolio_page->add_field( array(
		'name'    => __("Enable Filter", 'ascend' ),
		'desc'    => __("This is only a filter for what is visible on the page does not query for more posts. NOTE: This doens't apply when using tiles style.", 'ascend' ),
		'id'      => $prefix . 'portfolio_filter',
		'type'    => 'select',
		'default' => 'false',
		'options' => array(
			'false' => __("No, disabled", 'ascend' ),
			'true' 	=> __("Yes, enabled", 'ascend' ),
		),
	) );
}