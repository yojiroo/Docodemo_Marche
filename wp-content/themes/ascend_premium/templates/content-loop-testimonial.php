<?php 
global $post, $kt_testimonial_loop, $ascend;

	if ($kt_testimonial_loop['columns'] == '2') {
	 	$itemsize 	= 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
	} else if ($kt_testimonial_loop['columns'] == '1'){
		$itemsize = 'col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-ss-12';
	} else if ($kt_testimonial_loop['columns'] == '3'){
		$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
	} else if ($kt_testimonial_loop['columns'] == '6'){
		$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
	} else if ($kt_testimonial_loop['columns'] == '5'){
		$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
	} else {
		$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
	}
	$image_width = apply_filters('kt_testimonial_grid_image_width', 60);
    $image_height = apply_filters('kt_testimonial_grid_image_height', 60);
?>
	<div class="<?php echo esc_attr($itemsize);?> t_item">
	    <div class="grid_item testimonial_item kt_item_fade_in postclass">
	        <div class="testimonial-box clearfix">
	        	<div class="testimonial-img">
					<?php if (has_post_thumbnail( $post->ID ) ) {
							$img = ascend_get_image($image_width, $image_height, true, null, null, null, true);
					        if( ascend_lazy_load_filter() ) {
					            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
					        } else {
					            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
					        }
							echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'">';
						} else { ?>
	                    	<i class="kt-icon-quotes-left"></i>
		            <?php }?>
	            </div> 
	            <?php 
		            if($kt_testimonial_loop['content'] == 'excerpt') {
		            	the_excerpt();
		            } else {
		                the_content(); 
		                 if($kt_testimonial_loop['link'] == 'true') {
		                 	echo '<p><a href="'.get_the_permalink().'" class="kadtestimoniallink">';
			                   	if(!empty($ascend['$testimonial_link_text'])) {
									echo $ascend['$testimonial_link_text'];
								} else {
									echo  __('Read More', 'ascend');
								}
	                    	echo '</a></p>';
	                    }
	                 } ?>
			</div>
			<div class="testimonial-bottom">
				<div class="lipbg kad-arrow-down"></div>
				<p>
					<strong><?php the_title();?></strong>
				    <?php $location = get_post_meta( $post->ID, '_kad_testimonial_location', true ); 
					    if(!empty($location)) { 
					    	echo ' - ' . esc_html($location);
					    }
					?>
		      	</p>
			</div>
		</div>
	</div>

