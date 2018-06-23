<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_action( 'kadence_testimonial_header', 'ascend_single_testimonial_header', 20 );
function ascend_single_testimonial_header() {
	if(ascend_display_pagetitle()) {
		get_template_part('templates/post', 'header');
	} else {
		if( ascend_display_testimonial_breadcrumbs()) { 
			echo '<div class="kt_bc_nomargin">';
			ascend_breadcrumbs(); 
			echo '</div>';
		}
	}
}

