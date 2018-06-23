<?php
/**
* Search Template
*/
	/**
    * Header
    */
	get_header(); 

    /**
    * @hooked ascend_page_title - 20
    */
    do_action('kadence_page_title_container');

    global $ascend, $ascend_has_sidebar; 
    if(ascend_display_sidebar()) {
    	$ascend_has_sidebar = true;
        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12';
    } else {
    	$ascend_has_sidebar = false;
        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-4 col-xs-6 col-ss-12'; 
    }
    if(isset($ascend['search_layout_style'])) {
    	$layout = $ascend['search_layout_style'];
    } else {
    	$layout = 'grid';
    }
    if($layout == "singlecolumn") {
    	$isoclass = "";
	} else {
		$isoclass = "rowtight init-isotope-intrinsic";
	}?>
    <div id="content" class="container">
      	<div class="row">
      		<div class="main <?php echo ascend_main_class(); ?> " id="ktmain" role="main">

				<?php if (!have_posts()) : ?>
				  	<div class="alert">
				    	<?php _e('Sorry, no results were found.', 'ascend'); ?>
				  	</div>
				  	<?php get_search_form(); ?>
				<?php endif;
				?>
				<div class="clearfix search-archive <?php echo esc_attr($isoclass);?>"  data-iso-selector=".s_item" data-iso-style="masonry">
					<?php while (have_posts()) : the_post(); 
					 	if($layout == "singlecolumn") {
					 		 get_template_part('templates/content', get_post_format());
						} else {
					  		echo '<div class="'.esc_attr($itemsize).' s_item">';
					       	 	get_template_part('templates/content', 'loop-searchresults');
							echo '</div> <!-- Search Item -->';
						}
						endwhile; ?>
				</div> <!-- Blog Grid -->
				
				<?php 
					if ($wp_query->max_num_pages > 1) : 
				        ascend_wp_pagenav(); 
					 endif; ?>
				</div><!-- /.main -->
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
	get_footer(); ?>