<?php  
/**
* Single Testimonial
*/
	/**
    * Header
    */
	get_header(); 

		/**
	    * @hooked ascend_single_post_header - 20
	    */
	    do_action('kadence_testimonial_header'); ?>

		<div id="content" class="container clearfix">
    		<div class="row single-testimonial">
    			<div class="main <?php echo ascend_main_class(); ?>" id="ktmain" role="main">
			    	<?php 
					get_template_part('templates/content', 'single-testimonial');
					?>
				</div><!-- /.main-->

				<?php
				/**
			    * Sidebar
			    */
				if (ascend_display_sidebar()) : 
				      	get_sidebar();
			    endif; ?>
    		</div><!-- /.row-->
    	</div><!-- /#content -->
    	<?php 
    /**
    * Footer
    */
	get_footer(); 