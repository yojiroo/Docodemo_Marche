<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for portfolio Posts
function ascend_portfolio_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'orderby' => 'menu_order',
		'type' => '',
		'order' => '',
		'offset' => null,
		'id' => (rand(10,1000)),
		'columns' => '4',
		'lightbox' => 'false',
		'ratio' => 'square',
		'style' => 'default',
		'filter' => 'false',
		'excerpt' => 'false',
		'showtypes' => 'true',
		'items' => '4'
), $atts));
	global $kt_portfolio_loop, $ascend, $kt_portfolio_loop_count;
	if(!empty($order) ) {
		$order = $order;
	} else if($orderby == 'menu_order' || $orderby == "title") {
		$order = 'ASC';
	} else {
		$order = 'DESC';
	} 
	if(empty($type)) {
		$type = '';
		$portfolio_type_ID = '';
	} else {
		$portfolio_type = get_term_by ('slug',$type,'portfolio-type' );
		$portfolio_type_ID = $portfolio_type->term_id;
	}
	if($style == 'default') {
   		if(isset($ascend['portfolio_tax_style'])) {
   			$style = $ascend['portfolio_tax_style'];
   		} else {
   			$style = 'pgrid';
   		}
   	}
   	ob_start();
	if ($filter == 'true' && $style != 'tiles') { 
			$termtypes  = array( 'child_of' => $portfolio_type_ID );
			ascend_iso_filter('portfolio-type', $termtypes);
    } 
    if($ratio == 'softcrop') {
		$isostyle 	= 'masonry';
	} else {
		$isostyle 	= 'fitRows';
	}
	$tileheight = '0';
	$lastrow = 'nojustify';
    if($style == 'mosaic'){	
    	$isoclass 	= 'init-mosaic-isotope'; 
    	$isostyle 	= 'packery';
    	$margins 	= 'row-nomargin';
    } elseif($style == 'poststyle') {
    	$margins 	= 'row';
    	$isoclass 	= 'init-isotope-intrinsic reinit-isotope'; 
    } elseif($style == 'pgrid-no-margin') {
    	$margins 	= 'row-nomargin';
    	$isoclass 	= 'init-isotope-intrinsic reinit-isotope'; 
    } elseif($style == 'tiles') {
    	$margins 	= 'row-nomargin';
    	$isoclass 	= 'init-tiles-justified'; 
    	$tileheight = apply_filters('kadence_portfolio_tiles_height', '320' );
    	$lastrow 	= apply_filters('kadence_portfolio_tiles_last_row', 'nojustify' );
    } else {
    	$isoclass 	= 'init-isotope-intrinsic reinit-isotope'; 
    	$margins 	= 'rowtight';
    }
    $kt_portfolio_loop = array(
     	'lightbox' 		=> $lightbox,
     	'showexcerpt' 	=> $excerpt,
     	'showtypes' 	=> $showtypes,
     	'columns' 		=> $columns,
     	'ratio' 		=> $ratio,
     	'style' 		=> $style,
     	'carousel' 		=> 'false',
     	'tileheight' 	=> $tileheight,
    );

    	echo '<div class="kad-portfolio-wrapper-outer p-outer-'.esc_attr($style).'">';
            echo '<div id="portfolio_template_wrapper" class="'.esc_attr($isoclass).' entry-content portfolio-grid-light-gallery '.esc_attr($margins).'" data-iso-selector=".p_item" data-iso-style="'.esc_attr($isostyle).'" data-iso-filter="'.esc_attr($filter).'" data-gallery-height="'.esc_attr($tileheight).'" data-gallery-lastrow="'.esc_attr($lastrow).'" data-gallery-margins="3">';
				
			if(isset($wp_query)) {
				$temp = $wp_query;
			} else {
				$temp = null;
			}
		  	$wp_query = null; 
		  	$wp_query = new WP_Query();
		  	$wp_query->query(array(
				'orderby' 			=> $orderby,
				'order' 			=> $order,
				'post_type' 		=> 'portfolio',
				'portfolio-type'	=> $type,
				'posts_per_page' 	=> $items
				)
		  	);
			
			if ( $wp_query ) : 
				$kt_portfolio_loop_count['loop'] = 1;
				$kt_portfolio_loop_count['count'] = $wp_query->post_count;
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
							get_template_part('templates/content', 'loop-portfolio'); 
							$kt_portfolio_loop_count['loop']++;
				endwhile; else: ?>
			 
					<div class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'ascend');?></div>
				
				<?php endif; ?>
        	</div> <!--portfoliowrapper-->
        </div> <!--portfoliowrapper-outer-->
        <?php 
        $wp_query = $temp;  // Reset
        wp_reset_query(); 
 	
 	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
