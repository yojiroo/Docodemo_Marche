<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/** 
 * Checks if Theme is Kadence is enabled
 */
function theme_is_kadence() {
	if(class_exists('kt_api_manager')) {
		return true;
	}
	return false;
}

function kt_woo_get_srcset($width,$height,$url,$id) {
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
  $pathretinaflyfilename = str_replace($ext, '-'.$width.'x'.$height.'@2x' . $ext, $image_meta['file']);
  $flyfilename = basename($image_meta['file'], $ext) . '-'.$width.'x'.$height.'' . $ext;
  $retinaflyfilename = basename($image_meta['file'], $ext) . '-'.$width.'x'.$height.'@2x' . $ext;

  $upload_info = wp_upload_dir();
  $upload_dir = $upload_info['basedir'];

  $flyfile = trailingslashit($upload_dir).$pathflyfilename;
  $retinafile = trailingslashit($upload_dir).$pathretinaflyfilename;
  if(empty($image_meta['sizes']) ){ $image_meta['sizes'] = array();}
    if (file_exists($flyfile)) {
      $kt_add_imagesize = array(
        'kt_on_fly' => array( 
          'file'=> $flyfilename,
          'width' => $width,
          'height' => $height,
          'mime-type' => $image_meta['sizes']['thumbnail']['mime-type'] 
          )
      );
      $image_meta['sizes'] = array_merge($image_meta['sizes'], $kt_add_imagesize);
    }
    if (file_exists($retinafile)) {
      $size = getimagesize( $retinafile );
      if(($size[0] == 2 * $width) && ($size[1] == 2 * $height) ) {
        $kt_add_imagesize_retina = array(
        'kt_on_fly_retina' => array( 
          'file'=> $retinaflyfilename,
          'width' => 2 * $width,
          'height' => 2 * $height,
          'mime-type' => $image_meta['sizes']['thumbnail']['mime-type'] 
          )
        );
        $image_meta['sizes'] = array_merge($image_meta['sizes'], $kt_add_imagesize_retina);
      }
    }
    if(function_exists ( 'wp_calculate_image_srcset') ){
      $output = wp_calculate_image_srcset(array( $width, $height), $url, $image_meta, $id);
    } else {
      $output = '';
    }
    return $output;
}
function kt_woo_get_srcset_output($width,$height,$url,$id) {
    $img_srcset = kt_woo_get_srcset( $width, $height, $url, $id);
    if(!empty($img_srcset) ) {
      $output = 'srcset="'.esc_attr($img_srcset).'" sizes="(max-width: '.esc_attr($width).'px) 100vw, '.esc_attr($width).'px"';
    } else {
      $output = '';
    }
    return $output;
}

if(!class_exists('KT_WOO_Aq_Resize')) {
    class KT_WOO_Aq_Exception extends Exception {}

    class KT_WOO_Aq_Resize
    {
        /**
         * The singleton instance
         */
        static private $instance = null;

        /**
         * Should an KT_WOO_Aq_Exception be thrown on error?
         * If false (default), then the error will just be logged.
         */
        public $throwOnError = false;

        /**
         * No initialization allowed
         */
        private function __construct() {}

        /**
         * No cloning allowed
         */
        private function __clone() {}

        /**
         * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
         */
        static public function getInstance() {
            if(self::$instance == null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Run, forest.
         */
        public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
            try {
                // Validate inputs.
                if (!$url)
                    throw new KT_WOO_Aq_Exception('$url parameter is required');
                if (!$width)
                    //throw new KT_WOO_Aq_Exception('$width parameter is required');
                if (!$height)
                   // throw new KT_WOO_Aq_Exception('$height parameter is required');

                // Caipt'n, ready to hook.
                if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

                // Define upload path & dir.
                $upload_info = wp_upload_dir();
                $upload_dir = $upload_info['basedir'];
                $upload_url = $upload_info['baseurl'];
                
                $http_prefix = "http://";
                $https_prefix = "https://";
                $relative_prefix = "//"; // The protocol-relative URL
                
                /* if the $url scheme differs from $upload_url scheme, make them match 
                   if the schemes differe, images don't show up. */
                if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
                    $upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
                }
                elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
                    $upload_url = str_replace($https_prefix,$http_prefix,$upload_url);      
                }
                elseif(!strncmp($url,$relative_prefix,strlen($relative_prefix))){ //if url begins with // make $upload_url begin with // as well
                    $upload_url = str_replace(array( 0 => "$http_prefix", 1 => "$https_prefix"),$relative_prefix,$upload_url);
                }
                

                // Check if $img_url is local.
                if ( false === strpos( $url, $upload_url ) )
                    throw new KT_WOO_Aq_Exception('Image must be local: ' . $url);

                // Define path of image.
                $rel_path = str_replace( $upload_url, '', $url );
                $img_path = $upload_dir . $rel_path;

                // Check if img path exists, and is an image indeed.
                if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) )
                    throw new KT_WOO_Aq_Exception('Image file does not exist (or is not an image): ' . $img_path);

                // Get image info.
                $info = pathinfo( $img_path );
                $ext = $info['extension'];
                list( $orig_w, $orig_h ) = getimagesize( $img_path );

                // Get image size after cropping.
                $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
                $dst_w = $dims[4];
                $dst_h = $dims[5];

                // Return the original image only if it exactly fits the needed measures.
                if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                    $img_url = $url;
                    $dst_w = $orig_w;
                    $dst_h = $orig_h;
                } else {
                    // Use this to check if cropped image already exists, so we can return that instead.
                    $suffix = "{$dst_w}x{$dst_h}";
                    $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                    $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                    if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
                        // Can't resize, so return false saying that the action to do could not be processed as planned.
                        throw new KT_WOO_Aq_Exception('Unable to resize image because image_resize_dimensions() failed');
                    }
                    // Else check if cache exists.
                    elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                        $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                    }
                    // Else, we resize the image and return the new resized image url.
                    else {

                        $editor = wp_get_image_editor( $img_path );

                        if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) ) {
                            throw new KT_WOO_Aq_Exception('Unable to get WP_Image_Editor: (is GD or ImageMagick installed?)');
                        }

                        $resized_file = $editor->save();

                        if ( ! is_wp_error( $resized_file ) ) {
                            $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                            $img_url = $upload_url . $resized_rel_path;
                        } else {
                                throw new KT_WOO_Aq_Exception('Unable to save resized image file:');
                        }

                    }
                }

                // Okay, leave the ship.
                if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

                // Return the output.
                if ( $single ) {
                    // str return.
                    $image = $img_url;
                } else {
                    // array return.
                    $image = array (
                        0 => $img_url,
                        1 => $dst_w,
                        2 => $dst_h
                    );
                }

                // RETINA Support ---------------------------------------------------------------> 
                    if ( apply_filters( 'kadence_retina_support', true ) ) : 
                    $retina_w = $dst_w*2;
                    $retina_h = $dst_h*2;
                    
                    //get image size after cropping
                    $dims_x2 = image_resize_dimensions($orig_w, $orig_h, $retina_w, $retina_h, $crop);
                    $dst_x2_w = $dims_x2[4];
                    $dst_x2_h = $dims_x2[5];
                    
                    // If possible lets make the @2x image
                    if($dst_x2_h) {
                        if (true == $crop && ( $dst_x2_w < $retina_w || $dst_x2_h < $retina_h ) ) {
                            // do nothing
                        } else {
                            //@2x image url
                            $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}@2x.{$ext}";
                            
                            //check if retina image exists
                            if(file_exists($destfilename) && getimagesize($destfilename)) { 
                                // already exists, do nothing
                            } else {
                                // doesnt exist, lets create it
                                $editor = wp_get_image_editor($img_path);
                                if ( ! is_wp_error( $editor ) ) {
                                    $editor->resize( $retina_w, $retina_h, $crop );
                                    $editor->set_quality( 100 );
                                    $filename = $editor->generate_filename( $dst_w . 'x' . $dst_h . '@2x'  );
                                    $editor = $editor->save($filename); 
                                }
                            }

                        }
                    
                    }
                    endif;

                return $image;
            }
            catch (KT_WOO_Aq_Exception $ex) {
                //error_log('Aq_Resize.process() error: ' . $ex->getMessage());

                if ($this->throwOnError) {
                    // Bubble up exception.
                    throw $ex;
                }
                else {
                    // Return false, so that this patch is backwards-compatible.
                    return false;
                }
            }
        }

        /**
         * Callback to overwrite WP computing of thumbnail measures
         */
        function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            if ( ! $crop ) return null; // Let the wordpress default function handle this.

            // Here is the point we allow to use larger image size than the original one.
            $aspect_ratio = $orig_w / $orig_h;
            $new_w = $dest_w;
            $new_h = $dest_h;

            if ( ! $new_w ) {
                $new_w = intval( $new_h * $aspect_ratio );
            }

            if ( ! $new_h ) {
                $new_h = intval( $new_w / $aspect_ratio );
            }

            $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

            $crop_w = round( $new_w / $size_ratio );
            $crop_h = round( $new_h / $size_ratio );

            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );

            return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
        }
    }
}





if(!function_exists('kt_woo_aq_resize')) {

    /**
     * This is just a tiny wrapper function for the class above so that there is no
     * need to change any code in your own WP themes. Usage is still the same :)
     */
    function kt_woo_aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false, $id = null) {
        if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) ) {
                            if(empty($height) ) {
                                $args = array( 'w' => $width );
                                if(!empty($id)) {
                                    $image_attributes = wp_get_attachment_image_src ( $id, 'full' );
                                    $sizes = image_resize_dimensions($image_attributes[1], $image_attributes[2], $width, null, false );
                                    $height = $sizes[5];
                                } else {
                                    $height = null;
                                }
                            } else if(empty($width) ) {
                                $args = array( 'h' => $height );
                                if(!empty($id)) {
                                    $image_attributes = wp_get_attachment_image_src ( $id, 'full' );
                                    $sizes = image_resize_dimensions($image_attributes[1], $image_attributes[2], null, $height, false );
                                    $width = $sizes[4];
                                } else {
                                    $width = null;
                                }
                            } else {
                                $args = array( 'resize' => $width . ',' . $height );
                            }
                            if ( $single ) {
                                    // str return.
                                    $image = jetpack_photon_url( $url, $args );
                                } else {
                                    // array return.
                                    $image = array (
                                        0 => jetpack_photon_url( $url, $args ),
                                        1 => $width,
                                        2 => $height
                                    );
                                }
                                return $image;
        } else {
            $aq_resize = KT_WOO_Aq_Resize::getInstance();
            return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
        }
    }
}

add_action( 'cmb2_render_kt_woo_text_number', 'kt_woo_small_render_text_number', 10, 5 );
function kt_woo_small_render_text_number( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'class' => 'cmb2-text-small', 'type' => 'number', 'step' => 'any', ) );
}
add_filter( 'cmb2_sanitize_kt_woo_text_number', 'kt_woo_small_sanitize_text_number', 10, 2 );
function kt_woo_small_sanitize_text_number( $null, $new ) {
    //$new = preg_replace( "/[^0-9]/", "", $new );
    return $new;
}
function kt_woo_small_render_text_vote_up( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'class' => 'cmb2-text-small', 'type' => 'number' ) );
}
add_action( 'cmb2_render_text_vote_up', 'kt_woo_small_render_text_vote_up', 10, 5 );
function kt_woo_sanitize_text_vote_up_callback( $override_value, $value, $post_id) {
    $votes = get_post_meta($post_id, '_kt_review_votes', true);
    $old = get_post_meta($post_id, '_kt_review_upvotes', true);
    if($old >= $value){
        $new = $old - $value;
        $newvotes = $votes - $new;
    } else {
        $new = $value - $old;
        $newvotes = $votes + $new;
    }
    update_post_meta($post_id, '_kt_review_votes', $newvotes);
    return $value;
}
add_filter( 'cmb2_sanitize_text_vote_up', 'kt_woo_sanitize_text_vote_up_callback', 10, 3 );
function kt_woo_small_render_text_vote_down( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'class' => 'cmb2-text-small', 'type' => 'number' ) );
}
add_action( 'cmb2_render_text_vote_down', 'kt_woo_small_render_text_vote_down', 10, 5 );
function kt_woo_sanitize_text_vote_down_callback( $override_value, $value, $post_id) {
    $votes = get_post_meta($post_id, '_kt_review_votes', true);
    $old = get_post_meta($post_id, '_kt_review_downvotes', true);
    if($old >= $value){
        $new = $old - $value;
        $newvotes = $votes + $new;
    } else {
        $new = $value - $old;
        $newvotes = $votes - $new;
    }
    update_post_meta($post_id, '_kt_review_votes', $newvotes);
    return $value;
}
add_filter( 'cmb2_sanitize_text_vote_down', 'kt_woo_sanitize_text_vote_down_callback', 10, 3 );

function kt_woo_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type'   => 'post',
        'numberposts' => -1,
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}

function kt_woo_coupon_posts_options() {
	$posts = kt_woo_get_post_options( array( 'post_type' => 'shop_coupon', 'numberposts' => -1 ) );
	$posts['0'] = __('Select a Coupon', 'kadence-woo-extras');
	return $posts;
}
function kt_woo_product_posts_options() {
	$posts = kt_woo_get_post_options( array( 'post_type' => 'product', 'numberposts' => -1 ) );
	$posts['0'] = __('Select a Product', 'kadence-woo-extras');
	return $posts;
}
function kt_woo_size_chart_posts_options() {
	$posts = kt_woo_get_post_options( array( 'post_type' => 'kt_size_chart', 'numberposts' => -1 ) );
	$posts['0'] = __('None', 'kadence-woo-extras');
	return $posts;
}
function kt_woo_change_cmb2_styles() {
	wp_deregister_style('cmb2-styles');
	wp_register_style( 'cmb2-styles', KADENCE_WOO_EXTRAS_URL . "/cmb/css/cmb2.css" );
}
//add_action('init', 'kt_woo_change_cmb2_styles', 20);

function kt_get_term_options( $field ) {
    $args = $field->args( 'get_terms_args' );
    $args = is_array( $args ) ? $args : array();

    $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

    $taxonomy = $args['taxonomy'];

    $terms = (array) cmb2_utils()->wp_at_least( '4.5.0' )
        ? get_terms( $args )
        : get_terms( $taxonomy, $args );

    // Initate an empty array
    $term_options = array();
    if ( ! empty( $terms ) ) {
        foreach ( $terms as $term ) {
            $term_options[ $term->term_id ] = $term->name;
        }
    }

    return $term_options;
}
function kt_woo_default_placeholder_image() {
    return apply_filters('kt_woo_default_placeholder_image', 'http://placehold.it/');
}

function kt_woo_get_image_array($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false) {
    if(empty($id)) {
        $id = get_post_thumbnail_id();
    }
    if(!empty($id)) {
        $kt_woo_get_image = KT_WOO_Get_Image::getInstance();
        $image = $kt_woo_get_image->process( $id, $width, $height);
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
            'src' => kt_woo_default_placeholder_image().$width.'x'.$height.'?text=Image+Placeholder',
            'width' => $width,
            'height' => $height,
            'srcset' => '',
            'class' => $class,
            'alt' => $alt,
            'full' => kt_woo_default_placeholder_image().$width.'x'.$height.'?text=Image+Placeholder',
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

function kt_woo_get_full_image_output($width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false, $lazy = false, $schema = true, $extra = null) {
    $img = kt_woo_get_image_array($width, $height, $crop, $class, $alt, $id, $placeholder);
    if($lazy) {
        if( kt_woo_lazy_load_filter() ) {
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

