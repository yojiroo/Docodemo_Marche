<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	global $ascend; 

?>
<div class="sliderclass shop-sliderclass shop-ksp">
<?php  
	echo do_shortcode( '[kadence_slider_pro id="'.$ascend['shop_ksp_slider'].'"]' ); ?>
</div><!--sliderclass-->