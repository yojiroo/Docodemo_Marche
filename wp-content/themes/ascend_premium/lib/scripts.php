<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Enqueue scripts and stylesheets
 */

function ascend_scripts() {
    global $ascend; 

    wp_enqueue_style('ascend_main', get_template_directory_uri() . '/assets/css/ascend.css', false, ASCEND_VERSION);
    if(class_exists('woocommerce')) {
    	wp_enqueue_style('ascend_woo', get_template_directory_uri() . '/assets/css/ascend_woo.css', false, ASCEND_VERSION);
    }
    if(isset($ascend['minimal_icons']) && $ascend['minimal_icons'] == '1') {
    	wp_enqueue_style('ascend_icons', get_template_directory_uri() . '/assets/css/ascend_icons_min.css', false, ASCEND_VERSION);
    } else {
    	wp_enqueue_style('ascend_icons', get_template_directory_uri() . '/assets/css/ascend_icons.css', false, ASCEND_VERSION);
    }
    if(is_rtl()) {
        wp_enqueue_style('ascend_rtl', get_template_directory_uri() . '/assets/css/rtl.css', false, ASCEND_VERSION);
    }
    if (is_child_theme()) {
      	$child_theme = wp_get_theme();
      	$child_version = $child_theme->get( 'Version' );
        wp_enqueue_style('kadence_child', get_stylesheet_uri(), false, $child_version);
    } 
  
  	if (is_single() && comments_open() && get_option('thread_comments')) {
    	wp_enqueue_script('comment-reply');
  	}
  	wp_enqueue_script('modernizrc', get_template_directory_uri() . '/assets/js/vendor/custom-modernizer-min.js', false, ASCEND_VERSION, false);
  	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/min/bootstrap-min.js', array( 'jquery'), ASCEND_VERSION, true);
  	wp_enqueue_script('ascend_plugins', get_template_directory_uri() . '/assets/js/ascend-plugins.js', array( 'jquery'), ASCEND_VERSION, true);

  	if(isset($ascend['select2_select']) && $ascend['select2_select'] == '1') {
  		if(class_exists('woocommerce')) {
  			if ( version_compare( WC_VERSION, '2.7', '>' ) ) { 
  				wp_register_script('select2', get_template_directory_uri() . '/assets/js/min/select2_v4-min.js', false, ASCEND_VERSION, true);
  			} else {
  				wp_register_script('select2', get_template_directory_uri() . '/assets/js/min/select2-min.js', false, ASCEND_VERSION, true);
  			}
  		} else {
  			wp_register_script('select2', get_template_directory_uri() . '/assets/js/min/select2-min.js', false, ASCEND_VERSION, true);
  		}
  		wp_enqueue_script('select2');
  	}
  	if(isset($ascend["smooth_scrolling"]) && $ascend["smooth_scrolling"] == '1') { 
     	wp_enqueue_script('kadence_smoothscroll', get_template_directory_uri() . '/assets/js/min/nicescroll-min.js', false, ASCEND_VERSION, false);
  	} else if(isset($ascend["smooth_scrolling"]) && $ascend["smooth_scrolling"] == '2') { 
    	wp_enqueue_script('kadence_smoothscroll', get_template_directory_uri() . '/assets/js/min/smoothscroll-min.js', false, null, true);
  	}
  	wp_enqueue_script('kadence_tiles', get_template_directory_uri() . '/assets/js/min/kt-tiles-min.js', array( 'jquery'), ASCEND_VERSION, true);
  	wp_enqueue_script('ascend_main', get_template_directory_uri() . '/assets/js/ascend-main.js', array( 'jquery'), ASCEND_VERSION, true);

  	if((isset($ascend['infinitescroll']) && $ascend['infinitescroll'] == 1) || (isset($ascend['blog_infinitescroll']) && $ascend['blog_infinitescroll'] == 1)) {
    	wp_enqueue_script('infinite_scroll', get_template_directory_uri() . '/assets/js/vendor/jquery.infinitescroll.js', false, ASCEND_VERSION, true);
  	}

  	if(class_exists('woocommerce')) {
    	if(isset($ascend['product_radio']) && $ascend['product_radio'] == 1) {
        	wp_enqueue_script( 'kt-add-to-cart-variation-radio', get_template_directory_uri() . '/assets/js/min/kt-add-to-cart-variation-radio-min.js' , array( 'jquery' ), false, ASCEND_VERSION, true );
    	} else {
       		wp_enqueue_script( 'kt-wc-add-to-cart-variation', get_template_directory_uri() . '/assets/js/min/kt-add-to-cart-variation-min.js' , array( 'jquery' ), false, ASCEND_VERSION, true );
    	}
    	if(isset($ascend['product_quantity_input']) && $ascend['product_quantity_input'] == 1) {
        		wp_enqueue_script( 'wcqi-js', get_template_directory_uri() . '/assets/js/min/wc-quantity-increment-min.js' , array( 'jquery' ), false, ASCEND_VERSION, true );
    	}
  	}
}
add_action('wp_enqueue_scripts', 'ascend_scripts', 100);

function ascend_lightbox_text() {
  	global $ascend; 
  	if(!empty($ascend['lightbox_of_text'])) {$of_text = $ascend['lightbox_of_text'];} else {$of_text = __('of', 'ascend');}
  	if(!empty($ascend['lightbox_error_text'])) {$error_text = $ascend['lightbox_error_text'];} else {$error_text = __('The image could not be loaded.', 'ascend');}
  	echo  '<script type="text/javascript">var light_error = "'.$error_text.'", light_of = "%curr% '.$of_text.' %total%";</script>';
}
add_action('wp_head', 'ascend_lightbox_text');


add_action('wp_head', 'ascend_wp_head_script_output');
function ascend_wp_head_script_output() {
    global $ascend;
    if(isset($ascend['kt_header_script']) && !empty($ascend['kt_header_script']) ){
        echo $ascend['kt_header_script'];
    }
}
add_action('ascend_after_body_open', 'ascend_wp_after_body_script_output');
function ascend_wp_after_body_script_output() {
    global $ascend;
    if(isset($ascend['kt_after_body_open_script']) && !empty($ascend['kt_after_body_open_script']) ){
        echo $ascend['kt_after_body_open_script'];
    }
}
add_action('wp_footer', 'ascend_wp_footer_script_output');
function ascend_wp_footer_script_output() {
    global $ascend;
    if(isset($ascend['kt_footer_script']) && !empty($ascend['kt_footer_script']) ){
        echo $ascend['kt_footer_script'];
    }
}
/**
 * Add Respond.js for IE8 support of media queries
 */
function ascend_ie_support_scripts() {
	wp_enqueue_script( 'ascend-html5shiv', get_template_directory_uri().'/assets/js/vendor/html5shiv.min.js' );
    wp_script_add_data( 'ascend-html5shiv', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'ascend-respond', get_template_directory_uri().'/assets/js/vendor/respond.min.js' );
    wp_script_add_data( 'ascend-respond', 'conditional', 'lt IE 9' );

    wp_enqueue_style('ascend_ie_fallback', get_template_directory_uri() . '/assets/css/ie_fallback.css', false, ASCEND_VERSION);
 	wp_style_add_data( 'ascend_ie_fallback', 'conditional', 'lt IE' );
}
add_action( 'wp_enqueue_scripts', 'ascend_ie_support_scripts');

function ascend_google_analytics() { 
  	global $ascend; 
  	if(isset($ascend['google_analytics']) && !empty($ascend['google_analytics'])) { ?>
	  	<!-- Google Analytics -->
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo esc_js($ascend['google_analytics']); ?>', 'auto');
		ga('send', 'pageview');
		</script>
		<!-- End Google Analytics -->
	  	<?php
  	}
}
add_action('wp_head', 'ascend_google_analytics', 20);
