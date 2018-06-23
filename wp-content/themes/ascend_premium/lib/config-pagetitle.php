<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * Config Page Title
 */
function ascend_display_pagetitle() {
    if( is_front_page() ) {
        global $ascend;
        if(isset($ascend['home_header']) && $ascend['home_header'] == 'none') {
            $pagetitledisplay = false;
        } else {
            $pagetitledisplay = true;
        }
    } else if(is_home()) {
        $homeid = get_option( 'page_for_posts' );
        $hidepagetitle = get_post_meta( $homeid, '_kad_pagetitle_hide', true );
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
           if(isset($ascend['default_showpagetitle']) && $ascend['default_showpagetitle'] == '0') {
                $pagetitledisplay = false;
            } else {
                $pagetitledisplay = true;
            }
        }
    } else if (is_attachment()) {
        $pagetitledisplay = false;
    } else if(is_page() && !is_front_page() && !is_home() ) {
        global $post, $ascend;
        $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
            if(isset($ascend['default_showpagetitle']) && $ascend['default_showpagetitle'] == '0') {
                $pagetitledisplay = false;
            } else {
               $pagetitledisplay = true;
            }
        }
    } else if (is_singular('product') ) {
        global $post, $ascend;
        $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
            if(isset($ascend['product_post_title']) && $ascend['product_post_title'] == '1') {
                $pagetitledisplay = true;
            } else {
                $pagetitledisplay = false;
            }
        }
    } else if(is_tax('product_cat') || is_tax('product_tag') || is_tax('kt_album') || is_tax('series') || is_tax('speaker') || is_tax('portfolio-type') || is_tax('portfolio-tag') || is_category() ||  is_tag() ) {
        global $ascend;
        $cat_term_id = get_queried_object()->term_id;
        $meta = get_option('ascend_archive_pageheader');
        if (empty($meta)) {
            $meta = array();
        }
        if (!is_array($meta)) {
            $meta = (array) $meta;
        }
        $meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
        if(isset($meta['kad_pagetitle_hide'])) {
            $hidepagetitle = $meta['kad_pagetitle_hide'];
        }
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
            if(isset($ascend['default_showpagetitle']) && $ascend['default_showpagetitle'] == '0') {
                $pagetitledisplay = false;
            } else {
                $pagetitledisplay = true;
            }
        }
    } else if (is_singular('portfolio') ) {
        global $post, $ascend;
        $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
            if(isset($ascend['portfolio_post_title']) && $ascend['portfolio_post_title'] == '0') {
                $pagetitledisplay = false;
            } else {
                $pagetitledisplay = true;
            }
        }
    } else if (is_singular('testimonial') ) {
        global $post, $ascend;
        $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
            if(isset($ascend['testimonial_post_title']) && $ascend['testimonial_post_title'] == '0') {
                $pagetitledisplay = false;
            } else {
                $pagetitledisplay = true;
            }
        }
    } else if (is_singular('staff') ) {
        global $post, $ascend;
        $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
            if(isset($ascend['staff_post_title']) && $ascend['staff_post_title'] == '0') {
                $pagetitledisplay = false;
            } else {
                $pagetitledisplay = true;
            }
        }
    } else if (is_single() ) {
        global $post, $ascend;
        $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
            $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
            $pagetitledisplay = true;
        } else {
            if(isset($ascend['blog_post_title']) && $ascend['blog_post_title'] == '0') {
                $pagetitledisplay = false;
            } else {
                $pagetitledisplay = true;
            }
        }
    } else {
        global $ascend;
        if(isset($ascend['default_showpagetitle']) && $ascend['default_showpagetitle'] == '0') {
            $pagetitledisplay = false;
        } else {
            $pagetitledisplay = true;
        }
    }

    return apply_filters('kadence_pagetitle_display', $pagetitledisplay);
}
add_filter('kadence_pagetitle_display', 'ascend_shop_page_title');
function ascend_shop_page_title($show) {
    if (class_exists('woocommerce')) {
        if(is_shop()) {
            global $ascend;
            $shopid = get_option( 'woocommerce_shop_page_id' );
            $hidepagetitle = get_post_meta( $shopid, '_kad_pagetitle_hide', true );
            if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
                $show = false;
            } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
                $show = true;
            } else {
                if(isset($ascend['default_showpagetitle']) && $ascend['default_showpagetitle'] == '0') {
                    $show = false;
                } else {
                    $show = true;
                }
            }
        }
    }
    return $show;
}

function ascend_trans_header() {
  	if(!ascend_display_pagetitle()) {
    	$trans_head = false;
    	if(is_front_page()) {
    		$post_id =  get_option( 'page_on_front' );
    		$hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );
    		if(isset($hs_behind) && $hs_behind == 'true') {
            	$trans_head = true;
            }
    	} elseif(is_home()) {
    		$post_id = get_option( 'page_for_posts' );
        	$hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );
    		if(isset($hs_behind) && $hs_behind == 'true') {
            	$trans_head = true;
            }
    	} elseif (class_exists('woocommerce') && is_shop())  {
	        $post_id = wc_get_page_id('shop');
	        $hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );
        	if(isset($hs_behind) && $hs_behind == 'true') {
            	$trans_head = true;
          	}
	    } elseif(is_page() || is_single() || is_singular() ) {
	    	global $post;
    		if(is_search()){
				$post_id = '';
			} else if(is_404()){
				$post_id = '';
			} else {
				$post_id = $post->ID;
			}
        	$hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );
    		if(isset($hs_behind) && $hs_behind == 'true') {
            	$trans_head = true;
            }
    	}
  	} else {
    	if(is_front_page()) {
      			global $ascend;
                if(isset($ascend['home_transheader']) && $ascend['home_transheader'] == 'true') {
                  	$trans_head = true;
                } elseif(isset($ascend['home_transheader']) && $ascend['home_transheader'] == 'false') {
                  	$trans_head = false;
                } else {
		            if(isset($ascend['page_trans_default']) && $ascend['page_trans_default'] == '1') {
		          		$trans_head = true;
		        	} else {
		          		$trans_head = false;
		        	}
		        }
      	} else if(is_home()) {
        	$post_id = get_option( 'page_for_posts' );
        	$hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );
        	if(isset($hs_behind) && $hs_behind == 'true') {
                	$trans_head = true;
            } else if(isset($hs_behind) && $hs_behind == 'false') {
                	$trans_head = false;
            } else {
                	if(isset($ascend['page_trans_default']) && $ascend['page_trans_default'] == '1') {
                  		$trans_head = true;
                	} else {
                  		$trans_head = false;
                	}
            }
    	} elseif (class_exists('woocommerce') && is_shop())  {
		        global $ascend;
		        $post_id = wc_get_page_id('shop');
		        $hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );
	        	if(isset($hs_behind) && $hs_behind == 'true') {
	            	$trans_head = true;
	          	} else if(isset($hs_behind) && $hs_behind == 'false') {
	            	$trans_head = false;
	          	} else {
	            	if(isset($ascend['page_trans_default']) && $ascend['page_trans_default'] == '1') {
	              		$trans_head = true;
	            	} else {
	              		$trans_head = false;
	            	}
	          	}
    	} elseif(is_page() || is_single() || is_singular() ) {
    		global $post, $ascend;
    		if(is_search()){
				$post_id = '';
			} else if(is_404()){
				$post_id = '';
			} else {
				$post_id = $post->ID;
			}
              	$hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );

              	if(isset($hs_behind) && $hs_behind == 'true') {
                	$trans_head = true;
              	} else if(isset($hs_behind) && $hs_behind == 'false') {
                	$trans_head = false;
              	} else {
                	if(isset($ascend['page_trans_default']) && $ascend['page_trans_default'] == '1') {
                  		$trans_head = true;
                	} else {
                  		$trans_head = false;
                	}
              }
      	} else if(is_tax('product_cat') || is_tax('product_tag') || is_tax('kt_album') || is_tax('series') || is_tax('speaker') || is_tax('portfolio-type') || is_tax('portfolio-tag') || is_category() ||  is_tag() ) {
	        global $ascend;
	        $cat_term_id = get_queried_object()->term_id;
	        $meta = get_option('ascend_archive_pageheader');
	        if (empty($meta)) {
	            $meta = array();
	        }
	        if (!is_array($meta)) {
	            $meta = (array) $meta;
	        }
	        $meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
	        if(isset($meta['kad_transparent_header'])) {
	            $hs_behind = $meta['kad_transparent_header'];
	        }
	        if(isset($hs_behind) && $hs_behind == 'true') {
                	$trans_head = true;
              	} else if(isset($hs_behind) && $hs_behind == 'false') {
                	$trans_head = false;
              	} else {
                	if(isset($ascend['page_trans_default']) && $ascend['page_trans_default'] == '1') {
                  		$trans_head = true;
                	} else {
                  		$trans_head = false;
                	}
              }
        } else {
        	global $ascend;
        	if(isset($ascend['page_trans_default']) && $ascend['page_trans_default'] == '1') {
                  	$trans_head = true;
                } else {
                  	$trans_head = false;
                }
      	}
  	}
    return apply_filters('kadence_transparent_header', $trans_head);
}
function ascend_shop_trans_header($trans_head) {
   	if (class_exists('woocommerce'))  {
      	if(is_shop()) {
	        global $ascend;
	        $post_id = wc_get_page_id('shop');
	        $hs_behind = get_post_meta( $post_id, '_kad_transparent_header', true );
        	if(isset($hs_behind) && $hs_behind == 'true') {
            	$trans_head = true;
          	} else if(isset($hs_behind) && $hs_behind == 'false') {
            	$trans_head = false;
          	} else {
            	if(isset($ascend['page_trans_default']) && $ascend['page_trans_default'] == '1') {
              		$trans_head = true;
            	} else {
              		$trans_head = false;
            	}
          	}
      	}
    }
    return $trans_head;
}
//add_filter('kadence_transparent_header','ascend_shop_trans_header');