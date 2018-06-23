<?php 
	while (have_posts()) : the_post(); 
	global $post, $ascend; ?>
		<article <?php post_class(); ?>>
			  	<header>
			  		<?php if(isset($ascend['staff_post_title_inpost']) && $ascend['staff_post_title_inpost'] == 1) { ?>
	      					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } 
					$staff_job_title = get_post_meta( $post->ID, '_kad_staff_job_title', true );
			        if(!empty($staff_job_title)) {
			        	echo '<div class="kt-staff-title">'.$staff_job_title.'</div>'; 
			        } ?>
				</header>
				<div class="entry-content">
      				<?php 
      				do_action('kadence_staff_content_before'); 
      				
      				the_content(); 

      				do_action('kadence_staff_content_after');?>
    			</div>
    			<footer class="single-footer">
      				<?php 
      				/*
			    	*	@hooked ascend_wp_link_pages 10
			    	*	@hooked ascend_staff_links 20
			    	*	@hooked ascend_staff_navigation 30
			    	*/
      				do_action('kadence_staff_footer');
      				?>
			    </footer>
		</article>
	<?php endwhile; 
