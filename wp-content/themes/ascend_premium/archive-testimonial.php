<?php 
  	get_header(); 
    /**
    * @hooked ascend_archive_title - 20
    */
     do_action('kadence_archive_title_container');
    ?>
	
    <div id="content" class="container clearfix">
   		<div class="row">
      		<div class="main <?php echo ascend_main_class(); ?>" role="main">
      			<div class="entry-content">
      				<?php echo category_description(); ?>
      			</div>
				<?php if (!have_posts()) : ?>
		            <div class="error-not-found entry-content">
		                <h5><?php _e('Sorry, no results were found.', 'ascend'); ?></h5>
		                <?php get_search_form(); ?>
		            </div>
				<?php endif;  
				global $kt_testimonial_loop; 

				$kt_testimonial_loop = array(
                	'columns' 	=> '3',
                 	'content' 	=> 'content',
                 	'link' 		=> 'false',
                 	);
                ?>
                <div id="testimonial_template_wrapper" class="row entry-content testimonial-wrapper init-isotope" data-iso-selector=".t_item" data-iso-style="masonry" data-iso-filter="false"> 
					<?php 
						while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
							get_template_part('templates/content', 'loop-testimonial'); 
						endwhile; 
					?>
				</div> <!-- testimonial-wrapper -->
                <?php if ($wp_query->max_num_pages > 1) :
                        ascend_wp_pagenav(); 
                endif;
				?>
			</div><!-- /.main -->
			<?php
			/**
		    * Sidebar
		    */
			if (ascend_display_sidebar()) : 
			      	get_sidebar();
		    endif; ?>
		</div><!-- /.row-->
	</div><!-- /.content -->
	<?php 
/**
* Footer
*/
get_footer(); ?>