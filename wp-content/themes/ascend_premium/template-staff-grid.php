<?php
/*
Template Name: Staff Grid
*/
get_header(); 
    /**
    * @hooked ascend_page_title - 20
    */
     do_action('kadence_page_title_container');
    ?>
	
    <div id="content" class="container">
   		<div class="row">
      		<div class="main <?php echo esc_attr(ascend_main_class()); ?>" id="ktmain" role="main">
      		<?php
			/**
            * @hooked ascend_page_content_wrap_before - 10
            * @hooked ascend_page_content - 20
            * @hooked ascend_page_content_wrap_after - 30
            */
            do_action('kadence_page_content');

      		global $post, $ascend; 
      		$staff_group 			= get_post_meta( $post->ID, '_kad_staff_type', true );
      		$staff_content 			= get_post_meta( $post->ID, '_kad_staff_content', true );
      		$staff_link 			= get_post_meta( $post->ID, '_kad_single_staff_link', true );
      		$staff_items 			= get_post_meta( $post->ID, '_kad_staff_items', true );
      		$staff_columns 			= get_post_meta( $post->ID, '_kad_staff_columns', true );
      		$staff_ratio 			= get_post_meta( $post->ID, '_kad_staff_ratio', true );
      		$staff_filter 			= get_post_meta( $post->ID, '_kad_staff_filter', true ); 
      		$staff_orderby 			= get_post_meta( $post->ID, '_kad_staff_orderby', true ); 

      		if(!empty($staff_content)) {
      			$staff_content = $staff_content;
      		} else {
      			$staff_content = 'excerpt';
      		}
      		if(!empty($staff_order)) {
      			$staff_order = $staff_order;
      		} else {
      			$staff_order = 'ASC';
      		}
      		if(!empty($staff_orderby)) {
      			$staff_orderby = $staff_orderby;
      		} else {
      			$staff_orderby = 'menu_order';
      		}
      		if($staff_orderby == 'menu_order' || $staff_orderby == 'title') {
      			$staff_order = 'ASC';
      		} else {
      			$staff_order = 'DESC';
      		}
			if(!empty($staff_link)) {
				$staff_link = $staff_link;
			} else {
				$staff_link = 'false';
			}
			if(!empty($staff_filter)) {
      			$staff_filter = $staff_filter;
      		} else {
      			$staff_filter = 'false';
      		}
			if($staff_group == '-1' || empty($staff_group)) { 
				$staff_group_slug = '';
				$staff_group = '';
			} else {
				$staff_term 		= get_term_by ('id',$staff_group,'staff-group' );
				$staff_group_slug = $staff_term->slug;
			}
			$kt_staff_loop = array(
             	'content' 	=> $staff_content,
             	'link' 		=> $staff_link,
             	'filter' 	=> $staff_filter,
             	'ratio' 	=> $staff_ratio,
             	'columns' 	=> $staff_columns,
             );
	  		if ($staff_filter == 'true') { 
	  			$termtypes  = array( 'child_of' => $staff_group );
	  			ascend_iso_filter('staff-group', $termtypes);
            } ?>
               <div id="staff_template_wrapper" class="row entry-content staff-wrapper init-isotope" data-iso-selector=".s_item" data-iso-style="masonry" data-iso-filter="<?php echo esc_attr($staff_filter);?>"> 
            <?php 	if(isset($wp_query)) {
						$temp = $wp_query;
					} else {
						$temp = null;
					}
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'paged' 		=> $paged,
						'post_type' 	=> 'staff',
						'orderby' 		=> $staff_orderby,
						'order' 		=> $staff_order,
						'staff-group'	=> $staff_group_slug,
						'posts_per_page'=> $staff_items));					
					if ( $wp_query ) : 	 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
						get_template_part('templates/content', 'loop-staff'); 
					endwhile; else: ?>
					 
					<div class="error-not-found"><?php _e('Sorry, no staff entries found.', 'ascend');?></div>
						
				<?php endif; ?>
                </div> <!--staff-wrapper-->
                <?php 
                if ($wp_query->max_num_pages > 1) : 
                	 ascend_wp_pagenav();    
                endif;  
                
                $wp_query = $temp;  // Reset
                wp_reset_query(); 

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
	<?php 

    get_footer(); 
