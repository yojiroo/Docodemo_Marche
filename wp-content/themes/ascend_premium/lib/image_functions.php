<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Image Functions
 */

function ascend_lazy_load_filter() {
  $lazy = false;
  if(function_exists( 'get_rocket_option' ) && get_rocket_option( 'lazyload') ) {
    $lazy = true;
  }
  return apply_filters('kadence_lazy_load', $lazy);
}

add_filter( 'max_srcset_image_width','ascend_srcset_max');
function ascend_srcset_max($string) {
  	return 2300;
}

function ascend_get_srcset($width,$height,$url,$id) {
  	if(empty($id) || empty($url)) {
    	return;
  	}
  
  	$image_meta = get_post_meta( $id, '_wp_attachment_metadata', true );
  	if(empty($image_meta['file'])){
    	return;
  	}
  	// If possible add in our images on the fly sizes
  	$ext = substr($image_meta['file'], strrpos($image_meta['file'], "."));
  	$pathflyfilename = str_replace($ext,'-'.$width.'x'.$height.'' . $ext, $image_meta['file']);
  	$retina_w = $width*2;
	$retina_h = $height*2;
  	$pathretinaflyfilename = str_replace($ext, '-'.$retina_w.'x'.$retina_h . $ext, $image_meta['file']);
  	$flyfilename = basename($image_meta['file'], $ext) . '-'.$width.'x'.$height.'' . $ext;
  	$retinaflyfilename = basename($image_meta['file'], $ext) . '-'.$retina_w.'x'.$retina_h . $ext;

	$upload_info = wp_upload_dir();
  	$upload_dir = $upload_info['basedir'];

  	$flyfile = trailingslashit($upload_dir).$pathflyfilename;
  	$retinafile = trailingslashit($upload_dir).$pathretinaflyfilename;
  	if(empty($image_meta['sizes']) ){ 
  		$image_meta['sizes'] = array();
  	}
	if (file_exists($flyfile)) {
      	$kt_add_imagesize = array(
        	'kt_on_fly' => array( 
          	'file'=> $flyfilename,
          	'width' => $width,
          	'height' => $height,
          	'mime-type' => isset($image_meta['sizes']['thumbnail']) ? $image_meta['sizes']['thumbnail']['mime-type'] : '',
          	)
      	);
      	$image_meta['sizes'] = array_merge($image_meta['sizes'], $kt_add_imagesize);
	}
	if (file_exists($retinafile)) {
  		//$size = getimagesize( $retinafile );
  		//if(($size[0] == 2 * $width) && ($size[1] == 2 * $height) ) {
    		$kt_add_imagesize_retina = array(
    			'kt_on_fly_retina' => array( 
	          	'file'=> $retinaflyfilename,
	          	'width' => $retina_w,
	          	'height' => $retina_h,
	          	'mime-type' => isset($image_meta['sizes']['thumbnail']) ? $image_meta['sizes']['thumbnail']['mime-type'] : '', 
	          	)
    		);
    		$image_meta['sizes'] = array_merge($image_meta['sizes'], $kt_add_imagesize_retina);
  		//}
	}
	if(function_exists ( 'wp_calculate_image_srcset') ){
  		$output = wp_calculate_image_srcset(array( $width, $height), $url, $image_meta, $id);
	} else {
  		$output = '';
	}

    return $output;
}
function ascend_get_srcset_output($width,$height,$url,$id) {
    $img_srcset = ascend_get_srcset( $width, $height, $url, $id);
    if(!empty($img_srcset) ) {
      	$output = 'srcset="'.esc_attr($img_srcset).'" sizes="(max-width: '.esc_attr($width).'px) 100vw, '.esc_attr($width).'px"';
    } else {
      	$output = '';
    }
    return $output;
}
function ascend_get_options_placeholder_image() {
    global $ascend;
    if(isset($ascend['default_placeholder_image']['id']) && !empty($ascend['default_placeholder_image']['id'])){
        return $ascend['default_placeholder_image']['id'];
    } else {
        return '';
    }
}
function ascend_default_placeholder_image() {
    return apply_filters('kadence_default_placeholder_image', 'http://placehold.it/');
}
function ascend_get_image($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false) {
    if(empty($id)) {
        $id = get_post_thumbnail_id();
    }
    if(empty($id)){
        if($placeholder == true) {
            $id = ascend_get_options_placeholder_image();
        }
    }
    if(!empty($id)) {
        $ascend_get_image = Ascend_Get_Image::getInstance();
        $image = $ascend_get_image->process( $id, $width, $height);
        if(empty($alt)) {
            $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        }
        $return_array = array(
            'src' => $image[0],
            'width' => $image[1],
            'height' => $image[2],
            'srcset' => $image[3],
            'class' => $class,
            'alt' => $alt,
            'full' => $image[4],
        );
    } else if(empty($id) && $placeholder == true) {
    	if(empty($height)){
    		$height = $width;
    	}
    	if(empty($width)){
    		$width = $height;
    	}
        $return_array = array(
            'src' => ascend_default_placeholder_image().$width.'x'.$height,
            'width' => $width,
            'height' => $height,
            'srcset' => '',
            'class' => $class,
            'alt' => $alt,
            'full' => ascend_default_placeholder_image().$width.'x'.$height,
        );
    } else {
        $return_array = array(
            'src' => '',
            'width' => '',
            'height' => '',
            'srcset' => '',
            'class' => '',
            'alt' => '',
            'full' => '',
        );
    }

    return $return_array;
}
function ascend_get_image_output($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false, $lazy = false, $schema = true, $extra = null) {
    $img = ascend_get_image($width, $height, $crop, $class, $alt, $id, $placeholder);
    if($lazy) {
        if( ascend_lazy_load_filter() ) {
            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
        } else {
            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
        }
    } else {
        $image_src_output = 'src="'.esc_url($img['src']).'"'; 
    }
    if(!empty($img['src']) && $schema == true) {
        $output = '<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
        $output .='<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" itemprop="contentUrl" alt="'.esc_attr($img['alt']).'" '.$extra.'>';
        $output .= '<meta itemprop="url" content="'.esc_url($img['src']).'">';
        $output .= '<meta itemprop="width" content="'.esc_attr($img['width']).'px">';
        $output .= '<meta itemprop="height" content="'.esc_attr($img['height']).'px">';
        $output .= '</div>';
      	return $output;

    } elseif(!empty($img['src'])) {
        return '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'" '.$extra.'>';
    } else {
        return null;
    }
}
function ascend_mosaic_sizes($icount, $i) {
	if($icount == '2') {
        if($i == 2) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-8 col-xl-8 col-md-8 col-sm-8 col-xs-8 col-ss-12'; 
       	} else {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-4 col-xl-4 col-md-4 col-sm-4 col-xs-4 col-ss-12 mosaic-grid-size';  
        }
        $reset = 2;
    } else if($icount == '3') {
        if($i == 2) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-6 col-xl-6 col-md-6 col-sm-6 col-xs-6 col-ss-12'; 
       	} else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-3 col-xl-3 col-md-3 col-sm-3 col-xs-3 col-ss-12 mosaic-grid-size';  
        }
        $reset = 3;
    } else if($icount == '4') {
        if($i == 2) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-3 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-ss-12 mosaic-large-square-grid-size'; 
        } elseif ($i == 1) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-3 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-ss-12'; 
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-3 col-xl-3 col-md-3 col-sm-6 col-xs-6 col-ss-12 mosaic-grid-size';  
        }
        $reset = 8;
    } else if($icount == '5') {
        if($i == 2) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-3 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8'; 
        } elseif ($i == 5) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-3 col-xl-6 col-md-6 col-sm-12 col-xs-12 col-ss-12'; 
        } elseif ($i == 1) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-tall-grid-size';
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-grid-size';  
        }
        $reset = 5;
    } else if($icount == '6' || $icount == '12' || $icount == '24' || $icount == '30') {
        if($i == 1 || $i == 5 || $i == 8 || $i == 12) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8'; 
        } elseif ($i == 3 || $i == 9) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4'; 
        } elseif ($i == 2 || $i == 10) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8 mosaic-large-grid-size'; 
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-grid-size'; 
        }
        $reset = 12;
    } else if($icount == '7' || $icount == '14' || $icount == '21' || $icount == '28' ) {
        if($i == 7 || $i == 8) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-12'; 
        } elseif ($i == 3 || $i == 11) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-6'; 
        } elseif ($i == 1) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-12 mosaic-large-grid-size'; 
        }  elseif ($i == 13) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-4 col-xs-4 col-ss-6 mosaic-large-wide-grid-size mosaic-ss-tall-grid-size'; 
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-6 mosaic-grid-size'; 
        }
        $reset = 14;
    } else if($icount == '8' || $icount == '16') {
        if($i == 1 || $i == 16) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8'; 
        } elseif ($i == 3 || $i == 13) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4'; 
        } elseif ($i == 2 || $i == 5 || $i == 10 || $i == 14) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8 mosaic-sm-wide-grid-size'; 
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-grid-size'; 
        }
        $reset = 16;
    } else if($icount == '9' || $icount == '18') {
        if($i == 2) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-6 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8'; 
        } elseif ($i == 5) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-6 col-xl-6 col-md-6 col-sm-4 col-xs-4 col-ss-4 mosaic-sm-square-grid-size'; 
        } elseif ($i == 6 ) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-3 col-xl-6 col-md-6 col-sm-4 col-xs-4 col-ss-4'; 
        } elseif ($i == 1 ) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4';
        } elseif ($i == 7 ) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-tall-grid-size';
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-3 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-grid-size';  
        }
        $reset = 9;
    } else if($icount == '10' || $icount == '20') {
        if($i == 2) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8'; 
        } elseif ($i == 6) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-12'; 
        } elseif ($i == 5) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-4 col-xs-4 col-ss-12'; 
        }elseif ($i == 8) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-6 col-md-6 col-sm-8 col-xs-8 col-ss-8 mosaic-sm-wide-grid-size'; 
        } elseif ($i == 1 || $i == 7 ) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-tall-grid-size';
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-4 mosaic-grid-size';  
        }
        $reset = 10;
    } else if($icount == '11') {
        if($i == 5) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-4 col-xs-4 col-ss-12 mosaic-sm-square-grid-size mosaic-ss-inherit-wide'; 
        } elseif ($i == 3) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-6'; 
        } elseif ($i == 8) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-6 mosaic-tall-grid-size mosaic-tall-sm-square-grid-size'; 
        } elseif ($i == 1) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-4 col-xs-4 col-ss-12 mosaic-large-wide-grid-size'; 
        } elseif ($i == 10) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-4 col-xs-4 col-ss-6 mosaic-large-wide-grid-size'; 
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-4 col-ss-6 mosaic-grid-size'; 
        }
        $reset = 11;
    } else if($icount == '13') {
        if($i == 6) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-4 col-ss-12 mosaic-sm-square-grid-size mosaic-ss-inherit-wide'; 
        } else if($i == 9 || $i == 13) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-8 col-ss-12'; 
        } elseif ($i == 4) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-6'; 
        } elseif ($i == 11) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-6 mosaic-tall-grid-size'; 
        } elseif ($i == 2) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-8 col-ss-6'; 
        } elseif ($i == 8) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-6 col-md-6 col-sm-6 col-xs-8 col-ss-6'; 
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-6 mosaic-grid-size'; 
        }
        $reset = 13;
    } else if($icount == '15') {
        if($i == 2 || $i == 8 || $i == 14) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-8 col-ss-8'; 
        } else if($i == 12) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-4 col-ss-4 mosaic-sm-square-grid-size'; 
        } elseif ($i == 6) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-8 col-ss-12'; 
        } elseif ($i == 5) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-4 col-ss-12'; 
        }elseif ($i == 7) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-6 col-md-6 col-sm-6 col-xs-8 col-ss-8'; 
        } elseif ($i == 1 || $i == 10) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-4';
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-4 mosaic-grid-size';  
        }
        $reset = 15;
    } else {
        if($i == 5 || $i == 16) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-4 col-ss-12 mosaic-sm-square-grid-size mosaic-ss-inherit-wide'; 
        }else if($i == 17) {
            $image_width = 800;
            $image_height = 400;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
        } elseif ($i == 3 || $i == 13) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-6'; 
        } elseif ($i == 8) {
            $image_width = 400;
            $image_height = 800;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-6 mosaic-tall-grid-size mosaic-tall-sm-square-grid-size'; 
        } elseif ($i == 1 || $i == 12 || $i == 18 || $i == 19) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-4 col-ss-12 mosaic-large-wide-grid-size'; 
        } elseif ($i == 10) {
            $image_width = 800;
            $image_height = 800;
            $itemsize = 'col-xxl-40 col-xl-6 col-md-6 col-sm-6 col-xs-4 col-ss-6 mosaic-large-wide-grid-size'; 
        } else {
            $image_width = 400;
            $image_height = 400;
            $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-3 col-xs-4 col-ss-6 mosaic-grid-size'; 
        }
        $reset = 19;
    }
    return array(
    	'itemsize' => $itemsize,
    	'width' => $image_width,
    	'height' => $image_height,
    	'reset' => $reset
    	);
}
function ascend_basic_image_sizes() {

	$sizes = array('full' => 'Full Size');

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
			$sizes[$_size]  = $_size .' - '. get_option( "{$_size}_size_w" ).'x'.get_option( "{$_size}_size_h" );
		} 
	}
	$sizes['custom'] = 'Custom';

	return $sizes;
}

function ascend_get_image_array($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false) {
    if(empty($id)) {
        $id = get_post_thumbnail_id();
    }
    if(empty($id)){
        if($placeholder == true) {
            $id = ascend_get_options_placeholder_image();
        }
    }
    if(!empty($id)) {
        $Ascend_Get_Image = Ascend_Get_Image::getInstance();
        $image = $Ascend_Get_Image->process( $id, $width, $height);
        if(empty($alt)) {
            $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        }
        $return_array = array(
            'src' => $image[0],
            'width' => $image[1],
            'height' => $image[2],
            'srcset' => $image[3],
            'class' => $class,
            'alt' => $alt,
            'full' => $image[4],
        );
    } else if(empty($id) && $placeholder == true) {
    	if(empty($height)){
    		$height = $width;
    	}
    	if(empty($width)){
    		$width = $height;
    	}
        $return_array = array(
            'src' => ascend_default_placeholder_image().$width.'x'.$height.'?text=Image+Placeholder',
            'width' => $width,
            'height' => $height,
            'srcset' => '',
            'class' => $class,
            'alt' => $alt,
            'full' => ascend_default_placeholder_image().$width.'x'.$height.'?text=Image+Placeholder',
        );
    } else {
        $return_array = array(
            'src' => '',
            'width' => '',
            'height' => '',
            'srcset' => '',
            'class' => '',
            'alt' => '',
            'full' => '',
        );
    }

    return $return_array;
}
function ascend_get_full_image_output($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false, $lazy = false, $schema = true, $extra = null) {
    $img = ascend_get_image_array($width, $height, $crop, $class, $alt, $id, $placeholder);
    if($lazy) {
        if( ascend_lazy_load_filter() ) {
            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
        } else {
            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
        }
    } else {
        $image_src_output = 'src="'.esc_url($img['src']).'"'; 
    }
    $extras = '';
    if(is_array($extra)) {
    	foreach ($extra as $key => $value) {
    		$extras .= esc_attr($key).'="'.esc_attr($value).'" ';
    	}
    } else {
    	$extras = $extra;	
    }
    if(!empty($img['src']) && $schema == true) {
        $output = '<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
        $output .='<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" itemprop="contentUrl" alt="'.esc_attr($img['alt']).'" '.$extras.'>';
        $output .= '<meta itemprop="url" content="'.esc_url($img['src']).'">';
        $output .= '<meta itemprop="width" content="'.esc_attr($img['width']).'px">';
        $output .= '<meta itemprop="height" content="'.esc_attr($img['height']).'px">';
        $output .= '</div>';
      	return $output;

    } elseif(!empty($img['src'])) {
        return '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'" '.$extras.'>';
    } else {
        return null;
    }
}
