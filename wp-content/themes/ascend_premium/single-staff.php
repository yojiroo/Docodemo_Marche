<?php
/**
* Single Staff
*/
	/**
    * Header
    */
	get_header(); 
		
		/**
	    * @hooked asencd_single_staff_header - 20
	    */
	    do_action('kadence_staff_header'); ?>

		<div id="content" class="container clearfix">
    		<div class="row single-staff">
    			<div class="main <?php echo ascend_main_class(); ?>" id="ktmain" role="main">
			    	<?php 
					get_template_part('templates/content', 'single-staff');
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