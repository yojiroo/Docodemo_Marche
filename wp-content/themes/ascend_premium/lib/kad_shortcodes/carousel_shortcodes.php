<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for Carousels
function ascend_carousel_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'type' 						=> 'post',
		'id' 						=> (rand(10,1000)),
		'columns' 					=> '4',
		'orderby' 					=> 'date',
		'order' 					=> 'DESC',
		'xxlcol' 					=> null,
		'xlcol' 					=> null,
		'mcol' 						=> null,
		'scol' 						=> null,
		'xscol' 					=> null,
		'sscol' 					=> null,
		'img_height' 				=> null,
		'img_width' 				=> null,
		'autoplay' 					=> 'true',
		'offset' 					=> null,
		'speed' 					=> '9000',
		'trans_speed' 				=> '400',
		'scroll' 					=> '1',
		'arrows' 					=> 'true',
		'pagination' 				=> 'false',
		'cat' 						=> null,
		'class' 					=> 'products',
		'productargs' 				=> null,
		'items' 					=> '8'
), $atts));
	if(empty($type)) {
		$type = 'post';
	}

	ob_start(); 
		ascend_build_post_content_carousel($id, $columns, $type, $cat, $items, $orderby, $order, $class, $offset, $autoplay, $speed, $scroll, $arrows, $trans_speed, $productargs, $pagination, $xxlcol, $xlcol, $mcol, $scol, $xscol, $sscol );	

	$output = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	return $output;
}
if(!function_exists('ascend_build_post_content_carousel')) {
    function ascend_build_post_content_carousel($id='content_carousel', $columns='4', $type = 'post', $cat = null, $items = 8, $orderby = null, $order = null, $class = null, $offset = null, $auto = 'true', $speed = '9000', $scroll = '1', $arrows = 'true', $trans_speed = '400', $productargs = null, $pagination = 'false', $xxlcol = null, $xlcol = null, $mdcol = null, $smcol = null, $xscol = null, $sscol = null ) {
    	$cc = array();
		if ($columns == '2') {
			$cc = ascend_carousel_columns('2');
		}else if ($columns == '1') {
			$cc = ascend_carousel_columns('1');
		} else if ($columns == '3'){
			$cc = ascend_carousel_columns('3');
		} else if ($columns == '6'){
			$cc = ascend_carousel_columns('6');
		} else if ($columns == '5'){ 
			$cc = ascend_carousel_columns('5');
		} else {
			$cc = ascend_carousel_columns('4');
		} 
		$cc = apply_filters('kadence_carousel_columns', $cc, $id);
		if( !empty($xxlcol) ) {
			$cc['xxl'] = $xxlcol;
		}
		if( !empty($xlcol) ) {
			$cc['xl'] = $xlcol;
		}
		if( !empty($mdcol) ) {
			$cc['md'] = $mdcol;
		}
		if( !empty($smcol) ) {
			$cc['sm'] = $smcol;
		}
		if( !empty($xscol) ) {
			$cc['xs'] = $xscol;
		}
		if( !empty($sscol) ) {
			$cc['ss'] = $sscol;
		}
		$post_type = $type;
    	$extraargs = array();
    	if($type == 'portfolio') {
    		$tax = 'portfolio-type';
    		$margin = 'row-margin-small';
    		global $kt_portfolio_loop;
            $kt_portfolio_loop = array(
            	'lightbox' 		=> 'true',
             	'showexcerpt' 	=> 'false',
             	'showtypes' 	=> 'true',
            	'columns' 		=> $columns,
            	'ratio' 		=> 'square',
            	'style' 		=> 'pgrid',
            	'carousel' 		=> 'true',
            	'tileheight' 	=> '',
         	);
         	if(empty($orderby)) {
				$orderby = 'menu_order';
			}
			if(empty($order)) {
				$order = 'ASC';
			}
    	} elseif($type == 'product') {
    		global $woocommerce_loop;
    		$margin = 'row-margin-small';
    		if(empty($orderby)) {
				$orderby = 'menu_order';
			}
			if(empty($order)) {
				$order = 'ASC';
			}
			if($columns == 1) {
		  		$woocommerce_loop['columns'] = 3;
		  	}else {
		  		$woocommerce_loop['columns'] = $columns;
	    	}
	    	$class .= ' products';
    		if('featured' == $productargs || 'featured-products' == $productargs){
    			if ( version_compare( WC_VERSION, '3.0', '>' ) ) {
			        $meta_query  = WC()->query->get_meta_query();
					$tax_query   = WC()->query->get_tax_query();
					$tax_query[] = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
						'operator' => 'IN',
					);
					$extraargs = array(
						'meta_query'          => $meta_query,
						'tax_query'           => $tax_query,
					);
				} else {
					$meta_query   = WC()->query->get_meta_query();
					$meta_query[] = array(
						'key'   => '_featured',
						'value' => 'yes'
					);

					$extraargs = array(
						'meta_query'	 => $meta_query
					);
				}
    		} else if ('best' == $productargs ||  'best-products' == $productargs ) {
    			$extraargs = array(
	    			'meta_key' 		=> 'total_sales',
					'orderby' 	=> 'meta_value_num',
					'order'		=> 'DESC',
				);
			} else if ('sale' == $productargs || 'sale-products' == $productargs){
				if (class_exists('woocommerce')) {
					$extraargs = array(
		    			'meta_query' 		=> WC()->query->get_meta_query(),
						'post__in' 			=> array_merge( array( 0 ), wc_get_product_ids_on_sale() ),
						'tax_query' 		=> WC()->query->get_tax_query(),
					);
      			}
			} else if ($productargs == 'latest'){
			        $extraargs = array(
		    			'orderby' 	=> 'date',
						'order' 	=> 'desc',
					);
			}
    		$tax = 'product_cat';
    	} else if($type == 'staff') {
    		$margin = 'rowtight';
    		$tax = 'staff-group';
    		if(empty($orderby)) {
				$orderby = 'menu_order';
			}
			if(empty($order)) {
				$order = 'ASC';
			}
    	} else if($type == 'event') {
    		$margin = 'row';
    		$tax = 'event-category';
    		global $ascend_grid_columns;
    		$ascend_grid_columns = $columns;
    		if(empty($orderby)) {
				$orderby = 'menu_order';
			}
			if(empty($order)) {
				$order = 'ASC';
			}
    	} else if($type == 'podcast') {
    		$margin = 'row';
    		$tax = 'series';
    		global $kt_grid_columns, $kt_grid_carousel;
    		$kt_grid_columns = $columns;
    		$kt_grid_carousel = true;
    		if(empty($orderby)) {
				$orderby = 'date';
			}
			if(empty($order)) {
				$order = 'DESC';
			}
			if ($kt_grid_columns == '2') {
		        $itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
		    } else if ($kt_grid_columns == '1') {
		        $itemsize = 'col-xs-12 col-ss-12'; 
		    } else if ($kt_grid_columns == '3'){ 
		        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12'; 
		    } else {
		        $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
		   	}
    	} else if($type == 'testimonal') {
    		$margin = 'rowtight';
    		$tax = 'testimonal-group';
    		if(empty($orderby)) {
				$orderby = 'menu_order';
			}
			if(empty($order)) {
				$order = 'ASC';
			}
    	} else {
    		$post_type = 'post';
    		global $kt_grid_columns, $kt_grid_carousel;
    		$kt_grid_columns = $columns;
    		$kt_grid_carousel = true;
    		$margin = 'rowtight';
    		$tax = 'category_name';
    		if(empty($orderby)) {
				$orderby = 'date';
			}
			if(empty($order)) {
				$order = 'DESC';
			}
			if ($kt_grid_columns == '2') {
		        $itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
		    } else if ($kt_grid_columns == '1') {
		        $itemsize = 'col-xs-12 col-ss-12'; 
		    } else if ($kt_grid_columns == '3'){ 
		        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12'; 
		    } else {
		        $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
		   	}
    	}
    	$args = array(
			'orderby' 			=> $orderby,
			'order' 			=> $order,
			'post_type' 		=> $post_type,
			'offset' 			=> $offset,
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> $items,
		);
		$args = array_merge($args, $extraargs);
		if ( ! empty( $cat ) ) {
			if('product' == $post_type) {
				if ( empty( $args['tax_query'] ) ) {
					$args['tax_query'] = array();
				}
				$args['tax_query'][] = array(
					array(
						'taxonomy' => $tax,
						'terms'    => array_map( 'sanitize_title', explode( ',', $cat ) ),
						'field'    => 'slug',
					),
				);
			} else {
				$ccat = array($tax => $cat);
				$args = array_merge($args, $ccat);
			}
		}
			echo '<div class="carousel_outerrim">';
			echo '<div class="carouselcontainer '.esc_attr($margin).'">';
			echo '<div id="kadence-carousel-'.esc_attr($id).'" class="slick-slider '.esc_attr($class).' carousel_shortcode kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false"  data-slider-dots="'.esc_attr($pagination).'" data-slider-arrows="'.esc_attr($arrows).'" data-slider-type="content-carousel" data-slider-anim-speed="'.esc_attr($trans_speed).'" data-slider-scroll="'.esc_attr($scroll).'" data-slider-auto="'.esc_attr($auto).'" data-slider-speed="'.esc_attr($speed).'" data-slider-xxl="'.esc_attr($cc['xxl']).'" data-slider-xl="'.esc_attr($cc['xl']).'" data-slider-md="'.esc_attr($cc['md']).'" data-slider-sm="'.esc_attr($cc['sm']).'" data-slider-xs="'.esc_attr($cc['xs']).'" data-slider-ss="'.esc_attr($cc['ss']).'">';
				  	$loop = new WP_Query($args);
					if ( $loop ) : 
						if($type == 'portfolio') {
							while ( $loop->have_posts() ) : $loop->the_post(); 
					        	get_template_part('templates/content', 'loop-portfolio'); 
					        endwhile;
                    	} elseif($type == 'product') {
							while ( $loop->have_posts() ) : $loop->the_post(); 
                    			wc_get_template_part( 'content', 'product' ); 
                    		endwhile;
                    	} elseif($type == 'staff') {
                    		while ( $loop->have_posts() ) : $loop->the_post(); 
                    			get_template_part('templates/content', 'loop-staff'); 
                    		endwhile;
                    	} elseif($type == 'event') {
                    		while ( $loop->have_posts() ) : $loop->the_post(); 
                    			get_template_part('templates/content', 'loop-event'); 
                    		endwhile;
                    	} elseif($type == 'testimonal') {
                    		while ( $loop->have_posts() ) : $loop->the_post(); 
                    			get_template_part('templates/content', 'loop-stestimonal');
                    		endwhile;
                    	} elseif($type == 'post_photo') {
                    		while ( $loop->have_posts() ) : $loop->the_post(); 
                    			echo '<div class="'.esc_attr($itemsize).' b_item kad_blog_item">';
                    				get_template_part('templates/content', 'post-photo-grid');
                    			echo '</div>';
                    		endwhile;
                    	} else {
                    		while ( $loop->have_posts() ) : $loop->the_post();
                    			echo '<div class="'.esc_attr($itemsize).' b_item kad_blog_item">'; 
                    				get_template_part('templates/content', 'post-grid');
                    			echo '</div>';
                    		endwhile;
                    	}
					endif; 
                     wp_reset_postdata();
            echo '</div>';
            echo '</div>';
            echo '</div> <!--Carousel-->';
    }
}