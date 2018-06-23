<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * initial setup and constants
 */
function ascend_setup() {
 	global $pagenow, $ascend;
  	if(isset($ascend['above_header_style']) && $ascend['above_header_style'] == "center" && isset($ascend['site_layout']) && $ascend['site_layout'] == "above") {
      	register_nav_menus(array(
	        'left_navigation' 		=> __('Left Navigation', 'ascend'),
	        'right_navigation' 		=> __('Right Navigation', 'ascend'),
	        'secondary_navigation'	=> __('Secondary Navigation', 'ascend'),
	        'mobile_navigation' 	=> __('Mobile Navigation', 'ascend'),
	        'topbar_navigation' 	=> __('Topbar Navigation', 'ascend'),
	        'footer_navigation' 	=> __('Footer Navigation', 'ascend'),
      	));
  	} else {
  		register_nav_menus(array(
	        'primary_navigation' 	=> __('Primary Navigation', 'ascend'),
	        'secondary_navigation' 	=> __('Secondary Navigation', 'ascend'),
	        'mobile_navigation' 	=> __('Mobile Navigation', 'ascend'),
	        'topbar_navigation' 	=> __('Topbar Navigation', 'ascend'),
	        'footer_navigation' 	=> __('Footer Navigation', 'ascend'),
      	));
  	} 

    add_theme_support( 'title-tag' );
    add_theme_support('post-thumbnails');
    add_theme_support( 'woocommerce' );
    add_theme_support( 'site-logo', array( 'size' => 'full' ) );
    add_theme_support('post-formats', array('gallery', 'image', 'video', 'quote'));
    add_theme_support( 'automatic-feed-links' );
    add_editor_style('/assets/css/kt-editor-style.css');

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );


    // Indicate widget sidebars can use selective refresh in the Customizer.
    add_theme_support( 'customize-selective-refresh-widgets' );

    add_post_type_support( 'attachment', 'page-attributes' );

    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
        wp_redirect(admin_url("themes.php?page=kt_api_manager_dashboard"));
    }
    define( 'ASCEND_VERSION', '1.4.6' );

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active('virtue-toolkit/virtue_toolkit.php') ) {
		function ascend_plugin_admin_notice(){
		    echo '<div class="error"><p>Please <strong>Disable</strong> the Kadence ToolKit Plugin. It is not needed with Ascend Premium.</p></div>';
		}
		add_action('admin_notices', 'ascend_plugin_admin_notice');
	}
}
add_action('after_setup_theme', 'ascend_setup');

/**
 * Handles JavaScript detection.
 */
function ascend_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'ascend_javascript_detection', 0 );


/**
 * Page titles
 */
function ascend_title() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
				$title = get_the_title(get_option('page_for_posts', true));
		} else {
				$title = __('Latest Posts', 'ascend');
		}
	} elseif (is_search()) {
		$title = sprintf(__('Search Results for %s', 'ascend'), get_search_query());
	} elseif (is_404()) {
		$title = __('Not Found', 'ascend');
	} else {
		$title = get_the_title();
	}
	return apply_filters('ascend_title', $title);
}
/**
 * Archive Titles
 */
function ascend_title_archive() {
	if (is_home()) {
		if (get_option('page_for_posts', true)) {
				$title = get_the_title(get_option('page_for_posts', true));
		} else {
				$title = __('Latest Posts', 'ascend');
		}
	} elseif (is_archive()) {
		$title = get_the_archive_title();
	} elseif (is_search()) {
		$title = sprintf(__('Search Results for %s', 'ascend'), get_search_query());
	} elseif (is_404()) {
		$title = __('Not Found', 'ascend');
	} else {
		$title = get_the_title();
	}
	return apply_filters('ascend_title', $title);
}
add_filter('get_the_archive_title', 'ascend_filter_archive_title');
function ascend_filter_archive_title($title){
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    	if ( is_category() ) {
      		$title = single_cat_title( '', false );
    	} elseif ( is_tag() ) {
        	$title = single_tag_title( '', false );
    	} elseif (is_author()) {
      		$title = sprintf(__('Author: %s', 'ascend'), get_the_author());
    	} elseif (is_day()) {
      		$title = sprintf(__('Day: %s', 'ascend'), get_the_date());
    	} elseif (is_month()) {
      		$title = sprintf(__('Month: %s', 'ascend'), get_the_date('F Y'));
    	} elseif (is_year()) {
      		$title = sprintf(__('Year: %s', 'ascend'), get_the_date('Y'));
    	} elseif ( is_tax( array('product_cat', 'product_tag') ) ) {
    		$title = single_term_title( '', false );
    	} else if ($term) {
      		$title = $term->name;
    	} else if ( function_exists( 'is_bbpress' ) ) {
    		if ( is_bbpress() ) {
    			$title = bbp_title();
    		}
    	}
    	return $title;
}


add_action( "after_setup_theme", 'ascend_permalinks');
function ascend_permalinks() {

	global $wp_rewrite, $ascend;
	if(!empty($ascend['portfolio_permalink'])) {
		$port_rewrite = $ascend['portfolio_permalink'];
	} else {
		$port_rewrite = 'portfolio';
	}

	$portfolio_structure = '/'.$port_rewrite.'/%portfolio%';
	$wp_rewrite->add_rewrite_tag("%portfolio%", '([^/]+)', "portfolio=");
	$wp_rewrite->add_permastruct('portfolio', $portfolio_structure, false);

	add_filter('post_type_link', 'portfolio_permalink', 10, 3);  
	function portfolio_permalink($permalink, $post_id, $leavename) {
	    $post = get_post($post_id);
	    $rewritecode = array(
	        '%year%',
	        '%monthnum%',
	        '%day%',
	        '%hour%',
	        '%minute%',
	        '%second%',
	        $leavename? '' : '%postname%',
	        '%post_id%',
	        '%category%',
	        '%author%',
	        $leavename? '' : '%pagename%',
	    );
 
	    if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
	        $unixtime = strtotime($post->post_date);
	     
	        $category = '';
	        if ( strpos($permalink, '%category%') !== false ) {
	            $cats = wp_get_post_terms($post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'DESC' ));
	            if ( $cats ) {
	                $category = $cats[0]->slug;
	            }
	            // show default category in permalinks, without
	            // having to assign it explicitly
	            if ( empty($category) ) {
	                $category = 'portfolio-category';
	            }
	        }
	     
	        $author = '';
	        if ( strpos($permalink, '%author%') !== false ) {
	            $authordata = get_userdata($post->post_author);
	            $author = $authordata->user_nicename;
	        }
	     
	        $date = explode(" ",date('Y m d H i s', $unixtime));
	        $rewritereplace =
	        array(
	            $date[0],
	            $date[1],
	            $date[2],
	            $date[3],
	            $date[4],
	            $date[5],
	            $post->post_name,
	            $post->ID,
	            $category,
	            $author,
	            $post->post_name,
	        );
	        $permalink = str_replace($rewritecode, $rewritereplace, $permalink);
	    } else { 
	    	// if not using the fancy permalink option
	    }
    	return $permalink;
	}
}
function ascend_reflush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action( 'after_switch_theme', 'ascend_reflush_rules' );
// Custom 404
function ascend_custom_404_filter_template( $template ) {

  global $ascend;

  	if(isset($ascend['enable_custom_404']) && $ascend['enable_custom_404'] == 1 ) {
    	if(isset($ascend['custom_404_page']) && !empty($ascend['custom_404_page'])) {
	      	GLOBAL $wp_query;
	      	GLOBAL $post;

      		$post = get_post($ascend['custom_404_page']);

	      	$wp_query->posts             = array( $post );
	      	$wp_query->queried_object_id = $post->ID;
	      	$wp_query->queried_object    = $post;
	      	$wp_query->post_count        = 1;
	      	$wp_query->found_posts       = 1;
	      	$wp_query->max_num_pages     = 0;
	      	$wp_query->is_404            = false;
	      	$wp_query->is_page           = true;

	      	return get_page_template();

    	} else {

      		return $template;
    	}
  	} else {
    	return $template;
  	}
}
add_filter( '404_template', 'ascend_custom_404_filter_template' );