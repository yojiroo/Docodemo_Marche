<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Extend - Site Origin Panels 
 */
add_filter('siteorigin_panels_full_width_container', 'ascend_fullwidth_container_id');
function ascend_fullwidth_container_id($tag) {
	if($tag == 'body') {
		$tag = '#inner-wrap';
	}
	return $tag;
}

function ascend_siteoriginpanels_row_attributes($attr, $row) {
  if(!empty($row['style']['class'])) {
    if(empty($attr['style'])) $attr['style'] = '';
    $attr['style'] .= 'margin-bottom: 0px;';
    $attr['style'] .= 'margin-left: 0px;';
    $attr['style'] .= 'margin-right: 0px;';
  }

  return $attr;
}
add_filter('siteorigin_panels_row_attributes', 'ascend_siteoriginpanels_row_attributes', 10, 2);

function ascend_panels_row_background_styles($fields) {
	$fields['vertical_gutter'] = array(
        'name'      => __('Vertical Gutter', 'ascend'),
        'description' => __('Default matches row bottom margin settings.'),
        'type'      => 'select',
        'options'   => array(
               "default"       => __("Default", "ascend"),
               "no-margin"    => __("No Margin", "ascend"),
        ),
        'group'     => 'layout',
        'priority'  => 6,
  );
	$fields['background_image_url'] = array(
        'name'      => __('Background image external url', 'ascend'),
        'group'     => 'design',
        'description' => 'optional, overridden by button below.',
        'type'      => 'url',
        'priority'  => 4,
      );
  	$fields['background_image'] = array(
        'name'      => __('Background Image', 'ascend'),
        'group'     => 'design',
        'type'      => 'image',
        'priority'  => 5,
      );
  	$fields['background_image_position'] = array(
        'name'      => __('Background Image Position', 'ascend'),
        'type'      => 'select',
        'group'     => 'design',
        'default'   => 'center top',
        'priority'  => 6,
        'options'   => array(
               "left top"       => __("Left Top", "ascend"),
               "left center"    => __("Left Center", "ascend"),
               "left bottom"    => __("Left Bottom", "ascend"),
               "center top"     => __("Center Top", "ascend"),
               "center center"  => __("Center Center", "ascend"),
               "center bottom"  => __("Center Bottom", "ascend"),
               "right top"      => __("Right Top", "ascend"),
               "right center"   => __("Right Center", "ascend"),
               "right bottom"   => __("Right Bottom", "ascend")
                ),
      );
  $fields['background_image_style'] = array(
        'name'      => __('Background Image Style', 'ascend'),
        'type'      => 'select',
        'group'     => 'design',
        'default'   => 'center top',
        'priority'  => 6,
        'options'   => array(
             "cover"      => __("Cover", "ascend"),
             "parallax"   => __("Parallax", "ascend"),
             "contain"  	=> __("contain", "ascend"),
             "no-repeat"  => __("No Repeat", "ascend"),
             "repeat"     => __("Repeat", "ascend"),
             "repeat-x"   => __("Repeat-X", "ascend"),
             "repeat-y"   => __("Repeat-y", "ascend"),
              ),
        );
  $fields['border_top'] = array(
        'name'      => __('Border Top Size', 'ascend'),
        'type'      => 'measurement',
        'group'     => 'design',
        'priority'  => 8,
  );
  $fields['border_top_color'] = array(
        'name'      => __('Border Top Color', 'ascend'),
        'type'      => 'color',
        'group'     => 'design',
        'priority'  => 8.5,
      );
  $fields['border_bottom'] = array(
        'name'      => __('Border Bottom Size', 'ascend'),
        'type'      => 'measurement',
        'group'     => 'design',
        'priority'  => 9,
  );
  $fields['border_bottom_color'] = array(
        'name' => __('Border Bottom Color', 'ascend'),
        'type' => 'color',
        'group' => 'design',
        'priority' => 9.5,
  );
  $fields['row_separator'] = array(
        'name'      => __('Row Separator', 'ascend'),
        'type'      => 'select',
        'group'     => 'design',
        'default'   => 'none',
        'priority'  => 10,
        'options'   => array(
               "none"       				=> __("None", "ascend"),
               "center_triangle"    		=> __("Center Triangle", "ascend"),
               "center_triangle_double"    	=> __("Center Triangle Double", "ascend"),
               "left_triangle"  			=> __("Left Triangle", "ascend"),
               "right_triangle"  			=> __("Right Triangle", "ascend"),
               "tilt_left"     				=> __("Tilt Left", "ascend"),
               "tilt_right"  				=> __("Tilt Right", "ascend"),
               "center_small_triangle"  	=> __("Center Small Triangle", "ascend"),
               "three_small_triangle"  	=> __("Three Small Triangle", "ascend"),
                ),
      );
  $fields['next_row_background_color'] = array(
        'name'      => __('Next Row Background Color', 'ascend'),
        'type'      => 'color',
        'group'     => 'design',
        'default'   => 'none',
        'priority'  => 10.5,
      );
  return $fields;
}
add_filter('siteorigin_panels_row_style_fields', 'ascend_panels_row_background_styles');
function ascend_panels_remove_row_background_styles($fields) {
 unset( $fields['background_image_attachment'] );
 unset( $fields['background_display'] );
 unset( $fields['border_color'] );
 return $fields;
}
add_filter('siteorigin_panels_row_style_fields', 'ascend_panels_remove_row_background_styles');

function ascend_panels_row_background_styles_sep($attributes, $args) {
	$attributes['style'] = '';
	$attributes['class'] = 'panel-row-style kt-row-style-no-padding';
	if(!empty($args['background_image']) || !empty($args['background_image_url'] )) {
	   	if(!empty($args['background_image'])){
	    	$url = wp_get_attachment_image_src( $args['background_image'], 'full' );
	    } else {
	    	$url = false;
	    }
	    if($url == false ) {
	        $attributes['style'] .= 'background-image: url(' . $args['background_image_url'] . ');';
	    } else {
	        $attributes['style'] .= 'background-image: url(' . $url[0] . ');';
	    }
      	if(!empty($args['background_image_style'])) {
            switch( $args['background_image_style'] ) {
              	case 'no-repeat':
                	$attributes['style'] .= 'background-repeat: no-repeat;';
                break;
              	case 'repeat':
                	$attributes['style'] .= 'background-repeat: repeat;';
                break;
              	case 'repeat-x':
                	$attributes['style'] .= 'background-repeat: repeat-x;';
                break;
              	case 'repeat-y':
                	$attributes['style'] .= 'background-repeat: repeat-y;';
                break;
                case 'contain':
                	$attributes['style'] .= 'background-repeat: no-repeat;';
                	$attributes['style'] .= 'background-size: contain;';
                break;
              	case 'cover':
                	$attributes['style'] .= 'background-size: cover;';
                break;
              	case 'parallax':
                	$attributes['class'] .= ' kt-parallax-stellar';
                	$attributes['data-ktstellar-background-ratio'] = '0.5';
                break;
            }
        }
        if(!empty($args['background_image_position'])) {
            $attributes['style'] .= 'background-position: '.$args['background_image_position'].';';
        }
  	}
	if( !empty( $args['background'] ) ) {
		$attributes['style'] .= 'background-color:' . $args['background']. ';';
	}
	if( !empty( $args['bottom_margin'] ) ) {
		$attributes['style'] .= 'margin-bottom:' . $args['bottom_margin']. ';';
	}
	if( isset( $args['vertical_gutter'] ) && 'no-margin' == $args['vertical_gutter'] ) {
		$attributes['class'] .= ' kt-no-vertical-gutter';
	}
	if( !empty( $args['id'] ) ) {
		$attributes['id'] = $args['id'];
	}
	if( (!empty( $args['row_stretch']) && $args['row_stretch'] == 'full') || (!empty( $args['row_stretch']) && $args['row_stretch'] == 'full-stretched' )  ) {
	    	$attributes['style'] .= 'opacity: 0;';
	  	}
  	if( !empty( $args['row_stretch'] ) ) {
  		$attributes['class'] .= ' siteorigin-panels-stretch';
    	$attributes['data-stretch-type'] = $args['row_stretch'];
    	wp_enqueue_script('siteorigin-panels-front-styles');
  	}
  	if(!empty( $args['row_stretch']) && $args['row_stretch'] == 'full') {
    	$attributes['class'] .= ' kt-panel-row-stretch';
  	}
  	if(!empty( $args['row_stretch']) && $args['row_stretch'] == 'full-stretched') {
    	$attributes['class'] .= ' kt-panel-row-full-stretch';
  	}
 	if(!empty($args['border_top'])){
   		$attributes['style'] .= 'border-top: '.esc_attr($args['border_top']).' solid; ';
 	}
	if(!empty($args['border_top_color'])){
   		$attributes['style'] .= 'border-top-color: '.$args['border_top_color'].'; ';
 	}
 	if(!empty($args['border_bottom'])){
   		$attributes['style'] .= 'border-bottom: '.esc_attr($args['border_bottom']).' solid; ';
 	}
  	if(!empty($args['border_bottom_color'])){
   		$attributes['style'] .= 'border-bottom-color: '.$args['border_bottom_color'].'; ';
 	}

  	return $attributes;
}

function ascend_panels_row_background_styles_attributes($attributes, $args) {
	if(isset($args['row_separator']) && !empty($args['row_separator']) && $args['row_separator'] != 'none') {
		$attributes = array(
			'style' => '',
			'class' => array(),
			);
		if( !empty($args['row_css']) ){
		preg_match_all('/^(.+?):(.+?);?$/m', $args['row_css'], $matches);

		if(!empty($matches[0])){
				for($i = 0; $i < count($matches[0]); $i++) {
					$attributes['style'] .= $matches[1][$i] . ':' . $matches[2][$i] . ';';
				}
			}
		}
		if( !empty( $args['class'] ) ) {
			$attributes['class'] = array_merge( $attributes['class'], explode(' ', $args['class']) );
		}

	  	if( ! empty( $args[ 'padding' ] ) || ! empty( $args[ 'mobile_padding' ] ) ) {
			$attributes['class'][] = 'panel-row-style';
		} else {
			$attributes['class'][] = 'panel-no-flex';
		}

		return $attributes;
	} else {
	  	if(!empty($args['background_image']) || !empty($args['background_image_url'] )) {
	  		if(!empty($args['background_image'])){
		    	$url = wp_get_attachment_image_src( $args['background_image'], 'full' );
		    } else {
		    	$url = false;
		    }
		    if($url == false ) {
		        $attributes['style'] .= 'background-image: url(' . $args['background_image_url'] . ');';
		    } else {
		        $attributes['style'] .= 'background-image: url(' . $url[0] . ');';
		    }
	      	if(!empty($args['background_image_style'])) {
	            switch( $args['background_image_style'] ) {
	              	case 'no-repeat':
	                	$attributes['style'] .= 'background-repeat: no-repeat;';
	                break;
	              	case 'repeat':
	                	$attributes['style'] .= 'background-repeat: repeat;';
	                break;
	              	case 'repeat-x':
	                	$attributes['style'] .= 'background-repeat: repeat-x;';
	                break;
	              	case 'repeat-y':
	                	$attributes['style'] .= 'background-repeat: repeat-y;';
	                break;
	                case 'contain':
	                	$attributes['style'] .= 'background-repeat: no-repeat;';
	                	$attributes['style'] .= 'background-size: contain;';
	                break;
	              	case 'cover':
	                	$attributes['style'] .= 'background-size: cover;';
	                break;
	              	case 'parallax':
	                	$attributes['class'][] .= 'kt-parallax-stellar';
	                	$attributes['data-ktstellar-background-ratio'] = '0.5';
	                break;
	            }
	        }
	        if(!empty($args['background_image_position'])) {
	            $attributes['style'] .= 'background-position: '.$args['background_image_position'].';';
	        }
	  	}
	  	if( (!empty( $args['row_stretch']) && $args['row_stretch'] == 'full') || (!empty( $args['row_stretch']) && $args['row_stretch'] == 'full-stretched' )  ) {
	    	$attributes['style'] .= 'opacity: 0;';
	  	}
	  	if( isset( $args['vertical_gutter'] ) && 'no-margin' == $args['vertical_gutter'] ) {
			$attributes['class'][] .= 'kt-no-vertical-gutter';
		}
	  	if(!empty( $args['row_stretch']) && $args['row_stretch'] == 'full') {
	    	$attributes['class'][] .= 'kt-panel-row-stretch';
	  	}
	  	if(!empty( $args['row_stretch']) && $args['row_stretch'] == 'full-stretched') {
	    	$attributes['class'][] .= 'kt-panel-row-full-stretch';
	  	}
	 	if(!empty($args['border_top'])){
	   		$attributes['style'] .= 'border-top: '.esc_attr($args['border_top']).' solid; ';
	 	}
		if(!empty($args['border_top_color'])){
	   		$attributes['style'] .= 'border-top-color: '.$args['border_top_color'].'; ';
	 	}
	 	if(!empty($args['border_bottom'])){
	   		$attributes['style'] .= 'border-bottom: '.esc_attr($args['border_bottom']).' solid; ';
	 	}
	  	if(!empty($args['border_bottom_color'])){
	   		$attributes['style'] .= 'border-bottom-color: '.$args['border_bottom_color'].'; ';
	 	}

	  	return $attributes;
	}
}
add_filter('siteorigin_panels_row_style_attributes', 'ascend_panels_row_background_styles_attributes', 10, 2);

add_filter('siteorigin_panels_css_row_margin_bottom', 'ascend_panels_row_bottom_margin', 20, 2);
function ascend_panels_row_bottom_margin($margin, $panelsdata) {
	if(isset($panelsdata['style']['row_separator']) && !empty($panelsdata['style']['row_separator']) && $panelsdata['style']['row_separator'] != 'none') {
		$margin = '0';
	}
	return $margin;
}

function ascend_fix_row_background_with_sep($css, $panels_data, $post_id ) {
		// Add in the row padding styling
		foreach( $panels_data[ 'grids' ] as $i => $row ) {
			if( empty( $row[ 'style' ] ) ) continue;

			if( ! empty( $row['style']['background'] ) ) {
				if(isset($row['style']['row_separator']) && !empty($row['style']['row_separator']) && $row['style']['row_separator'] != 'none') {
					$css->add_row_css( $post_id, $i, '> .panel-row-style', array(
						'background' => 'transparent'
				) );
				}
			}
		}

		return $css;
}
add_filter('siteorigin_panels_css_object', 'ascend_fix_row_background_with_sep', 10, 3);
//add_filter('siteorigin_panels_row_attributes', 'ascend_panels_row_attributes', 5, 2);
function ascend_panels_row_attributes($attributes, $panelsdata) {
	if(isset($panelsdata['style']['row_separator']) && !empty($panelsdata['style']['row_separator']) && $panelsdata['style']['row_separator'] != 'none') {
		$attributes['data-id'] = $attributes['id'];
		$attributes['id'] = 'sep-'.$attributes['id'];
	}
	return $attributes;
}
add_filter('siteorigin_panels_before_row', 'ascend_panels_separator', 10, 3);
function ascend_panels_separator($content, $panelsdata, $attributes) {
	if(isset($panelsdata['style']['row_separator']) && !empty($panelsdata['style']['row_separator']) && $panelsdata['style']['row_separator'] != 'none') {
		$att = ascend_panels_row_background_styles_sep(null, $panelsdata['style']);
		$content =  '<div ';
		foreach ( $attributes as $name => $value ) {
			if($name == 'id') {
				$content .= $name.'="'.esc_attr('sep-'.$attributes['id']).'" ';
			} else {
				$content .= $name.'="'.esc_attr($value).'" ';
			}
		}
		$content .= '>';
		$content .=  '<div ';
		foreach ( $att as $name => $value ) {
				$content .= $name.'="'.esc_attr($value).'" ';
		}
		$content .= '>';
		$content .=  '<div class="inner-sep-content-wrap">';
	}
	return $content;
}
add_filter('siteorigin_panels_after_row', 'ascend_panels_separator_after', 10, 3);
function ascend_panels_separator_after($content, $panelsdata, $attributes) {
	if(isset($panelsdata['style']['row_separator']) && !empty($panelsdata['style']['row_separator']) && $panelsdata['style']['row_separator'] != 'none') {
		if(isset($panelsdata['style']['next_row_background_color']) && !empty($panelsdata['style']['next_row_background_color']) ) {
			$fill = $panelsdata['style']['next_row_background_color'];
		} else {
			$fill = '#fff';
		}
		if(isset($panelsdata['style']['row_stretch']) && !empty($panelsdata['style']['row_stretch']) ) {
			$class = 'siteorigin-panels-stretch';
		} else {
			$class = '';
		}
		if($panelsdata['style']['row_separator'] == 'center_triangle') {
			$svg = '<svg style="fill:'.esc_attr($fill).';" viewBox="0 0 100 100" preserveAspectRatio="none"><path class="large-center-triangle" d="M0 0 L50 90 L100 0 V100 H0"/></svg>';
		} else if($panelsdata['style']['row_separator'] == 'center_triangle_double') {
			$svg = '<svg style="fill:'.esc_attr($fill).';" viewBox="0 0 100 100" preserveAspectRatio="none"><path class="large-center-triangle" d="M0 0 L50 90 L100 0 V100 H0"/><path class="second-large-center-triangle" d="M0 40 L50 90 L100 40 V100 H0"/></svg>';
		} else if($panelsdata['style']['row_separator'] == 'center_small_triangle') {
			if(isset($panelsdata['style']['background']) && !empty($panelsdata['style']['background']) ) {
				$background = $panelsdata['style']['background'];
			} else {
				$background = '#fff';
			}
			$svg = '<div class="sep-triangle-bottom" style="border-top-color:'.$background.'"></div>';
		} else if($panelsdata['style']['row_separator'] == 'three_small_triangle') {
			if(isset($panelsdata['style']['background']) && !empty($panelsdata['style']['background']) ) {
				$background = $panelsdata['style']['background'];
			} else {
				$background = '#fff';
			}
			$svg = '<div class="sep-triangle-bottom left-small" style="border-top-color:'.$background.'"></div><div class="sep-triangle-bottom" style="border-top-color:'.$background.'"></div><div class="sep-triangle-bottom right-small" style="border-top-color:'.$background.'"></div>';
		} else if($panelsdata['style']['row_separator'] == 'left_triangle') {
			$svg = '<svg style="fill:'.esc_attr($fill).';" viewBox="0 0 2000 100" preserveAspectRatio="none"><polygon xmlns="http://www.w3.org/2000/svg" points="600,90 0,0 0,100 2000,100 2000,0 "></polygon></svg>';
		} else if($panelsdata['style']['row_separator'] == 'right_triangle') {
			$svg = '<svg style="fill:'.esc_attr($fill).';" viewBox="0 0 2000 100" preserveAspectRatio="none"><polygon xmlns="http://www.w3.org/2000/svg" points="600,90 0,0 0,100 2000,100 2000,0 "></polygon></svg>';
		} else if($panelsdata['style']['row_separator'] == 'tilt_right' || $panelsdata['style']['row_separator'] == 'tilt_left') {
			$svg = '<svg style="fill:'.esc_attr($fill).';" viewBox="0 0 100 100" preserveAspectRatio="none"><path class="large-angle" d="M0 0 L100 90 L100 0 V100 H0"/></svg>';
		}
		
			$content .= '<div class="panel-row-style kt-row-style-no-padding kt_sep_panel sep_'.esc_attr($panelsdata['style']['row_separator']).' '.esc_attr($class).'" data-stretch-type="full-stretched">';
				$content .= $svg;
			$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '</div>';
	}
	return $content;
}

add_filter( 'siteorigin_premium_upgrade_teaser', 'ascend_siteorigin_panels_update_notice'); 
function ascend_siteorigin_panels_update_notice() {
	return false;
}

function ascend_prebuilt_page_layouts($layouts){
	
	$layouts['home-travel-page'] = array (
    'name' => __('Travel Home Example', 'ascend'),
    'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_travel_home.jpg',
    'description' => 'Travel Home page example',
    'widgets' =>
  array (
    0 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/lush.jpg',
      'image_id' => null,
      'height' => 400,
      'height_setting' => 'normal',
      'title' => 'Travel Secrets',
      'subtitle' => 'FIND WIDE OPEN SPACES',
      'link' => '#',
      'target' => 'false',
      'align' => 'right',
      'valign' => 'center',
      'panels_info' => 
      array (
        'class' => 'kad_imgmenu_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'widget_id' => 'b8e3fa2b-870c-46af-8a5b-5660f8422556',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/backpack.jpg',
      'image_id' => null,
      'height' => 400,
      'height_setting' => 'normal',
      'title' => 'Travel Gear',
      'subtitle' => 'TRIED AND TESTED',
      'link' => '#',
      'target' => 'false',
      'align' => 'center',
      'valign' => 'center',
      'panels_info' => 
      array (
        'class' => 'kad_imgmenu_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'widget_id' => 'ae543861-56c9-4f6c-86fc-1fe8b1ba022b',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    2 => 
    array (
      'image_uri' => 'https://s3.amazonaws.com/ktdemocontent/layouts/surf.jpg',
      'image_id' => null,
      'height' => 400,
      'height_setting' => 'normal',
      'title' => 'NEW Adventures',
      'subtitle' => 'ULTIMATE TRAVEL TIPS',
      'link' => '#',
      'target' => 'false',
      'align' => 'left',
      'valign' => 'center',
      'panels_info' => 
      array (
        'class' => 'kad_imgmenu_widget',
        'raw' => false,
        'grid' => 0,
        'cell' => 2,
        'id' => 2,
        'widget_id' => 'b8e3fa2b-870c-46af-8a5b-5660f8422556',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => array (
			'height' => 500,
			'image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/skatergirl.jpg',
			'image_id' => null,
			'img_link' => '',
			'img_background_color' => '',
			'img_align' => 'right',
			'title' => 'WANDERLUST:',
			'description' => '<div style="font-size:18px;">A is a very strong desire to travel. An example of wanderlust is someone who, just after returning home from a two month trip, immediately starts planning their next one.</div>',
			'btn_text' => 'Read More',
			'btn_link' => '#',
			'link_target' => '_self',
			'content_background_color' => '',
			'filter' => false,
			'img_cover' => false,
			'panels_info' => 
	      	array (
		        'class' => 'kad_split_content_widget',
		        'raw' => false,
		        'grid' => 1,
		        'cell' => 0,
		        'id' => 3,
		        'widget_id' => 'aae72218-6a7c-4556-9a42-15db475bf784',
		        'style' => 
	        array (
	          	'background_display' => 'tile',
	        ),
      	),
    ),
    4 => 
    array (
      'title' => 'ADVENTURES:',
      'number' => 3,
      'orderby' => 'date',
      'thecate' => null,
      'first_feature' => 'true',
      'read_more' => 'true',
      'read_more_txt' => 'Read More',
      'panels_info' => 
      array (
        'class' => 'kad_recent_posts_widget',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 4,
        'widget_id' => 'c39fa4fa-c867-4b4d-95e4-556ab2df4ccd',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    5 => 
    array (
      'title' => 'TIPS & TRICKS:',
      'number' => 3,
      'orderby' => 'date',
      'thecate' => null,
      'first_feature' => 'true',
      'read_more' => 'true',
      'read_more_txt' => 'Read More',
      'panels_info' => 
      array (
        'class' => 'kad_recent_posts_widget',
        'grid' => 2,
        'cell' => 1,
        'id' => 5,
        'widget_id' => 'c39fa4fa-c867-4b4d-95e4-556ab2df4ccd',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    6 => 
    array (
      'type' => 'visual',
      'title' => 'ABOUT ME:',
      'text' => '<p style="text-align: center;"><a href="#"><img class="aligncenter wp-image-null" src="https://s3.amazonaws.com/ktdemocontent/layouts/woman.jpg" width="420" height="280" /></a></p><p style="text-align: center;">In eu finibus erat, vitae viverra nibh. Ut iaculis odio velit. Morbi et est nisl. Sed interdum eget risus vel mattis. Donec in accumsan purus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed in nulla nec neque pretium venenatis non <a href="#">read more</a>.</p>',
      'filter' => '1',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 2,
        'id' => 6,
        'widget_id' => 'ab090b7d-1d5d-41dd-b5bb-5bc92b7b22a2',
        'style' => 
        array (
          'widget_css' => 'max-width:420px
margin:auto;',
          'background_display' => 'tile',
        ),
      ),
    ),
    7 => 
    array (
      'title' => 'READY TO BEGIN YOUR ADVENTURE',
      'tsize' => 60,
      'tsmallsize' => 40,
      'tcolor' => '#ffffff',
      'title_html_tag' => 'h2',
      'subtitle' => 'THERE IS MORE TO SEE AND MORE TO DO',
      'ssize' => 40,
      'ssmallsize' => 20,
      'scolor' => '#ffffff',
      'align' => 'center',
      'btn_text' => 'Launch',
      'btn_link' => '#',
      'btn_target' => 'false',
      'btn_color' => '',
      'btn_background' => '',
      'btn_border' => '',
      'btn_border_radius' => '',
      'btn_border_color' => '',
      'btn_hover_color' => '',
      'btn_hover_background' => '',
      'btn_hover_border_color' => '',
      'panels_info' => 
      array (
        'class' => 'kad_calltoaction_widget',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 7,
        'widget_id' => '3a09ae81-dbc5-4745-a0ba-69075b862a91',
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'gutter' => '10px',
        'padding' => '50px 0px 30px 0px',
        'mobile_padding' => '20px 0px 10px 0px',
        'row_stretch' => 'full',
        'background' => '#ffffff',
        'background_image_position' => 'left top',
        'background_image_style' => 'cover',
        'row_separator' => 'left_triangle',
        'next_row_background_color' => '#eeeeee',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'class' => 'wide-feature',
        'bottom_margin' => '0px',
        'gutter' => '0px',
        'mobile_padding' => '40px 0px 10px 0px',
        'row_stretch' => 'full',
        'background' => '#eeeeee',
        'background_image_position' => 'left top',
        'background_image_style' => 'cover',
        'row_separator' => 'right_triangle',
        'next_row_background_color' => '#ffffff',
      ),
    ),
    2 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'padding' => '40px 0px 40px 0px',
        'row_stretch' => 'full',
        'background' => '#ffffff',
        'background_image_position' => 'left top',
        'background_image_style' => 'cover',
        'row_separator' => 'three_small_triangle',
        'next_row_background_color' => '#ffffff',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'padding' => '140px 0px 40px 0px',
        'mobile_padding' => '60px 0px 10px 0px',
        'row_stretch' => 'full',
        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/evergreens.jpg',
        'background_image_position' => 'center center',
        'background_image_style' => 'parallax',
        'row_separator' => 'center_triangle_double',
        'next_row_background_color' => '#333333',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 0.24977391933441850380148707699845544993877410888671875,
    ),
    1 => 
    array (
      'grid' => 0,
      'weight' => 0.49990956773376737931613433829625137150287628173828125,
    ),
    2 => 
    array (
      'grid' => 0,
      'weight' => 0.250316512931814061371227353447466157376766204833984375,
    ),
    3 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    4 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    5 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    6 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    7 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
  ),
);

	$layouts['parallax-page'] = array (
        'name' => __('Parallax Example', 'ascend'),
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_parallax_screenshot-min.jpg',
        'description' => 'A parallax page example,  Great for the landing page template.',
        'widgets' =>
  		array (
		    0 => 
		    array (
		      'text' => '<h1 style="color:#fff; font-size:70px; line-height:80px; text-align:center;">Parallax Backgrounds</h1>
		    <p style="color:#fff; text-align:center; max-width:600px; margin:0 auto;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse et leo nec justo accumsan ullamcorper a ut felis. Nunc auctor tristique enim, ut mattis mi ultricies vitae. Duis hendrerit dictum urna vitae molestie. Sed elementum enim tempus, interdum urna non, placerat massa. Maecenas ullamcorper pellentesque ornare. Nunc luctus tincidunt enim, quis molestie erat varius sit amet. Praesent nec pulvinar nibh.</p>',
		      'panels_info' => 
		      array (
		        'class' => 'WP_Widget_Text',
		        'raw' => false,
		        'grid' => 0,
		        'cell' => 0,
		        'id' => 0,
		        'widget_id' => '0ebcb546-279a-43c7-a1c6-054953a633a5',
		        'style' => 
		        array (
		        ),
		      ),
		    ),
		    1 => 
		    array (
		      'text' => '<div style="text-align:center">[btn text="View more" border="4px" borderradius="6px" link="#" tcolor="#ffffff" bcolor="transparent" bordercolor="#ffffff" thovercolor="#000000" bhovercolor="#ffffff" borderhovercolor="#ffffff" size="large" font="h1-family" icon="icon-arrow-right"]</div>',
		      'panels_info' => 
		      array (
		        'class' => 'WP_Widget_Text',
		        'raw' => false,
		        'grid' => 0,
		        'cell' => 0,
		        'id' => 1,
		        'widget_id' => '50e5fc7f-f8df-47f0-8c8f-cf61fcb4cde7',
		        'style' => 
		        array (
		        ),
		      ),
		    ),
		    2 => 
		    array (
		      'height' => 400,
		      'image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_split_content_01-min.jpg',
		      'image_id' => '',
		      'img_link' => '',
		      'img_background_color' => '',
		      'img_align' => 'left',
		      'title' => 'Evening Sky Photo Series',
		      'description' => 'Nullam luctus urna ac ultrices tristique. Aliquam id dolor in turpis dictum posuere at ac mauris. Pellentesque posuere eget nisi eu vestibulum. Maecenas ex leo, viverra at iaculis quis, mollis sit amet est. Phasellus efficitur, urna non bibendum venenatis, tortor nunc sodales nulla, id scelerisque justo metus in risus. Quisque finibus elit eu posuere ornare. Pellentesque posuere eget nisi eu vestibulum. Maecenas ex leo, viverra at iaculis quis, mollis sit amet est. Aliquam id dolor in turpis dictum posuere at ac mauris.

		    [btn text="View Gallery" border="2px" borderradius="4px" link="#" tcolor="#333333" bcolor="transparent" bordercolor="#333333" thovercolor="#ffffff" bhovercolor="#333333" borderhovercolor="#333333"]',
		      'filter' => true,
		      'btn_text' => '',
		      'btn_link' => '',
		      'link_target' => '_self',
		      'content_background_color' => '',
		      'img_cover' => false,
		      'panels_info' => 
		      array (
		        'class' => 'kad_split_content_widget',
		        'raw' => false,
		        'grid' => 1,
		        'cell' => 0,
		        'id' => 2,
		        'widget_id' => '6c4c7455-d553-4f11-a252-ca969aad2d52',
		        'style' => 
		        array (
		          'background_display' => 'tile',
		        ),
		      ),
		    ),
		    3 => 
		    array (
		      'title' => 'Night Sky Photo Series',
		      'image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_split_content_02-min.jpg',
		      'img_align' => 'right',
		      'height' => '400',
		      'description' => 'Nullam luctus urna ac ultrices tristique. Aliquam id dolor in turpis dictum posuere at ac mauris. Pellentesque posuere eget nisi eu vestibulum. Maecenas ex leo, viverra at iaculis quis, mollis sit amet est. Phasellus efficitur, urna non bibendum venenatis, tortor nunc sodales nulla, id scelerisque justo metus in risus. Quisque finibus elit eu posuere ornare. Pellentesque posuere eget nisi eu vestibulum. Maecenas ex leo, viverra at iaculis quis, mollis sit amet est. Aliquam id dolor in turpis dictum posuere at ac mauris.

		    [btn text="View Gallery" border="2px" borderradius="4px" link="#" tcolor="#333333" bcolor="transparent" bordercolor="#333333" thovercolor="#ffffff" bhovercolor="#333333" borderhovercolor="#333333"]',
		      'filter' => '1',
		      'panels_info' => 
		      array (
		        'class' => 'kad_split_content_widget',
		        'raw' => false,
		        'grid' => 2,
		        'cell' => 0,
		        'id' => 3,
		        'widget_id' => '6adef353-ae1e-4fe7-a25c-241cd364dc93',
		        'style' => 
		        array (
		        ),
		      ),
		    ),
		    4 => 
		    array (
		      'info_icon' => 'kt-icon-pencil2',
		      'image_uri' => '',
		      'image_id' => '',
		      'title' => 'Easy to Customize',
		      'description' => 'Semper nec tincidunt eu, condimentum non arcu. In hac habitasse platea dictumst. Fusce vel odio ut magna vestibulum.',
		      'background' => '',
		      'tcolor' => '',
		      'size' => 20,
		      'style' => 'kad-circle-iconclass',
		      'iconbackground' => '#444444',
		      'color' => '#ffffff',
		      'link' => '',
		      'target' => '_self',
		      'panels_info' => 
		      array (
		        'class' => 'kad_infobox_widget',
		        'raw' => false,
		        'grid' => 3,
		        'cell' => 0,
		        'id' => 4,
		        'widget_id' => 'e16da6ca-ca31-4b8b-946a-f3250cad9bdd',
		        'style' => 
		        array (
		          'background_display' => 'tile',
		        ),
		      ),
		    ),
		    5 => 
		    array (
		      'info_icon' => 'kt-icon-laptop2',
		      'image_uri' => '',
		      'image_id' => '',
		      'title' => 'Beautiful Layouts',
		      'description' => 'Duis ullamcorper sit amet diam in hendrerit. Nunc laoreet tincidunt consequat. Fusce vel odio ut magna vestibulum volutpat luctus a ante. ',
		      'background' => '',
		      'tcolor' => '',
		      'size' => 20,
		      'style' => 'kad-circle-iconclass',
		      'iconbackground' => '#444444',
		      'color' => '#ffffff',
		      'link' => '',
		      'target' => '_self',
		      'panels_info' => 
		      array (
		        'class' => 'kad_infobox_widget',
		        'raw' => false,
		        'grid' => 3,
		        'cell' => 1,
		        'id' => 5,
		        'widget_id' => 'd9dbeb73-d4f2-4e33-b995-92daa0f8aad1',
		        'style' => 
		        array (
		          'background_display' => 'tile',
		        ),
		      ),
		    ),
		  ),
		  'grids' => 
		  array (
		    0 => 
		    array (
		      'cells' => 1,
		      'style' => 
		      array (
		        'bottom_margin' => '0px',
		        'padding' => '100px 0px 100px 0px',
		        'row_stretch' => 'full',
		        'background_image_url' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_parallax_scroll_02-min.jpg',
		        'background_image_position' => 'center top',
		        'background_image_style' => 'parallax',
		        'row_separator' => 'center_triangle_double',
		        'next_row_background_color' => '#ffffff',
		      ),
		    ),
		    1 => 
		    array (
		      'cells' => 1,
		      'style' => 
		      array (
		        'padding' => '30px 0px 0px 0px',
		        'background_image_position' => 'center top',
		        'background_image_style' => 'cover',
		        'row_separator' => 'none',
		      ),
		    ),
		    2 => 
		    array (
		      'cells' => 1,
		      'style' => 
		      array (
		      ),
		    ),
		    3 => 
		    array (
		      'cells' => 2,
		      'style' => 
		      array (
		        'bottom_margin' => '30px',
		        'background_image' => false,
		        'background_image_position' => 'center top',
		        'background_image_style' => 'cover',
		        'row_separator' => 'none',
		        'next_row_background_color' => '',
		      ),
		    ),
		  ),
		  'grid_cells' => 
		  array (
		    0 => 
		    array (
		      'grid' => 0,
		      'weight' => 1,
		    ),
		    1 => 
		    array (
		      'grid' => 1,
		      'weight' => 1,
		    ),
		    2 => 
		    array (
		      'grid' => 2,
		      'weight' => 1,
		    ),
		    3 => 
		    array (
		      'grid' => 3,
		      'weight' => 0.5,
		    ),
		    4 => 
		    array (
		      'grid' => 3,
		      'weight' => 0.5,
		    ),
		  ),
		);
  	$layouts['contact-page'] = array (
        'name' => __('Contact Page Example', 'ascend'),
        'screenshot' => 'https://s3.amazonaws.com/ktdemocontent/layouts/kt_contact_page.jpg',
        'description' => 'A Contact page example with map',
        'widgets' =>
  			array (
		    0 => 
		    array (
		      'location' => '1337 S Flower St, Los Angeles, CA 90015',
		      'maptype' => 'ROADMAP',
		      'zoom' => '15',
		      'height' => 400,
		      'title' => '1337 S Flower Street',
		      'description' => 'Stop by for friendly fast service',
		      'panels_info' => 
		      array (
		        'class' => 'kad_gmap_widget',
		        'raw' => false,
		        'grid' => 0,
		        'cell' => 0,
		        'id' => 0,
		        'widget_id' => 'c89cf89e-fc20-44ae-b6af-225232086e0c',
		        'style' => 
		        array (
		          'background_display' => 'tile',
		        ),
		      ),
		    ),
		    1 => 
		    array (
		      'title' => 'Frequently Asked Questions',
		      'text' => '[accordion][pane title="What are your store hours?" start=open]
		<p>Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.</p>

		<p>Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.</p>
		[/pane][pane title="What kind of delivery options are available?"]Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.[/pane][pane title="What payment methods are accepted?"]Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.[/pane][pane title="What is your return policy?"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/pane][pane title="Do you offer bulk pricing?"]Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.[/pane][/accordion]',
		      'panels_info' => 
		      array (
		        'class' => 'WP_Widget_Text',
		        'grid' => 1,
		        'cell' => 0,
		        'id' => 1,
		        'widget_id' => 'b51e9bf9-9fb0-469d-885b-7cd1ede1d432',
		        'style' => 
		        array (
		          'background_image_attachment' => false,
		          'background_display' => 'tile',
		        ),
		      ),
		      'filter' => false,
		    ),
		    2 => 
		    array (
		      'title' => 'Send us an email',
		      'text' => '[kt_contact_form]',
		      'filter' => false,
		      'panels_info' => 
		      array (
		        'class' => 'WP_Widget_Text',
		        'raw' => false,
		        'grid' => 1,
		        'cell' => 1,
		        'id' => 2,
		        'widget_id' => 'b35863e1-4c64-4f66-849f-92429d4385de',
		        'style' => 
		        array (
		          'background_display' => 'tile',
		        ),
		      ),
		    ),
		  ),
		  'grids' => 
		  array (
		    0 => 
		    array (
		      'cells' => 1,
		      'style' => 
		      array (
		        'bottom_margin' => '0px',
		        'gutter' => '0px',
		        'padding' => '0px 0px 0px 0px',
		        'row_stretch' => 'full-stretched',
		        'background' => '#eeeeee',
		        'background_image_position' => 'center top',
		        'background_image_style' => 'cover',
		        'row_separator' => 'none',
		      ),
		    ),
		    1 => 
		    array (
		      'cells' => 2,
		      'style' => 
		      array (
		        'bottom_margin' => '30px',
		        'padding' => '20px 0px 0px 0px',
		        'background_image_position' => 'center top',
		        'background_image_style' => 'cover',
		        'row_separator' => 'none',
		      ),
		    ),
		  ),
		  'grid_cells' => 
		  array (
		    0 => 
		    array (
		      'grid' => 0,
		      'weight' => 1,
		    ),
		    1 => 
		    array (
		      'grid' => 1,
		      'weight' => 0.5,
		    ),
		    2 => 
		    array (
		      'grid' => 1,
		      'weight' => 0.5,
		    ),
		  ),
		);


  return $layouts;
}
//add_filter('siteorigin_panels_prebuilt_layouts', 'ascend_prebuilt_page_layouts');

