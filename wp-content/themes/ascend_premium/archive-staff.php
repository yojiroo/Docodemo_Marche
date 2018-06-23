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
				global $kt_staff_loop; 

				$kt_staff_loop = array(
	             	'content' 	=> 'excerpt',
	             	'link' 		=> 'false',
	             	'filter' 	=> 'false',
	             	'ratio' 	=> 'sqaure',
	             	'columns' 	=> '3',
	             ); ?>
               	<div id="staff_template_wrapper" class="row entry-content staff-wrapper init-isotope" data-iso-selector=".s_item" data-iso-style="masonry" data-iso-filter="false"> 
            		<?php 	
            		while (have_posts()) : the_post();
						get_template_part( 'templates/content', 'loop-staff' ); 
					endwhile; 
					 ?>
                </div> <!--staff-wrapper-->
                
                                    
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