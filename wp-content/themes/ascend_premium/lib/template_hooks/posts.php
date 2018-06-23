<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'ascend_post_header', 'ascend_single_post_header', 20 );
function ascend_single_post_header() {
	if(ascend_display_pagetitle()) {
		get_template_part('templates/post', 'header');
	} else {
		if( ascend_display_post_breadcrumbs()) { 
			echo '<div class="kt_bc_nomargin">';
			ascend_breadcrumbs(); 
			echo '</div>';
		}
	}
}

add_action( 'kadence_post_mini_excerpt_header', 'ascend_post_meta_tooltip_subhead', 20 );
function ascend_post_meta_tooltip_subhead() {
	get_template_part('templates/entry', 'meta-tooltip-subhead');
}

add_action( 'kadence_post_mini_excerpt_before_header', 'ascend_post_meta_date', 10 );
function ascend_post_meta_date() {
	get_template_part('templates/entry', 'meta-date');
}


add_filter( 'kt_single_post_image_height', 'ascend_post_header_single_image_height', 10 );
function ascend_post_header_single_image_height() {
	global $ascend;
	if(isset($ascend['post_header_single_image_height']) && $ascend['post_header_single_image_height'] == 1 ) {
		return null;
	} else {
		return 400;
	}
}
add_action('kadence_single_post_content_before', 'ascend_image_post_below_title', 5 );
function ascend_image_post_below_title(){
	if ( 'post' == get_post_type() ) {
		if( 'image_below' == ascend_get_post_head_content() ){
			global $post;
			if (has_post_thumbnail( $post->ID ) ) {
				$swidth = get_post_meta( $post->ID, '_kad_image_posthead_width', true );
				$height = get_post_meta( $post->ID, '_kad_image_posthead_height', true );
				if (!empty($height)) {
					$imageheight = $height;
				} else {
					$imageheight = apply_filters('kt_single_post_image_height', 400); 
				}
				if (! empty( $swidth ) ) {
					$slidewidth = $swidth;
				} else {
					$slidewidth = $kt_feat_width;
				}
				$image_id = get_post_thumbnail_id();
				$img = ascend_get_image($slidewidth, $height, true, null, get_the_title(), $image_id, false);
				if ( ascend_lazy_load_filter() ) {
					$image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
				} else {
					$image_src_output = 'src="'.esc_url($img['src']).'"'; 
				}
				?>
				<div class="imghoverclass postfeat post-single-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<a href="<?php echo esc_url($img['full']); ?>" data-rel="lightbox">
						<p>
						<img <?php echo $image_src_output; ?> itemprop="contentUrl" alt="<?php esc_attr($img['alt']); ?>" width="<?php echo esc_attr($img['width']);?>" height="<?php echo esc_attr($img['height']);?>" <?php echo $img['srcset'];?> />
						<meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
						<meta itemprop="width" content="<?php echo esc_attr($img['width'])?>px">
						<meta itemprop="height" content="<?php echo esc_attr($img['height'])?>px">
						</p>
					</a>
				</div>
				<?php
			}
		}
	}
}
function ascend_get_post_head_content() {
	global $post, $ascend;
	if ( has_post_format( 'video' )) {
      	$headcontent = get_post_meta( $post->ID, '_kad_video_blog_head', true );
      	if(empty($headcontent) || $headcontent == 'default') {
          	if(!empty($ascend['video_post_blog_default'])) {
                $headcontent = $ascend['video_post_blog_default'];
            } else {
                $headcontent = 'video';
            }
      	}
    } else if (has_post_format( 'gallery' )) {
        $headcontent = get_post_meta( $post->ID, '_kad_gallery_blog_head', true );
        if(empty($headcontent) || $headcontent == 'default') {
            if(!empty($ascend['gallery_post_blog_default'])) {
                $headcontent = $ascend['gallery_post_blog_default'];
            } else {
                $headcontent = 'gallery';
            }
        }
	 } elseif (has_post_format( 'image' )) {
        $headcontent = get_post_meta( $post->ID, '_kad_image_blog_head', true );
        if(empty($headcontent) || $headcontent == 'default') {
            if(!empty($ascend['image_post_blog_default'])) {
                $headcontent = $ascend['image_post_blog_default'];
            } else {
                $headcontent = 'image';
            }
        }
	} else {
        $headcontent = 'none';
    }
    return $headcontent;
}
/* Single Post Layout */
add_action( 'ascend_single_post_begin', 'ascend_single_post_upper_headcontent', 10 );
function ascend_single_post_upper_headcontent() {
	get_template_part('templates/post', 'head-upper-content');
}

add_action( 'kadence_single_post_before_header', 'ascend_single_post_headcontent', 10 );
function ascend_single_post_headcontent() {
	get_template_part('templates/post', 'head-content');
}
add_action( 'ascend_single_attachment_header', 'ascend_single_post_meta_date_author', 30 );
add_action( 'ascend_post_excerpt_header', 'ascend_single_post_meta_date_author', 30 );
add_action( 'ascend_single_loop_post_header', 'ascend_single_post_meta_date_author', 30 );
add_action( 'ascend_single_post_header', 'ascend_single_post_meta_date_author', 30 );
function ascend_single_post_meta_date_author() {
	get_template_part('templates/entry', 'meta-date-author');
}
add_action( 'ascend_single_attachment_header', 'ascend_post_header_title', 20 );
add_action( 'ascend_single_post_header', 'ascend_post_header_title', 20 );
function ascend_post_header_title() {
	global $ascend;
	if(isset($ascend['blog_post_title_inpost']) && $ascend['blog_post_title_inpost'] == 0) {
		// do nothing
	} else {
		echo '<h1 class="entry-title" itemprop="name headline">';
			the_title();
		echo '</h1>';
	}
}

add_action( 'kadence_single_attachment_before_header', 'ascend_single_attachment_image', 20 );
function ascend_single_attachment_image() {
	 echo wp_get_attachment_image( get_the_ID(), 'full' );
}

// CATEGORY OUTPUT
add_action( 'kadence_post_photo_grid_excerpt_after_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'kadence_post_grid_excerpt_before_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'kadence_post_excerpt_before_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'kadence_single_loop_post_before_header', 'ascend_post_header_meta_categories', 20 );
add_action( 'kadence_single_post_before_header', 'ascend_post_header_meta_categories', 20 );
function ascend_post_header_meta_categories() {
	if( has_category() ) {
		echo '<div class="kt_post_category kt-post-cats">';
			the_category(' | ');
		echo '</div>';
	} else if( has_term( null, 'series' ) ) {
		echo '<div class="kt_post_category kt-post-cats">';
				$terms = get_terms( 'series' ); 
				if ( $terms && ! is_wp_error( $terms ) ) {
					$output = array(); 
					foreach( $terms as $term ){ 
						$term_link = get_term_link( $term );
						if (! is_wp_error( $term_link ) ) {
							$output[] = '<a href="'.esc_url( $term_link ).'">'.esc_html( $term->name ).'</a>';
						}
					} 
	            	echo implode(' | ', $output); 
	            } 
		echo '</div>';
	}
}

add_action( 'ascend_single_attachment_footer', 'ascend_post_footer_pagination', 10 );
add_action( 'ascend_single_post_footer', 'ascend_post_footer_pagination', 10 );
function ascend_post_footer_pagination() {
	wp_link_pages(array('before' => '<nav class="pagination kt-pagination">', 'after' => '</nav>', 'link_before'=> '<span>','link_after'=> '</span>'));
}

add_action( 'ascend_single_post_footer', 'ascend_post_footer_tags', 20 );
function ascend_post_footer_tags() {
	$tags = get_the_tags();
	if ($tags) {  
		echo '<div class="posttags post-footer-section">';
		the_tags(__('Tags:', 'ascend'), ' ', '');
		echo '</div>';
	}
}
add_action( 'ascend_post_grid_excerpt_footer', 'ascend_post_footer_meta', 30 );
add_action( 'ascend_post_excerpt_footer', 'ascend_post_footer_meta', 30 );
add_action( 'ascend_single_loop_post_footer', 'ascend_post_footer_meta', 30 );
add_action( 'ascend_single_post_footer', 'ascend_post_footer_meta', 30 );
function ascend_post_footer_meta() {
	get_template_part('templates/entry', 'footer-meta');
}

add_action( 'ascend_single_loop_post_footer', 'ascend_post_footer_image_meta', 35 );
add_action( 'ascend_single_post_footer', 'ascend_post_footer_image_meta', 35 );
function ascend_post_footer_image_meta() {
	get_template_part('templates/entry', 'footer-image-meta');
}

add_action( 'ascend_single_post_footer', 'ascend_post_nav', 40 );
function ascend_post_nav() {
 global $ascend;
 if(!isset($ascend['show_postlinks']) || $ascend['show_postlinks'] != 0) {
 	get_template_part('templates/entry', 'post-links');
 }
}

add_action( 'kadence_single_post_after', 'ascend_post_authorbox', 20 );
function ascend_post_authorbox() {
 global $ascend, $post;
	 $authorbox = get_post_meta( $post->ID, '_kad_blog_author', true );
	 if((empty($authorbox) || $authorbox == 'default') && is_singular('post')) { 
	 	if(isset($ascend['post_author_default']) && ($ascend['post_author_default'] == 'yes')) {
	 	 ascend_author_box(); 
	 	}
	 } else if($authorbox == 'yes'){ 
	 	ascend_author_box(); 
	 } 
}
add_action( 'kadence_single_post_after', 'ascend_post_bottom_carousel', 30 );
function ascend_post_bottom_carousel() {
 	global $ascend, $post, $kt_bottom_carousel;
		$kt_bottom_carousel = get_post_meta( $post->ID, '_kad_blog_carousel_similar', true ); 
      	if(empty($kt_bottom_carousel) || $kt_bottom_carousel == 'default' ) { 
      		if(isset($ascend['post_carousel_default'])) {
      			$kt_bottom_carousel = $ascend['post_carousel_default']; 
      		}
      	}
	      
	    if ($kt_bottom_carousel == 'similar' || $kt_bottom_carousel == 'recent') { 
	      	get_template_part('templates/bottom', 'post-carousel');
	    }
}

add_action( 'kadence_single_attachment_after', 'ascend_post_comments', 40 );
add_action( 'kadence_single_post_after', 'ascend_post_comments', 40 );
function ascend_post_comments() {
	comments_template('/templates/comments.php');
}



// POST GRID 
add_action( 'kadence_post_photo_grid_excerpt_header', 'ascend_post_grid_excerpt_header_title', 10 );
add_action( 'kadence_post_grid_excerpt_header', 'ascend_post_grid_excerpt_header_title', 10 );
function ascend_post_grid_excerpt_header_title() {
	echo '<a href="'.get_the_permalink().'">';
    	echo '<h5 class="entry-title" itemprop="name headline">';
          		the_title();
    	echo '</h5>';
    echo '</a>';
}

add_action( 'ascend_post_grid_excerpt_footer', 'ascend_post_grid_footer_meta', 20 );
function ascend_post_grid_footer_meta() {
	get_template_part('templates/entry', 'meta-grid-footer');
}


if(!function_exists('ascend_build_image_collage')) {
    function ascend_build_image_collage($id = null, $link ='image', $sidebar = false) {
    	if(empty($id)) {
    		$id = get_the_ID();
    	}
 		echo '<div class="kad_post_grid kad-light-gallery">';
            $image_gallery = get_post_meta( $id, '_kad_image_gallery', true );
            if(!empty($image_gallery)) {
                $attachments = array_filter( explode( ',', $image_gallery ) );
                if ($attachments) {
                    $i = 1;
                    $count = count($attachments);
                    if($count == 2) {
                        echo '<div class="kad_postgrid_wrap kt-2-collage clearfix">';
                        if($sidebar) {
                            $widthimgsize = 525;
                            $heightimgsize = 350;
                            $smallimgsize = 330;
                        } else {
                            $widthimgsize = 750; 
                            $heightimgsize = 500;
                            $smallimgsize = 460;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 1) {
                                $img = ascend_get_image($widthimgsize, $heightimgsize, true, null, $alt, $attachment, false);
                                $padding = ($heightimgsize/$widthimgsize) * 100;
                            } else {
                                $img = ascend_get_image($smallimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$smallimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
                                        <a href="<?php echo esc_url($imagelink); ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr($padding);?>%;" data-rel="<?php echo esc_attr($datarel);?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                            <?php echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'" itemprop="contentUrl" '.$img['srcset'].'/>'; ?>
                                            <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr($img['width'])?>">
							                <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>">
                                        </a>
                                    </div>
                                </div>
                            <?php 
                            $i ++;
                            if($i==5) break;
                        }
                        echo '</div>';
                    } else if($count == 3){
                        echo '<div class="kad_postgrid_wrap kt-3-collage clearfix">';
                        if($sidebar) {
                            $widthimgsize = 525;
                            $heightimgsize = 350;
                            $swidthimgsize = 330;
                            $sheightimgsize = 170;
                        } else {
                            $widthimgsize = 750; 
                            $heightimgsize = 500;
                            $swidthimgsize = 460;
                            $sheightimgsize = 230;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 1) {
                                $img = ascend_get_image($widthimgsize, $heightimgsize, true, null, $alt, $attachment, false);
                                $padding = ($heightimgsize/$widthimgsize) * 100;
                            } else {
                                $img = ascend_get_image($swidthimgsize, $sheightimgsize, true, null, $alt, $attachment, false);
                                $padding = ($sheightimgsize/$swidthimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            if($i == 2 || $i == 3) { 
                                echo '<div class="side_post_gal">';
                            } ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
                                        <a href="<?php echo esc_url($imagelink) ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr($padding);?>%;" data-rel="<?php echo esc_attr($datarel);?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                            <?php echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'" itemprop="contentUrl" '.$img['srcset'].'/>'; ?>
                                            <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr($img['width'])?>">
							                <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>">
                                        </a>
                                    </div>
                                </div>
                            <?php 
                            if($i == 2 || $i == 3) { 
                                echo '</div>';
                            } 
                            $i ++;
                            if($i==5) break;
                        }
                        echo '</div>';

                    } else if($count == 4) {
                        echo '<div class="kad_postgrid_wrap kt-4-collage clearfix">';
                        if($sidebar) {
                            $largeimgsize = 440;
                            $smallimgsize = 220;
                        } else {
                            $largeimgsize = 600;
                            $smallimgsize = 300;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 1) {
                                $img = ascend_get_image($largeimgsize, floor($largeimgsize*1.55), true, null, $alt, $attachment, false);
                                $padding = (floor($largeimgsize*1.55)/$largeimgsize) * 100;
                            } elseif($i == 4) {
                                $img = ascend_get_image($largeimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$largeimgsize) * 100;
                            } else {
                                $img = ascend_get_image($smallimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$smallimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            if($i == 2 || $i == 4) { 
                                echo '<div class="side_post_gal">';
                            } ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
                                        <a href="<?php echo esc_url($imagelink) ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr($padding);?>%;" data-rel="<?php echo esc_attr($datarel);?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                            <?php echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'" itemprop="contentUrl" '.$img['srcset'].'/>'; ?>
                                            <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr($img['width'])?>">
							                <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>">
                                        </a>
                                    </div>
                                </div>
                            <?php 
                            if($i == 3 || $i == 4) { 
                                echo '</div>';
                            } 
                            $i ++;
                            if($i==5) break;
                        }
                        echo '</div>';

                    } else {
                        echo '<div class="kad_postgrid_wrap kt-5-collage clearfix">';
                        if($sidebar) {
                            $largeimgsize = 440;
                            $smallimgsize = 220;
                        } else {
                            $largeimgsize = 600;
                            $smallimgsize = 300;
                        }
                        foreach ($attachments as $attachment) {
                            $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
                            if($i == 3) {
                                $img = ascend_get_image($largeimgsize, $largeimgsize, true, null, $alt, $attachment, false);
                                $padding = ($largeimgsize/$largeimgsize) * 100;
                            } else if($i == 4 || $i == 5) {
                                $img = ascend_get_image($largeimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$largeimgsize) * 100;
                            } else {
                                $img = ascend_get_image($smallimgsize, $smallimgsize, true, null, $alt, $attachment, false);
                                $padding = ($smallimgsize/$smallimgsize) * 100;
                            }
                            if( ascend_lazy_load_filter() ) {
                                $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
                            } else {
                                $image_src_output = 'src="'.esc_url($img['src']).'"'; 
                            }
                            $datarel = 'post';
                            if($link == "post") {
                                $imagelink = get_the_permalink();
                            } else if($link == "attachment"){
                                $imagelink = get_permalink($attachment);
                            } else {
                            	$imagelink = $img['full'];
                                $datarel = "lightbox";
                            }
                            if($i == 1 || $i == 4) { 
                                echo '<div class="side_post_gal side-post-gal-'.esc_attr($i).'">';
                            } ?>
                                <div class="kpgi kad_post_grid_item-<?php echo esc_attr($i); ?>">
                                    <div class="kpgi-inner">
	                                    <a href="<?php echo esc_url($imagelink) ?>" class="kt-intrinsic" style="padding-bottom:<?php echo esc_attr($padding);?>%;" data-rel="<?php echo esc_attr($datarel);?>" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
	                                        <?php echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" data-caption="'.esc_attr( get_post_field('post_excerpt', $attachment) ).'" itemprop="contentUrl" '.$img['srcset'].'/>'; ?>
	                                        <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
							                <meta itemprop="width" content="<?php echo esc_attr($img['width'])?>">
							                <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>">
	                                    </a>
                                    </div>
                                </div>
                            <?php 
                            if($i == 2 || $i == 5) { 
                                echo '</div>';
                            } 
                            $i ++;
                            if($i==6) break;
                        }
                        echo '</div>';
                    }
                }
            } 
   		echo '</div>';
	}
}

