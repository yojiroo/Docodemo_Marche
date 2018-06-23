<?php 
do_action('kadence_testimonial_content_before'); 
	while (have_posts()) : the_post(); 
	global $post, $ascend; ?>
		    <article <?php post_class(); ?>>
		    	<div class="clearfix">
			    	<div class="testimonial-img thumbnail alignleft clearfix">
			    		<?php if (has_post_thumbnail( $post->ID ) ) {
			    			the_post_thumbnail( 'thumbnail' ); 
			    		} ?>
					</div>
			  	<header>
	      			<?php if(isset($ascend['testimonial_post_title_inpost']) && $ascend['testimonial_post_title_inpost'] == 1) { ?>
	      					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>
	      			<div class="subhead">
	      			<?php 	$occupation = get_post_meta( $post->ID, '_kad_testimonial_occupation', true ); 
	      					$clientlink = get_post_meta( $post->ID, '_kad_testimonial_link', true ); 
	      					$location = get_post_meta( $post->ID, '_kad_testimonial_location', true ); 
	      					if(!empty($location)) { 
	      						echo $location;
	      					}
	      					if(!empty($occupation) && !empty($location) && !empty($clientlink)) { 
	      						echo ' | '. $occupation . ' | '; 
	      					} elseif(!empty($occupation) && empty($location) && !empty($clientlink)) { 
	      						echo $occupation . ' | '; 
	      					} elseif(!empty($occupation) && !empty($location) && empty($clientlink)) { 
	      						echo ' | '.$occupation; 
	      					} elseif(!empty($occupation) && empty($location) && empty($clientlink)) { 
	      						echo $occupation; 
	      					} elseif(empty($occupation) && !empty($location) && !empty($clientlink)) { 
	      						echo ' | ';  
	      					}
	      					if(!empty($clientlink)) { 
	      						echo '<a href="'.$clientlink.'" target="_blank">'.$clientlink.'</a>';
	      					} 
	      				?>
	      			</div>
				</header>
				<div class="entry-content">
					<?php
		  				do_action( 'kadence_single_testimonial_content_before' );
		  				
		  				the_content(); 

		  				/*
				    	*	@hooked ascend_wp_link_pages 10
				    	*/
		  				do_action( 'kadence_single_testimonial_content_after' );?>
    			</div>
    			</div>
    			<footer class="single-footer">
      				<?php 
      					
      					if(isset($ascend['testimonial_single_nav']) && $ascend['testimonial_single_nav'] == 1) {
							echo '<div class="post-footer-section">';
								echo '<div class="kad-post-navigation testimonial-nav clearfix">';
									$prev_post = get_adjacent_post(false, null, true);
									if ( !empty( $prev_post ) ) : 
							        	echo '<div class="alignleft kad-previous-link">';
							        		echo '<a href="'.get_permalink( $prev_post->ID ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Previous Testimonial', 'ascend').'</span><span class="kt_postlink_title">'. $prev_post->post_title.'</span></a>';
							        	echo '</div>';
							        endif; 
							   		$next_post = get_adjacent_post(false, null, false);
							   		if ( !empty( $next_post ) ) :
							   			echo '<div class="alignright kad-next-link">';
							        		echo '<a href="'.get_permalink( $next_post->ID ).'"><span class="kt_postlink_meta kt_color_gray">'.__('Next Testimonial', 'ascend').'</span><span class="kt_postlink_title">'. $next_post->post_title.'</span></a>';
							        	echo '</div>';
							        endif; 
	 							echo '</div> <!-- end navigation -->';
 							echo '</div>';
		   				} ?>
			    </footer>

			</article>
		<?php endwhile; 
		do_action('kadence_testimonial_content_after');
