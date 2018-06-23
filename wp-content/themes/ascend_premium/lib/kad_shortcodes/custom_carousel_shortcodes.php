<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for Custom Carousels
function ascend_custom_carousel_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'id'			=>rand(10,1000),
		'columns' 		=> '4',
		'xxlcol' 		=> null,
		'xlcol' 		=> null,
		'mdcol' 		=> null,
		'smcol' 		=> null,
		'xscol' 		=> null,
		'sscol' 		=> null,
		'speed' 		=> '9000',
		'scroll' 		=> '1', 
		'arrows' 		=> 'true',
		'autoplay' 		=> 'true',
		'pagination' 	=> 'false'
), $atts));
$ccc = array();
if ($columns == '2') {
	$ccc = ascend_carousel_columns('2');
} else if ($columns == '3'){
	$ccc = ascend_carousel_columns('3');
} else if ($columns == '1'){
	$ccc = ascend_carousel_columns('1');
} else if ($columns == '6'){
	$ccc = ascend_carousel_columns('6');
} else if ($columns == '5'){ 
	$ccc = ascend_carousel_columns('5');
} else {
	$ccc = ascend_carousel_columns('4');
} 
if($scroll != '1'){
	$scroll = 'all';
}
$ccc = apply_filters('ascend_custom_carousel_columns', $ccc);
if( !empty($xxlcol) ) {
	$ccc['xxl'] = $xxlcol;
}
if( !empty($xlcol) ) {
	$ccc['xl'] = $xlcol;
}
if( !empty($mdcol) ) {
	$ccc['md'] = $mdcol;
}
if( !empty($smcol) ) {
	$ccc['sm'] = $smcol;
}
if( !empty($xscol) ) {
	$ccc['xs'] = $xscol;
}
if( !empty($sscol) ) {
	$ccc['ss'] = $sscol;
}
ob_start(); ?>
			<div class="carousel_outerrim">
				<div class="custom-carouselcontainer row-margin-small">
					<div id="custom-carousel-<?php echo esc_attr($id);?>" class="slick-slider custom_carousel_shortcode kt-slickslider kt-content-carousel loading clearfix" data-slider-fade="false" data-slider-type="content-carousel" data-slider-anim-speed="400" data-slider-scroll="<?php echo esc_attr($scroll);?>" data-slider-arrows="<?php echo esc_attr($arrows);?>" data-slider-dots="<?php echo esc_attr($pagination);?>" data-slider-auto="<?php echo esc_attr($autoplay);?>" data-slider-speed="<?php echo esc_attr($speed);?>" data-slider-xxl="<?php echo esc_attr($ccc['xxl']);?>" data-slider-xl="<?php echo esc_attr($ccc['xl']);?>" data-slider-md="<?php echo esc_attr($ccc['md']);?>" data-slider-sm="<?php echo esc_attr($ccc['sm']);?>" data-slider-xs="<?php echo esc_attr($ccc['xs']);?>" data-slider-ss="<?php echo esc_attr($ccc['ss']);?>">
								<?php echo do_shortcode($content); ?>
            		</div>
				</div>
			</div>		
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}

//Shortcode for Custom Carousel Items
function ascend_custom_carousel_item_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'columns' => '',
), $atts));
	if(empty($columns)) {$columns = '4';}

ob_start(); 
		if ($columns == '2') {
			$itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
		} else if ($columns == '3'){ 
			$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
		} else if ($columns == '1') {
			$itemsize = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 col-ss-12';
		} else if ($columns == '6'){
			$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
		} else if ($columns == '5'){ 
			$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
		} else {
			$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
		} 
	 ?>
							<div class="<?php echo esc_attr($itemsize); ?> kad_customcarousel_item">
								<div class="carousel_item grid_item">
								<?php echo do_shortcode($content); ?>
								</div>
							</div>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}