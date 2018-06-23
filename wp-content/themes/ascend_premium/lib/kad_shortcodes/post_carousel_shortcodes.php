<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
//Shortcode for post_Carousel
function ascend_post_carousel_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'type' 					=> 'post',
		'id' 					=> (rand(10,1000)),
		'orderby' 				=> 'date',
		'order' 				=> 'DESC',
		'width' 				=> null,
		'height' 				=> '400',
		'autoplay' 				=> 'true',
		'offset' 				=> null,
		'speed' 				=> '9000',
		'transtime' 			=> '400',
		'class' 				=> null,
		'cat' 					=> null,
		'featured' 				=> null,
		'items' 				=> '8'
), $atts));
	ob_start();
	ascend_build_post_carousel(null, $height, $class, $type, $cat, $items, $orderby, $order, $offset, $autoplay, $speed, 'true', $transtime, $featured); 		
	
	$output = ob_get_contents();
		ob_end_clean();
	return $output;
}