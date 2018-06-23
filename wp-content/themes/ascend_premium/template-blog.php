<?php
/*
Template Name: Blog
*/
get_header(); 

global $post, $ascend, $kt_grid_carousel;
	$post_id = $post->ID;
    $kt_grid_carousel = false;
    $blog_type 		= get_post_meta( $post_id, '_kad_blog_type', true );
    $blog_columns 	= get_post_meta( $post_id, '_kad_blog_columns', true );
    $blog_category 	= get_post_meta( $post_id, '_kad_blog_cat', true );
	$blog_order 	= get_post_meta( $post_id, '_kad_blog_order', true );
	$blog_items 	= get_post_meta( $post_id, '_kad_blog_items', true );
	$blog_cat 		= get_term_by ('id',$blog_category,'category');
	if($blog_category == '-1' || $blog_category == '') {
		$blog_cat_slug = '';
	} else {
		$blog_cat = get_term_by ('id',$blog_category,'category');
		$blog_cat_slug = $blog_cat -> slug;
	} 
	if($blog_items == 'all') {
		$blog_items = '-1';
	} 
	if(isset($blog_order)) {
		$b_orderby = $blog_order;
   	} else {
   		$b_orderby = 'date';
   	}
	if($b_orderby == 'menu_order' || $b_orderby == 'title') {
		$b_order = 'ASC';
	} else {
		$b_order = 'DESC';
	}
    $kt_blog_loop['loop'] = 1;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $lay = ascend_get_postlayout($blog_type);

    if(isset($ascend['blog_infinitescroll']) && $ascend['blog_infinitescroll'] == 1) {
        if($lay['sum'] == 'grid' || $lay['sum'] == 'photo' || $lay['sum'] == 'mosaic' ) {
            $infinit_selector = '.kad_blog_item';
            $scrollclass = 'init-infinit';
        } else {
            $infinit_selector = '.post';
            $scrollclass = 'init-infinit-norm';
        }
    } else {
    	$infinit_selector = '.post';
        $infinit = '';
        $scrollclass = '';
    }
    if(isset($blog_columns)) {
        $kt_grid_columns = $blog_columns;
    } else {
        $kt_grid_columns = '3';
    } 
    if(ascend_display_sidebar()) {
        $fullclass = '';
        $ascend_has_sidebar = true;
        if ($kt_grid_columns == '2') {
	        $itemsize = 'col-xxl-4 col-xl-6 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
	    } else if ($kt_grid_columns == '3'){ 
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-6 col-xs-6 col-ss-12'; 
	    } else {
	        $itemsize = 'col-xxl-25 col-xl-3 col-md-3 col-sm-4 col-xs-6 col-ss-12';
	   	}
    } else {
        $fullclass = 'fullwidth';
        $ascend_has_sidebar = false;
        if ($kt_grid_columns == '2') {
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-6 col-sm-6 col-xs-12 col-ss-12'; 
	    } else if ($kt_grid_columns == '3'){ 
	        $itemsize = 'col-xxl-3 col-xl-4 col-md-4 col-sm-6 col-xs-6 col-ss-12'; 
	    } else {
	        $itemsize = 'col-xxl-2 col-xl-25 col-md-3 col-sm-4 col-xs-6 col-ss-12';
	   	}
    }

    /**
    * @hooked ascend_page_title - 20
    */
     do_action('kadence_page_title_container');
    ?>
	
	<div id="content" class="container">
		<div class="row">
  			<div class="main <?php echo esc_attr(ascend_main_class());?> <?php echo esc_attr($lay['pclass']); ?>" id="ktmain" role="main">
	  			<?php 
                /**
                * @hooked ascend_page_content_wrap_before - 10
                * @hooked ascend_page_content - 20
                * @hooked ascend_page_content_wrap_after - 30
                */
                do_action('kadence_page_content');
                ?>
				<div class="kt_archivecontent <?php echo esc_attr($lay['tclass']).' '.esc_attr($scrollclass); ?>" data-nextselector=".wp-pagenavi a.next" data-navselector=".wp-pagenavi" data-itemselector="<?php echo esc_attr($infinit_selector);?>" data-itemloadselector=".kt_item_fade_in" <?php echo $lay['data'] ;?>> 
	  				<?php				
					if(isset($wp_query)) {
						$temp = $wp_query;
					} else {
						$temp = null;
					} 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'paged'		 	 	=> $paged,
						'orderby' 			=> $b_orderby,
						'order' 			=> $b_order,
						'category_name'	 	=> $blog_cat_slug,
						'posts_per_page' 	=> $blog_items
						)
					);
					if ( $wp_query ) : 
						$kt_blog_loop['count'] = $wp_query->post_count;
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
					 	if($lay['sum'] == 'full'){ 
			                if (has_post_format( 'quote' )) {
			                    get_template_part('templates/content', 'post-full-quote'); 
			                } else {
			                    get_template_part('templates/content', 'post-full'); 
			                }
				        } else if($lay['sum'] == 'grid') { 
				        	if($lay['highlight'] == 'true' && $kt_blog_loop['loop'] == 1 && $paged == 1) {
		                        get_template_part('templates/content', get_post_format());
		                    } else { ?>
		                       	<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
		                       		<?php get_template_part('templates/content', 'post-grid'); ?>
		                       	</div>
		                   <?php }
				        } else if($lay['sum'] == 'photo') { ?>
			               	<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
	                       		<?php get_template_part('templates/content', 'post-photo-grid'); ?>
	                       	</div>
				        <?php
				        } else if($lay['sum'] == 'mosaic') { 
				            get_template_part('templates/content', 'post-mosaic-grid'); 
				        } else if($lay['sum'] == 'below_title') {
				        	get_template_part('templates/content', 'post-title-above');
				        } else { 
				        	get_template_part('templates/content', get_post_format());
				        }
				        $kt_blog_loop['loop'] ++;
	                endwhile; else: ?>
						<div class="error-not-found"><?php _e('Sorry, no blog entries found.', 'ascend'); ?></div>
					<?php 
					endif; 
            		?>
            	 </div><!-- /.archive content -->
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