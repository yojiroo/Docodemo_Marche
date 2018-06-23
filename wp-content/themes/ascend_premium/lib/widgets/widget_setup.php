<?php
// load widgets
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_split_content_widget.php');   
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_tabs_widget.php');   
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_image_widget.php');
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_call_to_action_widget.php');  
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_testimonial_slider_widget.php');   
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_custom_carousel_widget.php');
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_carousel_widget.php');
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_info_box_widget.php');
require_once( trailingslashit( get_template_directory() ) . 'lib/widgets/class_kad_gallery_widget.php');


/**
 * Register sidebars and widgets
 */
function ascend_sidebar_list() {
	global $ascend; 
  	$all_sidebars= array(
		array('name'=>__('Primary Sidebar', 'ascend'), 'id'=>'sidebar-primary')
		);
  	if(isset($ascend['cust_sidebars'])) {
  		if (is_array($ascend['cust_sidebars'])) {
	    	$i = 1;
	  		foreach($ascend['cust_sidebars'] as $sidebar){
	    		if(empty($sidebar)) {$sidebar = 'sidebar'.$i;}
	    		$all_sidebars[]=array('name'=>$sidebar, 'id'=>'sidebar'.$i);
	    		$i++;
	  		}
	 	}
	}
  	return $all_sidebars;
}
function ascend_register_sidebars(){
  	$sidebars = ascend_sidebar_list();
  	if (function_exists('register_sidebar')){
    	foreach($sidebars as $side){
      		ascend_register_sidebar($side['name'], $side['id']);    
    	}
  	}
}
function ascend_register_sidebar($name, $id){
  	register_sidebar(array('name'=>$name,
    	'id' => $id,
    	'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    	'after_widget' => '</div></section>',
    	'before_title' => '<h4 class="widget-title"><span>',
    	'after_title' => '</span></h4>',
  	));
}
add_action('widgets_init', 'ascend_register_sidebars');

function ascend_widgets_init() {
	global $ascend; 
	// Header Widget area.
  	register_sidebar(array(
    	'name'          => __('Header Extras Widget Area', 'ascend'),
    	'id'            => 'header_extras_widget',
	    'before_widget' => '<div id="%1$s" class="kt-above-lg-widget-area %2$s"><div class="widget-inner">',
	    'after_widget'  => '</div></div>',
	    'before_title'  => '<h4 class="header-widget-title"><span>',
	    'after_title'   => '</span></h4>',
  	));
  	register_sidebar(array(
    	'name'          => __('Header Extras Widget Area (Second) ', 'ascend'),
    	'id'            => 'header_extras_widget_second',
	    'before_widget' => '<div id="%1$s" class="kt-above-lg-widget-area %2$s"><div class="widget-inner">',
	    'after_widget'  => '</div></div>',
	    'before_title'  => '<h4 class="header-widget-title"><span>',
	    'after_title'   => '</span></h4>',
  	));
  	register_sidebar(array(
    	'name'          => __('Topbar Widget Area', 'ascend'),
    	'id'            => 'topbar_widget',
	    'before_widget' => '<div id="%1$s" class="kt-below-lg-widget-area %2$s"><div class="widget-inner">',
	    'after_widget'  => '</div></div>',
	    'before_title'  => '<span class="topbar-header-widget-title"><span>',
	    'after_title'   => '</span></span>',
  	));
  	if(isset($ascend['mobile_topbar_widget_area']) && 1 == $ascend['mobile_topbar_widget_area'] ) {
	    register_sidebar(array(
	        'name' => __('Mobile Top Icon Bar Widget Area', 'ascend'),
	        'id' => 'mobile_topbar_widget',
	        'before_widget' => '<div id="%1$s" class="kt-mobile-topbar-widget-area %2$s"><div class="widget-inner">',
	        'after_widget' => '</div></div>',
	        'before_title' => '<span class="topbar-mobile-header-widget-title"><span>',
	        'after_title' => '</span></span>',
	    ));
	}
  	// Home Page
    register_sidebar(array(
        'name'          => __('Home Widget Area', 'ascend'),
        'id'            => 'homewidget',
        'before_widget' => '<div id="%1$s" class="home-widget-area-widget %2$s"><div class="widget-inner">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ));
    // Above Footer
    if(isset($ascend['footer_extra_enable']) && $ascend['footer_extra_enable'] == 1) {
	    register_sidebar(array(
	        'name' => __('Above Footer Widget Area', 'ascend'),
	        'id' => 'above_footer',
	        'before_widget' => '<div class="above-footer-widget widget"><div id="%1$s" class="%2$s">',
	        'after_widget' => '</div></div>',
	        'before_title' => '<h4 class="widget-title"><span>',
	        'after_title' => '</span></h4>',
	    ));
	}
    // Footer 
    register_sidebar(array(
        'name' => __('Footer Column 1', 'ascend'),
        'id' => 'footer_1',
        'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<div class="footer-widget-title"><span>',
        'after_title' => '</span></div>',
    ));
    register_sidebar(array(
        'name' => __('Footer Column 2', 'ascend'),
        'id' => 'footer_2',
        'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<div class="footer-widget-title"><span>',
        'after_title' => '</span></div>',
    ));
    if(isset($ascend['footer_layout'])) {
        $footer_layout = $ascend['footer_layout'];
    } else {
        $footer_layout = "fourc";
    }
    if ($footer_layout == "fourc" || $footer_layout == "four_single" || $footer_layout == "threec" || $footer_layout == "three_single") {
        register_sidebar(array(
            'name' => __('Footer Column 3', 'ascend'),
            'id' => 'footer_3',
            'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<div class="footer-widget-title"><span>',
            'after_title' => '</span></div>',
        ));
    }
    if ($footer_layout == "fourc" || $footer_layout == "four_single") {
        register_sidebar(array(
            'name' => __('Footer Column 4', 'ascend'),
            'id' => 'footer_4',
            'before_widget' => '<div class="footer-widget widget"><aside id="%1$s" class="%2$s">',
            'after_widget' => '</aside></div>',
            'before_title' => '<div class="footer-widget-title"><span>',
            'after_title' => '</span></div>',
        ));
    }

      // Widgets
    register_widget('kad_contact_widget');
    register_widget('kad_social_widget');
    register_widget('kad_recent_posts_widget');
    register_widget('kad_testimonial_slider_widget');
    register_widget('kad_post_grid_widget');
    register_widget('kad_image_widget');
    register_widget('kad_gallery_widget');
    register_widget('kad_carousel_widget');
    register_widget('kad_infobox_widget');
    register_widget('kad_gmap_widget');
    register_widget('kad_calltoaction_widget');
    register_widget('kad_imgmenu_widget');
    register_widget('kad_split_content_widget');
    register_widget('kad_icon_flip_box_widget');
    register_widget('kad_payment_methods_widget');
    if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
    	register_widget('kad_tabs_content_widget');
    	register_widget('kad_custom_carousel_widget');
    }
}
add_action('widgets_init', 'ascend_widgets_init');
