<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

	if ( version_compare( WC_VERSION, '3.3', '>' ) ) {
		global $ascend;
		$product_columns =  wc_get_loop_prop( 'columns' );

	} else {
		global $woocommerce_loop, $ascend;
		if ( empty( $woocommerce_loop['columns'] ) ) {
		 	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
		}
		$product_columns = $woocommerce_loop['columns'];
	}
	if(isset($ascend['product_fitrows']) && $ascend['product_fitrows'] == 1) {
		$style = 'fitRows';
	} else {
		$style = 'masonry';
	}
  	if(ascend_display_sidebar()) {
        $columns = "shopcolumn".$product_columns." shopsidebarwidth"; 
  	} else {
		$columns = "shopcolumn".$product_columns." shopfullwidth"; 
  	}
  	if(is_cart()) {
      	$columns = "shopcolumn-cart".$product_columns." shopfullwidth";
    }
	if(isset($ascend['product_img_resize']) && $ascend['product_img_resize'] == 0) { 
		$isoclass = 'init-isotope';
	} else { 
		$isoclass = 'init-isotope-intrinsic';
	}
	if(isset($ascend['infinitescroll']) && $ascend['infinitescroll'] == 1) {
		$scrollclass = 'init-infinit';
	} else {
		$scrollclass = '';
	}
	if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' && isset($ascend['shop_rating']) && $ascend['shop_rating'] != '0') {
 		$ratingclass = 'kt-show-rating';
 	} else {
 		$ratingclass = 'kt-hide-rating';
 	}
?>
<ul class="products kad_product_wrapper rowtight <?php echo esc_attr($columns); ?> <?php echo esc_attr($isoclass); ?> <?php echo esc_attr($ratingclass); ?> <?php echo esc_attr($scrollclass); ?> reinit-isotope" data-nextselector=".woocommerce-pagination a.next" data-navselector=".woocommerce-pagination" data-itemselector=".kad_product" data-itemloadselector=".kt_item_fade_in" data-iso-selector=".kad_product" data-iso-style="<?php echo esc_attr($style);?>" data-iso-filter="true">