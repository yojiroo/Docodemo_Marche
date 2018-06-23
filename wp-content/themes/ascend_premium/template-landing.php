<?php
/*
Template Name: Landing - no header
*/

	/* Load Scripts meta */
  	get_template_part('templates/head');
  	?>
	<body <?php body_class(); ?>>
	    <div id="content" class="container page-content-no-padding">
	   		<div class="row">
		      	<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
	                <?php 
	                /**
	                * @hooked ascend_page_content_wrap_before - 10
	                * @hooked ascend_page_content - 20
	                * @hooked ascend_page_content_wrap_after - 30
	                */
	                do_action('kadence_page_content');
	                ?>
					<?php 
	                /**
	                * @hooked ascend_page_comments - 20
	                */
	                do_action('kadence_page_footer');
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
	<?php wp_footer(); ?>
    </body>
</html>
