<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for portfolio Posts
function ascend_portfolio_type_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'orderby' 			=> 'menu_order',
		'order' 			=> 'ASC',
		'columns'			=> '4',
		'id' 				=> rand(10,1000),
		'childof' 			=> '0',
		'ratio'				=> 'square',
		'style'				=> 'default',
		'childcategories' 	=> 'false',
		'showexcerpt'		=> 'false',
		'items' 			=> '4'
), $atts));
	global $ascend;
	if($childcategories == 'true') {
		$parent = "";
	} else {
		$parent = "0";
	}
	if(!empty($order) ) {
		$order = $order;
	} else if($orderby == 'menu_order' || $orderby == "title") {
		$order = 'ASC';
	} else {
		$order = 'DESC';
	} 
	if($style == 'default') {
   		if(isset($ascend['portfolio_tax_style'])) {
   			$style = $ascend['portfolio_tax_style'];
   		} else {
   			$style = 'pgrid';
   		}
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
    	$tileheight = apply_filters('kadence_portfolio_tiles_height', '220' );
    	$lastrow 	= apply_filters('kadence_portfolio_tiles_last_row', 'nojustify' );
    } else {
    	$isoclass 	= 'init-isotope-intrinsic reinit-isotope'; 
    	$margins 	= 'rowtight';
    }
    $class = 'p_item';
    $crop = true;
    if ($columns == '2') {
	 	$itemsize 	= 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
	 	$image_width = 860;
	} else if ($columns == '1'){
		$itemsize = 'col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-ss-12';
		$image_width = 860;
	} else if ($columns == '3'){
		$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
		$image_width = 600;
	} else if ($columns == '6'){
		$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
		$image_width = 240;
	} else if ($columns == '5'){
		$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
		$image_width = 240;
	} else {
		$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
		$image_width = 300;
	}
    if($ratio == 'portrait') {
		$temppimgheight = $image_width * 1.35;
		$image_height = floor($temppimgheight);
	} else if($ratio == 'landscape') {
		$temppimgheight = $image_width / 1.35;
		$image_height = floor($temppimgheight);
	} else if($ratio == 'widelandscape') {
		$temppimgheight = $image_width / 2;
		$image_height = floor($temppimgheight);
	} else if($ratio == 'softcrop') {
        $image_height = null;
        $crop = false; 
    } else {
		$image_height = $image_width;
	}
	$image_width = apply_filters('kt_portfolio_grid_image_width', $image_width);
    $image_height = apply_filters('kt_portfolio_grid_image_height', $image_height);
    ob_start();
    echo '<div class="kad-portfolio-wrapper-outer p-outer-'.esc_attr($style).'">';
            echo '<div id="portfolio_template_wrapper" class="'.esc_attr($isoclass).' entry-content portfolio-grid-light-gallery '.esc_attr($margins).'" data-iso-selector=".p_item" data-iso-style="'.esc_attr($isostyle).'" data-iso-filter="false" data-gallery-height="'.esc_attr($tileheight).'" data-gallery-lastrow="'.esc_attr($lastrow).'" data-gallery-margins="3">';

			    $meta = get_option('portfolio_cat_image');
			    if (empty($meta)) {
			    	$meta = array();
			    }
				if (!is_array($meta)) {
					$meta = (array) $meta;
				}
				$args = array( 'parent'=>$parent,'hide_empty'=>'1', 'child_of' => $childof, 'orderby' => $orderby, 'order'=>$order);
				$terms = get_terms("portfolio-type", $args);
				if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
					$loop = 1;
					$count = count($terms);
					foreach ( $terms as $term ) :
						if($style == 'mosaic'){
							$imosaic = ascend_mosaic_sizes($count,$loop );
							$image_width = apply_filters('kt_portfolio_mosaic_image_width', $imosaic['width'], $loop );
							$image_height = apply_filters('kt_portfolio_mosaic_image_height', $imosaic['height'], $loop );
							$itemsize = apply_filters('kt_portfolio_mosaic_size', $imosaic['itemsize'], $loop );
						} else if($style == 'tiles'){
							$image_width = null;
							$image_height = $tileheight + 120;
							$itemsize = 'tiles_item';
						} 
						$cat_term_id = $term->term_id;
						?>
						<div class="<?php echo esc_attr($itemsize);?> <?php echo esc_attr($class);?>">
							<div class="portfolio_item grid_item kt_item_fade_in" data-post-title="<?php echo esc_attr($term->name);?>">
								<div class="portfolio-loop-image-container">
					            <?php
					            	if(isset($meta[$cat_term_id])) {
					            		$item_meta = $meta[$cat_term_id];
					            	} else {
					            		$item_meta = array();
					            	}
									if(isset($item_meta['category_image'])) {
										 $image_id = $item_meta['category_image'][0];
									} else {
										$image_id = '';
									}
					 				$img = ascend_get_image($image_width, $image_height, $crop, null, null, $image_id, true);
									echo '<div class="img-hoverclass kt-intrinsic portfolio-loop-image" style="padding-bottom:'.(($img['height']/$img['width']) * 100).'%;">';
										echo '<div class="portfolio-img-hover-inner">';
										if( ascend_lazy_load_filter() ) {
								            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
								        } else {
								            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
								        }
										echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'">';
										echo '</div>';
									echo '</div>';
								echo '<div class="portfolio-hover-item">';
								echo '<div class="portfolio-overlay-color"></div>';
								echo '<div class="portfolio-overlay-border"></div>';
								echo '<a href="'.esc_attr(get_term_link( $term )).'" class="portfolio-hover-item-link"></a>';
								echo '<div class="portfolio-hover-item-inner">';
									if($style != "poststyle") { ?>
										<a href="<?php echo esc_attr(get_term_link( $term )); ?>" class="portfolio-inner-link">
						                    <h5 class="portfolio-loop-title"><?php echo $term->name;?></h5>
						                </a>
											<?php if($showexcerpt == 'true') {?> 
						                        <div class="portfolio-loop-excerpt">
						                            <?php echo $term->description; ?>
						                        </div>
						                    <?php } ?>
					                <?php } ?>
					                </div>
					                </div>
								</div> 
								<?php 
					            if($style == "poststyle" ) { ?>
					            	<div class="portfolio-poststyle-content postclass">
					              		<a href="<?php echo esc_attr(get_term_link( $term )); ?>" class="portfolio-poststyle-link">  
					                        <h5 class="portfolio-loop-title"><?php echo $term->name;?></h5>
					                    </a>
					                    <?php 
					                       	if($showexcerpt == 'true') { ?> 
					                       		<div class="portfolio-loop-excerpt">
					                       			<?php echo $term->description; ?>
					                       		</div> 
					                       	<?php } ?>
					                </div>
					            <?php } ?>
					        </div>
					    </div>
					    <?php 
						$loop ++;
					endforeach; 
				}
			echo '</div>';
		echo '</div>';
	$output = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();

	return $output;
} ?>