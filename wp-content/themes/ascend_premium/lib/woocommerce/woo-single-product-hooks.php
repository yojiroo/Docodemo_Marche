<?php 
/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce */
/*-----------------------------------------------------------------------------------*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function ascend_single_woocommerce_support() { 
	global $ascend;
	function product_layout_post_class( $classes ) {
			global $ascend;
			if(is_singular('product')) {
				if(isset($ascend['product_content_layout']) && $ascend['product_content_layout'] == 'large-image') {
					$classes[] = 'kt-product-style-large-image';
				} else if(isset($ascend['product_content_layout']) && $ascend['product_content_layout'] == 'split-image') {
					$classes[] = 'kt-product-style-large-image kt-product-style-split-image';
				}
			}
			return $classes;
	}
	add_filter( 'body_class', 'product_layout_post_class' );
	// Add Product Nav above title
    function ascend_woo_product_navigation() {
    	global $ascend;
		if(isset($ascend['product_single_nav']) && $ascend['product_single_nav'] == '1') {
			echo '<div class="post-footer-section post-product-nav-section">';
				echo '<div class="kad-post-navigation product-nav clearfix">';
					$prev_post = get_adjacent_post(true, null, true, 'product_cat');
					if ( !empty( $prev_post ) ) : 
			        	echo '<div class="alignleft kad-previous-link">';
			        		echo '<a href="'.get_permalink( $prev_post->ID ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Previous Product', 'ascend').'</span><span class="kt_postlink_title">'. $prev_post->post_title.'</span></a>';
			        	echo '</div>';
			        endif; 
			   		$next_post = get_adjacent_post(true, null, false, 'product_cat');
			   		if ( !empty( $next_post ) ) :
			   			echo '<div class="alignright kad-next-link">';
			        		echo '<a href="'.get_permalink( $next_post->ID ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Next Product', 'ascend').'</span><span class="kt_postlink_title">'. $next_post->post_title.'</span></a>';
			        	echo '</div>';
			        endif; 
				echo '</div> <!-- end navigation -->';
			echo '</div>';
		} 

	}
	add_action('woocommerce_after_single_product_summary','ascend_woo_product_navigation', 12);
	function ascend_woo_product_title_cat() {
		global $ascend, $post;
		if(isset($ascend['product_cat_above_title']) && $ascend['product_cat_above_title'] == '1') {
			echo '<div class="product_title_cat">';
				  	if ( $terms = wp_get_post_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                      	$main_term = $terms[0];
                      	echo $main_term->name;
                    }
			echo '</div>';
		} 
	}
	add_action('woocommerce_single_product_summary','ascend_woo_product_title_cat', 4);

	if ( isset( $ascend['product_post_title_inpost'] ) && $ascend['product_post_title_inpost'] == 0 ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
		add_action( 'woocommerce_single_product_summary', 'kt_hidden_woocommerce_template_single_title', 5 );
	  	function kt_hidden_woocommerce_template_single_title() {
	    	echo '<span itemprop="name" class="product_title kt_title_hidden entry-title">';
	      		the_title(); 
	     	echo '</span>';
	  	}
	}


    // Redefine woocommerce_output_related_products()
    function ascend_woo_related_products_limit() {
        global $product, $woocommerce;
         if ( version_compare( WC_VERSION, '3.0', '>' ) ) {
			$related = wc_get_related_products($product->get_id(), 12);
		} else {
			$related = $product->get_related(12);
		}
        $args = array(
            'post_type'           => 'product',
            'no_found_rows'       => 1,
            'posts_per_page'      => 8,
            'ignore_sticky_posts'   => 1,
            'orderby'               => 'rand',
            'post__in'              => $related,
            'post__not_in'          => array($product->get_id())
        );
        return $args;
    }
    add_filter( 'woocommerce_related_products_args', 'ascend_woo_related_products_limit' );

    // Display product tabs?
    add_action('wp_head','ascend_woo_tab_check');
    function ascend_woo_tab_check() {
        global $ascend;
        if ( isset( $ascend[ 'product_tabs' ] ) && $ascend[ 'product_tabs' ] == "none" ) {
          	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        } elseif ( isset( $ascend[ 'product_tabs' ] ) && $ascend[ 'product_tabs' ] == "list" ) {
        	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        	add_action( 'woocommerce_after_single_product_summary', 'ascend_woo_output_product_tabs_list', 10);
        }
    }
    function ascend_woo_output_product_tabs_list() {
    	$tabs = apply_filters( 'woocommerce_product_tabs', array() );

		if ( ! empty( $tabs ) ) : ?>
			<div class="kt-custom-row-full-stretch">
				<div class="woocommerce-tabs-list">
					<?php foreach ( $tabs as $key => $tab ) : ?>
						<div class="woocommerce-Tabs-panel-list list-woocommerce-tab-panel-<?php echo esc_attr( $key ); ?> entry-content wc-tab" id="list-tab-<?php echo esc_attr( $key ); ?>">
							<div class="container tab-list-container">
								<?php call_user_func( $tab['callback'], $key, $tab ); ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		<?php endif; 
    }
    // Display related products?
    add_action('wp_head','ascend_woo_related_products');
    function ascend_woo_related_products() {
        global $ascend;
        if ( isset( $ascend[ 'related_products' ] ) && $ascend[ 'related_products' ] == "0" ) {
          	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
        }
    }

    // Change the tab title
    add_filter( 'woocommerce_product_tabs', 'ascend_woo_rename_tabs', 98 );
    function ascend_woo_rename_tabs( $tabs ) {
        global $ascend; 
        if(!empty($ascend['description_tab_text']) && !empty($tabs['description']['title'])) {$tabs['description']['title'] = $ascend['description_tab_text'];}
        if(!empty($ascend['additional_information_tab_text']) && !empty($tabs['additional_information']['title'])) {$tabs['additional_information']['title'] = $ascend['additional_information_tab_text'];}
        if(!empty($ascend['reviews_tab_text']) && !empty($tabs['reviews']['title'])) {$tabs['reviews']['title'] = $ascend['reviews_tab_text'];}
     
      return $tabs;
    }

    // Change the tab description heading
    add_filter( 'woocommerce_product_description_heading', 'ascend_description_tab_heading', 10, 1 );
    function ascend_description_tab_heading( $title ) {
        global $ascend; 
        if(!empty($ascend['description_header_text'])) {
        	$title = $ascend['description_header_text'];
        }
        return $title;
    }

    // Change the tab aditional info heading
    add_filter( 'woocommerce_product_additional_information_heading', 'ascend_additional_information_tab_heading', 10, 1 );
    function ascend_additional_information_tab_heading( $title ) {
        global $ascend; 
        if ( ! empty( $ascend[ 'additional_information_header_text' ] ) ) {
        	$title = $ascend[ 'additional_information_header_text' ];
        }
        return $title;
    }
    add_filter( 'woocommerce_product_tabs', 'ascend_woo_reorder_tabs', 98 );
	function ascend_woo_reorder_tabs( $tabs ) {
      	global $ascend; 
      	if ( isset( $ascend[ 'ptab_description' ] ) ) { $dpriority = $ascend[ 'ptab_description' ]; } else { $dpriority = 10; }
      	if ( isset( $ascend[ 'ptab_additional' ] ) ) { $apriority = $ascend[ 'ptab_additional' ]; } else { $apriority = 20; }
      	if ( isset( $ascend[ 'ptab_reviews' ] ) ) { $rpriority = $ascend[ 'ptab_reviews' ]; } else { $rpriority = 30; }
     
      	if ( ! empty( $tabs[ 'description' ] ) ) $tabs[ 'description' ][ 'priority' ] = $dpriority;      // Description
      	if ( ! empty( $tabs[ 'additional_information' ] ) ) $tabs[ 'additional_information' ][ 'priority' ] = $apriority; // Additional information 
      	if ( ! empty( $tabs[ 'reviews' ] ) ) $tabs[ 'reviews' ][ 'priority' ] = $rpriority;     // Reviews 
     
      	return $tabs;
	}

	add_action('woocommerce_before_single_product_summary','ascend_woocommerce_image_wrap_start', 1);
    function ascend_woocommerce_image_wrap_start() {
    	echo '<div class="row single-product-row clearfix">';
		echo '<div class="col-lg-4 col-md-5 col-sm-4 product-img-case">';
    }
	add_action('woocommerce_before_single_product_summary','ascend_woocommerce_image_wrap_end', 50);
    function ascend_woocommerce_image_wrap_end() {
    	echo '</div>';
		echo '<div class="col-lg-8 col-md-7 col-sm-8 product-summary-case">';
    }
    add_action('woocommerce_single_product_summary','ascend_woocommerce_summary_wrap_end', 100);
    function ascend_woocommerce_summary_wrap_end() {
    	echo '</div>';
		echo '</div>';
    }

}
add_action( 'after_setup_theme', 'ascend_single_woocommerce_support' );


/*
*
* WOO TABS
*
*/

function ascend_custom_tab_01($tabs) {
      global $post; 
      $tab_content = apply_filters('kadence_custom_woo_tab_01_content', get_post_meta( $post->ID, '_kad_tab_content_01', true ) );
      if(!empty( $tab_content) ) {
        $tab_title = get_post_meta( $post->ID, '_kad_tab_title_01', true );
        $tab_priority = get_post_meta( $post->ID, '_kad_tab_priority_01', true ); 
        if(!empty($tab_title)) {
        	$product_tab_title = $tab_title;
        } else {
        	$product_tab_title = __('Custom Tab', 'ascend');
        }
        if(!empty($tab_priority)) {
        	$product_tab_priority = esc_attr($tab_priority);
        } else {
        	$product_tab_priority = 45;
        }
       	$tabs['kad_custom_tab_01'] = array(
       		'title' => apply_filters('kadence_custom_woo_tab_01_title', $product_tab_title),
       		'priority' => apply_filters('kadence_custom_woo_tab_01_priority', $product_tab_priority),
       		'callback' => 'ascend_product_custom_tab_content_01'
       	);
      }

     return $tabs;
}
function ascend_product_custom_tab_content_01() {
   	global $post; 
   	$tab_content_01 = wpautop(get_post_meta( $post->ID, '_kad_tab_content_01', true ));
   	echo do_shortcode('<div class="product_custom_content_case ascend_custom_tab_01">'.apply_filters('kadence_custom_woo_tab_01_content', $tab_content_01 ).'</div>');
}
function ascend_custom_tab_02($tabs) {
  	global $post;
  	$tab_content = apply_filters('kadence_custom_woo_tab_02_content', get_post_meta( $post->ID, '_kad_tab_content_02', true ) );
   	if(!empty($tab_content) ) {
    	$tab_title = get_post_meta( $post->ID, '_kad_tab_title_02', true );
    	$tab_priority = get_post_meta( $post->ID, '_kad_tab_priority_02', true ); 
    	if(!empty($tab_title)) {
    		$product_tab_title = $tab_title;
    	} else {
    		$product_tab_title = __('Custom Tab', 'ascend');
    	}
    	if(!empty($tab_priority)) {
    		$product_tab_priority = esc_attr($tab_priority);
    	} else {
    		$product_tab_priority = 50;
    	}
   		$tabs['kad_custom_tab_02'] = array(
   			'title' => apply_filters('kadence_custom_woo_tab_02_title', $product_tab_title),
   			'priority' => apply_filters('kadence_custom_woo_tab_02_priority', $product_tab_priority),
   			'callback' => 'ascend_product_custom_tab_content_02'
   		);
  	}

 	return $tabs;
}
function ascend_product_custom_tab_content_02() {
   	global $post; 
   	$tab_content_02 = wpautop(get_post_meta( $post->ID, '_kad_tab_content_02', true ));
   	echo do_shortcode('<div class="product_custom_content_case ascend_custom_tab_02">'.apply_filters('kadence_custom_woo_tab_02_content', $tab_content_02 ).'</div>');

}
function ascend_custom_tab_03($tabs) {
  	global $post;
  	$tab_content = apply_filters('kadence_custom_woo_tab_03_content', get_post_meta( $post->ID, '_kad_tab_content_03', true ) );
  	if(!empty( $tab_content) ) {
    	$tab_title = get_post_meta( $post->ID, '_kad_tab_title_03', true );
    	$tab_priority = get_post_meta( $post->ID, '_kad_tab_priority_03', true ); 
    	if(!empty($tab_title)) {
    		$product_tab_title = $tab_title;
    	} else {
    		$product_tab_title = __('Custom Tab', 'ascend');
    	}
    	if(!empty($tab_priority)) {
    		$product_tab_priority = esc_attr($tab_priority);
    	} else {
    		$product_tab_priority = 55;
    	}
   		$tabs['kad_custom_tab_03'] = array(
   			'title' => apply_filters('kadence_custom_woo_tab_03_title', $product_tab_title ),
   			'priority' => apply_filters('kadence_custom_woo_tab_03_priority', $product_tab_priority),
   			'callback' => 'ascend_product_custom_tab_content_03'
   		);
  	}

 	return $tabs;
}
function ascend_product_custom_tab_content_03() {
   	global $post; 
   	$tab_content_03 = wpautop(get_post_meta( $post->ID, '_kad_tab_content_03', true ));
  	echo do_shortcode('<div class="product_custom_content_case ascend_custom_tab_03">'.apply_filters('kadence_custom_woo_tab_03_content', $tab_content_03 ).'</div>');
}

function ascend_woo_custom_tab_init() {
    global $ascend;
    if ( isset( $ascend['custom_tab_01'] ) && $ascend['custom_tab_01'] == 1 ) {
    	add_filter( 'woocommerce_product_tabs', 'ascend_custom_tab_01');
    }
    if ( isset( $ascend['custom_tab_02'] ) && $ascend['custom_tab_02'] == 1 ) {
    	add_filter( 'woocommerce_product_tabs', 'ascend_custom_tab_02');
    }
    if ( isset( $ascend['custom_tab_03'] ) && $ascend['custom_tab_03'] == 1 ) {
    	add_filter( 'woocommerce_product_tabs', 'ascend_custom_tab_03');
    }
}
add_action( 'init', 'ascend_woo_custom_tab_init' );


/*
*
* WOO RADIO VARIATION 
*
*/
function ascend_woo_variation_ratio_output() {
    if ( ! function_exists( 'kad_wc_radio_variation_attribute_options' ) ) {
        function kad_wc_radio_variation_attribute_options( $args = array() ) {
            $args['class'] = 'kt-no-select2';
            echo '<div class="kt-radio-variation-container">';
            kadence_variable_swatch_wc_dropdown_variation_attribute_options($args);
            kadence_wc_radio_variation_attribute_options($args);
            echo '</div>';
        }
    }
    if ( ! function_exists( 'kadence_wc_radio_variation_attribute_options' ) ) {
      function kadence_wc_radio_variation_attribute_options( $args = array() ) {
        $args = wp_parse_args( $args, array(
          'options'          => false,
          'attribute'        => false,
          'product'          => false,
          'selected'         => false,
          'name'             => '',
          'id'               => ''
        ) );
        $options   = $args['options'];
        $product   = $args['product'];
        $attribute = $args['attribute'];
        $name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
        $id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
        if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
          $attributes = $product->get_variation_attributes();
          $options    = $attributes[ $attribute ];
        }
        echo '<fieldset id="' . esc_attr( $id ) .'" class="kad_radio_variations" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';
        if ( ! empty( $options ) ) {
          if ( $product && taxonomy_exists( $attribute ) ) {
            $terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );
            foreach ( $terms as $term ) {
              if ( in_array( $term->slug, $options ) ) {
                echo '<label for="'. esc_attr( sanitize_title($name) ) . esc_attr( $term->slug ) . '"><input type="radio" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" value="' . esc_attr( $term->slug ) . '" ' . checked( sanitize_title( $args['selected'] ), $term->slug, false ) . ' id="'. esc_attr( sanitize_title($name) ) . esc_attr( $term->slug ) . '" name="'. sanitize_title($name).'">' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</label>';
              }
            }
          } else {
            foreach ( $options as $option ) {
              echo '<label for="'. esc_attr( sanitize_title($name) ) . esc_attr( sanitize_title( $option ) ) .'"><input type="radio" value="' . esc_attr( $option ) . '" ' . checked( $args['selected'], $option, false ) . ' id="'. esc_attr( sanitize_title($name) ) . esc_attr( sanitize_title( $option ) ) .'" name="'. sanitize_title($name).'">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</label>';
            }
          }
        }
        echo '</fieldset>';
      }
    }

    function kadence_variable_swatch_wc_dropdown_variation_attribute_options( $args = array() ) {
        $args = wp_parse_args( apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ), array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'show_option_none' => __( 'Choose an option', 'ascend' )
        ) );

        $options   = $args['options'];
        $product   = $args['product'];
        $attribute = $args['attribute'];
        $name      = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
        $id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
        $class     = $args['class'];

        if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
            $attributes = $product->get_variation_attributes();
            $options    = $attributes[ $attribute ];
        }

        $html = '<select class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '">';

        if ( $args['show_option_none'] ) {
            $html .= '<option value="">' . esc_html( $args['show_option_none'] ) . '</option>';
        }

        if ( ! empty( $options ) ) {
            if ( $product && taxonomy_exists( $attribute ) ) {
                // Get terms if this is a taxonomy - ordered. We need the names too.
                $terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

                foreach ( $terms as $term ) {
                    if ( in_array( $term->slug, $options ) ) {
                        $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) ) . '</option>';
                    }
                }
            } else {
                foreach ( $options as $option ) {
                    // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                    $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
                    $html .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
                }
            }
        }

        $html .= '</select>';

        echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html );
    }
}
add_action( 'init', 'ascend_woo_variation_ratio_output');


