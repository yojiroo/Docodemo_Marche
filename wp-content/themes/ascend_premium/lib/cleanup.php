<?php
/**
 * Clean up language_attributes() used in <html> tag
 *  
 */
function ascend_language_attributes() {
  $attributes = array();
  $output = '';

  if (function_exists('is_rtl')) {
    if (is_rtl() == 'rtl') {
      $attributes[] = 'dir="rtl"';
    }
  }

  $lang = get_bloginfo('language');

  if ($lang && $lang !== 'en-US') {
    	$attributes[] = "lang=\"$lang\"";
  } else {
    	$attributes[] = 'lang="en"';
  }

  $output = implode(' ', $attributes);
  $output = apply_filters('kadence_language_attributes', $output);

  return $output;
}
add_filter('language_attributes', 'ascend_language_attributes');


/**
 * Wrap embedded media
 */
function ascend_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  	return '<div class="entry-content-asset videofit">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'ascend_embed_wrap', 10, 4);

/**
 * Clean up the_excerpt()
 */
function ascend_excerpt_length($length) {
 	 global $ascend; 
  	if(isset($ascend['post_word_count'])) { 
  		$excerptlength = $ascend['post_word_count'];
  	} else {
  		$excerptlength = '40';
  	} 
  	return $excerptlength;
}
add_filter('excerpt_length', 'ascend_excerpt_length', 999);

function ascend_excerpt_more($more) {
  	global $ascend; 
  	if(!empty($ascend['post_readmore_text'])) {
  		$readmore = $ascend['post_readmore_text'];
  	} else { 
  		$readmore =  __('Read More', 'ascend') ;
  	}
  	return ' &hellip; <a class="kt-excerpt-readmore more-link" href="' . get_permalink() . '" aria-label="' . esc_attr(get_the_title()) . '">'. $readmore . '</a>';
}
add_filter('excerpt_more', 'ascend_excerpt_more');

function ascend_custom_excerpt_more( $excerpt ) {
  	$excerpt_more = '';
  	if( has_excerpt() ) {
      	global $ascend; 
    	if(!empty($ascend['post_readmore_text'])) {
    		$readmore = $ascend['post_readmore_text'];
    	} else {
    		$readmore =  __('Read More', 'ascend');
    	}
    	$excerpt_more = '&hellip; <a class="kt-excerpt-readmore more-link" href="' . get_permalink() . '" aria-label="' . esc_attr(get_the_title()) . '">'. $readmore . '</a>';
  	}
  	return $excerpt . $excerpt_more;
}
add_filter( 'get_the_excerpt', 'ascend_custom_excerpt_more' );

/**
 * Add additional classes onto widgets
 *
 */
function ascend_widget_first_last_classes($params) {
  	global $my_widget_num;

  	$this_id = $params[0]['id'];
  	$arr_registered_widgets = wp_get_sidebars_widgets();

  	if (!$my_widget_num) {
    	$my_widget_num = array();
  	}

  	if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) {
   		return $params;
  	}

  	if (isset($my_widget_num[$this_id])) {
    	$my_widget_num[$this_id] ++;
  	} else {
    	$my_widget_num[$this_id] = 1;
  	}

  	$class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

  	if ($my_widget_num[$this_id] == 1) {
    	$class .= 'widget-first ';
  	} elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) {
    	$class .= 'widget-last ';
  	}

  	$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1);

  	return $params;
}
add_filter('dynamic_sidebar_params', 'ascend_widget_first_last_classes');


