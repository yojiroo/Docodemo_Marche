<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 *
 * Re-create the [gallery] shortcode for Kadence Gallery
 *
 */
function ascend_gallery($attr) {
  	$post = get_post();
  	static $instance = 0;
  	$instance++;

  	if (!empty($attr['ids'])) {
    	if (empty($attr['orderby'])) {
      		$attr['orderby'] = 'post__in';
    	}
    	$attr['include'] = $attr['ids'];
  	}

  	$output = apply_filters('post_gallery', '', $attr);

  	if ($output != '') {
    	return $output;
  	}

  	if (isset($attr['orderby'])) {
    	$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    	if (!$attr['orderby']) {
      	unset($attr['orderby']);
    	}
  	}
  	if(!isset($post)) {
    	$post_id = null;
  	} else {
    	$post_id = $post->ID;
  	}

  	extract(shortcode_atts(array(
	    'order'      		=> 'ASC',
	    'orderby'    		=> 'menu_order ID',
	    'id'         		=> $post_id,
	    'ids'        		=> '',
	    'masonry'    		=> '',
	    'link'       		=> 'file',
	    'speed'      		=> '7000',
	    'transpeed'  		=> '400',
	    'fade'   			=> 'true',
	    'arrows'   			=> 'true',
	    'thumbs'   			=> 'false',
	    'height'     		=> '400',
	    'width'      		=> '1140',
	    'caption'    		=> '',
	    'type'       		=> '',
	    'scroll'     		=> '1',
	    'columns'    		=> 3,
	    'gallery_id'  		=> (rand(10,1000)),
	    'autoplay'    		=> 'true',
	    'size'       		=> 'full',
	    'lightboxsize' 		=> 'full',
	    'lastrow' 			=> 'nojustify',
	    'class' 			=> '',
	    'imgwidth'    		=> '',
	    'imgheight'   		=> '',
	    'use_image_alt' 	=> 'false',
	    'isostyle'   		=> 'masonry',
	    'include'    		=> '',
	    'exclude'    		=> ''
  	), $attr));

  	$id = intval($id);

  	if ($order === 'RAND') {
    	$orderby = 'none';
  	}

  	if(!empty($ids)){
	  	if (!empty($include)) {
	    	$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	    	$attachments = array();
	    	foreach ($_attachments as $key => $val) {
	      		$attachments[$val->ID] = $_attachments[$key];
	    	}
	  	} elseif (!empty($exclude)) {
	    	$attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	  	} else {
	    	$attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
	  	}

		if (empty( $attachments ) || ! is_array( $attachments ) ) {
		    return '';
		}
	}
  	if (empty($caption) || $caption == 'default') {
    	global $ascend;
    	if(isset($ascend['gallery_captions']) && $ascend['gallery_captions'] == 1)  {
      		$caption = 'true';
    	} else {
      		$caption = 'false';
    	}
  	}

  	if (is_feed()) {
    	$output = "\n";
    	foreach ($attachments as $att_id => $attachment) {
      		$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
    	}
    	return $output;
  	}

  	if (isset($type) && $type == 'carousel') {
    // CAROUSEL
	  	if(empty($scroll) || $scroll == 1) {
	  		$scroll = '1';
	  	} else {
	  		$scroll = 'all';
	  	}
	  	if ($columns == '1') {
	    	$itemsize = 'col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-ss-12'; 
	    	$imgsize = 1140;
	    	$cc = ascend_carousel_columns('1');
	    } else if ($columns == '2') {
	    	$itemsize = 'col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
	    	$imgsize = 600;
	    	$cc = ascend_carousel_columns('2');
	    } else if ($columns == '3'){
	    	$itemsize = 'col-xxl-25 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-6 col-ss-12'; 
	    	$imgsize = 400;
	    	$cc = ascend_carousel_columns('3');
	    } else if ($columns == '4'){ 
	    	$itemsize = 'col-xxl-2 col-xl-25 col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12'; 
	    	$imgsize = 300;
	    	$cc = ascend_carousel_columns('4');
	    } else if ($columns == '5'){ 
	    	$itemsize = 'col-xxl-2 col-xl-2 col-lg-25 col-md-25 col-sm-3 col-xs-4 col-ss-6'; 
	    	$imgsize = 240;
	    	$cc = ascend_carousel_columns('5');
	    } else if ($columns == '6'){ 
	    	$itemsize = 'col-xxl-15 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-4 col-ss-6'; 
	    	$imgsize = 240;
	    	$cc = ascend_carousel_columns('6');
	    } else { 
	    	$cc = ascend_carousel_columns('8');
	    	$itemsize = 'col-xxl-1 col-xl-15 col-lg-2 col-md-2 col-sm-3 col-xs-4 col-ss-4'; 
	    	$imgsize = 240;
	    }
	    $cc = apply_filters('kadence_gallery_carousel_columns', $cc);
	    if(!empty($imgheight)) {
	    	$imgheightsize = $imgheight;
	    } else {
	    	$imgheightsize = $imgsize;
	    }
	    if(!empty($imgwidth)) {
	    	$imgsize = $imgwidth;
	    } else {
	    	$imgsize = $imgsize;
	    }
	    if(!empty($lightboxsize)) {
	    	$attachmentsize = $lightboxsize;
	    } else {
	    	$attachmentsize = 'full';
	    }
		ob_start(); ?>
	  <div class="carousel-outer-container kad-wp-gallery">
	      <div id="gallery-carousel-<?php echo esc_attr($gallery_id); ?>" class="row-margin-small">
	     	 <div id="carousel-<?php echo esc_attr($gallery_id); ?>" class="slick-slider kt-slickslider kad-light-gallery kt-image-carousel loading clearfix" data-slider-fade="false" data-slider-type="content-carousel" data-slider-anim-speed="400" data-slider-arrows="<?php echo esc_attr($arrows);?>" data-slider-scroll="<?php echo esc_attr($scroll);?>" data-slider-auto=<?php echo esc_attr($autoplay);?>" data-slider-speed="<?php echo esc_attr($speed);?>" data-slider-xxl="<?php echo esc_attr($cc['xxl']);?>" data-slider-xl="<?php echo esc_attr($cc['xl']);?>" data-slider-md="<?php echo esc_attr($cc['md']);?>" data-slider-sm="<?php echo esc_attr($cc['sm']);?>" data-slider-xs="<?php echo esc_attr($cc['xs']);?>" data-slider-ss="<?php echo esc_attr($cc['ss']);?>">
	            <?php $gid = 0;
	                foreach ($attachments as $id => $attachment) {
	                	if($use_image_alt == 'true') {
				      		$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
				    	} else {
				      		$alt = $attachment->post_excerpt;
				    	}

				    	$img = ascend_get_image($imgsize, $imgheightsize, true, null, $alt, $id, false);
		                
				        // Check for lazy load
					    if( ascend_lazy_load_filter() ) {
					      	$image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
					    } else {
					      	$image_src_output = 'src="'.esc_url($img['src']).'"'; 
					    }
					    if($lightboxsize != 'full') {
					      	$attachment_lb = wp_get_attachment_image_src( $id, $lightboxsize);
					      	$img['full'] = $attachment_lb[0];
					    }
				     	$lightbox_data = 'data-rel="lightbox"';

				    	if($link == 'attachment_page') {
				      		$img['full'] = get_permalink($id);
				      		$lightbox_data = '';
				    	}
				    	$paddingbtn = ($img['height']/$img['width']) * 100;
	                  	echo '<div class="'.esc_attr($itemsize).' g_item">';
	                  	echo '<div class="carousel_item grid_item gallery_item">';
	                  	if($link != 'none') { 
	                    	echo '<a href="'.esc_url($img['full']).'" '.$lightbox_data.' class="gallery-link">';
	                  	}
			                echo  '<div class="kt-intrinsic" style="padding-bottom:'.esc_attr($paddingbtn).'%;" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
				    			echo  '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" itemprop="contentUrl" '.$img['srcset'].' class="kt-gallery-img"/>';
				    			echo '<meta itemprop="url" content="'.esc_url($img['src']).'">';
					            echo '<meta itemprop="width" content="'.esc_attr($img['width']).'">';
					            echo '<meta itemprop="height" content="'.esc_attr($img['height']).'>">';
				    		echo  '</div>';
				      		if (trim($attachment->post_excerpt) && $caption == 'true') {
				      			echo  '<div class="photo-caption-bg"></div>';
				        		echo  '<div class="caption kad_caption">';
				        			echo  '<div class="kad_caption_inner">' . wptexturize($attachment->post_excerpt) . '</div>';
				        		echo  '</div>';
				      		}
	                  	if($link != 'none') { 
	                    	echo '</a>';
	                  	}
	                  	echo '</div>';
	                  	echo '</div>';
	                  $gid ++; 
	                }?>
	        </div>
	      </div>
	      <div class="clearfix"></div>
	    </div> 
	  <?php  $output = ob_get_contents();
	    ob_end_clean();

  	} elseif (isset($type) && $type == 'imagecarousel') { 
    	if(empty($height)) {$height = '400';}
    	if($link == 'attachment_page') {
	      	$link = 'attachment';
	    } else if ($link == 'none'){
	    	$link = 'none';
	    } else {
	    	$link = 'image';
	    }
	    $type = 'carousel';
        $images = array();
        foreach ($attachments as $id => $attachment) {
        		$images[] = $id;
        }
        $images = implode(",", $images);
  		ob_start(); 

  			ascend_build_slider($gallery_id, $images, null, $height, $link, $class .' kt-image-carousel kt-image-carousel-center-fade kad-wp-gallery', $type, $caption, $autoplay, $speed, $arrows, 'false', $transpeed);
      
 		$output = ob_get_contents();
    	ob_end_clean();
    } elseif (isset($type) && $type == 'slider') {
    	// Slider 
        if($link == 'attachment_page') {
	      	$link = 'attachment';
	    } else if ($link == 'none'){
	    	$link = 'none';
	    } else {
	    	$link = 'image';
	    }
	    if($thumbs == 'true') {
	      	$type = 'thumb';
	    } else {
	    	$type = 'slider';
	    }
        $images = array();
        foreach ($attachments as $id => $attachment) {
        		$images[] = $id;
        }
        $images = implode(",", $images);
        ob_start(); 

            	ascend_build_slider($gallery_id, $images, $width, $height, $link, 'kt-slider-same-image-ratio kad-wp-gallery', $type, $caption, $autoplay, $speed, $arrows, $fade, $transpeed);

 		$output = ob_get_contents();
    	ob_end_clean();
    
    } else if(isset($type) && $type == 'mosaic') {
    // Mosaic
  	$output .= '<div class="kad-mosaic-gallery-wrapper">';
	  	$output .= '<div id="kad-wp-gallery'.esc_attr($gallery_id).'" class="kad-wp-gallery reinit-isotope init-mosaic-isotope kad-light-gallery row-nomargin clearfix" data-iso-selector=".g_item" data-iso-style="packery" data-mosaic-selector=".mosaic-grid-size" data-iso-filter="false">';
	    $i = 1;
	    $icount = count($attachments);
	  	foreach ($attachments as $id => $attachment) {
	  		$imosaic = ascend_mosaic_sizes($icount, $i);
	  		
	        // Let make the whole thing filterable
	        $image_width = apply_filters('kt_gallery_mosaic_image_width', $imosaic['width'], $i);
		    $image_height = apply_filters('kt_gallery_mosaic_image_height', $imosaic['height'], $i);
		    $itemsize = apply_filters('kt_gallery_mosaic_size', $imosaic['itemsize'], $i);

	    	if($use_image_alt == 'true') {
	      		$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
	    	} else {
	      		$alt = $attachment->post_excerpt;
	    	}

	    	$img = ascend_get_image($image_width, $image_height, true, null, $alt, $id, false);
	    	$padding = ($image_height/$image_width) * 100;

	    	// Check for lazy load
		    if( ascend_lazy_load_filter() ) {
		      	$image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
		    } else {
		      	$image_src_output = 'src="'.esc_url($img['src']).'"'; 
		    }

	    	if($lightboxsize != 'full') {
		      	$attachment_lb = wp_get_attachment_image_src( $id, $lightboxsize);
		      	$img['full'] = $attachment_lb[0];
		    }
	     	$lightbox_data = 'data-rel="lightbox"';

	    	if($link == 'attachment_page') {
	      		$img['full'] = get_permalink($id);
	      		$lightbox_data = '';
	    	}

	    	$output .= '<div class="'.$itemsize.' g_item g_item_'.esc_attr($i).'">';
	    		$output .= '<div class="grid_item kt_item_fade_in kad_gallery_fade_in gallery_item g_mosiac_item grid_mosiac_item" style="padding-bottom:'.esc_attr($padding).'%;">';
	    			$output .= '<div class="g_mosiac_item_inner">';
						if($link != 'none') { 
				        	$output .='<a href="'.esc_url($img['full']).'" '.$lightbox_data.' class="gallery-link">';
				      	}
					      	$output .= '<div class="g_mosiac_item_image_case kt-intrinsic" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
			        			$output .= '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" itemprop="contentUrl" '.$img['srcset'].' class="kt-gallery-img"/>';
			        			$output .= '<meta itemprop="url" content="'.esc_url($img['src']).'">';
				                $output .= '<meta itemprop="width" content="'.esc_attr($img['width']).'">';
				                $output .= '<meta itemprop="height" content="'.esc_attr($img['height']).'>">';
			          			if (trim($attachment->post_excerpt) && $caption == 'true') {
			          				$output .= '<div class="photo-caption-bg"></div>';
			            			$output .= '<div class="caption kad_caption">';
			            				$output .= '<div class="kad_caption_inner">' . wptexturize($attachment->post_excerpt) . '</div>';
			            			$output .= '</div>';
			          			}
			          		$output .= '</div>';
		      			if($link != 'none') { 
		 					$output .= '</a>';
		 				}
		 			$output .= '</div>';
	    		$output .= '</div>';
	    	$output .= '</div>';
			if($imosaic['reset'] == $i) {
			    $i = 0;
			}
	    	$i ++;
	  		}
		$output .= '</div>';
  	$output .= '</div>';

  	} else if(isset($type) && $type == 'tiles') {
    // Titles
  	if(!empty($imgheight)) {
  		$imgheightsize = $imgheight;
  	} else {
  		$imgheightsize = 300;
  	}
  	$tileheight = $imgheightsize - 100;
  	$output .= '<div id="kad-wp-gallery'.$gallery_id.'" class="kad-wp-gallery kt-gallery-tiles init-tiles-justified kad-light-gallery clearfix" data-gallery-height="'.esc_attr($tileheight).'" data-gallery-lastrow="'.esc_attr($lastrow).'" data-gallery-margins="3">';
  	
  	$i = 0;

  	foreach ($attachments as $id => $attachment) {
	    if($use_image_alt == 'true') {
      		$alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    	} else {
      		$alt = $attachment->post_excerpt;
    	}
	    $img = ascend_get_image(null, $imgheightsize, false, null, $alt, $id, false);

	    // Get Lightbox size
	    if($lightboxsize != 'full') {
	      	$attachment_lb = wp_get_attachment_image_src( $id, $lightboxsize);
	      	$img['full'] = $attachment_lb[0];
	    }

	    $lightbox_data = 'data-rel="lightbox"';
	    if($link == 'attachment_page') {
	      	$img['full'] = get_permalink($id);
	      	$lightbox_data = '';
	    }
	    // Check for lazy load
	    if( ascend_lazy_load_filter() ) {
	      	$image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
	    } else {
	      	$image_src_output = 'src="'.esc_url($img['src']).'"'; 
	    }

    	$output .= '<div class="g_item" style="float:left;">';
    	$output .= '<div class="grid_item kad_gallery_fade_in gallery_item">';
	      	if($link != 'none') { 
	        	$output .='<a href="'.esc_url($img['full']).'" '.$lightbox_data.' class="gallery-link" style="">';
	      	}
    		$output .= '<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
    			$output .= '<img '.$image_src_output.'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'"  itemprop="contentUrl" '.$img['srcset'].' class="kt-gallery-img"/>';
    			$output .= '<meta itemprop="url" content="'.esc_url($img['src']).'">';
                $output .= '<meta itemprop="width" content="'.esc_attr($img['width']).'">';
                $output .= '<meta itemprop="height" content="'.esc_attr($img['height']).'>">';
    		$output .= '</div>';
      		if (trim($attachment->post_excerpt) && $caption == 'true') {
      			$output .= '<div class="photo-caption-bg"></div>';
        		$output .= '<div class="caption kad_caption">';
        			$output .= '<div class="kad_caption_inner">' . wptexturize($attachment->post_excerpt) . '</div>';
        		$output .= '</div>';
      		}
	      	if($link != 'none') { 
	        	$output .= '</a>';
	      	}
	    	$output .= '</div>';
	    	$output .= '</div>';
	    }
	 $output .= '</div>';
  
  	return $output;

	} else {
    // NORMAL
  	$output .= '<div id="kad-wp-gallery'.esc_attr($gallery_id).'" class="kad-wp-gallery kt-gallery-column-'.esc_attr($columns).' init-isotope-intrinsic reinit-isotope kad-light-gallery clearfix row-margin-small" data-iso-selector=".g_item" data-iso-style="'.esc_attr($isostyle).'" data-iso-filter="false">';
    if ($columns == '1') {
    	$itemsize = 'col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-ss-12'; 
    	$imgsize = 1140;
    } else if ($columns == '2') {
    	$itemsize = 'col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
    	$imgsize = 600;
    } else if ($columns == '3'){
    	$itemsize = 'col-xxl-25 col-xl-3 col-lg-4 col-md-4 col-sm-4 col-xs-6 col-ss-12'; 
    	$imgsize = 400;
    } else if ($columns == '4'){ 
    	$itemsize = 'col-xxl-2 col-xl-25 col-lg-3 col-md-3 col-sm-4 col-xs-6 col-ss-12'; 
    	$imgsize = 300;
    } else if ($columns == '5'){ 
    	$itemsize = 'col-xxl-2 col-xl-2 col-lg-25 col-md-25 col-sm-3 col-xs-4 col-ss-6'; 
    	$imgsize = 240;
    } else if ($columns == '6'){ 
    	$itemsize = 'col-xxl-15 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-4 col-ss-6'; 
    	$imgsize = 240;
    } else { 
    	$itemsize = 'col-xxl-1 col-xl-15 col-lg-2 col-md-2 col-sm-3 col-xs-4 col-ss-4'; 
    	$imgsize = 240;
    }

  	if(!empty($imgheight)) {
  		$imgheightsize = $imgheight;
  	} else {
  		$imgheightsize = $imgsize;
  	}

  	if(!empty($imgwidth)) {
  		$imgsize = $imgwidth;
  	} else {
  		$imgsize = $imgsize;
	}
  	
  	if(empty($masonry) || $masonry == 'default') {
  		global $ascend;
    	if(isset($ascend['kadence_gallery_masonry']) && $ascend['kadence_gallery_masonry'] ==  '1') {
      		$masonry = 'true';
    	} else {
      		$masonry = 'false';
    	}
  	} 
  	$i = 0;

  	foreach ( $attachments as $id => $attachment ) {
		if( $masonry == 'true' ){
			$img = ascend_get_image( $imgsize, null, false, null, null, $id, false );
	    } else {
			$img = ascend_get_image( $imgsize, $imgheightsize, true, null, null, $id, false );
	    }
	    
	    // Get Lightbox size
	    if($lightboxsize != 'full') {
	      	$attachment_lb = wp_get_attachment_image_src( $id, $lightboxsize );
	      	$attachment_url = $attachment_lb[ 0 ];
	    } else {
	    	$attachment_url = $img[ 'full' ];
	    }

	    $lightbox_data = 'data-rel="lightbox"';

	    if($link == 'attachment_page') {
	      	$attachment_url = get_permalink( $id );
	      	$lightbox_data = '';
	    }

    	// Get alt or caption for alt
	    if($use_image_alt == 'true') {
	      	// do nothing
	    } else {
	      	$img[ 'alt' ] = $attachment->post_excerpt;
	    }
	    // Check for lazy load
	    if( ascend_lazy_load_filter() ) {
			$image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url( $img[ 'src' ] ).'" '; 
	    } else {
			$image_src_output = 'src="'.esc_url( $img[ 'src' ] ).'"'; 
	    }

    	$paddingbtn = ($img[ 'height' ]/$img[ 'width' ]) * 100;
    	$output .= '<div class="'.esc_attr( $itemsize ).' g_item"><div class="grid_item kt_item_fade_in kad_gallery_fade_in gallery_item">';
	      	if($link != 'none') { 
	        	$output .='<a href="'.esc_url( $attachment_url ).'" '.wp_kses_post( $lightbox_data ).' class="gallery-link">';
	      	}
    		$output .= '<div class="kt-intrinsic" style="padding-bottom:'.esc_attr($paddingbtn).'%;" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
    			$output .= '<img '.$image_src_output.' width="'.esc_attr( $img[ 'width' ] ).'" height="'.esc_attr( $img[ 'height' ] ).'" alt="'.esc_attr( $img[ 'alt' ] ).'" '.wp_kses_post( $img[ 'srcset' ] ).' itemprop="contentUrl" class="kt-gallery-img"/>';
    			$output .= '<meta itemprop="url" content="'.esc_url( $img[ 'src' ] ).'">';
                $output .= '<meta itemprop="width" content="'.esc_attr( $img[ 'height' ] ).'">';
                $output .= '<meta itemprop="height" content="'.esc_attr( $img[ 'width' ] ).'>">';
    		$output .= '</div>';
      		if (trim($attachment->post_excerpt) && $caption == 'true') {
      			$output .= '<div class="photo-caption-bg"></div>';
        		$output .= '<div class="caption kad_caption">';
        			$output .= '<div class="kad_caption_inner">' . wptexturize($attachment->post_excerpt) . '</div>';
        		$output .= '</div>';
      		}
	      	if($link != 'none') { 
	        	$output .= '</a>';
	      	}
    	$output .= '</div></div>';
  		}
  	$output .= '</div>';
  	}
  
  	return $output;
}

add_action('init', 'ascend_gallery_setup_init');
function ascend_gallery_setup_init() {
  	global $ascend;
  	if(isset($ascend['kadence_gallery']) && $ascend['kadence_gallery'] == '1')  {
  		remove_shortcode('gallery');
  		add_shortcode('gallery', 'ascend_gallery');
  	}
}