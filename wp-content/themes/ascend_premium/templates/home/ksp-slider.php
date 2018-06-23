<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	global $ascend;

if(isset( $ascend[ 'home_ksp_slider' ] ) && !empty( $ascend[ 'home_ksp_slider' ] ) ) {
?>
	<div class="sliderclass kt_desktop_slider clearfix home-sliderclass">
		<?php echo do_shortcode( '[kadence_slider_pro id="'. esc_attr( $ascend[ 'home_ksp_slider' ] ) .'"]' ); ?>
	</div><!--sliderclass-->
<?php 
}