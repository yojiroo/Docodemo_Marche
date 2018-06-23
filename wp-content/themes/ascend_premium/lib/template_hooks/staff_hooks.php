<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'kadence_staff_header', 'ascend_single_staff_header', 20 );
function ascend_single_staff_header() {
	if(ascend_display_pagetitle()) {
		get_template_part('templates/post', 'header');
	} else {
		if( ascend_display_staff_breadcrumbs()) { 
			echo '<div class="kt_bc_nomargin">';
			ascend_breadcrumbs(); 
			echo '</div>';
		}
	}
}

add_action( 'kadance_staff_footer', 'ascend_wp_link_pages', 10 );

function ascend_staff_nav() { 
	global $post, $ascend; 
	if(isset($ascend['staff_single_nav']) && $ascend['staff_single_nav'] == 1) {
		echo '<div class="post-footer-section">';
			echo '<div class="kad-post-navigation staff-nav clearfix">';
				$prev_post = get_adjacent_post(false, null, true);
				if ( !empty( $prev_post ) ) : 
		        	echo '<div class="alignleft kad-previous-link">';
		        		echo '<a href="'.get_permalink( $prev_post->ID ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Previous staff', 'ascend').'</span><span class="kt_postlink_title">'. $prev_post->post_title.'</span></a>';
		        	echo '</div>';
		        endif; 
		   		$next_post = get_adjacent_post(false, null, false);
		   		if ( !empty( $next_post ) ) :
		   			echo '<div class="alignright kad-next-link">';
		        		echo '<a href="'.get_permalink( $next_post->ID ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Next staff', 'ascend').'</span><span class="kt_postlink_title">'. $next_post->post_title.'</span></a>';
		        	echo '</div>';
		        endif; 
			echo '</div> <!-- end navigation -->';
		echo '</div>';
	}
}
add_action( 'kadence_staff_footer', 'ascend_staff_nav', 30 );

function ascend_staff_meta_links() { 
	get_template_part('templates/content', 'loop-staff-meta'); 
}
add_action( 'kadence_staff_loop_footer', 'ascend_staff_meta_links', 20 );
add_action( 'kadence_staff_footer', 'ascend_staff_meta_links', 20 );

