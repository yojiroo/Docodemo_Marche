<?php
/*
Template Name: Portfolio Grid
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

      		global $post, $ascend, $kt_portfolio_loop, $kt_portfolio_loop_count; 
  			$portfolio_type 		= get_post_meta( $post->ID, '_kad_portfolio_type', true );
		   	$portfolio_items 		= get_post_meta( $post->ID, '_kad_portfolio_items', true );
		   	$portfolio_order 		= get_post_meta( $post->ID, '_kad_portfolio_orderby', true );
		   	$portfolio_filter 		= get_post_meta( $post->ID, '_kad_portfolio_filter', true );
		   	$portfolio_column 		= get_post_meta( $post->ID, '_kad_portfolio_columns', true );
		   	$portfolio_excerpt 		= get_post_meta( $post->ID, '_kad_portfolio_excerpt', true );
		   	$portfolio_item_types 	= get_post_meta( $post->ID, '_kad_portfolio_types', true );
		   	$portfolio_ratio 		= get_post_meta( $post->ID, '_kad_portfolio_ratio', true );
		   	$portfolio_style 		= get_post_meta( $post->ID, '_kad_portfolio_style', true );
		   	$portfolio_lightbox 	= get_post_meta( $post->ID, '_kad_portfolio_lightbox', true );

		   	if(!empty($portfolio_order)) {
		   		$p_orderby = $portfolio_order;
		   	} else {
		   		$p_orderby = 'menu_order';
		   	}
		   	if($p_orderby == 'menu_order' || $p_orderby == 'title') {
		   		$p_order = 'ASC';
		   	} else {
		   		$p_order = 'DESC';
		   	}
		   	if(!empty($portfolio_lightbox)) {
      			$portfolio_lightbox = $portfolio_lightbox;
      		} else {
      			$portfolio_lightbox = 'true';
      		}
      		if(!empty($portfolio_ratio)) {
      			$portfolio_ratio = $portfolio_ratio;
      		} else {
      			$portfolio_ratio = 'square';
      		}
      		if(!empty($portfolio_item_types)) {
      			$portfolio_item_types = $portfolio_item_types;
      		} else {
      			$portfolio_item_types = 'true';
      		}
      		if(!empty($portfolio_excerpt)) {
      			$portfolio_excerpt = $portfolio_excerpt;
      		} else {
      			$portfolio_excerpt = 'false';
      		}
      		if(!empty($portfolio_column)) {
      			$portfolio_column = $portfolio_column;
      		} else {
      			$portfolio_column = '3';
      		}
			if($portfolio_type == '-1' || empty($portfolio_type)) {
				$portfolio_type_slug = '';
				$portfolio_type = '';
			} else {
				$portfolio_cat = get_term_by ('id',$portfolio_type,'portfolio-type' );
				$portfolio_type_slug = $portfolio_cat -> slug;
			}
			if($portfolio_items == 'all') { 
				$portfolio_items = '-1'; 
			}
			if(!empty($portfolio_style)) {
		   		$style = $portfolio_style;
		   	} else {
		   		$style = 'default';
		   	}
		   	if($style == 'default') {
		   		if(isset($ascend['portfolio_tax_style'])) {
		   			$style = $ascend['portfolio_tax_style'];
		   		} else {
		   			$style = 'pgrid';
		   		}
		   	}
  			if ($portfolio_filter == 'true' && $style != 'tiles') { 
  				$termtypes  = array( 'child_of' => $portfolio_type );
	  			ascend_iso_filter('portfolio-type', $termtypes);
            } 
            if($portfolio_ratio == 'softcrop') {
        		$isostyle 	= 'masonry';
        	} else {
        		$isostyle 	= 'fitRows';
        	}
        	$tileheight = '0';
        	$lastrow = 'nojustify';
            if($style == 'mosaic'){	
            	$isoclass 	= 'init-mosaic-isotope'; 
            	$isostyle 	= 'packery';
            	$margins 	= 'row-nomargin';
            } elseif($style == 'poststyle') {
            	$margins 	= 'row';
            	$isoclass 	= 'init-isotope-intrinsic'; 
            } elseif($style == 'pgrid-no-margin') {
            	$margins 	= 'row-nomargin';
            	$isoclass 	= 'init-isotope-intrinsic'; 
            } elseif($style == 'tiles') {
            	$margins 	= 'row-nomargin';
            	$isoclass 	= 'init-tiles-justified'; 
            	$tileheight = apply_filters('kadence_portfolio_tiles_height', '320' );
            	$lastrow 	= apply_filters('kadence_portfolio_tiles_last_row', 'nojustify' );
            } else {
            	$isoclass 	= 'init-isotope-intrinsic'; 
            	$margins 	= 'rowtight';
            }
            $kt_portfolio_loop = array(
             	'lightbox' 		=> $portfolio_lightbox,
             	'showexcerpt' 	=> $portfolio_excerpt,
             	'showtypes' 	=> $portfolio_item_types,
             	'columns' 		=> $portfolio_column,
             	'ratio' 		=> $portfolio_ratio,
             	'style' 		=> $style,
             	'carousel' 		=> 'false',
             	'tileheight' 	=> $tileheight,
            );

            	echo '<div class="kad-portfolio-wrapper-outer p-outer-'.esc_attr($style).'">';
               		echo '<div id="portfolio_template_wrapper" class="'.esc_attr($isoclass).' entry-content portfolio-grid-light-gallery '.esc_attr($margins).'" data-iso-selector=".p_item" data-iso-style="'.esc_attr($isostyle).'" data-iso-filter="'.esc_attr($portfolio_filter).'" data-gallery-height="'.esc_attr($tileheight).'" data-gallery-lastrow="'.esc_attr($lastrow).'" data-gallery-margins="3">';
				
					if(isset($wp_query)) {
						$temp = $wp_query;
					} else {
						$temp = null;
					}
				  	$wp_query = null; 
				  	$wp_query = new WP_Query();
				  	$wp_query->query(array(
						'paged' 			=> $paged,
						'orderby' 			=> $p_orderby,
						'order' 			=> $p_order,
						'post_type' 		=> 'portfolio',
						'portfolio-type'	=> $portfolio_type_slug,
						'posts_per_page' 	=> $portfolio_items
						)
				  	);
					
					if ( $wp_query ) : 
						$kt_portfolio_loop_count['loop'] = 1;
						$kt_portfolio_loop_count['count'] = $wp_query->post_count;
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
									get_template_part('templates/content', 'loop-portfolio'); 
									$kt_portfolio_loop_count['loop']++;
						endwhile; else: ?>
					 
							<div class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'ascend');?></div>
						
						<?php endif; ?>
                	</div> <!--portfoliowrapper-->
                </div> <!--portfoliowrapper-outer-->
                                    
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
