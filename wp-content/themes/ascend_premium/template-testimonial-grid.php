<?php
/*
Template Name: Testimonial Grid
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

				global $post, $kt_testimonial_loop; 
	      		$testimonial_category 		= get_post_meta( $post->ID, '_kad_testimonial_type', true ); 
				$testimonial_items 			= get_post_meta( $post->ID, '_kad_testimonial_items', true );
				$testimonial_content		= get_post_meta( $post->ID, '_kad_testimonial_content', true );
				$single_testimonial_link 	= get_post_meta( $post->ID, '_kad_single_testimonial_link', true );
				$testimonial_link_text 		= get_post_meta( $post->ID, '_kad_testimonial_link_text', true );
				$testimonial_columns 		= get_post_meta( $post->ID, '_kad_testimonial_columns', true );
				$testimonial_orderby		= get_post_meta( $post->ID, '_kad_testimonial_orderby', true );
			   	if($testimonial_category == '-1' || empty($testimonial_category)) {
			   		$testimonial_cat_slug 	= '';
			   	} else {
					$testimonial_cat 		= get_term_by ('id',$testimonial_category,'testimonial-group' );
					$testimonial_cat_slug 	= $testimonial_cat -> slug;
				}
				if($testimonial_items == 'all') {
					$testimonial_items = '-1';
				}
				if(isset($testimonial_content) && $testimonial_content == 'excerpt') {
					$testimonial_content = 'excerpt';
				} else {
					$testimonial_content = 'content';
				}
				if(isset($single_testimonial_link) && $single_testimonial_link == 'true') {
					$link = 'true';
				} else {
					$link = 'false';
				}
				if(!empty($testimonial_orderby)) {
					$torderby = $testimonial_orderby;
				} else {
					$torderby = 'menu_order';
				}
				if(!empty($testimonial_columns)) {
					$testimonial_columns = $testimonial_columns;
				} else {
					$testimonial_columns = '3';
				}
				if($torderby == 'menu_order' || $torderby == 'title') {
					$torder = 'ASC';
				} else {
					$torder = 'DESC';
				}
				$kt_testimonial_loop = array(
					'columns' 	=> $testimonial_columns,
					'content' 	=> $testimonial_content,
					'link' 		=> $link,
				);
                ?>
                <div id="testimonial_template_wrapper" class="row entry-content testimonial-wrapper init-isotope" data-iso-selector=".t_item" data-iso-style="masonry" data-iso-filter="false"> 
				<?php 
					if(isset($wp_query)) {
						$temp = $wp_query;
					} else {
						$temp = null;
					}
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'paged' 			=> $paged,
						'post_type' 		=> 'testimonial',
						'orderby' 			=> $torderby,
						'order' 			=> $torder,
						'testimonial-group' => $testimonial_cat_slug,
						'posts_per_page' 	=> $testimonial_items
						)
					);
					if ( $wp_query ) : 
						while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
							get_template_part('templates/content', 'loop-testimonial'); 
						endwhile; else: ?>
						<div class="error-not-found"><?php _e('Sorry, no testimonial entries found.', 'ascend');?></div>
					<?php endif; ?>
				</div> <!-- testimonial-wrapper -->

				<?php 
				if ($wp_query->max_num_pages > 1) :
	                ascend_wp_pagenav(); 
	            endif; 
	            $wp_query = $temp; 
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
