<?php 
global $post, $kt_staff_loop, $ascend;

	if ($kt_staff_loop['columns'] == '2') {
	 	$itemsize 	= 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12';
	 	$image_width = 600;
	} else if ($kt_staff_loop['columns'] == '1'){
		$itemsize = 'col-xxl-12 col-xl-12 col-md-12 col-sm-12 col-xs-12 col-ss-12';
		$image_width = 600;
	} else if ($kt_staff_loop['columns'] == '3'){
		$itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
		$image_width = 600;
	} else if ($kt_staff_loop['columns'] == '6'){
		$itemsize = 'col-xxl-15 col-xl-2 col-md-2 col-sm-3 col-xs-4 col-ss-6';
		$image_width = 300;
	} else if ($kt_staff_loop['columns'] == '5'){
		$itemsize = 'col-xxl-2 col-xl-2 col-md-25 col-sm-3 col-xs-4 col-ss-6';
		$image_width = 300;
	} else {
		$itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
		$image_width = 300;
	}
    $crop = true;
    if(isset($kt_staff_loop['ratio']) && !empty($kt_staff_loop['ratio'])) {
    	$staff_ratio = $kt_staff_loop['ratio'];
    } else {
		$staff_ratio = 'square';
    }
    if($staff_ratio == 'portrait') {
		$temppimgheight = $image_width * 1.35;
		$image_height = floor($temppimgheight);
	} else if($staff_ratio == 'landscape') {
		$temppimgheight = $image_width / 1.35;
		$image_height = floor($temppimgheight);
	} else if($staff_ratio == 'widelandscape') {
		$temppimgheight = $image_width / 2;
		$image_height = floor($temppimgheight);
	} else if($staff_ratio == 'softcrop') {
        $image_height = null;
        $crop = false; 
    } else {
		$image_height = $image_width;
	}
	$image_width = apply_filters('kt_staff_grid_image_width', $image_width);
    $image_height = apply_filters('kt_staff_grid_image_height', $image_height);
    $terms = get_the_terms( $post->ID, 'staff-group' );
	if ( $terms && ! is_wp_error( $terms ) ) : 
		$links = array();
		foreach ( $terms as $term ) { 
			$links[] = $term->slug;
		}
		$tax = join( " ", $links );		
	else :	
		$tax = '';	
	endif;
?>	
	<div class="<?php echo esc_attr($itemsize);?> <?php echo esc_attr($tax); ?> s_item">
        <div class="grid_item staff_item kt_item_fade_in postclass">
			<?php if (has_post_thumbnail( $post->ID ) ) { 
				echo '<div class="staff-image-container">';
					if($kt_staff_loop['link'] == "true") {
						echo '<a href="'.get_the_permalink().'" class="staff-loop-image-link">';
					}
					$img = ascend_get_image($image_width, $image_height, $crop, null, null, null, true);
					echo '<div class="img-hoverclass kt-intrinsic staff-loop-image" style="padding-bottom:'.(($img['height']/$img['width']) * 100).'%;">';
						if( ascend_lazy_load_filter() ) {
				            $image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="'.esc_url($img['src']).'" '; 
				        } else {
				            $image_src_output = 'src="'.esc_url($img['src']).'"'; 
				        }
						echo '<img '.$image_src_output.' width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" '.$img['srcset'].' class="'.esc_attr($img['class']).'" alt="'.esc_attr($img['alt']).'">';
					echo '</div>';
					if($kt_staff_loop['link'] == "true") {
						echo '</a>';
					}
				echo '</div>';
			} ?>
			<header class="kt-staff-header">
		        <?php if($kt_staff_loop['link'] == 'true') {?>
		        	<a href="<?php the_permalink(); ?>"> 
		        <?php }?>
	        	<h3><?php the_title();?></h3>
		        <?php if($kt_staff_loop['link'] == 'true') {?>
		        	</a>
		        <?php } 
				$title = get_post_meta( $post->ID, '_kad_staff_job_title', true );
				if(!empty($title)) {
					echo '<div class="kt-staff-title">'.esc_html($title).'</div>';
				} ?>
		    </header>
			<div class="entry-content staff-entry-content">
				<?php if($kt_staff_loop['content'] == 'excerpt') {
					the_excerpt();
				} else {
					the_content(); 
				} ?>
			</div>
			<footer class="clearfix staff-footer">
		    	<?php 
		    	/*
		    	*	@hooked ascend_staff_links 20
		    	*/
		    	do_action('kadence_staff_loop_footer');?>
			</footer>
		</div>
	</div>

